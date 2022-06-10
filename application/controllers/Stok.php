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

        $this->template->kasir('stok/index', $data);
    }

    private function is_admin()
    {
        if (!$this->session->userdata('level') || $this->session->userdata('level') != 'admin') {
            redirect('dashboard');
        }
    }

    public function tambah_data()
    {
        //cek apakah user yang login adalah admin atau bukan
        //jika bukan maka alihkan ke dashboard
        $this->is_admin();
        if ($this->input->post('submit', TRUE) == 'submit') {
            //set rules form validasi
        

            //jika data sudah valid maka lakukan proses penyimpanan
            if ($this->form_validation->run() == TRUE) {
                //masukkan data ke variable array
                $simpan = array(
                    'nama_barang' => $this->security->xss_clean($this->input->post('nama_barang', TRUE)),
                    'qty_inv' => $this->security->xss_clean($this->input->post('qty_inv', TRUE)),
                    'nama_cabang' => $this->security->xss_clean($this->input->post('nama_cabang', TRUE))
                );

                //simpan ke database
                $save = $this->m_stok->save('tbl_stok', $simpan);

                if ($save) {
                    $this->session->set_flashdata('success', 'Data Barang berhasil ditambah...');

                    redirect('stok');
                } else {
                    $this->session->set_flashdata('error', 'gagal');
                    redirect('dashboard');
                }
            }
            
        }

        $data = [
            'title' => 'Tambah Data Stok',
            'data' => $this->m_stok->getAllData('tbl_barang'),
            'lokasi' => $this->m_stok->getAllData('tbl_lokasi'),
            'pembelian' => $this->m_stok->getAllData('tbl_pembelian'),
        ];

        $this->template->kasir('stok/form_input', $data);
        
    }

}

/* End of file Inv.php */