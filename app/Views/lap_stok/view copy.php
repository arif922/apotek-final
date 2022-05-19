<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>


<section class="content-header">
    <h1>
        <i class="fa fa-file-text-o"></i>&nbsp; Laporan Stok Obat

        <a class="btn btn-primary pull-right" onclick="window.print()" href="" title="Cetak Data" data-toggle="tooltip">
            &nbsp; &nbsp; Cetak &nbsp; &nbsp;
        </a>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row" id="cetak">
        <div class="col-md-12">

            <!-- menampilkan data berhasil disimpan -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class='alert berhasil'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4> <i class='icon fa fa-check-circle'></i> Sukses!</h4>
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <!-- untuk laporan -->
            <div class="kotak" hidden>
                <div style="color:#3c8dbc" class="login-logo">
                    <img style="margin-top:-12px" src="<?= base_url() ?>/img/logo.jpg" alt="Logo" class="pull-left" height="100">
                    <div class="laporan">
                        <b>Apotek Setya Medika</b>
                        <p class="center" style="font-size: 32px;">Laporan Stok Obat</p>
                    </div>
                    <p style="font-size: 20px;">Jl Turi, Panggung, Lumbungrejo, Kec. Tempel, Kabupaten Sleman, DI Yogyakarta 55552</p>
                    <div class="border" style=" border-width: 5px; border-bottom-style: outset; border-color: #000;">
                    </div>
                </div>
            </div>

            <div style="background: white; padding-top: 15px;">
                <div class="box-body table-responsive">
                    <!-- tampilan tabel obat -->
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th>Kode Obat</th>
                                <th>Nama Obat</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Expired</th>



                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($stok as $o) : ?>
                                <tr>
                                    <td width='40' class='center'><?= $i++; ?></td>
                                    <td><?= $o['kode_obat']; ?></td>
                                    <td><?= $o['nama_obat']; ?></td>
                                    <td><?= $o['stok']; ?></td>
                                    <td><?= $o['satuan']; ?></td>
                                    <td><?= $o['expired']; ?></td>

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



<?= $this->endSection() ?>