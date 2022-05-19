<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>


<section class="content-header">
    <h1>
        <i class="fa fa-edit icon-title"></i> Ubah Data Obat
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Beranda </a></li>
        <li><a href="/data_obat/view"> Obat </a></li>
        <li class="active"> Ubah </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" action="/dt_obat/updateobat" method="POST" enctype="multipart/form-data">
                    <div class="box-body">
                        <?php foreach ($obat as $ob) : ?>
                            <input type="hidden" name="fotolama" value="<?= $ob['foto']; ?>">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Kode Obat</label>
                                        <input type="text" class="form-control" name="kode_obat" value="<?= $ob['kode_obat']; ?>" readonly required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Nama obat</label>
                                        <input type="text" class="form-control" id="nama_obat" name="nama_obat" autocomplete="off" value="<?= $ob['nama_obat']; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Golongan</label>
                                        <select class="form-control" name="id_golongan" required>
                                            <option hidden value="<?= $ob['id_golongan']; ?>"><?= $ob['nama_golongan']; ?></option>
                                            <?php foreach ($golongan as $g) : ?>
                                                <option value="<?= $g['id_golongan']; ?>"><?= $g['nama_golongan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Satuan</label>
                                        <select class="form-control" name="id_satuan" required>
                                            <option hidden value="<?= $ob['id_satuan']; ?>"><?= $ob['nama_satuan']; ?></option>
                                            <?php foreach ($satuan as $g) : ?>
                                                <option value="<?= $g['id_satuan']; ?>"><?= $g['nama_satuan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Komposisi</label>
                                        <input type="text" class="form-control" name="komposisi" autocomplete="off" value="<?= $ob['komposisi']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Penyimpanan</label>
                                        <input type="text" class="form-control" name="penyimpanan" autocomplete="off" value="<?= $ob['penyimpanan']; ?>" required>
                                    </div>
                                </div>

                                <!-- tombol -->
                                <div class="form-group" style="margin-top: 30px;">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-primary btn-submit btn-standar" name="simpan" value="Ubah">
                                        <a href="/data_obat/view" class="btn btn-danger btn-reset btn-standar" style="margin-left: 11px;">Batal</a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-6">


                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="inp" class="">Harga Beli</label>
                                        <div class="input-group"> <span class="input-group-addon">Rp.</span>
                                            <input type="text" name="beli" onkeypress="return hanyaAngka(event)" value="<?= number_format($ob['harga_beli'], 0, ',', '.'); ?>" class="form-control" id="rupiah1" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="inp" class="">Harga Jual</label>
                                        <div class="input-group"> <span class="input-group-addon">Rp.</span>
                                            <input type="text" class="form-control " name="jual" onkeypress="return hanyaAngka(event)" value="<?= number_format($ob['harga_jual'], 0, ',', '.'); ?>" id="rupiah2" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Deskripsi Obat</label>
                                        <textarea required class="form-control" rows="3" name="deskripsi_obat"><?= $ob['deskripsi_obat']; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Foto</label>
                                        <input type="file" name="ftobat" id="ftobat" value="<?= $ob['foto']; ?>">
                                        <br />
                                        <img style="border:1px solid #eaeaea;border-radius:5px;" src="<?= base_url() ?>/img/obat/<?= $ob['foto']; ?>" width="128">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div><!-- /.box body -->



                </form>
            </div><!-- /.box -->
        </div>
        <!--/.col -->
    </div> <!-- /.row -->
</section><!-- /.content -->



<?= $this->endSection() ?>