<?php
defined('BASEPATH') or exit('No direct script access allowed');

//fungsi untuk merubah nama hari menjadi hari indonesia
function hari_ini()
{
    switch (date('D')) {
        case 'Sun':
            $hari = 'Minggu';
            break;
        case 'Mon':
            $hari = 'Senin';
            break;
        case 'Tue':
            $hari = 'Selasa';
            break;
        case 'Wed':
            $hari = 'Rabu';
            break;
        case 'Thu':
            $hari = 'Kamis';
            break;
        case 'Fri':
            $hari = 'Jum\'at';
            break;
        case 'Sat':
            $hari = 'Sabtu';
            break;

        default:
            $hari = 'Hari tidak diketahui';
            break;
    }

    return $hari;
}

//fungsi untuk merubah format tanggal menjadi tanggal indonesia
function tanggal_indo()
{
    $bulan  = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $exp    = explode('-', date('d-m-Y'));

    return $exp[0] . ' ' . $bulan[(int) $exp[1]] . ' ' . $exp[2];
}

?>

<div class="alert alert-info" role="alert">
    <p class="mb-0 text-right"><b><i class="fa fa-calendar"></i> <?= hari_ini(); ?>, <?= tanggal_indo(); ?></b></p>
    <hr>
    <h4 class="alert-heading"><i class="fa fa-info-circle"></i> Selamat Datang di <b>Aplikasi Stok Barang</b>
    </h4>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= getJumlahSupplier() ?></h3>

                        <p>Supplier</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= getJumlahBarang() ?></h3>

                        <p>Barang</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= getJumlahPembelian() ?></h3>

                        <p>Stok Pembelian</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= getJumlahPenjualan() ?></h3>

                        <p>Stok Penjualan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>