<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>


<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
<!-- Content Header (Page header) -->
<section class="content-header">
    <!-- <h1>
        <i class="fas fa-file-invoice"></i> <?= $title; ?>
    </h1> -->
    <!-- <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="/returbeli/view"> Retur Pembelian </a></li>
        <li> Rincian </li>
    </ol> -->
    <h1>
        <i class="fas fa-file-invoice"></i> Rincian Retur Pembelian
        <a class="btn btn-danger pull-right" style="margin-left: 11px;" href="/returbeli/view" title="" data-toggle="tooltip">
            Kembali
        </a>
        <a class="btn btn-primary pull-right" onclick="window.print()" href="" title="" data-toggle="tooltip">
            Cetak
        </a>
    </h1>
</section>

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
        <p class="center" style="font-size: 30px; margin-bottom: -30px;"><b> Retur Pembelian Obat</b></p>

    </div>
    <div class="border" style=" border-width: 5px; border-bottom-style: outset; border-color: #000;"></div>
    <div class="pusing" style="margin-left: 25px; font-size: 15px; margin-bottom: -20px;">
        <?php foreach ($cetak as $c) : ?>
            Kode Retur Pembelian : <?= $c['kd_returbeli']; ?> <br>
            Tanggal : <?= $c['tanggal_retur']; ?> <br>
            User : <?= $c['username']; ?> <br>
            Supplier : <?= $c['nama_supplier']; ?>
        <?php endforeach; ?>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-warning">
                <div class="box-body table-responsive">
                    <!-- tampilan tabel user -->
                    <table id="example1" class="table table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr class="hilang">
                                <th class="center">No.</th>
                                <!-- <th class="center">Kode Transaksi</th> -->
                                <th class="center">Kode Detail</th>
                                <th class="center">Nama Obat</th>
                                <th class="center">Kode Obat</th>
                                <!-- <th class="center">Satuan</th> -->
                                <th class="center">Harga</th>
                                <th class="center">Jumlah</th>
                                <th class="center">Sub Total</th>
                                <th class="center">Keterangan</th>

                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($detailreturbeli as $m) : ?>
                                <tr class='center hilang2'>
                                    <td width='40'><?= $i++; ?></td>

                                    <!-- <td><?= $m['kd_returbeli']; ?></td> -->
                                    <td><?= $m['det_kd_returbeli']; ?></td>
                                    <td><?= $m['nama_obat']; ?></td>
                                    <td><?= $m['kode_obat']; ?></td>
                                    <td>Rp <?= number_format($m['harga'], 0, ",", "."); ?></td>
                                    <td><?= $m['jumlah_rb']; ?></td>
                                    <td>Rp <?= number_format($m['sub_total'], 0, ",", "."); ?></td>
                                    <td><?= $m['keterangan']; ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <?php foreach ($total as $b) : ?>
                                <?php if (!empty($b['total_harga'])) : ?>
                                    <tr class="hilang3">
                                        <th rowspan="" class="center" colspan="4">Total</th>
                                        <th class="center" id="total_order">Rp. <?= number_format($b['total_harga'], 0, ',', '.') ?></th>
                                        <th class="center" id="total_order"><?= $b['total_rb']; ?></th>
                                        <th class="center" id="total_order">Rp. <?= number_format($b['total'], 0, ',', '.') ?></th>
                                        <th class="center" id="total_order"></th>
                                    </tr>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <!--/.col -->
    </div> <!-- /.row -->
</section>
<!-- /.content-->


<?= $this->endSection() ?>