<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Stok extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load library
        $this->load->library(['template', 'form_validation']);
        //load model
        $this->load->model('m_stok');

        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    // ============================ MAIN FUNCTION ==================================
    public function index()
    {

        $this->is_admin();


        $data['title'] = 'Data Stok Barang';
        $data['cabang'] = $this->m_stok->getLocation();
        $this->template->kasir('stok/index', $data);
    }

    private function is_admin()
    {
        if (!$this->session->userdata('level') || $this->session->userdata('level') != 'admin') {
            redirect('dashboard');
        }
    }

    public function editStok_All()
    {
        $this->is_admin();
        //ketika user mengklik submit
        if ($this->input->post('submit', TRUE) == 'submit') {
            //validasi form
            $this->form_validation->set_rules(
                'nama_barang',
                'Nama Barang',
                "required|min_length[2]|max_length[100]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 2 karakter',
                    'max_length' => '{field} maksimal 100 karakter'
                )
            );

            $this->form_validation->set_rules(
                'nama_cabang',
                'Nama Lokasi',
                "required|min_length[10]|max_length[255]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 5 karakter',
                    'max_length' => '{field} maksimal 30 karakter'
                )
            );

            if ($this->input->post('hp', TRUE) != '') {
                $this->form_validation->set_rules(
                    'stok',
                    'Jumlah',
                    "required|min_length[8]|max_length[15]",
                    array(
                        'required' => '{field} wajib diisi',
                        'min_length' => '{field} minimal 8 karakter',
                        'max_length' => '{field} maksimal 15 karakter'
                    )
                );
            }

            $this->form_validation->set_rules(
                'cabangtj',
                'Cabang Tujuan',
                "required|min_length[10]|max_length[255]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 5 karakter',
                    'max_length' => '{field} maksimal 30 karakter'
                )
            );

            //jika validasi berhasil maka lakukan proses penyimpanan
            if ($this->form_validation->run() == TRUE) {
                //tampung data ke variabel
                $nama = $this->security->xss_clean($this->input->post('nama_barang', TRUE));
                $stok = $this->security->xss_clean($this->input->post('qty_inv', TRUE));
                $nama_lokasi = $this->security->xss_clean($this->input->post('nama_cabang', TRUE));
                $cabangTj = $this->security->xss_clean($this->input->post('cabangTj', TRUE));

                $data_simpan = [
                    'nama_supplier' => $nama,
                    'stok' => $stok,
                    'nama_lokasi' => $nama_lokasi
                ];

                $simpan = $this->m_stok->save('tbl_stok', $data_simpan);

                if ($simpan) {
                    $this->session->set_flashdata('success', 'Data Supplier berhasil ditambahkan..');

                    redirect('stok');
                }
            }
        }

        $data = [
            'title' => 'Tambah Data Stok',
            'data' => $this->m_stok->getAllData('tbl_barang'),
            'lokasi' => $this->m_stok->getAllData('tbl_lokasi'),
            'pembelian' => $this->m_stok->getAllData('tbl_pembelian'),
        ];

        $this->template->kasir('stok/form_editall', $data);
    }

    private function is_login()
    {
        if (!$this->session->userdata('level')) {
            redirect('login');
        }
    }

    public function edit_stok($id)
    {
        $this->is_admin();

        //ambil data
        $getData = $this->m_stok->getData('tbl_stok', ['id_stok' => $id]);
        //cek jumlah data
        if ($getData->num_rows() != 1) {
            redirect('stok');
        }
        //ketika user mengklik submit
        if ($this->input->post('submit', TRUE) == 'Update') {
            //validasi form
            $this->form_validation->set_rules(
                'id_stok',
                'Id Stok',
                "required|min_length[1]|max_length[100]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 1 karakter',
                    'max_length' => '{field} maksimal 100 karakter'
                )
            );

            $this->form_validation->set_rules(
                'id_cabang',
                'Nama Cabang',
                "required|min_length[1]|max_length[100]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 1 karakter',
                    'max_length' => '{field} maksimal 100 karakter'
                )
            );

            //jika validasi berhasil maka lakukan proses penyimpanan
            if ($this->form_validation->run() == TRUE) {
                //tampung data ke variabel
                $id_stok = $this->security->xss_clean($this->input->post('id_stok', TRUE));
                $id_cabang = $this->security->xss_clean($this->input->post('id_cabang', TRUE));

                $data_update = [
                    'id_cabang' => $id_cabang,
                ];

                $up = $this->m_stok->update('tbl_stok', $data_update, ['id_stok' => $id_stok]);

                if ($up) {
                    $this->session->set_flashdata('success', 'Data Stok berhasil diperbarui..');
                    redirect('stok');
                }
            }
        }

        //ambil data
        // $where = [
        //     'id_stok' => $this->security->xss_clean($id)
        // ];

        $data = [
            'title' => 'Edit Stok',
            'data' => $this->m_stok->getAllData('tbl_lokasi'),
            'stok' => $getData->row()
        ];

        $this->template->kasir('stok/form_editcabang', $data);
    }

    public function hapus_data()
    {
        //cek login
        $this->is_admin();
        //validasi request ajax
        if ($this->input->is_ajax_request()) {
            //validasi
            $this->form_validation->set_rules(
                'id',
                'Id stok',
                "required|min_length[1]",
                array(
                    'required' => '{field} tidak valid',
                    'min_length' => 'Isi {field} tidak valid'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                //tangkap rowid
                $id = $this->security->xss_clean($this->input->post('id', TRUE));

                $hapus = $this->m_stok->delete('tbl_stok', ['id_stok' => $id]);

                if ($hapus) {
                    echo json_encode(['message' => 'success']);
                }
            } else {
                echo json_encode(['message' => 'failed']);
            }
        } else {
            redirect('dashboard');
        }
    }

    public function ajax_stok()
    {


        $this->is_login();
        //cek apakah request berupa ajax atau bukan, jika bukan maka redirect ke home
        if ($this->input->is_ajax_request()) {

            if (!empty($_POST['cabang'])) {
                $this->db->where('nama_cabang', $_POST['cabang']);
            }
            //ambil list data
            $list = $this->m_stok->get_datatables();

            //siapkan variabel array
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $i) {

                $button = '';
                if ($this->session->userdata('level') == 'admin' || $this->session->userdata('UserID') == $i->id_user) :

                    $button .= '<a href="' . site_url('edit_stok/' . $i->id_stok) . '" class="btn btn-warning btn-sm text-white">Edit</a>
                    <button type="button" class="btn btn-danger btn-sm"onclick="hapus_stok(\'' . $i->id_stok . '\')">Hapus</button>';

                endif;

                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $i->nama_barang;
                $row[] = $i->nama_cabang;
                $row[] = $i->id_pembelian;
                $row[] = $i->id_penjualan;
                $row[] = $button;

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->m_stok->count_all(),
                "recordsFiltered" => $this->m_stok->count_filtered(),
                "data" => $data
            );
            //output to json format
            echo json_encode($output);
        } else {
            redirect('dashboard');
        }
    }
}

/* End of file Inv.php */