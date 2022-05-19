<?php
$usr = session()->get('username');
$fto = session()->get('foto');
$jbt = session()->get('hak_akses');
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- <div class="user-panel" style="height: 70px;">
            <div class="pull-left image">
                <img src="/img/<?= $fto; ?>" class="img-circle" alt="User Image" style="height: 50px;">
            </div>
            <div class="pull-left info">
                <p class="center"><?= $usr; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> -->
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header" style="background-color: #1A2226; color: #B8C7CE;">MAIN MENU</li>

            <li>
                <a href="/dashboard">
                    <i class="fa fa-home"></i> <span>Beranda</span>
                </a>
            </li>

            <!-- DATA MASTER -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-database"></i> <span>Data Master</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/data_supplier/view"><i class="far fa-circle"></i> Data Supplier</a></li>
                    <li><a href="/customer/view"><i class="far fa-circle"></i> Data Customer</a></li>
                    <li class="treeview">
                        <a href="#"><i class="far fa-circle"></i> Data Obat
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/data_obat/view"><i class="far fa-circle"></i> Data Obat</a></li>
                            <li><a href="/golongan/view"><i class="far fa-circle"></i> Golongan</a></li>
                            <li><a href="/satuan/view"><i class="far fa-circle"></i> Satuan</a></li>
                            <!-- <li class="treeview">
                                <a href="#"><i class="far fa-circle"></i> Level Two
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="far fa-circle"></i> Level Three</a></li>
                                    <li><a href="#"><i class="far fa-circle"></i> Level Three</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </li>
                    <!-- <li><a href="#"><i class="far fa-circle"></i> Level One</a></li> -->
                </ul>
            </li>



            <!-- Transkasi -->

            <li class="header" style="background-color: #1A2226; color: #B8C7CE;">TRANSAKSI</li>

            <li><a href="/obat_masuk/view"><i class="glyphicon glyphicon-save-file"></i> <span>Pembelian</span> </a></li>
            <li><a href="/obat_keluar/view"><i class="glyphicon glyphicon-open-file"></i> <span>Penjualan</span></a></li>
            <li><a href="/returbeli/view"><i class="glyphicon glyphicon-open-file"></i> <span>Retur Pembelian</span></a></li>
            <li><a href="/returjual/view"><i class="fas fa-people-carry"></i>&nbsp; <span>Retur Penjualan</span></a></li>

            <!-- <li class="treeview">
                <a href="#">
                    <i class="fas fa-boxes"></i>&nbsp; <span>Stok Opname</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/so/view"><i class="far fa-circle"></i> Stok Opname</a></li>
                    <li><a href="/penyesuaian"><i class="far fa-circle"></i> Penyesuaian</a></li>
                    <?php if ($jbt == 'APA') : ?>
                        <li><a href="/persetujuan"><i class="far fa-circle"></i> Persetujuan</a></li>
                    <?php endif; ?>
                </ul>
            </li> -->
            <!-- Laporan -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>Laporan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/lap_obmasuk/view"><i class="far fa-circle"></i> Pembelian</a></li>
                    <li><a href="/lap_obkeluar/view"><i class="far fa-circle"></i> Penjualan</a></li>
                    <!-- <li><a href=""><i class="far fa-circle"></i> Retur Pembelian</a></li> -->
                    <li><a href="/lap_returbeli/view"><i class="far fa-circle"></i> Retur Pembelian</a></li>
                    <li><a href="/lap_retur/view"><i class="far fa-circle"></i> Retur Penjualan</a></li>
                    <li><a href="/lap_stok/view"><i class="far fa-circle"></i> Stok Obat</a></li>
                    <li><a href="/lap_so/view"><i class="far fa-circle"></i> Stok Opname</a></li>
                </ul>
            </li>

            <li class="header" style="background-color: #1A2226; color: #B8C7CE;">LABELS</li>

            <!-- Laporan -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>Grafik</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/grafik/pembelian"><i class="far fa-circle"></i> Pembelian</a></li>
                    <li><a href="/grafik/penjualan"><i class="far fa-circle"></i> Penjualan</a></li>
                    <!-- <li><a href="/lap_retur/view"><i class="far fa-circle"></i> Retur Penjualan</a></li> -->

                </ul>
            </li>

            <?php if ($jbt == 'APA') : ?>
                <li><a href="/data_user/view"><i class="fa fa-user"></i><span> Manajemen User</span></a></li>
            <?php endif; ?>
        </ul>
    </section>
    <!-- /.sidebar -->

</aside>