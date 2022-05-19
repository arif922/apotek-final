<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>

<section class="content-header">
    <h1>
        <i class="fa fa-edit icon-title"></i> Tambah Supplier
    </h1>
    <ol class="breadcrumb">

        <li><a href="/dashboard"><i class="fa fa-home"></i> Beranda </a></li>
        <li><a href="/data_supplier/view"> Supplier </a></li>
        <li class="active"> Tambah </li>

    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" method="POST" action="/dt_supplier/save">
                    <div class="box-body">
                        <div style="margin-left: 15px;">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label class="">Nama</label>
                                    <input type="text" class="form-control" name="nama" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label class="">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label class="">Kota</label>
                                    <input type="text" class="form-control" name="kota" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label class="">Telepon</label>
                                    <input type="text" class="form-control" name="telp" autocomplete="off" maxlength="13" onKeyPress="return goodchars(event,'01234567890-',this)" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                                    <a href="" class="btn btn-danger btn-reset btn-standar" style="margin-left: 11px;">Batal</a>
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