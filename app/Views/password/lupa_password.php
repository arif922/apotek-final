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
        </div>

        <!-- pesan validasi error -->
        <?php if (session()->getFlashdata('error')) : ?>
            <div class='alert alert-danger alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <li><?= session()->getFlashdata('error'); ?></li>
            </div>
        <?php endif; ?>

        <div class="login-box-body">
            <!-- <p class="login-box-msg"> Silahkan Masukkan Email Anda</p> -->
            <p class="login-box-msg"> Silahkan Masukkan Username Anda</p>
            <br />

            <!-- <form method="POST" action="<?php echo base_url('/auth/cek_email') ?>"> -->
            <form method="POST" action="<?php echo base_url('/auth/cek_username') ?>">

                <div class="form-group has-feedback">
                    <!-- <input type="text" class="form-control" name="email" placeholder="Email" required /> -->
                    <input type="text" class="form-control" name="username" placeholder="Username" required />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>

                </div>

                <div class="row">
                    <div class="col-xs-12">

                        <button type="submit" class="btn btn-primary btn-lg btn-block btn-flat">Lanjut</button>
                        <a href="<?php echo base_url('') ?>" class="btn btn-default btn-lg btn-block btn-flat">Batal</a>

                        <!-- <input type="submit" class="btn btn-primary btn-lg btn-block btn-flat" name="login" value="Login" /> -->
                    </div><!-- /.col -->
                </div>


            </form>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="<?= base_url() ?>/template/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?= base_url() ?>/template/assets/js/bootstrap.min.js" type="text/javascript"></script>
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