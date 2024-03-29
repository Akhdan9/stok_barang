<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_penjualan extends CI_Model
{

    var $select = array('p.id_penjualan AS id_penjualan', 'tgl_penjualan', 'count(id_barang) AS jumlah', 'SUM(qty * harga) AS total', 'p.id_user AS id_user', 'fullname', 'nama_pembeli'); //data yang akan diambil

    var $table           = 'tbl_penjualan p
                            JOIN tbl_detail_penjualan dp ON(p.id_penjualan = dp.id_penjualan)
                            JOIN tbl_user u ON(p.id_user = u.id_user)';

    var $column_order    =  array(null, 'p.id_penjualan', 'tgl_penjualan', 'nama_pembeli', 'jumlah', 'total', 'fullname', null); //set column field database untuk datatable order
    var $column_search   =  array('p.id_penjualan', 'tgl_penjualan', 'nama_pembeli', 'fullname'); //set column field database untuk datatable search
    var $order = array('p.id_penjualan' => 'asc'); // default order

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


    function getBarang($id)
    {
        $this->db->select("*");
        $this->db->from("tbl_stok");
        $this->db->join("tbl_barang", "tbl_barang.kode_barang = tbl_stok.id_barang");
        $this->db->where("id_cabang", $id);
        $this->db->group_by("id_barang");
        $query = $this->db->get()->result();
        // $query = $this->db->group_by('id_barang')->get_where('tbl_stok', ['id_cabang' => $id])->result();
        return $query;
    }



    function getDataPenjualan($id)
    {
        $select = 'p.id_penjualan AS id_penjualan, tgl_penjualan, qty, dp.harga AS harga, kode_barang, nama_barang, fullname, u.id_user AS id_user, nama_pembeli, l.id_cabang AS id_cabang, nama_cabang';

        $table = 'tbl_penjualan p
                    LEFT JOIN tbl_detail_penjualan dp ON(p.id_penjualan = dp.id_penjualan)
                    LEFT JOIN tbl_barang b ON(dp.id_barang = b.kode_barang)
                    LEFT JOIN tbl_user u ON(p.id_user = u.id_user)';

        $where = array('p.id_penjualan' => $id);

        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);

        return $this->db->get();
    }

    function getDetailPenjualan($id)
    {
        $select = 'p.id_penjualan AS id_penjualan, tgl_penjualan, qty, dp.harga AS harga, kode_barang, nama_barang, fullname, u.id_user AS id_user, nama_pembeli, l.id_cabang AS id_cabang, nama_cabang';

        $table = 'tbl_detail_penjualan dp
                    LEFT JOIN tbl_penjualan p ON(dp.id_penjualan = p.id_penjualan)
                    LEFT JOIN tbl_barang b ON(dp.id_barang = b.kode_barang)
                    LEFT JOIN tbl_user u ON(p.id_user = u.id_user)
                    LEFT JOIN tbl_lokasi l ON(dp.id_cabang = l.id_cabang)';

        $where = array('p.id_penjualan' => $id);

        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);

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

    function multiUpdate($table = null, $data = array(), $where = '')
    {
        $jumlahUp = count($data);

        if ($jumlahUp > 0) {
            $this->db->update_batch($table, $data, $where);
        }
    }

    function getSqlUpdate($table = null, $data = null, $where = null)
    {
        return $this->db->get_compiled_update($table, $data, $where);
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

        $this->db->select($this->select);
        $this->db->from($this->table);
        $this->db->group_by(array('p.id_penjualan', 'tgl_penjualan', 'p.id_user', 'fullname', 'nama_pembeli'));

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
        $this->db->select($this->select);
        $this->db->from($this->table);
        $this->db->group_by(array('p.id_penjualan', 'tgl_penjualan', 'p.id_user', 'fullname', 'nama_pembeli'));

        return $this->db->count_all_results();
    }
}
