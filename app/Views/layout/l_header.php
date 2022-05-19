<?php
$foto = session()->get('foto');
$username = session()->get('username');
$hak_akses = session()->get('hak_akses');
$jumlah = session()->get('jumlah');
$tgl = session()->get('tgl');
?>

<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>M</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="" alt=""><b>Setya</b> Medika</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu" id="Notifikasi">
                    <!-- //jumlah stok -->


                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <?php if ($jumlah == 0) { ?>
                            <span class="label" style="background-color: red;" hidden></span>

                        <?php } else { ?>
                            <span class="label" style="background-color: red;"><?= $jumlah; ?></span>
                        <?php } ?>
                    </a>

                    <ul class="dropdown-menu" style="width: auto; min-width: 250px;">
                        <li class="header center" style="background-color: #222D32; color: white;"><strong><?php if ($jumlah == 0) { ?> Tidak Ada Notifikasi <?php } else { ?> Anda Mempunyai <?= $jumlah; ?> Notifikasi<?php } ?></strong></li>
                        <li>


                            <!-- inner menu: contains the actual data -->
                            <?php
                            $nma = session()->get('nma');
                            ?>
                            <ul class="menu">
                                <li>

                                    <a href="#">
                                        <?php if ($nma == null) { ?>
                                            <strong hidden>Stok</strong>
                                        <?php } else { ?>
                                            <strong>Stok</strong>
                                        <?php } ?>
                                    </a>

                                </li>
                            </ul>

                            <ul class="menu">
                                <li>
                                    <?php foreach ($nama_obat as $o) : ?>
                                        <a href="/data_obat/view">
                                            <i class="fa fa-cart-plus text-aqua"></i> Stok Obat <?= $o['nama_obat']; ?> <?php if ($o['stok'] == 0) { ?> Kosong <?php } else { ?> Tersisa <?= $o['stok']; ?><?php } ?>
                                        </a>
                                    <?php endforeach ?>

                                </li>
                            </ul>

                            <?php
                            $exp = session()->get('exp');
                            ?>
                            <ul class="menu">
                                <li>

                                    <a href="#">
                                        <?php if ($exp == null) { ?>
                                            <strong hidden>Expired</strong>
                                        <?php } else { ?>
                                            <strong>Expired</strong>
                                        <?php } ?>
                                    </a>

                                </li>
                            </ul>

                            <ul class="menu">
                                <li>
                                    <?php foreach ($expired as $o) : ?>
                                        <a href="/data_obat/view">
                                            <i class="fa fa-hourglass-half text-aqua"></i> Obat <?= $o['nama_obat']; ?> akan kadaluarsa pada <?= $o['expired']; ?>
                                        </a>
                                    <?php endforeach ?>

                                </li>
                            </ul>




                        </li>

                        <!-- <li class="footer"> <?php if ($jumlah == 0) { ?><?php } else { ?><a href="/data_obat/view"> Tampilkan Semua <?php } ?></a></li> -->


                    </ul>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= base_url() ?>/img/<?= $foto; ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= $username; ?></span>
                        <!-- <i class="fa  fa-caret-down"></i> -->
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php base_url() ?>/img/<?= $foto; ?>" class="img-circle" alt="User Image">

                            <p>
                                <?= $username; ?>
                                <small><?= $hak_akses; ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </div>
                </li> -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php base_url() ?>/user/profil" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a style="width:80px" data-toggle="modal" href="#logout" class="btn btn-default btn-flat">Logout</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" id="Pengaturan" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Modal Logout -->
<div class="modal fade" id="logout">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Logout</b> </h4>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin logout? </p>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-danger" href="<?php echo base_url('auth/logout') ?>">Ya, Logout</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->