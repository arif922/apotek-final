<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>
<?php foreach ($detailso as $m) : ?>
    <?php
    $kd_so = $m['kd_so'];

    ?>

<?php endforeach; ?>


<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-book"></i> Draf Obat Stok Opname

        <a class="btn btn-danger pull-right" href="/det_persetujuan/<?= $kd_so; ?>" title="" data-toggle="tooltip">
            Kembali
        </a>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <!-- menampilkan data berhasil disimpan -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class='alert berhasil'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class='icon fa fa-check-circle'></i> Sukses!</h4>
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('berhasil')) : ?>
                <div class='alert berhasil'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class='icon fa fa-check-circle'></i> Sukses!</h4>
                    <?= session()->getFlashdata('berhasil'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('gagal')) : ?>
                <div class='alert alert-gagal'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class="fa fa-exclamation-circle"></i> Gagal!</h4>
                    <?= session()->getFlashdata('gagal'); ?>
                </div>
            <?php endif; ?>

            <div class="box box-primary">
                <div class="box-body table-responsive">
                    <!-- tampilan tabel user -->
                    <table id="" class="table table-bordered table-striped table-hover">
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

<section class="content-header" style="margin-top: -200px;">
    <h1>
        <i class="fa fa-edit icon-title"></i> <?= $title; ?>
    </h1>
</section>

<?php
$user = session()->get('username');
$id = session()->get('id_user');
?>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-body table-responsive">
                    <!-- tampilan tabel user -->
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <!-- <th class="center">Kode Transaksi</th> -->
                                <th class="center">Kode Penyesuaian</th>
                                <th class="center">Kode Detail SO</th>
                                <!-- <th class="center">Kode Obat</th> -->
                                <!-- <th class="center">Satuan</th> -->
                                <th class="center">User</th>
                                <th class="center">Tindakan</th>
                                <th class="center">Jumlah</th>
                                <th class="center">Keterangan</th>
                                <!-- <th class="center">Status</th> -->
                                <th class="center">Aksi</th>


                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php $i = 1; ?>

                            <?php foreach ($penyesuaian as $m) : ?>
                                <tr class='center'>
                                    <td width='40'><?= $i++; ?></td>
                                    <td><?= $m['kd_penyesuaian']; ?></td>
                                    <td><?= $m['det_kd_so']; ?></td>
                                    <td><?= $m['username']; ?></td>
                                    <td><?= $m['tindakan']; ?></td>
                                    <td><?= $m['jumlah']; ?></td>
                                    <td><?= $m['keterangan']; ?></td>
                                    <!-- <td><?= $m['status']; ?></td> -->

                                    <?php if ($m['status'] == 'dalam proses') : ?>
                                        <td class='center'>
                                            <a data-toggle="modal" id="Setujui" title="" class="btn btn-success btn-sm" href="#S<?= $m['kd_penyesuaian']; ?>">
                                                Setujui
                                            </a>
                                            <a data-toggle="modal" id="tidak" title="" class="btn btn-danger btn-sm" href="#H<?= $m['kd_penyesuaian']; ?>">
                                                Tidak
                                            </a>
                                        </td>
                                    <?php elseif ($m['status'] == 'Disetujui-tambah') : ?>
                                        <td>SUDAH DISETUJUI : DITAMBAH</td>
                                    <?php elseif ($m['status'] == 'Disetujui-kurangi') : ?>
                                        <td>SUDAH DISETUJUI : DIKURANGI</td>
                                    <?php elseif ($m['status'] == 'Disetujui-expired') : ?>
                                        <td>SUDAH DISETUJUI : EXPIRED</td>
                                    <?php elseif ($m['status'] == 'Disetujui-tidak dilakukan tindakan') : ?>
                                        <td>SUDAH DISETUJUI : TIDAK DILAKUKAN TINDAKAN</td>
                                    <?php elseif ($m['status'] == 'tidak disetujui') : ?>
                                        <td>TIDAK DISETUJUI</td>
                                    <?php endif; ?>

                                </tr>

                                <!-- Modal Disetujui -->
                                <div class="modal fade" id="S<?= $m['kd_penyesuaian']; ?>">
                                    <form action="/disetujui/<?= $m['kd_penyesuaian']; ?>" method="POST">
                                        <?php foreach ($detailso as $c) : ?>

                                            <input type="hidden" name="kd_obat" value="<?= $c['kode_obat']; ?>" id="">
                                            <input type="hidden" name="det_kd_so" value="<?= $c['det_kd_so']; ?>" id="">
                                        <?php endforeach; ?>

                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title"><b>Disetujui</b> </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda Yakin Ingin Menyetujui Data Penyesuaian <?= $m['kd_penyesuaian']; ?> ? </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                                    <a href="" class="btn btn-default ">Batal</a>

                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </form>
                                </div><!-- /.modal -->

                                <!-- Modal tidak Disetujui -->
                                <div class="modal fade" id="H<?= $m['kd_penyesuaian']; ?>">
                                    <form action="/tidak-disetujui/<?= $m['kd_penyesuaian']; ?>" method="POST">
                                        <?php foreach ($detailso as $c) : ?>

                                            <input type="hidden" name="kd_obat" value="<?= $c['kode_obat']; ?>" id="">
                                            <input type="hidden" name="det_kd_so" value="<?= $c['det_kd_so']; ?>" id="">
                                        <?php endforeach; ?>

                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title"><b>Tidak Disetujui</b> </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda Yakin Tidak Menyetujui Data Penyesuaian <?= $m['kd_penyesuaian']; ?> ? </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                                    <a href="" class="btn btn-default ">Batal</a>

                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </form>
                                </div><!-- /.modal -->

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