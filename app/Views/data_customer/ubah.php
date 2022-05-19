<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>

<section class="content-header">
    <h1>
        <i class="fa fa-edit icon-title"></i> Ubah Data Customer
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="/customer/view"> Customer </a></li>
        <li class="active"> Ubah </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" method="POST" action="/dt_customer/update_customer" enctype="multipart/form-data">
                    <div class="box-body" style="margin-left: 15px;">
                        <?php foreach ($customer as $sup) : ?>

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label class="">Id Customer</label>
                                    <input type="text" class="form-control" name="id_customer" autocomplete="off" value="<?= $sup['id_customer']; ?>" readonly required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label class="">Nama</label>
                                    <input type="text" class="form-control" name="nama_customer" autocomplete="off" value="<?= $sup['nama_customer']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label class="">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" autocomplete="off" value="<?= $sup['alamat']; ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label class="">Telepon</label>
                                    <input type="text" class="form-control" name="telepon" autocomplete="off" value="<?= $sup['telepon']; ?>" maxlength="13" onKeyPress="return goodchars(event,'0123456789-',this)" required>
                                </div>
                            </div>

                        <?php endforeach; ?>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <input type="submit" class="btn btn-primary btn-submit btn-standar" name="simpan" value="Ubah">
                                <a href="/customer/view" class="btn btn-danger btn-reset btn-standar" style="margin-left: 11px;">Batal</a>
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