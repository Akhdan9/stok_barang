<?php
header("Content-type:application/octet-stream/");

header("Content-Disposition:attachment; filename=$title.xlsx");

header("Pragma: no-cache");

header("Expires: 0");

?>

<table>
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
</table>