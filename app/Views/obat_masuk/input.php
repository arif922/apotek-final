<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>
<style>
    .form-group .control-label {
        text-align: left;
    }
</style>


<section class="content-header">
    <h1>
        <i class="fas fa-cart-plus"></i> Tambah Pembelian
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Beranda </a></li>
        <li><a href="/obat_masuk/view"> Pembelian </a></li>
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
                <form role="form" class="form-horizontal" method="POST" action="/ob_masuk/tambahdump" enctype="multipart/form-data">
                    <div class="box-body row" style="padding: 25px;">

                        <!-- kiri -->
                        <div class="col-sm-6">

                            <div class="form-group ">
                                <div class="col-sm-12">
                                    <label class="">Kode Transaksi</label>
                                    <input type="text" class="form-control" name="kd_trans" autocomplete="off" value="<?= $kdtrans; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class=" text-xl-left">Kode Detail</label>
                                    <input type="text" class="form-control" name="kode_detail" autocomplete="off" value="<?= $kddet;
                                                                                                                            date_default_timezone_set('Asia/Jakarta');
                                                                                                                            echo date("h-i-s"); ?>" readonly required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Nama Obat</label>
                                    <select class="form-control select2" name="nm_obat" id="nama_obat" onchange="kdobat_mas()" required>
                                        <option value="" selected hidden>
                                            <p>-- Pilih --</p>
                                        </option>
                                        <?php foreach ($obat as $ob) : ?>
                                            <option value="<?= $ob['kode_obat']; ?>|<?= number_format($ob['harga_beli'], 0, ',', '.') ?>|<?= $ob['expired']; ?>"><?= $ob['nama_obat']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="">Nama Obat</label>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="nm_obat" id="nama_obat" onchange="kdobat_mas()" required>
                                        <option value="" selected hidden>
                                            <p>-- Pilih --</p>
                                        </option>
                                        <?php foreach ($obat as $ob) : ?>
                                            <option value="<?= $ob['kode_obat']; ?>|<?= number_format($ob['harga_beli'], 0, ',', '.'); ?>"><?= $ob['nama_obat']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div> -->


                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class=" text-xl-left">Kode Obat</label>
                                    <input type="text" class="form-control" id="kode_obat1" name="kode_obat2" autocomplete="off" value="" readonly required>
                                </div>
                            </div>



                            <!-- tombol -->
                            <div class="form-group" style="margin-bottom: -30px; margin-top: 30px;">
                                <div class="col-sm-12">

                                    <input type="submit" class="btn btn-success btn-submit" name="simpan" value="Tambah">
                                    <a href="" class="btn btn-primary btn-reset" data-toggle="modal" style="margin-left: 11px;" data-target="#modal-default">Rincian</a>
                                    <a href="/obat_masuk/view" class="btn btn-danger btn-reset btn-standar" style="margin-left: 11px;">Batal</a>
                                </div>
                            </div>


                        </div>

                        <!-- kanan -->
                        <div class="col-sm-6">


                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="inp" class="">Harga</label>
                                    <div class="input-group"> <span class="input-group-addon">Rp.</span>
                                        <input type="text" name="harga_beli" class="form-control" id="harga" readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah" name="jml_masuk" onkeyup="hitung()" onchange="hitung()" autocomplete="off" maxlength="13" min="1" onKeyPress="return goodchars(event,'0123456789',this)" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="inp" class="">Diskon</label>
                                    <div class="input-group"> <span class="input-group-addon">%</span>
                                        <input type="text" name="diskon" class="form-control" onkeyup="hitung()" onKeyPress="return goodchars(event,'0123456789.',this)" id="disk" autocomplete="off" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="inp" class="">Sub Total</label>
                                    <div class="input-group"> <span class="input-group-addon">Rp.</span>
                                        <input type="text" name="total" class="form-control" onkeyup="hitung()" id="rupiah1" readonly />
                                    </div>
                                </div>
                            </div>

                            <?php
                            date_default_timezone_set("Asia/Jakarta");
                            $date1 = date("Y-m-d");
                            //menambah 1 hr pada tanggal sekarang
                            $date2    = date('Y-m-d', strtotime('+1 days', strtotime($date1))); ?>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Expired</label>
                                    <input type="date" class="form-control" name="expired" min='<?php echo $date2 ?>' autocomplete="off" value="<?php echo $date2 ?>" required>
                                    <input type="hidden" class="form-control" id="expired" name="expired1" autocomplete="off" value="" readonly required>
                                </div>
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
                            <div class="modal-body" style="height: 380px;">
                                <form action="/ob_masuk/simpan2" method="POST">

                                    <input type="hidden" class="form-control" name="kd_trans" autocomplete="off" value="<?= $kdtrans; ?>" readonly>


                                    <div class="form-group">
                                        <div class="col-sm-12" style="margin-top: -20px;">
                                            <label class="">No.Faktur </label>
                                            <input type="text" class="form-control" id="faktur" name="faktur" autocomplete="off" value="" required>
                                        </div>
                                    </div>
                                    <br><br><br>
                                    <!-- <div class="form-group">
                                            <label class="col-sm-2 control-label">User</label>
                                            <div class="col-sm-6">
                                                <select class="form-control " name="user1" id="username" onchange="kduser()" required>
                                                    <option value="" selected hidden>-- Pilih --</option>
                                                   
                                                </select>
                                            </div>
                                        </div> -->
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
                                    <!-- <br><br>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Id</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="id_user" name="id_user" autocomplete="off" value="<?php echo $id; ?>" readonly required>
                                        </div>
                                    </div> -->

                                    <br><br>
                                    <div class="form-group ">

                                        <div class="col-sm-12" style="margin-top: 8px;">
                                            <label class="">Supplier</label><br>
                                            <select class="form-control" name="supplier" id="nama_supplier" onchange="kdsupplier()" required>
                                                <option value="" selected hidden>-- Pilih --</option>
                                                <?php foreach ($supplier as $sup) : ?>
                                                    <option value="<?= $sup['id_supplier']; ?>"><?= $sup['nama_supplier']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div hidden>
                                            <label class="col-sm-1 control-label ">Id</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="id_supplier" name="id_supplier" autocomplete="off" value="" readonly required>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- <br><br>
                                    <div class="form-group">
                                        <label class=" ">Id</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="id_supplier" name="id_supplier" autocomplete="off" value="" readonly required>
                                        </div>
                                    </div> -->
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
        <?php echo view('obat_masuk/view_dump'); ?>
    </div>

    </div><!-- /.box -->
    </div>
    <!--/.col -->
    </div> <!-- /.row -->
</section><!-- /.content -->

<?= $this->endSection() ?>