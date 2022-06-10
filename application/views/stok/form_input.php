<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-reply"></i> Tambah Data stok</h4>
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
        <label for="nama_barang" class="col-sm-2 col-form-label">Barang</label>
        <div class="col-sm-6">
            <select class="custom-select custom-select-sm barang-select" id="id_barang">
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
        <label for="jumlahx" class="col-sm-2 col-form-label">Stok</label>
        <div class="col-sm-2">
            <input type="number" class="form-control form-control-sm" id="qty_inv" placeholder="Stok">
        </div>
    </div>
    <div class="form-group row">
        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
        <div class="col-sm-6">
            <select class="custom-select custom-select-sm lokasi <?= (form_error('lokasi')) ? 'is-invalid' : ''; ?>" id="id_cabang" name="id_cabang">
                <option value="" disabled selected>Pilih Lokasi</option>
                <?php foreach ($lokasi->result() as $l) : ?>
                    <option value="<?= $l->id_cabang; ?>">
                        <?= $l->nama_cabang; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= form_error('supplier', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-9 offset-md-3">
        <button type="submit" name="submit" class="btn btn-primary btn-sm" value="Submit">
            <i class="fa fa-save"></i> Simpan Data Stok
        </button>
            <button type="button" class="btn btn-light btn-sm" onclick="window.history.back()">Kembali</button>
        </div>
    </div>
</div>
<?= form_close(); ?>