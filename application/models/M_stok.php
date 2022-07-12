<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_stok extends CI_Model
{
    var $select = array('s.id_stok AS id_stok', 'nama_barang', 'nama_cabang', 'id_pembelian', 'id_penjualan'); //data yang akan diambil
    var $table           = '((((tbl_stok s 
                                LEFT JOIN tbl_barang b ON(s.id_barang = b.kode_barang))
                                LEFT JOIN tbl_lokasi l ON(s.id_cabang = l.id_cabang))
                                LEFT JOIN tbl_pembelian p ON(s.id_pembelian = p.id_pembelian))
                                LEFT JOIN tbl_penjualan j ON(s.id_penjualan = j.id_penjualan))';

    var $column_order    =  array(null, 's.id_stok', 'nama_barang', 'nama_cabang', 'id_pembelian', 'id_penjualan', null); //set column field database untuk datatable order
    var $column_search   =  array('s.id_stok', 'nama_barang', 'nama_cabang'); //set column field database untuk datatable search

    function __construct()
    {
        parent::__construct();
    }

    function getAllData($table = null)
    {
        return $this->db->get($table);
    }

    function getData($table = null, $where = null)
    {
        $this->db->from($table);
        $this->db->where($where);

        return $this->db->get();
    }

    public function getLocation($where = null)
    {
        $this->db->select('tbl_stok.id_cabang, kode_barang, nama_barang, brand, nama_cabang, COUNT(*) as total');
        $this->db->from('tbl_stok');
        $this->db->join('tbl_barang', 'tbl_stok.id_barang = tbl_barang.kode_barang');
        $this->db->join('tbl_lokasi', 'tbl_stok.id_cabang = tbl_lokasi.id_cabang');
        $this->db->group_by(array("tbl_stok.id_cabang", "nama_barang"));
        if ($where != '') {
            $this->db->where('tbl_stok.id_cabang = ' . $where);
        }
        return $this->db->get();
    }


    function save($table = null, $data = null)
    {
        return $this->db->insert($table, $data);
    }
    function multiSave($table = null, $data = array())
    {
        $jumlah = count($data);

        if ($jumlah > 0) {
            $this->db->insert_batch($table, $data);
        }
    }

    function update($table = null, $data = null, $where = null)
    {
        return $this->db->update($table, $data, $where);
    }

    function delete($table = null, $where = null)
    {
        $this->db->where($where);
        $this->db->delete($table);

        return $this->db->affected_rows();
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // loop column
        {
            if ($_POST['search']['value']) // Jika datatable mengirim POST untuk search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket.

                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) { //last loop
                    $this->db->group_end(); //close bracket
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) // Proses order
        {

            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {

            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();

            return $query->result();
        }
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();

        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from($this->table);

        return $this->db->count_all_results();
    }
}
