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
                                <th class="center">Satuan</th>
                                <!-- <th class="center">Jumlah Sistem</th> -->
                                <th class="center">Jumlah Rill</th>
                                <!-- <th class="center">Status</th>
                                <th class="center">Selisih</th> -->
                                <th class="center">Aksi</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>



                            <!-- tampilan tabel body -->
                            <?php $i = 1; ?>
                            <?php foreach ($viewdump as $det) : ?>
                                <tr class='center'>
                                    <td width='40'><?= $i++; ?></td>
                                    <!-- <td><?= $det['kd_so']; ?></td> -->
                                    <td><?= $det['det_kd_so']; ?></td>
                                    <td><?= $det['nama_obat']; ?></td>
                                    <td><?= $det['kode_obat']; ?></td>
                                    <td><?= $det['nama_satuan']; ?></td>
                                    <!-- <td><?= $det['jumlah_sistem']; ?></td> -->
                                    <td><?= $det['jumlah_rill']; ?></td>
                                    <!-- <td><?= $det['status']; ?></td>
                                    <td><?= $det['selisih']; ?></td> -->

                                    <td class='center' width='80'>
                                        <div>
                                            <a data-toggle="modal" id="hapus" title="" class="btn btn-danger btn-sm" href="#H<?= $det['det_kd_so']; ?>">
                                                <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal hapus -->
                                <div class="modal fade" id="H<?= $det['det_kd_so']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><b>Hapus</b> </h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus data stok opname <?= $det['det_kd_so']; ?> ? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" href="/hapus_so/<?= $det['det_kd_so']; ?>">Ya</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

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