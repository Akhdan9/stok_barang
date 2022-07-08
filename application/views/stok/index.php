<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-cubes"></i> Data Stok</h4>
    </div>
    <div class="col-sm-12 col-md-2">
        <!-- <a href="<?= site_url('tambah_stok'); ?>" class="btn btn-success btn-sm btn-block">Edit Stok</a> -->
    </div>
</div>
<hr class="mt-0" />
<?php
//tampilkan pesan success
if ($this->session->flashdata('success')) {
    echo '<div class="alert alert-success" role="alert">
    ' . $this->session->flashdata('success') . '
  </div>';
}

//tampilkan pesan error
if ($this->session->flashdata('error')) {
    echo '<div class="alert alert-danger" role="alert">
    ' . $this->session->flashdata('error') . '
  </div>';
}
?>
<div class="row">
    <div class="col-md-10 col-sm-12">
        <?= form_open('', ['class' => "form-inline"]); ?>
        <div class="form-group mx-sm-2 mb-2">
            <label for="cabang" class="sr-only">Lokasi</label>
            <select id="id_cabang" class="form-control form-control-sm" style="min-width:150px">
                <option value="">-- Select Location --</option>
                <?php
                foreach ($cabang as $c) { ?>
                    <option value="<?= $c->id_cabang ?>"><?= $c->nama_cabang ?></option>
                <?php }
                ?>
            </select>
        </div>
        <?= form_close(); ?>
    </div>
    <!-- <div class="col-md-2 col-sm-12">
        <a href="<?= site_url('stok_tahunan/' . $tahun); ?>" class="btn btn-success btn-block btn-sm" target="_blank">
            <i class="fa fa-print"></i> Cetak Laporan
        </a>
    </div> -->
</div>


<div class="table-responsive">
    <table class="table table-sm table-hover table-striped" id="stok">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Nama Lokasi</th>
                <th scope="col">ID Pembelian</th>
                <th scope="col">ID Penjualan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>