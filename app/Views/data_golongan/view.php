<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>


<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-users"></i>&nbsp; <?= $title; ?>
        <a class="btn btn-primary btn-social pull-right" href="/golongan/input" title="Tambah Data" data-toggle="tooltip">
            <i class="fa fa-plus-circle"></i> Tambah
        </a>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <!-- menampilkan data berhasil disimpan -->
            <?php if (session()->getFlashdata('berhasil')) : ?>
                <div class='alert berhasil'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class="fa fa-check-circle"></i> Sukses!</h4>
                    <li style="margin-left: 2%;"> <?= session()->getFlashdata('berhasil'); ?></li>
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
                                <th>No.</th>
                                <th>Id Golongan</th>
                                <th>Nama Golongan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($golongan as $s) : ?>
                                <tr>
                                    <td class="center" width='40'><?= $i++; ?></td>

                                    <td><?= $s['id_golongan']; ?></td>
                                    <td><?= $s['nama_golongan']; ?></td>

                                    <td width='80'>
                                        <div>
                                            <a id="ubah" title='' style='margin-right:5px' class='btn btn-primary btn-sm' href="/golongan/ubah/<?= $s['id_golongan']; ?>">
                                                <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                                            </a>
                                            <a data-toggle="modal" id="hapus" title="" class="btn btn-danger btn-sm" href="#H<?= $s['id_golongan']; ?>">
                                                <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal hapus -->
                                <div class="modal fade" id="H<?= $s['id_golongan']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><b>Hapus</b> </h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus data golongan <?= $s['nama_golongan']; ?> ? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" href="/delete_golongan/<?= $s['id_golongan']; ?>">Ya</a>
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