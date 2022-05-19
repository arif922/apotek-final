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
        <li><a href="/returbeli/view"> Retur pembelian </a></li>
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
            <?php if (session()->getFlashdata('eror')) : ?>
                <div class='alert alert-gagal'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class="fa fa-exclamation-circle"></i> Gagal!</h4>
                    <li style="margin-left: 2%;"> <?= session()->getFlashdata('eror'); ?></li>
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
                <!-- form start -->
                <form role="form" class="form-horizontal" method="POST" action="/retur_pembelian/tambahdump_rj" enctype="multipart/form-data">
                    <div class="box-body row" style="padding: 25px;">
                        <!-- kiri -->
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <div class="col-sm-12">
                                    <label class="">Kode Retur beli</label>
                                    <input type="text" class="form-control" name="kd_returbeli" autocomplete="off" value="<?= $kdtrans; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class=" text-xl-left">Kode Detail</label>
                                    <input type="text" class="form-control" name="det_kd_returbeli" autocomplete="off" value="<?= $kddet;
                                                                                                                                date_default_timezone_set('Asia/Jakarta');
                                                                                                                                echo date("h-i-s"); ?>" readonly required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-9">
                                    <label class="">Nama Obat</label>
                                    <input type="text" class="form-control" id="nama_obat" name="nm_obat" required readonly>
                                </div>
                                <div class="col-sm-3">
                                    <label class="" style="visibility: hidden;">Nama Obat</label>
                                    <a href="" class="btn btn-success btn-reset pull-right" data-toggle="modal" data-target="#cari-obat">Cari Obat</a>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class=" text-xl-left">Kode Obat</label>
                                    <input type="text" class="form-control" id="kode_obat" name="kode_obat" autocomplete="off" value="" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12" style="margin-top: 20px;">
                                    <input type="submit" class="btn btn-success btn-submit" name="simpan" value="Tambah">
                                    <a href="" class="btn btn-primary btn-reset" style="margin-right: 11px; margin-left: 11px;" data-toggle="modal" data-target="#modal-default">Rincian</a>
                                    <a href="/returbeli/view" class="btn btn-danger btn-reset btn-standar">Batal</a>
                                </div>
                            </div>

                        </div>

                        <!-- kanan -->
                        <div class="col-sm-6">



                            <!-- <div class="form-group">
                                <div class="col-sm-12">
                                    <label class=" text-xl-left">Satuan</label>
                                    <input type="text" class="form-control" id="satuan" name="satuan" autocomplete="off" value="" readonly required>
                                </div>
                            </div> -->



                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="inp" class="">Harga</label>
                                    <div class="input-group"> <span class="input-group-addon">Rp.</span>
                                        <input type="text" name="harga_beli" class="form-control" id="h_beli" value="" readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Jumlah Beli</label>
                                    <input type="number" id="jml_beli" min="1" class="form-control" name="jumlah_beli" value="" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class="">Jumlah Retur</label>
                                    <input type="number" id="jml_masuk" min="1" class="form-control" onkeyup="pembelian()" onchange="pembelian()" name="jumlah_rj" autocomplete="off" maxlength="13" onKeyPress="return goodchars(event,'0123456789',this)" value="" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="inp" class="">Sub Total</label>
                                    <div class="input-group"> <span class="input-group-addon">Rp.</span>
                                        <input type="text" name="sub_total" class="form-control" id="totall" readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label class=" text-xl-left">Keterangan</label>
                                    <input type="text" class="form-control" id="" name="keterangan" autocomplete="off" value="">
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
                            <div class="modal-body" style="height: 320px;">
                                <form action="/retur_pembelian/simpan_returbeli" method="POST">

                                    <input type="hidden" class="form-control" name="kode_returbeli" autocomplete="off" value="<?= $kdtrans; ?>" readonly>

                                    <!-- <div class="form-group">
                                            <label class="col-sm-2 control-label">User</label>
                                            <div class="col-sm-6">
                                                <select class="form-control " name="user1" id="username" onchange="kduser()" required>
                                                    <option value="" selected hidden>-- Pilih --</option>
                                                   
                                                </select>
                                            </div>
                                        </div> -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">User </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="user" name="user" autocomplete="off" value="<?php echo $user; ?>" readonly required>
                                        </div>

                                        <div hidden>
                                            <label class="col-sm-1 control-label">Id </label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="id_user" name="id_user" autocomplete="off" value="<?php echo $id; ?>" readonly required>

                                            </div>
                                        </div>
                                    </div>


                                    <!-- <div class="form-group">
                                        <label class="col-sm-2 control-label" style="margin-top: 10px;">supplier</label>

                                        <div class="col-sm-12">
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
                                    </div> -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" style="margin-top: 10px;">supplier</label>
                                        <div class="col-sm-12">
                                            <?php
                                            $nama = session()->get('nama');
                                            $id =  session()->get('id');
                                            ?>
                                            <input type="text" class="form-control" id="nama_supplier" name="supplier" autocomplete="off" value="<?= $nama; ?>" readonly>
                                        </div>
                                        <div hidden>
                                            <label class="col-sm-1 control-label ">Id</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="id_supplier" name="id_supplier" autocomplete="off" value="<?= $id; ?>" readonly required>

                                            </div>
                                        </div>
                                    </div>


                                    <!-- <br><br>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Id </label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="id_supplier" name="id_user" autocomplete="off" value="<?php echo $id; ?>" readonly required>
                                        </div>
                                    </div> -->
                                    <br><br>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" style="margin-top: 10px;">Tanggal</label>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control" name="tgl1" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                                                            echo date("Y-m-d"); ?>" required>
                                        </div>
                                    </div>





                                    <!-- <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="inp" class="" style="margin-top: 10px;">Tunai</label>
                                            <div class="input-group"> <span class="input-group-addon">Rp.</span>
                                                <input type="text" name="tunai2" class="form-control" onkeyup="detail_beli()" id="tunaii" value="" onKeyPress="return goodchars(event,'01234567890',this)" required />
                                            </div>
                                        </div>
                                    </div> -->


                                    <div class="form-group" hidden>
                                        <div class="col-sm-12">
                                            <label for="inp" class="" style="margin-top: 10px;">Total</label>
                                            <div class="input-group"> <span class="input-group-addon">Rp.</span>
                                                <?php foreach ($jml_dump as $j) : ?>
                                                    <input type="text" name="u_kembali" class="form-control" id="u_kembali" value="<?= number_format($j['jml_kembali'], 0, ',', '.') ?>" readonly />
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-12" style="margin-top: 30px;">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-danger btn-standar" style="margin-left: 11px;" data-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                            </div>


                            </form>

                        </div><!-- /.box -->
                    </div>
                </div>


                <!-- Modal cari obat-->
                <div class="modal fade" id="cari-obat">
                    <div class="modal-dialog" style="width: 800px;">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:  steelblue; color: white;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><b>Data Pembelian</b> </h4>
                            </div>
                            <div class="modal-body">
                                <form action="/retur_pembelian/simpan_returbeli" method="POST">

                                    <div class="box box-warning">
                                        <div class="box-body table-responsive">
                                            <!-- tampilan tabel user -->
                                            <table id="example5" class="table table-bordered table-striped table-hover">
                                                <!-- tampilan tabel header -->
                                                <thead>
                                                    <tr>
                                                        <th class="center">No.</th>
                                                        <!-- <th>Kode Transaksi</th> -->
                                                        <th>Faktur</th>
                                                        <th>Tanggal</th>

                                                        <th>supplier</th>
                                                        <th>Obat</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah</th>
                                                        <th class="center">Aksi</th>


                                                    </tr>
                                                </thead>
                                                <!-- tampilan tabel body -->
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($cari_obat as $data) : ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <!-- <td><?= $data['kd_obat_masuk']; ?></td>
                                                            <td><?= $data['kode_detail']; ?></td> -->
                                                            <td><?= $data['faktur']; ?></td>
                                                            <td><?= $data['tanggal_masuk']; ?></td>
                                                            <td><?= $data['nama_supplier']; ?></td>
                                                            <td><?= $data['nama_obat']; ?></td>
                                                            <td>Rp <?= number_format($data['harga_beli'], 0, ",", "."); ?></td>
                                                            <td><?= $data['jumlah_masuk']; ?></td>

                                                            <td class="center">
                                                                <a id="nama_obat" title="" class="btn btn-success btn-sm" href="/returbeli/tambah/<?= $data['kode_detail']; ?>">
                                                                    Pilih
                                                                </a>
                                                            </td>



                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->


                                </form>

                            </div><!-- /.box -->
                        </div>
                    </div>

                </div><!-- /.box -->
            </div>
            <!--/.col -->

        </div> <!-- /.row -->
        <?php echo view('retur_beli/view_dump'); ?>
</section><!-- /.content -->


<?= $this->endSection() ?>