<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fas fa-user-friends"></i>&nbsp; Data Supplier
        <a class="btn btn-primary btn-social pull-right" href="<?php echo base_url('data_supplier/input'); ?>" title="" data-toggle="tooltip">
            <i class="fa fa-plus-circle"></i> Tambah
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
                    <h4> <i class="fa fa-check-circle"></i> Sukses!</h4>
                    <li style="margin-left: 2%;"> <?= session()->getFlashdata('pesan'); ?></li>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('eror2')) : ?>
                <div class='alert alert-gagal'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class="fa fa-exclamation-circle"></i> Gagal!</h4>
                    <li style="margin-left: 2%;"> <?= session()->getFlashdata('eror2'); ?></li>
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
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Telpon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($supplier as $s) : ?>
                                <tr>
                                    <td class="center" width='40'><?= $i++; ?></td>

                                    <td><?= $s['nama_supplier']; ?></td>
                                    <td><?= $s['alamat']; ?></td>
                                    <td><?= $s['kota']; ?></td>
                                    <td><?= $s['telepon']; ?></td>

                                    <td width='80'>
                                        <div>
                                            <a id="ubah" title='' style='margin-right:5px' class='btn btn-primary btn-sm' href="/ubah_supplier/<?= $s['id_supplier']; ?>">
                                                <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                                            </a>
                                            <a data-toggle="modal" id="hapus" title="" class="btn btn-danger btn-sm" href="#H<?= $s['id_supplier']; ?>">
                                                <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal hapus -->
                                <div class="modal fade" id="H<?= $s['id_supplier']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><b>Hapus</b> </h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus data supplier <?= $s['nama_supplier']; ?> ? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" href="/delete_supplier/<?= $s['id_supplier']; ?>">Ya</a>
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