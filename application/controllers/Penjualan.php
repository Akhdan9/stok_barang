<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //load library
        $this->load->library(['template', 'form_validation', 'cart', 'cartpenj']);
        //load model
        $this->load->model('m_penjualan');
        $this->load->model('m_stok');

        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    public function index()
    {
        //cek login
        $this->is_login();
        //kosongkan cart
        $this->cart->destroy();

        $data = [
            'title' => 'Data penjualan Barang'
        ];

        $this->template->kasir('penjualan/index', $data);
    }

    public function tambah_data()
    {
        //cek login
        $this->is_login();
        // ketika button submit di klik
        if ($this->input->post('submit', TRUE) == 'Submit') {
            //cek apakah cart ada isinya atau kosong
            if (!$this->cart->contents()) {
                $this->session->set_flashdata('alert', 'Anda belum memilih barang...');

                redirect('tambah_penjualan', 'refresh');
            }
            //validasi input data
            $this->form_validation->set_rules(
                'tanggal',
                'Tanggal Pembelian',
                'required|callback_checkDateFormat',
                array(
                    'required' => '{field} wajib diisi',
                    'checkDateFormat' => '{field} tidak valid'
                )
            );

            $this->form_validation->set_rules(
                'pembeli',
                'Nama Pembeli',
                "required|min_length[3]|max_length[30]|regex_match[/^[A-Z a-z.']+$/]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'max_length' => '{field} maksimal 30 karakter',
                    'regex_match' => '{field} hanya boleh huruf, titik dan kutip satu (\')'
                )
            );

            if ($this->form_validation->run() == TRUE) {

                $id = 'ID' . time();
                $tgl = date('Y-m-d', strtotime(str_replace('/', '-', $this->security->xss_clean($this->input->post('tanggal', TRUE)))));
                $pembeli = $this->security->xss_clean($this->input->post('pembeli', TRUE));
                $user = $this->session->userdata('UserID');

                $data_penjualan = [
                    'id_penjualan' => $id,
                    'tgl_penjualan' => $tgl,
                    'nama_pembeli' => $pembeli,
                    'id_user' => $user,
                    // 'id_cabang' => $this->security->xss_clean($this->input->post('id_cabang', TRUE))
                ];
                //baca cart dan memasukkannya dalam array untuk disimpan
                $cart = array();

                //cart stock
                $cartPenj = array();
                
                $arrayP = array();

                //detail penjualan
                $countime = 0;
                foreach ($this->cartpenj->contents() as $c) {
                    $id_penjualan = $id;
                    $item = [
                        'id_penjualan' => $id,
                        'id_barang' => $c['id'],
                        'qty' => $c['qty'],
                        'harga' => $c['price'],
                        'id_cabang' => $c['id_cabang']
                    ];

                    for($x = 0; $x < $c['qty']; $x++ ){

                        $stock_temp = $this->m_penjualan->getData('tbl_stok', 'id_barang = '. $c['id'] . ' AND id_cabang = ' . $c['id_cabang'] . ' AND id_penjualan = ' . 0)->result_array();
                        // var_dump($stock_temp);
                        // die();
                        $itemP = [
                            'id_penjualan' => $id,
                            'id_stok' => $stock_temp[$x]['id_stok']
                        ];
                        
                        array_push($arrayP, $itemP);
    
                    }
                    
                    // //foreach sebanyak qty
                    // for($x = 1; $x <= $c['qty']; $x++){
                    //     $countime++;
                    //     $id_stok = 'ID' . time() + $countime;
                    //     $itemPenj = [
                    //         'id_stok' => $id . $x,
                    //         'id_barang' => $c['id'],
                    //         'id_cabang' => 1,
                    //         'id_penjualan' => $id_penjualan,
                    //     ];
                    //     //array push item stock to cart stock
                    //     array_push($cartPenj, $itemPenj);
                    // }

                    //push ke array cart
                    array_push($cart, $item);
                }
                
                //simpan data penjualan
                $simpan = $this->m_penjualan->save('tbl_penjualan', $data_penjualan);

                if ($simpan) {
                    //simpan data detail penjualan
                    $simpanPenjualan = $this->m_penjualan->multiSave('tbl_detail_penjualan', $cart);
                    //simpan stock 
                    $updateStok = $this->m_penjualan->multiUpdate('tbl_stok', $arrayP, 'id_stok');
                    // foreach($arrayP as $a){
                    //     $this->m_penjualan->getSqlUpdate('tbl_stok', $a, 'id_stok');
                    // }
                    if($simpanPenjualan && $updateStok){
                    //kosongkan cart
                    $this->cart->destroy();
                    //buat notifikasi penyimpanan berhasil
                    $this->session->set_flashdata('success', 'Data penjualan berhasil ditambahkan...');
                    }
                    redirect('data_penjualan');
                }
            }
        }

        $data = [
            'title' => 'Tambah Data penjualan Barang',
            'data' => $this->m_penjualan->getAllData('tbl_barang'),
            'lokasi' => $this->m_penjualan->getAllData('tbl_lokasi'),
            'table' => $this->read_cart()
        ];

        $this->template->kasir('penjualan/form_input', $data);
    }

    function get_sub_barang(){
        $id = $this->input->post('id',TRUE);
        $data = $this->m_penjualan->getBarang($id);
        $output = '<option value = "">--Pilih Barang-- </option>';
        foreach($data as $row){
            $output .= '<option value ="' . $row->id_barang .'"> '.$row->id_barang.'</option>';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    

    public function detail_penjualan($id_penjualan = null)
    {
        if ($id_penjualan == null) {
            redirect('data_penjualan');
        }

        $this->is_login();
        //ambil data
        $getData = $this->m_penjualan->getDetailPenjualan($this->security->xss_clean($id_penjualan));

        if ($getData->num_rows() < 1) {
            redirect('dashboard');
        }

        $data = [
            'title' => 'Detail Penjualan ' . $id_penjualan,
            'data' => $getData
        ];

        $this->template->kasir('penjualan/detail', $data);
    }

    public function hapus_penjualan()
    {
        //cek login
        $this->is_login();
        //validasi request ajax
        if ($this->input->is_ajax_request()) {
            //validasi
            $this->form_validation->set_rules(
                'id',
                'ID Penjualan',
                "required|min_length[10]",
                array(
                    'required' => '{field} tidak valid',
                    'min_length' => 'Isi {field} tidak valid'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                //tangkap id
                $id = $this->security->xss_clean($this->input->post('id', TRUE));

                $hapus = $this->m_penjualan->delete(['tbl_penjualan', 'tbl_detail_penjualan'], ['id_penjualan' => $id]);

                if ($hapus) {
                    echo json_encode(['message' => 'success']);
                } else {
                    echo json_encode(['message' => 'failed']);
                }
            } else {
                echo json_encode(['message' => 'failed']);
            }
        } else {
            redirect('dashboard');
        }
    }

    public function edit_penjualan($id)
    {
        if ($id == null) {
            redirect('data_penjualan');
        }

        $this->is_login();

        //ketika user menyimpan data
        if ($this->input->post('submit', TRUE) == 'Submit') {
            //cek apakah user sudah memilih barang atau belum, jika belum maka munculkan pesan kesalahan
            if (!$this->cart->contents()) {
                $this->session->set_flashdata('alert', 'Anda belum memilih barang...');

                redirect('edit_penjualan/' . $id, 'refresh');
            }
            //validasi input data tanggal
            $this->form_validation->set_rules(
                'tanggal',
                'Tanggal Pembelian',
                'required|callback_checkDateFormat',
                array(
                    'required' => '{field} wajib diisi',
                    'checkDateFormat' => '{field} tidak valid'
                )
            );

            $this->form_validation->set_rules(
                'pembeli',
                'Nama Pembeli',
                "required|min_length[3]|max_length[30]|regex_match[/^[A-Z a-z.']+$/]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'max_length' => '{field} maksimal 30 karakter',
                    'regex_match' => '{field} hanya boleh huruf, titik dan kutip satu (\')'
                )
            );

            $this->form_validation->set_rules(
                'idP',
                'ID Penjualan',
                'required|min_length[10]',
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} tidak valid'
                )
            );

            if ($this->form_validation->run() == TRUE) {

                $idP = $this->security->xss_clean($this->input->post('idP', TRUE));
                $tgl = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('tanggal', TRUE))));
                $pembeli = $this->security->xss_clean($this->input->post('pembeli', TRUE));

                $data_penjualan = [
                    'tgl_penjualan' => $tgl,
                    'nama_pembeli' => $pembeli
                ];

                //baca cart dan memasukkannya dalam array untuk disimpan
                $cart = array();

                foreach ($this->cart->contents() as $c) {
                    $item = [
                        'id_penjualan' => $idP,
                        'id_barang' => $c['id'],
                        'qty' => $c['qty'],
                        'harga' => $c['price'],
                        'id_cabang' => $c['id_cabang']
                    ];
                    //hapus session
                    $this->session->unset_userdata($c['id']);
                    //push ke array cart
                    array_push($cart, $item);
                }

                //simpan perubahan data penjualan
                $update = $this->m_penjualan->update('tbl_penjualan', $data_penjualan, ['id_penjualan' => $idP]);

                if ($update) {
                    //hapus detail penjualan
                    $this->m_penjualan->delete('tbl_detail_penjualan', ['id_penjualan' => $idP]);
                    //simpan data detail penjualan
                    $this->m_penjualan->multiSave('tbl_detail_penjualan', $cart);
                    //kosongkan cart
                    $this->cart->destroy();
                    //buat notifikasi penyimpanan berhasil
                    $this->session->set_flashdata('success', 'Data pembelian berhasil diperbarui...');

                    redirect('data_penjualan');
                }
            }
        }

        //ambil data penjualan
        $getData = $this->m_penjualan->getDetailPenjualan($this->security->xss_clean($id));

        //hitung data
        if ($getData->num_rows() < 1) {
            redirect('data_penjualan');
        }

        //cek apakah yang akses adalah admin / user yang menginputkan, jika bukan keduanya maka redirect ke halaman data pembelian
        $fData = $getData->row();

        if ($this->session->userdata('level') != 'admin' && $this->session->userdata('UserID') != $fData->id_user) {
            redirect('data_pembelian');
        }

        //masukkan detail penjualan ke cart
        if (!$this->cart->contents()) {
            $dataCart = [];

            foreach ($getData->result() as $c) {
                $keranjang = array(
                    'id'      => $c->kode_barang,
                    'qty'     => $c->qty,
                    'price'   => $c->harga,
                    'id_cabang' => $c->id_cabang,
                    'name'    => $c->nama_barang
                );

                array_push($dataCart, $keranjang);
            }

            $this->cart->insert($dataCart);
        }

        $data = [
            'title' => 'Edit Data Penjualan',
            'fdata' => $fData,
            'data' => $this->m_penjualan->getAllData('tbl_barang'),
            'lokasi' => $this->m_penjualan->getAllData('tbl_lokasi'),
            'table' => $this->read_cart()
        ];

        $this->template->kasir('penjualan/form_edit', $data);
    }


    public function tambah_cart_penjualan()
    {
        //cek login
        $this->is_login();
        //validasi request ajax
        if ($this->input->is_ajax_request()) {
            //validasi data
            $this->form_validation->set_rules(
                'barangx',
                'Barang',
                'required',
                array(
                    'required' => '{field} wajib dipilih',
                    'min_length' => 'Isi {field} tidak valid',
                )
            );

            $this->form_validation->set_rules(
                'jumlah',
                'Jumlah',
                "required",
                array(
                    'required' => '{field} wajib diisi'
                )
            );

            $this->form_validation->set_rules(
                'harga',
                'Harga Jual',
                "required",
                array(
                    'required' => '{field} wajib diisi'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                //ambil barang sesuai kode
                $get_barang = $this->m_penjualan->getData('tbl_barang', ['kode_barang' => $this->security->xss_clean($this->input->post('barangx', TRUE))]);

                if ($get_barang->num_rows() == 1) {
                    //fetch data barang dan masukkan kedalam cart
                    $b = $get_barang->row();
                    
                    $keranjang = array(
                        'id'      => $b->kode_barang,
                        'qty'     => $this->security->xss_clean($this->input->post('jumlah', TRUE)),
                        'price'   => $this->security->xss_clean(str_replace('.', '', $this->input->post('harga', TRUE))),
                        'id_cabang' => $this->security->xss_clean($this->input->post('id_cabang', TRUE)),
                        'name'    => $b->nama_barang
                    );

                    $this->cartpenj->insert($keranjang);

                    $table = $this->read_cartpenj();

                    $alert = '<div class="alert alert-success" role="alert">Data berhasil ditambahkan ke daftar</div>';

                    $status = 'success';

                    $arr = array('table' => $table, 'alert' => $alert, 'status' => $status);

                    echo json_encode($arr);

                    //cari item di dalam cart
                    // foreach ($this->cart->contents() as $c) {
                    //     if ($c['id'] == $b->kode_barang) {
                    //         $stok = $stok - $c['qty'];
                    //     }
                    // }

                    // if ($this->security->xss_clean($this->input->post('qty', TRUE)) > $stok) {

                    //     $alert = '<div class="alert alert-danger" role="alert">Jumlah beli melebihi stok yang ada</div>';

                    //     $status = 'gagal';
                    // } else {

                    // }
                
                } else {
                    $table = $this->read_cart();

                    $alert = '<div class="alert alert-danger" role="alert">Data tidak valid</div>';

                    $arr = array('table' => $table, 'alert' => $alert, 'status' => 'gagalaaa');

                    echo json_encode($arr);
                }
            } else {
                $table = $this->read_cart();

                $alert = '<div class="alert alert-danger" role="alert">' . validation_errors('<p class="mb-0 mt-0"><i class="fa fa-caret-right"></i> ', '</p>') . '</div>';

                $arr = array('table' => $table, 'alert' => $alert, 'status' => 'gagalll');

                echo json_encode($arr);
            }
        } else {
            redirect('dashboard');
        }
    }

    public function hapus_cart_penjualan()
    {
        //cek login
        $this->is_login();
        //validasi request ajax
        if ($this->input->is_ajax_request()) {
            //validasi
            $this->form_validation->set_rules(
                'rowid',
                'Row ID',
                "required|min_length[10]",
                array(
                    'required' => '{field} tidak valid',
                    'min_length' => 'Isi {field} tidak valid'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                //tangkap rowid
                $rowid = $this->security->xss_clean($this->input->post('rowid', TRUE));
                //ambil data barang dalam cart
                $get_item = $this->cart->get_item($rowid);
                //hapus session
                $this->session->unset_userdata($get_item['id']);
                //hapus cart
                $this->cart->remove($rowid);

                $alert = '<div class="alert alert-success" role="alert">Data barang berhasil dihapus</div>';

                $message = 'success';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">' . validation_errors('<p class="mb-0 mt-0"><i class="fa fa-caret-right"></i> ', '</p>') . '</div>';

                $message = 'failed';
            }

            $table = $this->read_cart();

            $arr = array('table' => $table, 'alert' => $alert, 'message' => $message);

            echo json_encode($arr);
        } else {
            redirect('dashboard');
        }
    }

    public function get_item_penjualan($uri = null)
    {
        $this->is_login();

        if ($this->input->is_ajax_request()) {
            //tangkap rowid
            $rowid = $this->security->xss_clean($this->input->post('rowid', TRUE));

            $get_item = $this->cart->get_item($rowid);

            if ($get_item) {
                //cek item dalam database untuk mengambil stok terakhir dan ditambah stok barang yang akan dijual
                $getBarang = $this->m_penjualan->getData('tbl_stok', ['id_cabang' => $get_item['id']]);

                if ($getBarang->num_rows() != 1) {
                    $arr = [
                        'lokasi' => '',
                        'barang' => '',
                        'qty' => '',
                        'rowid' => '',
                        'table' => $this->read_cart(),
                        'status' => 'false'
                    ];
                } else {
                    $b = $getBarang->row();

                    if (strtolower($uri) == 'edit_penjualan') {

                        if ($this->session->userdata($get_item['id'])) {
                            $stok = $this->session->userdata($get_item['id']);
                        } 
                    } 
                    $arr = [
                        'lokasi' => $get_item['id_cabang'],
                        'barang' => $get_item['id'],
                        'qty' => $get_item['qty'],
                        // 'rowid' => '<input type="hidden" id="rowid" value="' . $get_item['rowid'] . '" /><input type="hidden" id="lastQty" value="' . $stok . '">',
                        'table' => $this->read_cart(),
                        'status' => 'true'
                    ];
                }
            } else {
                $arr = [
                    'lokasi' => '',
                    'barang' => '',
                    'qty' => '',
                    'rowid' => '',
                    'table' => $this->read_cart(),
                    'status' => 'false'
                ];
            }

            echo json_encode($arr);
        } else {
            redirect('dashboard');
        }
    }

    public function update_cart_penjualan()
    {
        //cek login
        $this->is_login();
        //validasi request ajax
        if ($this->input->is_ajax_request()) {
            //validasi data
            $this->form_validation->set_rules(
                'id',
                'Barang',
                'required|min_length[4]|max_length[6]',
                array(
                    'required' => '{field} wajib dipilih',
                    'min_length' => 'Isi {field} tidak valid',
                    'max_length' => 'Isi {field} tidak valid',
                )
            );

            $this->form_validation->set_rules(
                'jumlah',
                'Jumlah',
                "required|min_length[1]|regex_match[/^[0-9]+$/]|greater_than[0]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => 'Isi {field} tidak valid',
                    'regex_match' => '{field} hanya boleh angka',
                    'greater_than' => '{field} harus lebih dari nol'
                )
            );

            $this->form_validation->set_rules(
                'rowid',
                'Row ID',
                "required|min_length[10]",
                array(
                    'required' => '{field} tidak valid',
                    'min_length' => 'Isi {field} tidak valid'
                )
            );

            if ($this->form_validation->run() == TRUE) {

                //ambil barang sesuai kode
                $where = [
                    'kode_barang' => $this->security->xss_clean($this->input->post('id', TRUE))
                ];

                $get_barang = $this->m_penjualan->getData('tbl_barang', $where);

                if ($get_barang->num_rows() == 1) {
                    //fetch data barang dan masukkan kedalam cart
                    $b = $get_barang->row();
                    $stok = $b->stok;
                    //cari item di dalam cart
                    foreach ($this->cart->contents() as $c) {
                        if ($c['id'] == $b->kode_barang) {
                            $stok = $stok + $c['qty'];
                        }
                    }

                    if ($this->security->xss_clean($this->input->post('qty', TRUE)) > $stok) {

                        $alert = '<div class="alert alert-danger" role="alert">Jumlah beli melebihi stok yang ada</div>';

                        $status = 'gagal';
                    } else {
                        $keranjang = array(
                            'rowid' => $this->security->xss_clean($this->input->post('rowid', TRUE)),
                            'qty' => $this->security->xss_clean($this->input->post('jumlah', TRUE))
                        );

                        $this->cart->update($keranjang);

                        $table = $this->read_cart();

                        $alert = '<div class="alert alert-success" role="alert">Data barang berhasil diubah</div>';

                        $status = 'success';
                    }

                    $table = $this->read_cart();

                    $arr = array('table' => $table, 'alert' => $alert, 'status' => $status);
                } else {
                    $table = $this->read_cart();

                    $alert = '<div class="alert alert-danger" role="alert">Barang tidak ditemukan</div>';

                    $arr = array('table' => $table, 'alert' => $alert, 'status' => 'gagal');
                }

                echo json_encode($arr);
            } else {
                $table = $this->read_cart();

                $alert = '<div class="alert alert-danger" role="alert">' . validation_errors('<p class="mb-0 mt-0"><i class="fa fa-caret-right"></i> ', '</p>') . '</div>';

                $arr = array('table' => $table, 'alert' => $alert, 'status' => 'gagal');

                echo json_encode($arr);
            }
        } else {
            redirect('dashboard');
        }
    }

    function checkDateFormat($date)
    {
        if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $date)) {
            if (checkdate(substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4))) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function ajax_penjualan()
    {
        $this->is_login();
        //cek apakah request berupa ajax atau bukan, jika bukan maka redirect ke home
        if ($this->input->is_ajax_request()) {
            //ambil list data
            $list = $this->m_penjualan->get_datatables();
            //siapkan variabel array
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $i) {

                $button = '';
                if ($this->session->userdata('level') == 'admin' || $this->session->userdata('UserID') == $i->id_user) :

                    $button .= '<a href="' . site_url('edit_penjualan/' . $i->id_penjualan) . '" class="btn btn-warning btn-sm text-white">Edit</a>
                        <button type="button" class="btn btn-danger btn-sm"onclick="hapus_penjualan(\'' . $i->id_penjualan . '\')">Hapus</button>';

                endif;

                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $i->id_penjualan;
                $row[] = $this->tanggal_indo($i->tgl_penjualan);
                $row[] = $i->nama_pembeli;
                $row[] = $i->jumlah;
                $row[] = '<span class="pr-3">' . number_format($i->total, 0, ',', '.') . ',-</span>';
                $row[] = $i->fullname;
                $row[] = '<a href="' . site_url('data_penjualan/' . $i->id_penjualan) . '" class="btn btn-sm btn-success">Detail</a>
                ' . $button;

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->m_penjualan->count_all(),
                "recordsFiltered" => $this->m_penjualan->count_filtered(),
                "data" => $data
            );
            //output to json format
            echo json_encode($output);
        } else {
            redirect('dashboard');
        }
    }

    private function read_cart()
    {
        if ($this->cart->contents()) {

            $table = '';
            $i = 1;
            foreach ($this->cart->contents() as $c) {
                $table .= '<tr><td>' . $i++ . '</td>';
                $table .= '<td>' . $c['name'] . '</td>';
                $table .= '<td class="text-center">' . $c['qty'] . '</td>';
                $table .= '<td class="text-center">' . $c['id_cabang'] . '</td>';
                $table .= '<td class="text-right">' . number_format($c['price'], 0, ',', '.') . '</td>';
                $table .= '<td class="text-right">' . number_format($c['subtotal'], 0, ',', '.') . '</td>';
                $table .= '<td class="text-center">
                                <button type="button" class="btn btn-warning btn-sm text-white" onclick="get_item_penjualan(\'' . $c['rowid'] . '\')">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm text-white" onclick="hapus_item_penjualan(\'' . $c['rowid'] . '\')">Hapus</button>
                            </td></tr>';
            }
            $table .= '<tr>
                        <td scope="col" colspan="4" class="text-center"><b><i>Total Harga</i></b></td>
                        <td scope="col" class="text-right"><b>' . number_format($this->cart->total(), 0, ',', '.') . '</b></td>
                        <td scope="col"></td>
                    </tr>';
        } else {
            $table = '<tr>
                        <td scope="col" colspan="6" class="text-center"><i>Belum ada data</i></td>
                    </tr>';
        }

        return $table;
    }

    private function read_cartPenj()
    {
        if ($this->cartpenj->contents()) {

            $table = '';
            $i = 1;
            foreach ($this->cartpenj->contents() as $c) {
                $table .= '<tr><td>' . $i++ . '</td>';
                $table .= '<td>' . $c['name'] . '</td>';
                $table .= '<td class="text-center">' . $c['qty'] . '</td>';
                $table .= '<td class="text-center">' . $c['id_cabang'] . '</td>';
                $table .= '<td class="text-right">' . number_format($c['price'], 0, ',', '.') . '</td>';
                $table .= '<td class="text-right">' . number_format($c['subtotal'], 0, ',', '.') . '</td>';
                $table .= '<td class="text-center">
                                <button type="button" class="btn btn-warning btn-sm text-white" onclick="get_item_penjualan(\'' . $c['rowid'] . '\')">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm text-white" onclick="hapus_item_penjualan(\'' . $c['rowid'] . '\')">Hapus</button>
                            </td></tr>';
            }
            $table .= '<tr>
                        <td scope="col" colspan="4" class="text-center"><b><i>Total Harga</i></b></td>
                        <td scope="col" class="text-right"><b>' . number_format($this->cartpenj->total(), 0, ',', '.') . '</b></td>
                        <td scope="col"></td>
                    </tr>';
        } else {
            $table = '<tr>
                        <td scope="col" colspan="6" class="text-center"><i>Belum ada data</i></td>
                    </tr>';
        }

        return $table;
    }

    private function tanggal_indo($tgl)
    {
        $bulan  = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $exp    = explode('-', date('d-m-Y', strtotime($tgl)));

        return $exp[0] . ' ' . $bulan[(int) $exp[1]] . ' ' . $exp[2];
    }

    private function is_login()
    {
        if (!$this->session->userdata('UserID')) {
            redirect('dashboard');
        }
    }
}
