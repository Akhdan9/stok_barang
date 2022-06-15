<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-cubes"></i> Edit Data Cabang</h4>
    </div>
</div>
<hr class="mt-0" />
<?= form_open(); ?>
<input type="hidden" name="id_stok" value="<?= $stok->id_stok; ?>" />
<div class="col-md-8">
    <div class="form-group row">
        <label for="nama_cabang" class="col-sm-3 col-form-label">Nama Cabang</label>
        <div class="col-sm-9">
        <select class="custom-select custom-select-sm id_cabang <?= (form_error('id_cabang')) ? 'is-invalid' : ''; ?>" id="id_cabang" name="id_cabang">
                <option value="" disabled selected>Pilih Cabang</option>
                <?php
                foreach ($data->result() as $s) :
                    $sup = (set_value('data')) ? set_value('data') : $stok->id_cabang;

                    $pilih = ($sup == $s->id_cabang) ? 'selected' : '';

                    echo '<option value="' . $s->id_cabang . '" ' . $pilih . '>
                        ' . $s->nama_cabang . '
                    </option>';
                endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= form_error('nama_barang', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-9 offset-md-3">
            <button type="submit" name="submit" value="Update" class="btn btn-primary btn-sm">Update Data</button>
            <button type="button" class="btn btn-light btn-sm" onclick="window.history.back()">Kembali</button>
        </div>
    </div>
</div>
<?= form_close(); ?>