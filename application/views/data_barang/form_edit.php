<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12 col-md-10">
        <h4 class="mb-0"><i class="fa fa-cubes"></i> Edit Data Barang</h4>
    </div>
</div>
<hr class="mt-0" />
<?= form_open(); ?>
<div class="col-md-8">
    
<div class="form-group row">
        <label for="KodeBarang" class="col-sm-3 col-form-label">Kode Barang</label>
        <div class="col-sm-9 col-md-6">
            <input type="text" class="form-control form-control-sm <?= (form_error('kode')) ? 'is-invalid' : ''; ?>" id="KodeBarang" required name="kode" placeholder="Kode Barang" value="<?= $barang->kode_barang; ?>" readonly>
            <input type="hidden" name="ID" value="<?= $barang->kode_barang; ?>" />
            <div class="invalid-feedback">
                <?= form_error('kode', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm <?= (form_error('nama_barang')) ? 'is-invalid' : ''; ?>" id="nama_barang" name="nama_barang" placeholder="Nama Barang" value="<?= (set_value('nama_barang')) ? set_value('nama_barang') : $barang->nama_barang; ?>">
            <div class="invalid-feedback">
                <?= form_error('nama_barang', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="brand" class="col-sm-3 col-form-label">Brand</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm <?= (form_error('brand')) ? 'is-invalid' : ''; ?>" id="brand" name="brand" placeholder="Nama Brand" value="<?= (set_value('brand')) ? set_value('brand') : $barang->brand; ?>">
            <div class="invalid-feedback">
                <?= form_error('brand', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="item_no" class="col-sm-3 col-form-label">Item No</label>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm <?= (form_error('item_no')) ? 'is-invalid' : ''; ?>" id="item_no" name="item_no" placeholder="Item No" value="<?= (set_value('item_no')) ? set_value('item_no') : $barang->item_no; ?>">
            <div class="invalid-feedback">
                <?= form_error('item_no', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="size" class="col-sm-3 col-form-label">Size</label>
        <div class="col-sm-6">
            <input type="text" class="form-control form-control-sm <?= (form_error('size')) ? 'is-invalid' : ''; ?>" id="size" name="size" placeholder="Size" value="<?= (set_value('size')) ? set_value('size') : $barang->size; ?>">
            <div class="invalid-feedback">
                <?= form_error('size', '<p class="error-message">', '</p>'); ?>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-9 offset-md-3">
            <button type="submit" name="update" value="Update" class="btn btn-primary btn-sm">Update Data</button>
            <button type="button" class="btn btn-light btn-sm" onclick="window.history.back()">Kembali</button>
        </div>
    </div>
</div>
<?= form_close(); ?>