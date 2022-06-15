<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-reply"></i> Tambah Data Penjualan Barang</h4>
    </div>
</div>
<hr class="mt-0" />
<div id="message">
    <?php if ($this->session->flashdata('alert')) : ?>
        <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('alert'); ?></div>
    <?php endif; ?>
</div>
<?= form_open(); ?>
<div class="col-md-12">
    <div class="form-group row">
        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Penjualan</label>
        <div class="col-sm-3">
            <input type="text" class="form-control form-control-sm <?= (form_error('tanggal')) ? 'is-invalid' : ''; ?>" name="tanggal" id="date-picker" value="<?= (set_value('tanggal')) ? set_value('tanggal') : date('d/m/Y'); ?>">
            <div class="invalid-feedback">
                <?= form_error('tanggal', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="pembeli" class="col-sm-2 col-form-label">Nama Pembeli</label>
        <div class="col-sm-6">
            <input type="text" name="pembeli" id="pembeli" class="form-control form-control-sm <?= (form_error('pembeli')) ? 'is-invalid' : ''; ?>" placeholder="Nama Pembeli" value="<?= (set_value('pembeli')) ? set_value('pembeli') : ''; ?>">
            <div class="invalid-feedback">
                <?= form_error('pembeli', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="barangx" class="col-sm-2 col-form-label">Barang</label>
        <div class="col-sm-6">
            <select class="custom-select custom-select-sm barang-select" id="barangx">
                <option value="" disabled selected>Pilih Barang</option>
                <?php foreach ($data->result() as $d) : ?>
                    <option value="<?= $d->kode_barang; ?>">
                        <?= $d->nama_barang; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="cabang" class="col-sm-2 col-form-label">Lokasi</label>
        <div class="col-sm-6">
            <select class="custom-select custom-select-sm barang-select" id="id_cabang">
                <option value="" disabled selected>Pilih Lokasi</option>
                <?php foreach ($lokasi->result() as $l) : ?>
                    <option value="<?= $l->id_cabang; ?>">
                        <?= $l->nama_cabang; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="jumlahx" class="col-sm-2 col-form-label">Jumlah Barang</label>
        <div class="col-sm-2">
            <input type="text" class="form-control form-control-sm qty" id="jumlahx" placeholder="Jumlah Beli">
        </div>
    </div>
    <div class="form-group row">
        <label for="harga" class="col-sm-2 col-form-label">Harga jual</label>
        <div class="col-sm-3">
            <input type="text" class="form-control form-control-sm uang" id="harga" placeholder="Harga Jual">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-3 offset-sm-2">
            <div id="rowid-field"></div>
            <div id="btn-act">
                <button type="button" class="btn btn-success btn-sm tambah-penjualan" onclick="tambah_pembelian()">
                    Tambah Barang
                </button>
            </div>
        </div>
    </div>
    
    <div class="table-responsive">
    <table class="table table-sm table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Qty</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Harga</th>
                <th scope="col">Harga Total</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody id="daftar-jual">
            <?= $table; ?>
        </tbody>
    </table>
    </div>
    <div class="col-sm-4 offset-sm-8">
        <button type="submit" name="submit" class="btn btn-primary btn-sm" value="Submit">
            <i class="fa fa-save"></i> Simpan Data Penjualan
        </button>
        <button type="button" onclick="window.history.back()" class="btn btn-light btn-sm">
            Kembali
        </button>
    </div>
</div>
<?= form_close(); ?>