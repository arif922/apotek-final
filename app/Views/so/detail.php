<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>


<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fas fa-file-invoice"></i> <?= $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="/so/view"> Stok Opname </a></li>
        <li> Rincian </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-body table-responsive">
                    <!-- tampilan tabel user -->
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <!-- <th class="center">Kode Transaksi</th> -->
                                <th class="center">Kode Detail</th>
                                <th class="center">Nama Obat</th>
                                <th class="center">Kode Obat</th>
                                <!-- <th class="center">Satuan</th> -->
                                <th class="center">Jumlah Sistem</th>
                                <th class="center">Jumlah Rill</th>
                                <th class="center">Status</th>
                                <th class="center">Selisih</th>

                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($detailso as $m) : ?>
                                <tr class='center'>
                                    <td width='40'><?= $i++; ?></td>

                                    <!-- <td><?= $m['kd_so']; ?></td> -->
                                    <td><?= $m['det_kd_so']; ?></td>
                                    <td><?= $m['nama_obat']; ?></td>
                                    <td><?= $m['kode_obat']; ?></td>

                                    <td><?= $m['jumlah_sistem']; ?></td>
                                    <td><?= $m['jumlah_rill']; ?></td>
                                    <td><?= $m['status']; ?></td>
                                    <td><?= $m['selisih']; ?></td>

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