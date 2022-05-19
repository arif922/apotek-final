<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>

<section class="content-header">
    <h1>
        <i class="fa fa-medkit"></i> Data Obat

        <a class="btn btn-primary btn-social pull-right" href="<?php echo base_url('data_obat/input'); ?>" title="" data-toggle="tooltip">
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

            <?php if (session()->getFlashdata('error')) : ?>
                <div class='alert alert-gagal'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class='icon fa fa-check-circle'></i> Gagal!</h4>
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('gagal')) : ?>
                <div class='alert alert-gagal'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class='icon fa fa-check-circle'></i> Gagal!</h4>
                    <li style="margin-left: 2%;"> <?= session()->getFlashdata('gagal'); ?> <?= session()->getFlashdata('gagal2'); ?></li>
                </div>
            <?php endif; ?>
            <div class="box box-primary">
                <form role="form" class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                    <div class="box-body table-responsive">
                        <!-- tampilan tabel obat -->
                        <table id="example1" class="table table-bordered table-striped table-hover">
                            <!-- tampilan tabel header -->
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Golongan Obat</th>
                                    <th>Expired</th>
                                    <th class="center">Aksi</th>
                                </tr>
                            </thead>
                            <!-- tampilan tabel body -->
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($join as $o) : ?>
                                    <tr>
                                        <td class="center" width='40'><?= $i++; ?></td>
                                        <td><?= $o['kode_obat']; ?></td>
                                        <td><?= $o['nama_obat']; ?></td>
                                        <td><?= $o['stok']; ?></td>
                                        <td><?= $o['nama_satuan']; ?></td>
                                        <td><?= $o['nama_golongan']; ?></td>
                                        <td><?= $o['expired']; ?></td>
                                        <td width='140' class="center">
                                            <div>
                                                <a title='' id="ubah" style='margin-right:5px' class='btn btn-primary btn-sm' href="/ubah_obat/<?= $o['kode_obat']; ?>">
                                                    <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                                                </a>

                                                <!-- <a data-toggle="modal" title="Hapus" id="hapus" style='margin-right:5px' class="btn btn-danger btn-sm" href="/delete_obat/<?= $o['kode_obat']; ?>" onclick="return confirm('Anda yakin ingin menghapus obat <?= $o['nama_obat']; ?> ?');">
                                                        <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                                                    </a> -->
                                                <a data-toggle="modal" title="" id="hapus" style='margin-right:5px' class="btn btn-danger btn-sm" href="" data-target="#H<?= $o['kode_obat']; ?>">
                                                    <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                                                </a>

                                                <a data-toggle="modal" id="detail" data-toggle="modal" data-placement="top" title="" data-toggle="modal" data-target="#D<?= $o['kode_obat']; ?>" class="btn btn-success btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>


                                        <!-- Modal hapus -->
                                        <div class="modal fade" id="H<?= $o['kode_obat']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title"><b>Hapus</b> </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus data obat <?= $o['nama_obat']; ?> ? </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a type="button" class="btn btn-danger" href="/delete_obat/<?= $o['kode_obat']; ?>">Ya</a>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->

                                        <!-- Modal -->
                                        <div class="modal fade" id="D<?= $o['kode_obat']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: steelblue;">
                                                        <h5 class="modal-title" id="staticBackdropLabel" style="color: white; "><b>Detail Obat</b> </h5>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="">

                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-sm-4">Nama Obat</label>:
                                                                <?= $o['nama_obat']; ?></label>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-sm-4">Kode Obat</label>:
                                                                <?= $o['kode_obat']; ?></label>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-sm-4">Golongan Obat</label>:
                                                                <?= $o['nama_golongan']; ?></label>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-sm-4">Stok</label>:
                                                                <?= $o['stok']; ?>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-sm-4">Satuan</label>:
                                                                <?= $o['nama_satuan']; ?>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-sm-4">Harga Beli</label>:
                                                                Rp. <?= number_format($o['harga_beli'], 0, ',', '.'); ?>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-sm-4">Harga Jual</label>:
                                                                Rp. <?= number_format($o['harga_jual'], 0, ',', '.'); ?>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-sm-4">Expired</label>:
                                                                <?= $o['expired']; ?>
                                                            </div>

                                                            <div class="form-group row" style="padding-right: 10px;">
                                                                <label for="" class="col-form-label col-sm-4">Komposisi</label>:
                                                                <?= $o['komposisi']; ?>
                                                            </div>

                                                            <div class="form-group row" style="padding-right: 10px;">
                                                                <label for="" class="col-form-label col-sm-4">Penyimpanan</label>:

                                                                <?= $o['penyimpanan']; ?>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-sm-4">Deskripsi Obat</label>
                                                                <textarea class="col-form-label col-sm" name="" id="" cols="49" rows="4" readonly style="text-align: justify;"><?= $o['deskripsi_obat']; ?></textarea>

                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-sm-4">Foto</label>
                                                                <span class="border border-dark">
                                                                    <img class="w3-border" style="padding:4spx;" alt="Norway" src="/img/obat/<?= $o['foto']; ?>" width="200">
                                                                </span>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>



                        </table>
                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
        </div>
        <!--/.col -->
    </div> <!-- /.row -->
</section>


<?= $this->endSection() ?>