<?= $this->extend('layout/bl'); ?>
<?= $this->section('content'); ?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fas fa-user-friends"></i>&nbsp; Grafik Pembelian Per Bulan
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">


            <div class="box box-warning">

                <canvas id="pembelian" width="400" height="190" style="padding: 10px;"></canvas>

            </div><!-- /.box -->
        </div>
        <!--/.col -->
    </div> <!-- /.row -->
</section>
<!-- /.content-->
<?= $this->endSection(); ?>