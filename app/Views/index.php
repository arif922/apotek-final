<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Aplikasi Persediaan Obat pada Apotek">
    <meta name="author" />

    <!-- favicon -->
    <link rel="shortcut icon" href="<?= base_url() ?>/template/assets/img/favicon.png" />

    <!-- Bootstrap 3.3. -->
    <link href="<?= base_url() ?>/template/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?= base_url() ?>/template/assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?= base_url() ?>/template/assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?= base_url() ?>/template/assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>/template/assets/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body class="login-page bg-login">
    <div class="login-box">
        <div style="color:#3c8dbc" class="login-logo">
            <!-- <img style="margin-top:-12px" src="<?= base_url() ?>/template/assets/img/logo-blue.png" alt="Logo" height="50"> <b>Setya Medika</b> -->
            <img style="margin-top:-12px" src="" height="50"> <b>Apotek Setya Medika</b>
        </div><!-- /.login-logo -->
        <?php
        //pesan validasi error
        $errors = session()->getFlashdata('errors');
        if (!empty($errors)) {
        ?>
            <div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <?php foreach ($errors as $error) : ?>
                    <?= esc($error) ?>
                    <br>
                <?php endforeach ?>
            </div>
        <?php } ?>

        <?php if (session()->getFlashdata('eror')) : ?>
            <div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='icon fa fa-close'></i>
                <?= session()->getFlashdata('eror'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='icon fa fa-check-circle'></i>
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>

        <div class="login-box-body">
            <p class="login-box-msg"><i class="fa fa-user icon-title"></i> Silahkan Login</p>
            <br />

            <form method="POST" action="<?php echo base_url('auth/cek_login') ?>">

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="Username" required />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control form-password" name="password" autocapitalize="on" placeholder="Password" required />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">

                    <input type="checkbox" id="show-hide" class="form-checkbox" name="show-hide" value="" />
                    <label for="show-hide">&nbsp; Tampilkan Password</label>

                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-block btn-flat">Login</button>
                        <!-- <input type="submit" class="btn btn-primary btn-lg btn-block btn-flat" name="login" value="Login" /> -->
                    </div><!-- /.col -->
                </div>
                <br>
                <div class="center">
                    <a href="<?php echo base_url('/lupa_password') ?>">Lupa Password ?</a>
                </div>
            </form>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <!-- jQuery 2.1.3 -->
    <script src="<?= base_url() ?>/template/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?= base_url() ?>/template/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- manampilkan password -->
    <script src="<?= base_url() ?>/template/assets/js/myjs.js"></script>
    <!-- menghilangkan icon ci4 -->
    <style>
        @media screen {

            /* a#debug-icon-link  */

            #toolbarContainer {
                display: none;
            }
        }
    </style>
</body>

</html>