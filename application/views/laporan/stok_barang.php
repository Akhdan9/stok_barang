<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-file-text"></i> Laporan Stok Barang</h4>
    </div>
</div>
<hr class="mt-0" />
<?php
if ($this->session->flashdata('alert')) {
    echo '<div class="alert alert-danger" role="alert">
    ' . $this->session->flashdata('alert') . '
  </div>';
}
?>
<div class="row">
    <div class="col-md-10 col-sm-12">
        <?= form_open('', ['class' => "form-inline"]); ?>
        <div class="form-group mx-sm-3 mb-2">
            <select class="custom-select custom-select-sm id_cabang " id="id_cabang" name="id_cabang">
                <?php
                if ($selected_loc == '') {
                ?>
                    <option value="" selected>Semua Cabang</option>
                <?php
                } else {
                ?>
                    <option value="">Semua Cabang</option>
                <?php
                }
                ?>
                <?php
                foreach ($lokasi as $loc) {
                    if ($selected_loc == $loc->id_cabang) {
                ?>
                        <option selected value="<?= $loc->id_cabang; ?>"><?= $loc->nama_cabang; ?> </option>
                    <?php
                    } else {
                    ?>
                        <option value="<?= $loc->id_cabang; ?>"><?= $loc->nama_cabang; ?> </option>
                <?php
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-2 btn-sm" name="cari" value="Search">
            Cari Data
        </button>
        <?= form_close(); ?>
    </div>
    <div class="col-md-2 col-sm-12">
        <a href="<?= site_url('print'); ?>" class="btn btn-success btn-block btn-sm">
            <i class="fa fa-print"></i> Print
        </a>
    </div>
</div>
<table class="table table-sm table-bordered table-striped mt-3">
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