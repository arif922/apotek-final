<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>


<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-book"></i> <?= $title; ?>

        <!-- <a class="btn btn-primary pull-right" href="/so/tambah" title="Simpan Data" data-toggle="tooltip">
            Simpan
        </a> -->
        <!-- <?php foreach ($detailso as $m) : ?>
            <a class="btn btn-danger pull-right" style="margin-left: 11px;" href="/det_penyesuaian/<?= $m['kd_so']; ?>" title="" data-toggle="tooltip">
                Kembali
            </a>
        <?php endforeach; ?> -->
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
                    <h4> <i class="fa fa-check-circle"></i> Sukses!</h4>
                    <li style="margin-left: 2%;"> <?= session()->getFlashdata('pesan'); ?></li>
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
                                <?php $selisih =  $m['selisih']; ?>
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
        <i class="fa fa-edit icon-title"></i> Item
    </h1>
</section>

<?php
$user = session()->get('username');
$id = session()->get('id_user');
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <!-- form start -->
                <?php foreach ($detailso as $m) : ?>
                    <form role="form" class="form-horizontal" method="POST" action="/penyesuaian/tambah/<?= $m['det_kd_so']; ?>">
                    <?php endforeach; ?>

                    <div class="box-body">
                        <div>

                            <div class="col-sm-6">

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Kode Penyesuaian</label>
                                        <input type="text" class="form-control" name="kd_penyesuaian" value="<?= $kd_pen; ?>" autocomplete="off" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Kode Detail SO</label>
                                        <?php foreach ($detailso as $m) : ?>
                                            <input type="text" class="form-control" name="det_kd_so" value="<?= $m['det_kd_so']; ?>" autocomplete="off" readonly>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">User</label>
                                        <input type="text" class="form-control" name="username" value="<?= $user; ?>" autocomplete="off" readonly>
                                        <input type="hidden" class="form-control" name="id_user" value="<?= $id; ?>" autocomplete="off" readonly>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-top: 25px;">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-success btn-submit" name="Tambah" value="Tambah">
                                        <?php foreach ($detailso as $m) : ?>
                                            <!-- <a href="/penyesuaian/save/<?= $m['det_kd_so']; ?>" class="btn btn-success btn-reset btn-standar" style="margin-left: 11px;">Tambah</a> -->
                                            <a href="/penyesuaian/simpan/<?= $m['kd_so']; ?>/<?= $m['det_kd_so']; ?>" class="btn btn-primary btn-reset btn-standar" style="margin-left: 11px;">Simpan</a>
                                            <a href="/penyesuaian/batal/<?= $m['kd_so']; ?>/<?= $m['det_kd_so']; ?>" class="btn btn-danger btn-reset btn-standar" style="margin-left: 11px;">Batal</a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Tindakan</label>
                                        <select class="form-control" name="tindakan" required>
                                            <option value="" selected hidden>-- Pilih --</option>
                                            <?php foreach ($detailso as $m) : ?>
                                                <?php if ($m['status'] == 'Lebih') : ?>
                                                    <option value="Kurangi">Kurangi</option>
                                                    <option value="Obat Expired">Obat Expired</option>
                                                    <option value="Tidak Dilakukan Tindakan">Tidak Dilakukan Tindakan</option>
                                                <?php else : ?>
                                                    <option value="Tambah">Tambah</option>
                                                    <option value="Tidak Dilakukan Tindakan">Tidak Dilakukan Tindakan</option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Jumlah</label>
                                        <input type="number" class="form-control" min="1" name="jumlah" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box body -->
                    </form>
            </div><!-- /.box -->
        </div>
        <!--/.col -->
    </div> <!-- /.row -->
</section><!-- /.content -->

<section class="content" style="margin-top: -50px;">
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

                                    <td class='center' width='80'>
                                        <div>
                                            <a data-toggle="modal" id="hapus" title="" style='margin-right:5px' class="btn btn-danger btn-sm" href="#H<?= $m['kd_penyesuaian']; ?>">
                                                <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal hapus -->
                                <div class="modal fade" id="H<?= $m['kd_penyesuaian']; ?>">
                                    <form action="/hapus_penyesuaian/<?= $m['kd_penyesuaian']; ?>" method="POST">
                                        <input type="hidden" value="<?= $m['det_kd_so']; ?>" name="det_kd_so" id="">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title"><b>Hapus</b> </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus data transaksi <?= $m['kd_penyesuaian']; ?> ? </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                                    <button type="button" class="btn btn-default">Batal</button>
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