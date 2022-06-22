<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-truck"></i> Edit Data cabang</h4>
    </div>
</div>
<hr class="mt-0" />
<?= form_open(); ?>
<input type="hidden" name="id_cabang" value="<?= $data->id_cabang; ?>" />
<div class="col-md-8">
    <div class="form-group row">
        <label for="nama_supplier" class="col-sm-3 col-form-label">Nama Cabang</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm <?= (form_error('nama_cabang')) ? 'is-invalid' : ''; ?>" id="nama_cabang" required autofocus name="nama_cabang" placeholder="Nama Cabang" value="<?= (set_value('nama_cabang')) ? set_value('nama_cabang') : $data->nama_cabang; ?>">
            <div class="invalid-feedback">
                <?= form_error('nama_cabang', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    

    <div class="form-group row">
        <div class="col-sm-9 offset-md-3">
            <button type="submit" name="submit" value="submit" class="btn btn-primary btn-sm">Update Data</button>
            <button type="button" class="btn btn-light btn-sm" onclick="window.history.back()">Kembali</button>
        </div>
    </div>
</div>
<?= form_close(); ?>