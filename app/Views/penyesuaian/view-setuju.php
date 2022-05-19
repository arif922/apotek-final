<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>


<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-book"></i> <?= $title; ?>

        <!-- <a class="btn btn-primary btn-social pull-right" href="/so/tambah" title="Tambah Data" data-toggle="tooltip">
            <i class="fa fa-plus-circle"></i> Tambah
        </a> -->
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
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th>Kode Stok Opname</th>
                                <th>User</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Keterangan</th>



                                <th class="center">Aksi</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($so2 as $m) : ?>
                                <tr>
                                    <td class='center' width='40'><?= $i++; ?></td>

                                    <td><?= $m['kd_so']; ?></td>
                                    <td><?= $m['username']; ?></td>
                                    <td><?= $m['tanggal']; ?></td>
                                    <td><?= $m['status']; ?></td>
                                    <td><?= $m['keterangan']; ?></td>


                                    <td class='center' width='80'>
                                        <div>
                                            <!-- <a data-toggle="modal" id="hapus" title="Hapus" style='margin-right:5px' class="btn btn-danger btn-sm" href="#H<?= $m['kd_so']; ?>">
                                                <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                                            </a> -->
                                            <a id="detail" title="" class="btn btn-success btn-sm" href="/det_persetujuan/<?= $m['kd_so']; ?>">
                                                <i class="fa fa-eye"></i></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal hapus -->
                                <div class="modal fade" id="H<?= $m['kd_so']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><b>Hapus</b> </h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus data transaksi <?= $m['kd_so']; ?> ? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" href="/hapus_obat_keluar/<?= $m['kd_so']; ?>">Ya</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
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