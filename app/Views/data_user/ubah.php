<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>

<section class="content-header">
    <h1>
        <i class="fa fa-edit icon-title"></i> Ubah Data User
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Beranda</a></li>
        <li><a href="/data_user/view"> User </a></li>
        <li class="active"> Ubah </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" method="POST" action="/dt_user/update_user" enctype="multipart/form-data">

                    <div class="box-body">
                        <?php foreach ($user as $us) : ?>
                            <input type="hidden" name="fotolama" value="<?= $us['foto']; ?>">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Id User</label>
                                        <input type="text" class="form-control" name="id_user" autocomplete="off" value="<?= $us['id_user']; ?>" readonly required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Username</label>
                                        <input type="text" class="form-control" name="username" autocomplete="off" value="<?= $us['username']; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Email</label>
                                        <input type="email" class="form-control" name="email" autocomplete="off" value="<?= $us['email']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Password</label>
                                        <input type="password" class="form-control" name="password1" autocomplete="off" placeholder="Kosongkan Jika Tidak Di Ubah">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12" style="margin-top: 15px;">
                                        <input type="submit" class="btn btn-primary btn-submit btn-standar" name="simpan" value="Ubah">
                                        <a href="/data_user/view" class="btn btn-danger btn-reset btn-standar" style="margin-left: 11px;">Batal</a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" autocomplete="off" value="<?= $us['alamat']; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Telepon</label>
                                        <input type="text" class="form-control" name="telepon" autocomplete="off" maxlength="13" onKeyPress="return goodchars(event,'0123456789-',this)" value="<?= $us['telepon']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Hak Akses</label>
                                        <select class="form-control" name="hak_akses" required>

                                            <option <?php if ($us['hak_akses'] == "APA") {
                                                        echo "selected";
                                                    } ?> value="APA">APA</option>
                                            <option <?php if ($us['hak_akses'] == "APING") {
                                                        echo "selected";
                                                    } ?> value="APING">APING</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="">Foto</label>
                                        <input type="file" class="custom-file-input" name="ftuser" id="ftuser">
                                        <br />
                                        <img style="border:1px solid #eaeaea;border-radius:5px;" src="/img/<?= $us['foto']; ?>" width="128" class="img-preview">
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