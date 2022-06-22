<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_cabang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //load library
        $this->load->library(['template', 'form_validation']);
        //load model
        $this->load->model('m_cabang');

        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    public function index()
    {
        //cek apakah user yang login adalah admin atau bukan
        //jika bukan maka alihkan ke dashboard
        $this->is_admin();

        $data = [
            'title' => 'Data Cabang'
        ];

        $this->template->kasir('cabang/index', $data);
    }

    public function tambah_cabang()
    {
        //cek apakah user yang login adalah admin atau bukan
        //jika bukan maka alihkan ke dashboard
        $this->is_admin();

        if ($this->input->post('submit', TRUE) == 'submit') {
            //set rules form validasi
            

            $this->form_validation->set_rules(
                'nama_cabang',
                'Nama Cabang',
                'required|min_length[3]|max_length[255]',
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'max_length' => '{field} maksimal 255 karakter'
                )
            );

            //jika data sudah valid maka lakukan proses penyimpanan
            if ($this->form_validation->run() == TRUE) {
                //masukkan data ke variable array
                $simpan = array(
                    'nama_cabang' => $this->security->xss_clean($this->input->post('nama_cabang', TRUE)),
                );

                //simpan ke database
                $save = $this->m_cabang->save('tbl_lokasi', $simpan);

                if ($save) {
                    $this->session->set_flashdata('success', 'Data Barang berhasil ditambah...');

                    redirect('cabang');
                }
            }
        }

        $data = [
            'title' => 'Tambah Data Cabang'
        ];

        $this->template->kasir('cabang/form_input', $data);
    }

    public function edit_cabang($id)
    {
        $this->is_admin();

        //ketika user mengklik submit
        if ($this->input->post('submit', TRUE) == 'submit') {
            // validasi form
            $this->form_validation->set_rules(
                'id_cabang',
                'ID Cabang',
                'required',
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} tidak valid'
                )
            );

            $this->form_validation->set_rules(
                'nama_cabang',
                'Nama Cabang',
                "required|min_length[2]|max_length[100]",
                array(
                    'required' => '{field} wajib diisi',
                    'min_length' => '{field} minimal 2 karakter',
                    'max_length' => '{field} maksimal 100 karakter'
                )
            );

            // if ($this->input->post('hp', TRUE) != '') {
            //     $this->form_validation->set_rules(
            //         'hp',
            //         'Nomor Telp.',
            //         "required|min_length[8]|max_length[15]",
            //         array(
            //             'required' => '{field} wajib diisi',
            //             'min_length' => '{field} minimal 8 karakter',
            //             'max_length' => '{field} maksimal 15 karakter'
            //         )
            //     );
            // }

            // $this->form_validation->set_rules(
            //     'alamat',
            //     'Alamat',
            //     "required|min_length[10]|max_length[255]",
            //     array(
            //         'required' => '{field} wajib diisi',
            //         'min_length' => '{field} minimal 5 karakter',
            //         'max_length' => '{field} maksimal 30 karakter'
            //     )
            // );

            //jika validasi berhasil maka lakukan proses penyimpanan
            if ($this->form_validation->run() == TRUE) {
                //tampung data ke variabel
                $id_cabang = $this->security->xss_clean($this->input->post('id_cabang', TRUE));
                $nama = $this->security->xss_clean($this->input->post('nama_cabang', TRUE));
                

                $data_update = [
                    'nama_cabang' => $nama
                ];

                $up = $this->m_cabang->update('tbl_lokasi', $data_update, ['id_cabang' => $id_cabang]);

                if ($up) {
                    $this->session->set_flashdata('success', 'Data cabang berhasil diperbarui..');
                    redirect('cabang');
                }
            }
        }

        //ambil data
        $where = [
            'id_cabang' => $this->security->xss_clean($id)
        ];
        $getData = $this->m_cabang->getData('tbl_lokasi', $where);
        //cek jumlah data
        if ($getData->num_rows() != 1) {
            redirect('cabang');
        }

        $data = [
            'title' => 'Edit Cabang',
            'data' => $getData->row()
        ];

        $this->template->kasir('cabang/form_edit', $data);
    }


    public function ajax_cabang()
    {
        $this->is_admin();
        //cek apakah request berupa ajax atau bukan, jika bukan maka redirect ke home
        if ($this->input->is_ajax_request()) {
            //ambil list data
            $list = $this->m_cabang->get_datatables();
            //siapkan variabel array
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $i) {

                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $i->nama_cabang;
                $row[] = '<a href="' . site_url('edit_cabang/' . $i->id_cabang) . '" class="btn btn-warning btn-sm text-white">Edit</a>
                <button type="button" class="btn btn-danger btn-sm"onclick="hapus_cabang(\'' . $i->id_cabang . '\')">Hapus</button>';

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->m_cabang->count_all(),
                "recordsFiltered" => $this->m_cabang->count_filtered(),
                "data" => $data
            );
            //output to json format
            echo json_encode($output);
        } else {
            redirect('dashboard');
        }
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
                'Id cabang',
                "required|min_length[1]",
                array(
                    'required' => '{field} tidak valid',
                    'min_length' => 'Isi {field} tidak valid'
                )
            );

            if ($this->form_validation->run() == TRUE) {
                //tangkap rowid
                $id = $this->security->xss_clean($this->input->post('id', TRUE));

                $hapus = $this->m_cabang->delete('tbl_lokasi', ['id_cabang' => $id]);

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

    public function delete_cabang($id_cabang)
    {
        $this->db->where('id_cabang', $id_cabang)->delete('tbl_lokasi');
        redirect('data_cabang');
    }

    private function is_admin()
    {
        if (!$this->session->userdata('level') || $this->session->userdata('level') != 'admin') {
            redirect('dashboard');
        }
    }

}