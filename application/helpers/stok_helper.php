<?php

/**
 * Mendapatkan jumlah karyawan
 */
function getJumlahPembelian()
{
    $CI = &get_instance();
    $CI->db->select_sum('qty');
    $result = $CI->db->get('tbl_detail_pembelian')->row();
    return $result->qty;
}
/**
 * Mendapatkan jumlah supplier
 */
function getJumlahSupplier()
{
    $CI = &get_instance();
    return $CI->db->get('tbl_supplier')->num_rows();
}

/**
 * Mendapatkan jumlah supplier
 */
function getJumlahBarang()
{
    $CI = &get_instance();
    return $CI->db->get('tbl_barang')->num_rows();
}

/**
 * Mendapatkan jumlah stok
 */
function getJumlahPenjualan()
{
    $CI = &get_instance();
    $CI->db->select_sum('qty');
    $result = $CI->db->get('tbl_detail_penjualan')->row();
    return $result->qty;
}
