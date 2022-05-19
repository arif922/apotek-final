<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>
<style>
    .form-group .control-label {
        text-align: left;
    }
</style>


<section class="content-header">
    <h1>
        <i class="fas fa-cart-plus"></i> <?= $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Beranda </a></li>
        <li><a href="/so/view"> Stok Opname </a></li>
        <li class="active"> Tambah </li>
    </ol>
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
                    <h4> <i class="fa fa-exclamation-circle"></i> Gagal!</h4>
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('eror')) : ?>
                <div class='alert alert-gagal'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class="fa fa-exclamation-circle"></i> Gagal!</h4>
                    <li style="margin-left: 2%;"> <?= session()->getFlashdata('eror'); ?></li>
                </div>
            <?php endif; ?>
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" method="POST" action="/stok_opname/tambahdump_so" enctype="multipart/form-data">
                    <div class="box-body row" style="padding: 25px;">
                        <!-- kiri -->
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <div class="col-sm-12">
                                    <label class="">Kode Stok Opname</label>
                                    <input type="text" class="form-control" name="kd_so" autocomplete="off" value="<?= $kdtrans; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class=" text-xl-left">Kode Detail</label>
                                    <input type="text" class="form-control" name="det_kd_so" autocomplete="off" value="<?= $kddet;
                                                                                                                        date_default_timezone_set('Asia/Jakarta');
                                                                                                                        echo date("h-i-s"); ?>" readonly required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Nama Obat</label>
                                    <select class="form-control select2" id="nama_obat" onchange="kd_soo()" name="nm_obat" required>
                                        <option value="" selected hidden>-- Pilih --</option>
                                        <?php foreach ($obat as $ob) : ?>
                                            <option value="<?= $ob['kode_obat']; ?>|<?= $ob['nama_satuan']; ?>|<?= $ob['stok']; ?>"> <?= $ob['nama_obat']; ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>





                        </div>

                        <!-- kanan -->
                        <div class="col-sm-6">

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class=" text-xl-left">Kode Obat</label>
                                    <input type="text" class="form-control" id="kd_obat" name="kode_obat" autocomplete="off" value="" readonly required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class=" text-xl-left">Satuan</label>
                                    <input type="text" class="form-control" id="st" name="satuan" autocomplete="off" value="" readonly required>
                                </div>
                            </div>

                            <div class="form-group" hidden>
                                <div class="col-sm-12">
                                    <label class="">Jumlah Sistem</label>
                                    <input type="text" id="jml_sistem" name="jumlah_sistem" min="1" class="form-control" value="" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Jumlah Rill</label>
                                    <input type="number" id="jml_rill" min="1" class="form-control" onkeyup="stok_opname()" onchange="stok_opname()" name="jumlah_rill" maxlength="13" onKeyPress="return goodchars(event,'0123456789',this)" value="" required>
                                </div>
                            </div>


                            <div class="form-group" hidden>
                                <div class="col-sm-12">
                                    <label class="">Status</label>
                                    <input type="text" id="status1" name="status" min="1" class="form-control" value="" readonly>
                                </div>
                            </div>

                            <div class="form-group" hidden>
                                <div class="col-sm-12">
                                    <label class=" text-xl-left">Selisih</label>
                                    <input type="text" class="form-control" id="selisih" name="selisih" autocomplete="off" value="" readonly>
                                </div>
                            </div>


                        </div>

                        <div class="form-group" style="margin-left:2px; margin-bottom: -30px;">
                            <div class="col-sm-12" style="margin-top: 20px;">
                                <input type="submit" class="btn btn-success btn-submit" name="simpan" value="Tambah">
                                <a href="" class="btn btn-primary btn-reset" style="margin-right: 11px; margin-left: 11px;" data-toggle="modal" data-target="#modal-default">Rincian</a>
                                <a href="/so/view" class="btn btn-danger btn-reset btn-standar">Batal</a>
                            </div>
                        </div>
                    </div><!-- /.box body -->
                </form>

                <?php
                $user = session()->get('username');
                $id = session()->get('id_user');
                ?>

                <!-- Modal Awal-->
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:  steelblue; color: white;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><b>Lengkapi Data</b> </h4>
                            </div>
                            <div class="modal-body" style="height: 245px;">
                                <form action="/stok_opname/simpan_so" method="POST">

                                    <input type="hidden" class="form-control" name="kd_so" autocomplete="off" value="<?= $kdtrans; ?>" readonly>

                                    <div class="form-group">
                                        <div class="col-sm-12" style="margin-top: -10px;">
                                            <label class="">User</label>
                                            <input type="text" class="form-control" id="user" name="user" autocomplete="off" value="<?php echo $user; ?>" readonly required>
                                        </div>
                                        <div hidden>
                                            <label class="col-sm-1 control-label">Id</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="id_user" name="id_user" autocomplete="off" value="<?php echo $id; ?>" readonly required>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <br><br>
                                    <div class="form-group">
                                        <div class="col-sm-12" style="margin-top: 8px;">
                                            <label class="">Tanggal</label>
                                            <input type="date" class="form-control" name="tgl1" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                                                            echo date("Y-m-d"); ?>" required>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="col-sm-12" style="margin-top: 25px;">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-danger btn-standar" style="margin-left: 11px;" data-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

                <!-- Modal Akhir-->


                </form>
            </div>
        </div>
        <?php echo view('so/view_dump'); ?>
    </div>

    </div><!-- /.box -->
    </div>
    <!--/.col -->
    </div> <!-- /.row -->
</section><!-- /.content -->

<?= $this->endSection() ?>