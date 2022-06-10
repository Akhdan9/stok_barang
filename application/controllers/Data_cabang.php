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
                $row[] = '<a href="' . site_url('cabang/' . $i->id_cabang) . '" class="btn btn-warning btn-sm text-white">Edit</a>
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
                "required|min_length[10]",
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