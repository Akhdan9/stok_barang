<?php
defined('BASEPATH') or exit('No direct script access allowed');

function tanggal_indo($tgl)
{
    $bulan  = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $exp    = explode('-', date('d-m-Y', strtotime($tgl)));

    return $exp[0] . ' ' . $bulan[(int) $exp[1]] . ' ' . $exp[2];
}
?>

<img src="<?= base_url('assets/img/ptsbmlogo.png'); ?>" class="logo" />
<hr class="mt-0" />
<h6 class="display-5 text-center mt-2 mb-0">Laporan Stok Barang</h6>
<hr class="mt-0" />
<table class="table table-sm table-bordered table-striped mt-3" id="export">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Kode Barang</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Brand</th>
            <th scope="col">Nama Cabang</th>
            <th scope="col">Stok Barang</th>
            <!-- <th scope="col" class="text-center">Stok Barang</th> -->
            <!-- <th scope="col" class="text-center">Qty Penjualan</th>
            <th scope="col" class="text-center">Qty Pembelian</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if ($data->num_rows() > 0) {
            foreach ($data->result() as $dt) {
                // $penjualan = ($dt->qty_penjualan_new != '') ? $dt->qty_penjualan_new : 0;
                // $pembelian = ($dt->qty_pembelian_new != '') ? $dt->qty_pembelian_new : 0;

                echo '<tr>';
                echo '<td>' . $i++ . '</td>';
                echo '<td>' . $dt->kode_barang . '</td>';
                echo '<td>' . $dt->nama_barang . '</td>';
                echo '<td>' . $dt->brand . '</td>';
                echo '<td>' . $dt->nama_cabang . '</td>';
                echo '<td>' . $dt->total . '</td>';
                // echo '<td class="text-center">' . (($dt->qty + $penjualan) - $pembelian) . '</td>';
                // echo '<td class="text-center">' . (($dt->qty_penjualan != '') ? $dt->qty_penjualan : 0) . '</td>';
                // echo '<td class="text-center">' . (($dt->qty_pembelian != '') ? $dt->qty_pembelian : 0) . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr>';
            echo '<td colspan="7" class="text-center">Data tidak ditemukan</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>