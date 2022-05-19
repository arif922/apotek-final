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
                                <th class="center">Harga</th>
                                <th class="center">Jumlah</th>
                                <th class="center">Sub Total</th>
                                <th class="center">Keterangan</th>
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
                                    <!-- <td><?= $det['kd_returjual']; ?></td> -->
                                    <td><?= $det['det_kd_returjual']; ?></td>
                                    <td><?= $det['nama_obat']; ?></td>
                                    <td><?= $det['kode_obat']; ?></td>
                                    <td>Rp <?= number_format($det['harga'], 0, ",", "."); ?></td>

                                    <td><?= $det['jumlah_rj']; ?></td>
                                    <td>Rp <?= number_format($det['sub_total'], 0, ",", "."); ?></td>

                                    <td><?= $det['keterangan']; ?></td>

                                    <td class='center' width='80'>
                                        <div>
                                            <a data-toggle="modal" id="hapus" title="" class="btn btn-danger btn-sm" href="#H<?= $det['det_kd_returjual']; ?>">
                                                <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal hapus -->
                                <div class="modal fade" id="H<?= $det['det_kd_returjual']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><b>Hapus</b> </h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus data retur penjualan <?= $det['det_kd_returjual']; ?> ? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" class="btn btn-danger" href="/hapus_dump_rj/<?= $det['det_kd_returjual']; ?>">Ya</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                            <?php endforeach; ?>
                        </tbody>
                        <?php foreach ($total as $b) : ?>
                            <?php if (!empty($b['total_harga'])) : ?>
                                <tr class="hilang3">
                                    <th rowspan="" class="center" colspan="4">Total</th>
                                    <th class="center" id="total_order">Rp. <?= number_format($b['total_harga'], 0, ',', '.') ?></th>
                                    <th class="center" id="total_order"><?= $b['total_rj']; ?></th>
                                    <th class="center" id="total_order">Rp. <?= number_format($b['total'], 0, ',', '.') ?></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <!--/.col -->
    </div> <!-- /.row -->
</section>
<!-- /.content-->