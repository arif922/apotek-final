<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>


<section class="content-header">
    <h1>
        <i class="fas fa-chart-bar"></i> Laporan Stok Obat

        <a class="btn btn-primary pull-right" onclick="window.print()" href="" title="Cetak Data" data-toggle="tooltip">
            &nbsp; &nbsp; Cetak &nbsp; &nbsp;
        </a>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row" id="cetak">
        <div class="col-md-12">

            <!-- menampilkan data berhasil disimpan -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class='alert berhasil'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class='icon fa fa-check-circle'></i> Sukses!</h4>
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <!-- untuk laporan -->
            <div class="kotak" hidden>
                <div style="color:#3c8dbc" class="login-logo">
                    <img style="margin-top:-12px" src="<?= base_url() ?>/img/logo.jpg" class="pull-left" alt="Logo" height="100">
                    <div class="laporan">
                        <b>Apotek Setya Medika</b>
                        <p style="font-size: 20px;">Jl Turi, Panggung, Lumbungrejo, Kec. Tempel <br> Kabupaten Sleman, DI Yogyakarta 55552</p>
                    </div>
                    <div class="border" style=" border-width: 5px; border-bottom-style: outset; border-color: #000;">
                    </div>
                    <p class="center" style="font-size: 32px; margin-bottom: -30px;"><b> Laporan Stok Obat</b></p>
                </div>
            </div>

            <div style="background: white; padding-top: 15px;">
                <div class="box-body table-responsive">
                    <!-- tampilan tabel obat -->
                    <table id="example5" class="table table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr class="hilang">
                                <th class="center">No.</th>
                                <th>Kode Obat</th>
                                <th>Nama Obat</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Expired</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($stok as $o) : ?>
                                <tr class="hilang2">
                                    <td width='40' class='center'><?= $i++; ?></td>
                                    <td><?= $o['kode_obat']; ?></td>
                                    <td><?= $o['nama_obat']; ?></td>
                                    <td><?= $o['stok']; ?></td>
                                    <td><?= $o['nama_satuan']; ?></td>
                                    <td><?= $o['expired']; ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr id="">
                                <th rowspan="" colspan="6"></th>
                                <!-- <th rowspan="" colspan="5">Total</th>
<th id="total_order"></th> -->
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <!--/.col -->
    </div> <!-- /.row -->
</section>
<!-- Untuk Laporan -->
<?php
date_default_timezone_set('asia/jakarta');
$date = date('d-M-Y');

$nama = session()->get('username');
?>
<div class="fot" style="font-size: 17px;" hidden>
    <div class="kanan pull-right">
        <div class="col-sm-12">
            <p class="col-sm-6 pull-right" style="margin-right: 10px; margin-top: 100px;">Yogyakarta,............</p>
        </div>
        <div class="col-sm-12">
            <p class="col-sm-6 pull-right" style="margin-right: 10px; margin-top: 100px;">(..........................)</p>
        </div>
    </div>
</div>



<?= $this->endSection() ?>