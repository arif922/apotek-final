<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>
<?php
date_default_timezone_set("Asia/Jakarta");
$tanggal = date("d-M-Y");

$hari   = date('l', microtime($tanggal));
$hari_indonesia = array(
    'Monday'  => 'Senin',
    'Tuesday'  => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu',
    'Sunday' => 'Minggu'
);

$nama = session()->get('username');
$hak = session()->get('hak_akses');

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-home icon-title"></i> Beranda
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda</a></li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="alert alert-dashboard">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="font-size:15px">
                    <i class="icon fa fa-user"></i>Selamat datang <strong><?= $nama; ?></strong>, anda login pada <?php echo $hari_indonesia[$hari] . '&nbsp;' . $tanggal ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <!-- hak akses APING -->
        <?php if ($hak == 'APING') : ?>

            <?php foreach ($supplier as $sup) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#00c0ef;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $sup['jml_supplier']; ?></h3>
                            <p>Data supplier</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="/data_supplier/view" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($customer as $sup) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#FF7701;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $sup['jml_customer']; ?></h3>
                            <p>Data Customer</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="/customer/view" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($obat as $det) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#00a65a;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $det['jumlah']; ?></h3>
                            <p>Data Obat</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-medkit"></i>
                        </div>
                        <a href="/data_obat/view" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($obmasuk as $obm) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#f39c12;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $obm['jml_masuk']; ?></h3>
                            <p>Data Pembelian</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-download"></i>
                        </div>
                        <a href="/obat_masuk/view" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($obkeluar as $obk) : ?>
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#DD4B39;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $obk['jml_keluar']; ?></h3>
                            <p>Data Penjualan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <a href="/obat_keluar/view" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($rj as $obk) : ?>
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#5A6E83;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $obk['jml_rj']; ?></h3>
                            <p>Data Retur Penjualan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-people-carry"></i>
                        </div>
                        <a href="/returjual/view" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($so as $obk) : ?>
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#9896C7;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $obk['jml_so']; ?></h3>
                            <p>Data Stok Opname</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <a href="" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($t_hari as $obk) : ?>
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#357CA5;color:#fff" class="small-box">
                        <div class="inner">
                            <?php if ($obk['total'] == 0) : ?>
                                <h3>Rp. 0,-</h3>
                            <?php else : ?>
                                <h3>Rp. <?= number_format($obk['total'], 0, ",", "."); ?>,-</h3>
                            <?php endif; ?>
                            <p>Total Penjualan Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer" title="" data-toggle="tooltip">&nbsp;</a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($t_bulan as $obk) : ?>
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#357CA5;color:#fff" class="small-box">
                        <div class="inner">
                            <?php if ($obk['total'] == 0) : ?>
                                <h3>Rp. 0,-</h3>
                            <?php else : ?>
                                <h3>Rp. <?= number_format($obk['total'], 0, ",", "."); ?>,-</h3>
                            <?php endif; ?>
                            <p>Total Penjualan Bulan Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer" title="" data-toggle="tooltip">&nbsp;</a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- hak akses APA -->
        <?php if ($hak == 'APA') : ?>
            <?php foreach ($user as $sup) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#605CA8;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $sup['jml_user']; ?></h3>
                            <p>Data User</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="/data_user/view" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($supplier as $sup) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#00c0ef;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $sup['jml_supplier']; ?></h3>
                            <p>Data supplier</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="/data_supplier/view" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($customer as $sup) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#FF7701;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $sup['jml_customer']; ?></h3>
                            <p>Data Customer</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="/customer/view" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($obat as $det) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#00a65a;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $det['jumlah']; ?></h3>
                            <p>Data Obat</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-medkit"></i>
                        </div>
                        <a href="/data_obat/view" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($obmasuk as $obm) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#f39c12;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $obm['jml_masuk']; ?></h3>
                            <p>Data Pembelian</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-download"></i>
                        </div>
                        <a href="/obat_masuk/view" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($obkeluar as $obk) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#DD4B39;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $obk['jml_keluar']; ?></h3>
                            <p>Data Penjualan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <a href="/obat_keluar/view" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($rj as $obk) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#5A6E83;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $obk['jml_rj']; ?></h3>
                            <p>Data Retur Penjualan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-people-carry"></i>
                        </div>
                        <a href="/returjual/view" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($so as $obk) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#9896C7;color:#fff" class="small-box">
                        <div class="inner">
                            <h3><?= $obk['jml_so']; ?></h3>
                            <p>Data Stok Opname</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <a href="" class="small-box-footer" title="" data-toggle="tooltip">More Info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($t_hari as $obk) : ?>
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#357CA5;color:#fff" class="small-box">
                        <div class="inner">
                            <?php if ($obk['total'] == 0) : ?>
                                <h3>Rp. 0,-</h3>
                            <?php else : ?>
                                <h3>Rp. <?= number_format($obk['total'], 0, ",", "."); ?>,-</h3>
                            <?php endif; ?>
                            <p>Total Penjualan Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer" title="" data-toggle="tooltip">&nbsp;</a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>

            <?php foreach ($t_bulan as $obk) : ?>
                <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div style="background-color:#357CA5;color:#fff" class="small-box">
                        <div class="inner">
                            <?php if ($obk['total'] == 0) : ?>
                                <h3>Rp. 0,-</h3>
                            <?php else : ?>
                                <h3>Rp. <?= number_format($obk['total'], 0, ",", "."); ?>,-</h3>
                            <?php endif; ?>
                            <p>Total Penjualan Bulan Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer" title="" data-toggle="tooltip">&nbsp;</a>
                    </div>
                </div><!-- ./col -->
            <?php endforeach; ?>
        <?php endif; ?>


    </div><!-- /.row -->
</section><!-- /.content -->

<section class="content">
    <!-- <div class="callout callout-warning">
        <h4>Warning!</h4>

        <p><b>Morris.js</b> charts are no longer maintained by its author. We would recommend using any of the other
            charts that come with the template.</p>
    </div> -->
    <div class="row">
        <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Penjualan Obat Hari Ini</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body table-responsive">
                    <!-- tampilan tabel user -->
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th>Nama Obat</th>
                                <th>Jumlah Terjual</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($pen_hariini as $data) : ?>
                                <tr>
                                    <td class='center' width='40'><?= $i++; ?></td>
                                    <td><?= $data['nama_obat']; ?></td>
                                    <td><?= $data['jml_keluar']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->


                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">


            <!-- AREA CHART -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">10 Obat Paling Banyak Terjual Bulan Ini</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body table-responsive">
                    <!-- tampilan tabel user -->
                    <table id="" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th>Nama Obat</th>
                                <th>Jumlah Terjual</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($top10 as $top) : ?>
                                <tr>
                                    <td class='center' width='40'><?= $i++; ?></td>
                                    <td><?= $top['nama_obat']; ?></td>
                                    <td><?= $top['jml_keluar']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-body chart-responsive">
                    <div class="chart" id="revenue-chart"></div>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
        <!-- /.col (RIGHT) -->
    </div>
    <!-- /.row -->



</section>

<?= $this->endSection(); ?>