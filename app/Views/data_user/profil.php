<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>

<?php
$id_user = session()->get('id_user');
$username = session()->get('username');
$alamat = session()->get('alamat');
$email = session()->get('email');
$telepon = session()->get('telepon');
$hak_akses = session()->get('hak_akses');
$foto = session()->get('foto');

?>
<style>
    .box-body .col-sm-2 {
        text-align: left;
        margin-left: 10px;
    }

    .box-body .form-group {
        font-family: cursive;
        font-weight: bold;
    }

    #aa {
        font-family: cursive;
    }

    .img-circle {

        margin-left: auto;
        margin-right: auto;
        display: block;
        width: auto;
        max-width: 177px;
        height: 197px;
    }

    /* @media (max-width: 500px) {
        .img-circle {
            margin-left: 100%;
            height: 189px;
            width: 168px;
        }
    } */
</style>

<section class="content-header">
    <h1>
        <i class="fa fa-user icon-title"></i> Profil User
    </h1>
    <ol class="breadcrumb">
        <li><a href="/dashboard"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Profil User</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">


            <div class="col-sm-6">
                <div class="box box-primary">

                    <form role="form" class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Id User </label>
                                <label style="text-align:left" class="col-sm-8 control-label">: <?= $id_user; ?></label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Username</label>
                                <label style="text-align:left" class="col-sm-8 control-label">: <?= $username; ?></label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Alamat</label>
                                <label style="text-align:left" class="col-sm-8 control-label">: <?= $alamat; ?></label>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <label style="text-align:left" class="col-sm-8 control-label">: <?= $email; ?></label>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Telepon</label>
                                <label style="text-align:left" class="col-sm-8 control-label">: <?= $telepon; ?></label>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Jabatan</label>
                                <label style="text-align:left" class="col-sm-8 control-label">: <?php if ($hak_akses == 'APA') {
                                                                                                    echo "APA (Apoteker Pengelola Apotek)"
                                                                                                ?>
                                    <?php } else {
                                                                                                    echo "APING (Apoteker Pendamping)";
                                                                                                } ?>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="box box-primary">

                    <form role="form" class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                                <!-- <label class="col-sm-2 control-label"> -->
                                <img class="img-circle" alt="User Image" src="/img/<?= $foto; ?>">
                                <!-- </label> -->
                            </div>
                            <div class="center">
                                <b id="aa"><?= $username; ?></b>
                                <br>
                                <b id="aa"><?php if ($hak_akses == 'APA') {
                                                echo "APA (Apoteker Pengelola Apotek)"
                                            ?>
                                    <?php } else {
                                                echo "APING (Apoteker Pendamping)";
                                            } ?></b>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>