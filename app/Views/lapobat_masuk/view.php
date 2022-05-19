<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fas fa-chart-bar"></i> Laporan Pembelian Obat
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Laporan Pembelian Obat</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if (session()->getFlashdata('salah')) : ?>
                <div class='alert alert-gagal'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class="fa fa-exclamation-circle"></i> Gagal!</h4>
                    <li style="margin-left: 2%;"> <?= session()->getFlashdata('salah'); ?></li>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('gagal')) : ?>
                <div class='alert alert-gagal'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class="fa fa-exclamation-circle"></i> Gagal!</h4>
                    <?= session()->getFlashdata('gagal'); ?>
                </div>
            <?php endif; ?>
            <!-- Form Laporan -->
            <div style="background: white; padding-top: 15px;">
                <!-- form start -->
                <form role="form" class="form-horizontal" method="POST" action="<?php echo base_url('/laporan_masuk/lihat_lap_masuk'); ?>">
                    <div class="box-body hapus">
                        <div class="col-sm-6">
                            <?php
                            $awal = session()->get('awal');
                            $akhir = session()->get('akhir');

                            $tgl1 = date('d/m/Y', strtotime($awal));
                            $tgl2 = date('d/m/Y', strtotime($akhir));
                            ?>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Tanggal Awal</label>
                                    <input type="date" class="form-control" name="awal" autocomplete="off" value="<?= $awal; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12" style="margin-top: 15px;">
                                    <input type="submit" class="btn btn-success btn-submit btn-standar" style="margin-right: 11px;" value="Filter">
                                    <!-- <a href="" class="btn btn-success btn-submit" style="margin-right: 11px;"> Lihat</a> -->
                                    <a href="/lap_obmasuk/view" onclick="window.print()" class="btn btn-primary btn-submit btn-standar" style="margin-right: 11px;"> Cetak</a>
                                    <a href="/lap_obmasuk/view" class="btn btn-default btn-submit" style="margin-right: 11px;"> Refresh</a>

                                </div>
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Tanggal Akhir</label>

                                    <input type="date" class="form-control" name="akhir" autocomplete="off" value="<?= $akhir; ?>" required>

                                </div>
                            </div>
                        </div>


                    </div>

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
                            <p class="center" style="font-size: 32px; margin-bottom: -30px;"><b> Laporan Pembelian Obat</b></p>
                            <?php if ($awal == null && $akhir == null) : ?>
                                <p hidden class="center" style="font-size: 20px; margin-bottom: -45px;"> Tanggal : (<?= $tgl1; ?>) - (<?= $tgl2; ?>)</p>
                            <?php else : ?>
                                <br><br>
                                <p class="center" style="font-size: 20px; margin-bottom: -45px; margin-top: -60px;"> Tanggal : (<?= $tgl1; ?>) - (<?= $tgl2; ?>)</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <hr class="hr1" style="border-width: 15px; border-color: #ECF0F5;">
                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="box-body table-responsive">
                                    <!-- tampilan tabel obat -->
                                    <table id="example3" class="table table-striped table-hover garis">
                                        <!-- tampilan tabel header -->
                                        <thead>
                                            <tr class="hilang">
                                                <th class="center">No.</th>
                                                <!-- <th>Kode Transaksi</th> -->
                                                <!-- <th>Kode Detail</th> -->
                                                <th>Tanggal</th>
                                                <th>No.Faktur</th>
                                                <th>Nama Obat</th>
                                                <!-- <th >Kode Obat</th> -->
                                                <th>User</th>
                                                <th>Supplier</th>
                                                <th>Harga</th>
                                                <th class="center">Jumlah</th>
                                                <th class="center">Diskon(%)</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <!-- tampilan tabel body -->
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($lapmasuk as $o) : ?>
                                                <tr class="hilang2">
                                                    <td class='center' width='40'><?= $i++; ?></td>
                                                    <!-- <td><?= $o['kd_obat_masuk']; ?></td> -->
                                                    <!-- <td><?= $o['kode_detail']; ?></td> -->
                                                    <td><?= $o['tanggal_masuk']; ?></td>
                                                    <td><?= $o['faktur']; ?></td>
                                                    <td><?= $o['nama_obat']; ?></td>
                                                    <td><?= $o['username']; ?></td>
                                                    <td><?= $o['nama_supplier']; ?></td>
                                                    <td>Rp <?= number_format($o['harga'], 0, ",", "."); ?></td>
                                                    <td class="center"><?= $o['jumlah_masuk']; ?></td>
                                                    <td class="center"><?= $o['diskon']; ?></td>
                                                    <td>Rp <?= number_format($o['total'], 0, ",", "."); ?></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="hilang3">
                                                <th class="center" colspan="6"> Total</th>
                                                <!-- <th rowspan="" colspan="5">Total</th> -->
                                                <th id="total_order1"></th>
                                                <th class="center" id="total_order2"></th>
                                                <th class="center" id="total_order3"></th>
                                                <th id="total_order4"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->

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
                                <p class="col-sm-6 pull-right" style="margin-right: 10px; margin-top: 70px;">(..........................)</p>
                            </div>
                        </div>
                    </div>
            </div>
            <!--/.col -->
        </div> <!-- /.row -->
</section>

<?= $this->endSection() ?>