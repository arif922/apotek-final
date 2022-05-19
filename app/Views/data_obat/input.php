<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>


<section class="content-header">
    <h1>
        <i class="fa fa-edit icon-title"></i> Tambah Obat
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Beranda </a></li>
        <li><a href="/data_obat/view"> Obat </a></li>
        <li class="active"> Tambah </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php if (session()->getFlashdata('error')) : ?>
                <div class='alert alert-gagal'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class="fa fa-exclamation-circle"></i> Gagal!</h4>
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" action="/dt_obat/save" method="POST" enctype="multipart/form-data">
                    <div class="box-body">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Kode Obat</label>
                                    <input type="text" class="form-control" name="kode_obat" readonly required value="<?php
                                                                                                                        echo $kdobat;
                                                                                                                        ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Nama obat</label>
                                    <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="<?= old('nama_obat'); ?>" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Golongan Obat</label>
                                    <select class="form-control" name="id_golongan" required>
                                        <option value="" hidden selected>-- Pilih --</option>
                                        <?php foreach ($golongan as $g) : ?>
                                            <option value="<?= $g['id_golongan']; ?>"><?= $g['nama_golongan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- JENIS OBAT MENGGUNAKAN SELECT DROPWON -->
                            <!-- <div class="form-group">
                                <label class="col-sm-2 control-label">Jenis Obat</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="jenis_obat" name="jenis_obat[]" multiple="multiple" required>
                                        <option value="Box">Box</option>
                                        <option value="Botol">Botol</option>
                                        <option value="Kotak">Kotak</option>
                                        <option value="Strip">Strip</option>
                                        <option value="Tube">Tube</option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Satuan</label>
                                    <select class="form-control" name="id_satuan" required>
                                        <option value="" hidden selected>-- Pilih --</option>
                                        <?php foreach ($satuan as $g) : ?>
                                            <option value="<?= $g['id_satuan']; ?>"><?= $g['nama_satuan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Komposisi</label>
                                    <input type="text" class="form-control" name="komposisi" autocomplete="off" required value="<?= old('komposisi'); ?>">
                                </div>
                            </div>

                            <!-- tombol -->
                            <div class="form-group">
                                <div class="col-sm-12" style="margin-top: 5px;">
                                    <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                                    <a href="" class="btn btn-danger btn-reset btn-standar" style="margin-left: 11px;">Batal</a>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Cara Penyimpanan</label>
                                    <input type="text" class="form-control" name="penyimpanan" autocomplete="off" value="<?= old('penyimpanan'); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="inp" class="">Harga Beli</label>
                                    <div class="input-group"> <span class="input-group-addon">Rp.</span>
                                        <input type="text" name="beli" onkeypress="return hanyaAngka(event)" class="form-control" id="rupiah1" value="<?= old('beli'); ?>" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="inp" class="">Harga Jual</label>
                                    <div class="input-group"> <span class="input-group-addon">Rp.</span>
                                        <input type="text" class="form-control " name="jual" onkeypress="return hanyaAngka(event)" value="<?= old('jual'); ?>" id="rupiah2" required />
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Deskripsi Obat</label>
                                    <textarea class="form-control" rows="4" name="deskripsi_obat" value="<?= old('deskripsi_obat'); ?>"><?= old('deskripsi_obat'); ?></textarea>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Foto</label>
                                    <input type="file" name="ftobat" id="ftobat">
                                    <br />

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



<?= $this->endSection() ?>