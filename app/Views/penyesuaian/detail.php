<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>
<?php foreach ($detailso as $m) : ?>
    <?php $kd_so =  $m['kd_so']; ?>
<?php endforeach; ?>

<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-book"></i> <?= $title; ?>
        <a class="btn btn-danger pull-right" style="margin-left: 11px;" href="/penyesuaian/kembali/<?= $kd_so; ?>" title="" data-toggle="tooltip">
            Kembali
        </a>
        <a class="btn btn-primary pull-right" href="/penyesuaian2/<?= $kd_so; ?>" title="" data-toggle="tooltip">
            Simpan
        </a>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class='alert berhasil'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class="fa fa-check-circle"></i> Sukses!</h4>
                    <li style="margin-left: 2%;"> <?= session()->getFlashdata('pesan'); ?></li>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('blm_disesuaikan')) : ?>
                <div class='alert alert-gagal'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class="fa fa-exclamation-circle"></i> Gagal!</h4>
                    <li style="margin-left: 2%;"> <?= session()->getFlashdata('blm_disesuaikan'); ?></li>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('gagal')) : ?>
                <div class='alert alert-gagal'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class="fa fa-exclamation-circle"></i> Gagal!</h4>
                    <li style="margin-left: 2%;"> <?= session()->getFlashdata('gagal'); ?></li>
                </div>
            <?php endif; ?>

            <div class="box box-primary">
                <div class="box-body table-responsive">
                    <!-- tampilan tabel user -->
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <!-- <th class="center">Kode Transaksi</th> -->
                                <th class="center">Kode Detail</th>
                                <th class="center">Nama Obat</th>
                                <!-- <th class="center">Kode Obat</th> -->
                                <!-- <th class="center">Satuan</th> -->
                                <th class="center">Jumlah Sistem</th>
                                <th class="center">Jumlah Rill</th>
                                <th class="center">Status</th>
                                <th class="center">Selisih</th>
                                <!-- <th class="center">Keterangan</th> -->
                                <th class="center">Aksi</th>

                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($detailso as $m) : ?>
                                <tr class='center'>
                                    <td width='40'><?= $i++; ?></td>

                                    <!-- <td><?= $m['kd_so']; ?></td> -->
                                    <td><?= $m['det_kd_so']; ?></td>
                                    <td><?= $m['nama_obat']; ?></td>
                                    <!-- <td><?= $m['kode_obat']; ?></td> -->

                                    <td><?= $m['jumlah_sistem']; ?></td>
                                    <td><?= $m['jumlah_rill']; ?></td>
                                    <td><?= $m['status']; ?></td>
                                    <td><?= $m['selisih']; ?></td>
                                    <!-- <td><?= $m['keterangan']; ?></td> -->
                                    <?php if ($m['keterangan'] == 'belum') : ?>
                                        <td class='center' width='80'>
                                            <!-- <a data-toggle="modal" id="hapus" title="Hapus" style='margin-right:5px' class="btn btn-danger btn-sm" href="#H<?= $m['kd_so']; ?>">
                                                <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                                            </a> -->
                                            <a title="" class="btn btn-success btn-sm" href="/det_penyesuaian2/<?= $m['det_kd_so']; ?>">
                                                <!-- <i style="color:#fff" class="glyphicon glyphicon-list-alt"></i> -->Buat Penyesuaian
                                            </a>
                                        </td>
                                    <?php elseif ($m['keterangan'] == 'sudah') : ?>
                                        <td>SUDAH DISESUAIKAN</td>
                                    <?php endif; ?>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <!--/.col -->
    </div> <!-- /.row -->
</section>
<!-- /.content-->


<?= $this->endSection() ?>