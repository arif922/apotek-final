<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>


<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fas fa-shopping-cart"></i> Data Pembelian

        <a class="btn btn-primary btn-social pull-right" id="ob_masuk" href="<?php echo base_url('obat_masuk/input'); ?>" title="" data-toggle="tooltip">
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

            <div class="box box-primary">
                <div class="box-body table-responsive">
                    <!-- tampilan tabel user -->
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th>Kode Transaksi</th>
                                <th>Tanggal</th>
                                <th>No.Faktur</th>
                                <th>User</th>
                                <th>Supplier</th>
                                <th class="center">Aksi</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($obatmasuk as $m) : ?>
                                <tr>
                                    <td class='center' width='40'><?= $i++; ?></td>
                                    <td><?= $m['kd_obat_masuk']; ?></td>
                                    <td><?= $m['tanggal_masuk']; ?></td>
                                    <td><?= $m['faktur']; ?></td>
                                    <td><?= $m['username']; ?></td>
                                    <td><?= $m['nama_supplier']; ?></td>


                                    <td class='center' width='80'>
                                        <div>
                                            <!-- <a data-toggle="modal" id="hapus" title="Hapus" class="btn btn-danger btn-sm" style='margin-right:5px' href="#H<?= $m['kd_obat_masuk']; ?>">
                                                <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                                            </a> -->
                                            <a id="detail" title="" class="btn btn-success btn-sm" href="/detail_dtobat/<?= $m['kd_obat_masuk']; ?>">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal hapus -->
                                <div class="modal fade" id="H<?= $m['kd_obat_masuk']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><b>Hapus</b> </h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus data transaksi <?= $m['kd_obat_masuk']; ?> ? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" href="/hapus_dtobat/<?= $m['kd_obat_masuk']; ?>">Ya</a>
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


<section class="content-header" style="margin-top: -25px;">
    <h1>
        <i class="fas fa-shopping-cart"></i> History Pembelian
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">


            <div class="box box-primary">
                <div class="box-body table-responsive">
                    <!-- tampilan tabel user -->
                    <table id="example5" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th>Obat</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Expired</th>
                                <th>Jumlah Masuk</th>
                                <th>Keluar</th>
                                <th>Sisa</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($his_beli as $m) : ?>
                                <tr>
                                    <td class='center' width='40'><?= $i++; ?></td>
                                    <td><?= $m['nama_obat']; ?></td>
                                    <td><?= $m['tanggal_masuk']; ?></td>
                                    <td><?= $m['expired']; ?></td>
                                    <td><?= $m['jumlah_masuk']; ?></td>
                                    <td><?= $m['keluar']; ?></td>
                                    <td><?= $m['sisa']; ?></td>
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