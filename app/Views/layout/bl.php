<!DOCTYPE html>
<html>
<?php

$id = session()->get('id_user');


if (empty($id)) {

?>
    <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="shortcut icon" href="<?= base_url() ?>/img/logo.png" />

    <body style="background-color: #ECF0F5;">

        <div style="text-align: center; margin-top: 14%;">
            <h1>404</h1>
            <h1><i class="fa fa-warning"></i> Oops! Page Error</h1>
            <h2>Anda Belum Login, Silahkan Login Terlebih dahulu</h2>
            <h4>Silahkan Login<a href="<?php echo base_url('') ?>"> Disini</a></h4>
        </div>
    </body>

<?php return redirect()->to(base_url(''));
} ?>

<?php echo view('layout/l_head') ?>


<body class="hold-transition skin-blue fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <?php echo view('layout/l_header') ?>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <?php echo view('layout/l_nav') ?>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?= $this->renderSection('content'); ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php echo view('layout/l_footer') ?>



        <?php echo view('layout/setting') ?>
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="<?= base_url() ?>/template/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url() ?>/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?= base_url() ?>/template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?= base_url() ?>/template/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>/template/dist/js/demo.js"></script>

    <!-- DataTables -->
    <script src="<?= base_url() ?>/template/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/template/bower_components/datatables.net/js/jquery.dataTables2.js"></script>
    <script src="<?= base_url() ?>/template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <!-- Morris.js charts -->
    <script src="<?= base_url() ?>/template/bower_components/raphael/raphael.min.js"></script>
    <script src="<?= base_url() ?>/template/bower_components/morris.js/morris.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url() ?>/template/bower_components/chart.js/Chart.js"></script>
    <script src="<?= base_url() ?>/template/chart/chart.js"></script>
    <script src="<?= base_url() ?>/template/chart/chart.min.js"></script>

    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/template/dist/js/adminlte.min.js"></script>


</body>
<!-- <script>
    $('.sidebar-menu ul li').find('a').each(function() {
        var link = new RegExp($(this).attr('href')); //Check if some menu compares inside your the browsers link
        if (link.test(document.location.href)) {
            if (!$(this).parents().hasClass('active')) {
                $(this).parents('li').addClass('menu-open');
                $(this).parents().addClass("active");
                $(this).addClass("active"); //Add this too
            }
        }
    });
</script> -->

<script>
    var rupiah1 = document.getElementById("rupiah1");
    rupiah1.addEventListener("keyup", function(e) {
        rupiah1.value = convertRupiah(this.value);
    });
    rupiah1.addEventListener('keydown', function(event) {
        return isNumberKey(event);
    });

    var rupiah2 = document.getElementById("rupiah2");
    rupiah2.addEventListener("keyup", function(e) {
        rupiah2.value = convertRupiah(this.value);
    });
    rupiah2.addEventListener('keydown', function(event) {
        return isNumberKey(event);
    });

    function convertRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
    }

    function isNumberKey(evt) {
        key = evt.which || evt.keyCode;
        if (key != 188 // Comma
            &&
            key != 8 // Backspace
            &&
            key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
            &&
            (key < 48 || key > 57) // Non digit
        ) {
            evt.preventDefault();
            return;
        }
    }
</script>

<script type="text/javascript">
    function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57)) {
            return false;
        }
        return true;
    }
</script>

<script>
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
</script>

<script>
    function tabel() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    }
</script>


<!-- menghilangkan icon ci4 -->
<style>
    @media screen {

        /* a#debug-icon-link  */

        #toolbarContainer {
            display: none;
        }
    }
</style>

<!-- page script -->
<script type="text/javascript">
    $(function() {
        // datepicker plugin
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        // chosen select
        $('.chosen-select').chosen({
            allow_single_deselect: true
        });
        //resize the chosen on window resize

        // mask money
        $('#harga_beli').maskMoney({
            thousands: '.',
            decimal: ',',
            precision: 0
        });
        $('#harga_jual').maskMoney({
            thousands: '.',
            decimal: ',',
            precision: 0
        });

        $(window)
            .off('resize.chosen')
            .on('resize.chosen', function() {
                $('.chosen-select').each(function() {
                    var $this = $(this);
                    $this.next().css({
                        'width': $this.parent().width()
                    });
                })
            }).trigger('resize.chosen');
        //resize chosen on sidebar collapse/expand
        $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if (event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
                var $this = $(this);
                $this.next().css({
                    'width': $this.parent().width()
                });
            })
        });


        $('#chosen-multiple-style .btn').on('click', function(e) {
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if (which == 2) $('#form-field-select-4').addClass('tag-input-style');
            else $('#form-field-select-4').removeClass('tag-input-style');
        });

    });
</script>


<!-- tippy.js -->
<script src="<?= base_url() ?>/template/dist/css/tippy/popper.min.js"></script>
<script src="<?= base_url() ?>/template/dist/css/tippy/tippy-bundle.umd.min.js"></script>

<!-- membuat tooltip -->
<!-- awal -->
<script>
    tippy('#detail', {
        content: "Detail",
    });
</script>

<script>
    tippy('#hapus', {
        content: "Hapus",
    });
</script>

<script>
    tippy('#ubah', {
        content: "Ubah",
    });
</script>

<script>
    tippy('#Notifikasi', {
        content: "Notifikasi",
    });
</script>

<script>
    tippy('#Pengaturan', {
        content: "Pengaturan",
    });
</script>
<!-- akhir -->




<!-- membuat dropdown multipel select -->
<script>
    $(document).ready(function() {

        $("#jenis_obat").select2({
            maximumSelectionLength: 2,
            placeholder: "  -- Pilih --",
            allowClear: true
        });
    });
</script>

</body>
<!-- saat nama obat di pilih maka kode obat keluar otomatis (expload) -->
<script type="text/javascript">
    function kdobat() {
        var obat = document.getElementById("nama_obat").value;
        var explode = obat.split("|");
        document.getElementById("kode_obat").value = explode[0];
        document.getElementById("satuan").value = explode[1];
        document.getElementById("h_jual").value = explode[2];
        // document.getElementById("h_beli").value = explode[3];
    }
</script>

<script type="text/javascript">
    function rtjual() {
        var obat = document.getElementById("nama_obat").value;
        var explode = obat.split("|");
        document.getElementById("kode_obat").value = explode[0];
        // document.getElementById("satuan").value = explode[1];
        document.getElementById("h_jual").value = explode[1];
        // document.getElementById("h_beli").value = explode[3];
    }
</script>

<!-- user -->
<script type="text/javascript">
    function kduser() {
        var user = document.getElementById("username").value;
        var explode = user.split("|");
        document.getElementById("id_user").value = user;
    }
</script>

<!-- supplier -->
<script type="text/javascript">
    function kdsupplier() {
        var supplier = document.getElementById("nama_supplier").value;
        var explode = supplier.split("|");
        document.getElementById("id_supplier").value = supplier;

    }
</script>

<!-- customer -->
<script type="text/javascript">
    function kdcustomer() {
        var customer = document.getElementById("nama_customer").value;
        var explode = customer.split("|");
        document.getElementById("id_customer").value = customer;

    }
</script>

<!-- nama obat di transaksi obat masuk -->
<script type="text/javascript">
    function kdobat_mas() {
        var obat = document.getElementById("nama_obat").value;
        var explode = obat.split("|");
        document.getElementById("kode_obat1").value = explode[0];
        document.getElementById("harga").value = explode[1];
        document.getElementById("expired").value = explode[2];
    }
</script>

<!-- stok opname -->
<script type="text/javascript">
    function kd_soo() {
        var obat = document.getElementById("nama_obat").value;
        var explode = obat.split("|");
        document.getElementById("kd_obat").value = explode[0];
        document.getElementById("st").value = explode[1];
        document.getElementById("jml_sistem").value = explode[2];

    }
</script>



<style>
    @media print {
        @page {
            margin-top: 30px;
            margin-bottom: 10px;
        }

        .row .col-xs-6,
        .row .col-sm-5,
        .row .col-sm-7,
        footer,
        a#debug-icon-link,
        .box-body .col-sm-6,
        .form-group .btn-submit,
        .content .hapus,
        .hr1 {
            display: none;
        }

        .kotak,
        hr.tampil,
        .fot {
            display: contents;
        }

        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_desc:after,
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_desc:before {
            display: none;
        }

        table td {

            border-top: 0;
            border-bottom: 0;
        }


        table#example1 th,
        table#example3 th,
        table#example4 th,
        table#example5 th {
            border-top: 3px solid black;
            /* border-bottom: 3px solid black; */
        }

        table tr.hilang>th {
            /* border-top: 3px solid black; */
            border-bottom: 3px solid black;
        }



        table tr.hilang2>td {
            /* border-bottom: 1px solid black; */
            border-top: 2px solid #ECF0F5;
        }

        table tr.hilang3>th {
            border-bottom: 3px solid black;
            /* border-top: 2px solid #ECF0F5; */
        }

    }
</style>




<!-- Fungsi untuk membatasi karakter yang diinputkan -->
<script language="javascript">
    function getkey(e) {
        if (window.event)
            return window.event.keyCode;
        else if (e)
            return e.which;
        else
            return null;
    }

    function goodchars(e, goods, field) {
        var key, keychar;
        key = getkey(e);
        if (key == null) return true;

        keychar = String.fromCharCode(key);
        keychar = keychar.toLowerCase();
        goods = goods.toLowerCase();

        // check goodkeys
        if (goods.indexOf(keychar) != -1)
            return true;
        // control keys
        if (key == null || key == 0 || key == 8 || key == 9 || key == 27)
            return true;

        if (key == 13) {
            var i;
            for (i = 0; i < field.form.elements.length; i++)
                if (field == field.form.elements[i])
                    break;
            i = (i + 1) % field.form.elements.length;
            field.form.elements[i].focus();
            return false;
        };
        // else return false
        return false;
    }
</script>

<!-- Select2 -->
<script src="<?= base_url() ?>/template/bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- membuat dropdown search -->
<script type="text/javascript">
    $('.select2').select2()
</script>

<!-- membuat total pada transaksi obT Msuk -->
<!-- <script type="text/javascript">
    function total() {
        var harga_beli = document.getElementById("rupiah1").value;
        var jumlah = document.getElementById("jumlah").value;

        var total = harga_beli * jumlah;

        document.getElementById('total').value = total;
    }
</script> -->

<!-- <script type="text/javascript">
    function math() {

        var a = parseInt(document.getElementById("harga").value);
        var b = parseInt(document.getElementById("jumlah").value);

        var total = a * b;

        document.getElementById('rupiah1').value = total;

    }
</script> -->

<!-- perhitungan transaksi pembelian -->
<script>
    function hitung() {
        var harga1 = (document.getElementById('harga').value == '' ? 0 : document.getElementById('harga').value);
        var jumlah = (document.getElementById('jumlah').value == '' ? 0 : document.getElementById('jumlah').value);
        var diskonn = (document.getElementById('disk').value == '' ? 0 : document.getElementById('disk').value);

        //menghilangkkan titik
        var harga = harga1.replace(".", "");

        var result = (parseInt(harga)) * (parseInt(jumlah));

        var diskon = (parseInt(diskonn)) * (parseInt(result)) / 100;

        var total = (parseInt(result)) - (parseInt(diskon));

        var number_string_total = total.toString(),
            sisatotal = number_string_total.length % 3,
            total = number_string_total.substr(0, sisatotal),
            ribuantotal = number_string_total.substr(sisatotal).match(/\d{3}/g);

        if (ribuantotal) {
            separator_total = sisatotal ? '.' : '';
            total += separator_total + ribuantotal.join('.');
        }
        document.getElementById("rupiah1").value = total;

        // if (!isNaN(hasil)) {
        //     document.getElementById('rupiah1').value = hasil;
        // }
    }
</script>


<!-- perhitungan transaksi penjualan -->
<script>
    function penjualan() {
        var harga1 = (document.getElementById('h_jual').value == '' ? 0 : document.getElementById('h_jual').value);
        var jumlah = (document.getElementById('jml_keluar').value == '' ? 0 : document.getElementById('jml_keluar').value);

        //menghilangkkan titik
        var harga = harga1.replace(".", "");

        var total = (parseInt(harga)) * (parseInt(jumlah));

        var number_string_total = total.toString(),
            sisatotal = number_string_total.length % 3,
            total = number_string_total.substr(0, sisatotal),
            ribuantotal = number_string_total.substr(sisatotal).match(/\d{3}/g);

        if (ribuantotal) {
            separator_total = sisatotal ? '.' : '';
            total += separator_total + ribuantotal.join('.');
        }
        document.getElementById("totall").value = total;

    }
</script>

<!-- perhitungan retur pembelian -->
<script>
    function pembelian() {
        var harga1 = (document.getElementById('h_beli').value == '' ? 0 : document.getElementById('h_beli').value);
        var jumlah = (document.getElementById('jml_masuk').value == '' ? 0 : document.getElementById('jml_masuk').value);

        //menghilangkkan titik
        var harga = harga1.replace(".", "");

        var total = (parseInt(harga)) * (parseInt(jumlah));

        var number_string_total = total.toString(),
            sisatotal = number_string_total.length % 3,
            total = number_string_total.substr(0, sisatotal),
            ribuantotal = number_string_total.substr(sisatotal).match(/\d{3}/g);

        if (ribuantotal) {
            separator_total = sisatotal ? '.' : '';
            total += separator_total + ribuantotal.join('.');
        }
        document.getElementById("totall").value = total;

    }
</script>

<script>
    function penjualan2() {
        var harga = (document.getElementById('h_beli').value == '' ? 0 : document.getElementById('h_beli').value);
        var jumlah = (document.getElementById('jml_keluar').value == '' ? 0 : document.getElementById('jml_keluar').value);

        var result = (parseInt(harga)) * (parseInt(jumlah));

        if (!isNaN(result)) {
            document.getElementById('totall').value = result;
        }
    }
</script>



<!-- perhitungan detail transaksi penjualan -->
<script>
    function detail_jual() {
        var total1 = (document.getElementById('total_jual').value == '' ? 0 : document.getElementById('total_jual').value);
        var tunai1 = (document.getElementById('rupiah1').value == '' ? 0 : document.getElementById('rupiah1').value);

        //menghilangkkan titik
        var total2 = total1.replace(".", "");
        var tunai2 = tunai1.replace(".", "");


        var total = (parseInt(tunai2)) - (parseInt(total2));

        var number_string_total = total.toString(),
            sisatotal = number_string_total.length % 3,
            total = number_string_total.substr(0, sisatotal),
            ribuantotal = number_string_total.substr(sisatotal).match(/\d{3}/g);

        if (ribuantotal) {
            separator_total = sisatotal ? '.' : '';
            total += separator_total + ribuantotal.join('.');
        }
        document.getElementById("kembalian").value = total;



    }
</script>

<!-- stok opname -->
<script>
    function stok_opname() {
        var sistem = (document.getElementById('jml_sistem').value == '' ? 0 : document.getElementById('jml_sistem').value);
        var rill = (document.getElementById('jml_rill').value == '' ? 0 : document.getElementById('jml_rill').value);

        var result = (parseInt(sistem)) - (parseInt(rill));

        if (!isNaN(result)) {
            document.getElementById('selisih').value = result;
        }

        if (result > 0) {
            document.getElementById('status1').value = 'Lebih';
        } else if (result < 0) {
            document.getElementById('status1').value = 'Kurang';
        } else {
            document.getElementById('status1').value = 'Sama';

        }


    }
</script>

<!-- persetujuan -->
<script>
    function setuju() {
        document.getElementById("t_setuju").style.display = "contents";
    }
</script>





<!-- jumlah otomatis laporan pembelian -->
<script>
    $(document).ready(function() {
        $('#example3').dataTable({
            "language": {
                "lengthMenu": 'Tampilkan <select>' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    // '<option value="5">5</option>' +
                    '<option value="-1">All</option>' +
                    '</select> Data'
            },
            "responsive": true,
            "autoWidth": false,
            // "sPaginationType": "full_numbers",
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;
                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ? i.replace(/[\Rp.]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                // total_salary over all pages
                total_salary = api.column(6).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                // total_page_salary over this page
                total_page_salary = api.column(6, {
                    page: 'current'
                }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                var rupiah = total_page_salary = parseFloat(total_page_salary);
                total_salary = parseFloat(total_salary);
                // Update footer
                $('#total_order1').html('Rp ' + total_page_salary.toLocaleString('id', {
                    currency: 'IDR'
                }));

                // total_salary over all pages
                total_salary = api.column(7).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                // total_page_salary over this page
                total_page_salary = api.column(7, {
                    page: 'current'
                }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                var rupiah = total_page_salary = parseFloat(total_page_salary);
                total_salary = parseFloat(total_salary);
                // Update footer
                $('#total_order2').html(total_page_salary.toLocaleString('id', {
                    currency: 'IDR'
                }));

                // total_salary over all pages
                total_salary = api.column(8).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                // total_page_salary over this page
                total_page_salary = api.column(8, {
                    page: 'current'
                }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                var rupiah = total_page_salary = parseFloat(total_page_salary);
                total_salary = parseFloat(total_salary);
                // Update footer
                $('#total_order3').html(total_page_salary.toLocaleString('id'));

                // total_salary over all pages
                total_salary = api.column(9).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                // total_page_salary over this page
                total_page_salary = api.column(9, {
                    page: 'current'
                }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                var rupiah = total_page_salary = parseFloat(total_page_salary);
                total_salary = parseFloat(total_salary);
                // Update footer
                $('#total_order4').html('Rp ' + total_page_salary.toLocaleString('id', {
                    currency: 'IDR'
                }));
            },
        });
    });
</script>


<!-- jumlah otomatis laporan penjualan -->
<script>
    $(document).ready(function() {
        $('#example4').dataTable({
            "language": {
                "lengthMenu": 'Tampilkan <select>' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    // '<option value="5">5</option>' +
                    '<option value="-1">All</option>' +
                    '</select> Data'
            },
            "responsive": true,
            "autoWidth": false,
            // "sPaginationType": "full_numbers",
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;
                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ? i.replace(/[\Rp.]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                // total_salary over all pages
                total_salary = api.column(6).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                // total_page_salary over this page
                total_page_salary = api.column(6, {
                    page: 'current'
                }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                var rupiah = total_page_salary = parseFloat(total_page_salary);
                total_salary = parseFloat(total_salary);
                // Update footer
                $('#total_order1').html('Rp ' + total_page_salary.toLocaleString('id', {
                    currency: 'IDR'
                }));

                // total_salary over all pages
                total_salary = api.column(7).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                // total_page_salary over this page
                total_page_salary = api.column(7, {
                    page: 'current'
                }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                var rupiah = total_page_salary = parseFloat(total_page_salary);
                total_salary = parseFloat(total_salary);
                // Update footer
                $('#total_order2').html(total_page_salary.toLocaleString('id', {
                    currency: 'IDR'
                }));

                // total_salary over all pages
                total_salary = api.column(8).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                // total_page_salary over this page
                total_page_salary = api.column(8, {
                    page: 'current'
                }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                var rupiah = total_page_salary = parseFloat(total_page_salary);
                total_salary = parseFloat(total_salary);
                // Update footer
                $('#total_order3').html('Rp ' + total_page_salary.toLocaleString('id', {
                    currency: 'IDR'
                }));
            },
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#example5').dataTable({
            "language": {
                "lengthMenu": 'Tampilkan <select>' +
                    '<option value="10">10</option>' +
                    '<option value="25">25</option>' +
                    '<option value="50">50</option>' +
                    '<option value="100">100</option>' +
                    // '<option value="5">5</option>' +
                    '<option value="-1">All</option>' +
                    '</select> Data'
            },
            "responsive": true,
            "autoWidth": false
        });
    });
</script>


<!-- grafik pembelian-->
<script>
    <?php
    $db = \Config\Database::connect();
    date_default_timezone_set("Asia/Jakarta");
    $year = date("Y"); //tahun sekarang
    $januari1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_januari FROM `detail_obat_masuk` AS a
    JOIN `obat_masuk` AS b ON b.`kd_obat_masuk` = a.`kd_obat_masuk` WHERE MONTH(b.`tanggal_masuk`) = '01' AND YEAR(b.`tanggal_masuk`) = '$year'");
    $januari = $januari1->getRow();

    $februari1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_februari FROM `detail_obat_masuk` AS a
    JOIN `obat_masuk` AS b ON b.`kd_obat_masuk` = a.`kd_obat_masuk` WHERE MONTH(b.`tanggal_masuk`) = '02'  AND YEAR(b.`tanggal_masuk`) = '$year'");
    $februari = $februari1->getRow();

    $maret1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_maret FROM `detail_obat_masuk` AS a
    JOIN `obat_masuk` AS b ON b.`kd_obat_masuk` = a.`kd_obat_masuk` WHERE MONTH(b.`tanggal_masuk`) = '03'  AND YEAR(b.`tanggal_masuk`) = '$year'");
    $maret = $maret1->getRow();

    $april1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_april FROM `detail_obat_masuk` AS a
    JOIN `obat_masuk` AS b ON b.`kd_obat_masuk` = a.`kd_obat_masuk` WHERE MONTH(b.`tanggal_masuk`) = '04'  AND YEAR(b.`tanggal_masuk`) = '$year'");
    $april = $april1->getRow();

    $mei1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_mei FROM `detail_obat_masuk` AS a
    JOIN `obat_masuk` AS b ON b.`kd_obat_masuk` = a.`kd_obat_masuk` WHERE MONTH(b.`tanggal_masuk`) = '05' AND YEAR(b.`tanggal_masuk`) = '$year'");
    $mei = $mei1->getRow();

    $juni1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_juni FROM `detail_obat_masuk` AS a
    JOIN `obat_masuk` AS b ON b.`kd_obat_masuk` = a.`kd_obat_masuk` WHERE MONTH(b.`tanggal_masuk`) = '06' AND YEAR(b.`tanggal_masuk`) = '$year'");
    $juni = $juni1->getRow();

    $juli1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_juli FROM `detail_obat_masuk` AS a
    JOIN `obat_masuk` AS b ON b.`kd_obat_masuk` = a.`kd_obat_masuk` WHERE MONTH(b.`tanggal_masuk`) = '07' AND YEAR(b.`tanggal_masuk`) = '$year'");
    $juli = $juli1->getRow();

    $agustus1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_agustus FROM `detail_obat_masuk` AS a
    JOIN `obat_masuk` AS b ON b.`kd_obat_masuk` = a.`kd_obat_masuk` WHERE MONTH(b.`tanggal_masuk`) = '08' AND YEAR(b.`tanggal_masuk`) = '$year'");
    $agustus = $agustus1->getRow();

    $september1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_september FROM `detail_obat_masuk` AS a
    JOIN `obat_masuk` AS b ON b.`kd_obat_masuk` = a.`kd_obat_masuk` WHERE MONTH(b.`tanggal_masuk`) = '09' AND YEAR(b.`tanggal_masuk`) = '$year'");
    $september = $september1->getRow();

    $oktober1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_oktober FROM `detail_obat_masuk` AS a
    JOIN `obat_masuk` AS b ON b.`kd_obat_masuk` = a.`kd_obat_masuk` WHERE MONTH(b.`tanggal_masuk`) = '10' AND YEAR(b.`tanggal_masuk`) = '$year'");
    $oktober = $oktober1->getRow();

    $november1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_november FROM `detail_obat_masuk` AS a
    JOIN `obat_masuk` AS b ON b.`kd_obat_masuk` = a.`kd_obat_masuk` WHERE MONTH(b.`tanggal_masuk`) = '11' AND YEAR(b.`tanggal_masuk`) = '$year'");
    $november = $november1->getRow();

    $desember1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_desember FROM `detail_obat_masuk` AS a
    JOIN `obat_masuk` AS b ON b.`kd_obat_masuk` = a.`kd_obat_masuk` WHERE MONTH(b.`tanggal_masuk`) = '12' AND YEAR(b.`tanggal_masuk`) = '$year'");
    $desember = $desember1->getRow();
    ?>

    var januari = <?php echo $januari->jml_januari; ?>;
    var februari = <?php echo $februari->jml_februari; ?>;
    var maret = <?php echo $maret->jml_maret; ?>;
    var april = <?php echo $april->jml_april; ?>;
    var mei = <?php echo $mei->jml_mei; ?>;
    var juni = <?php echo $juni->jml_juni; ?>;
    var juli = <?php echo $juli->jml_juli; ?>;
    var agustus = <?php echo $agustus->jml_agustus; ?>;
    var september = <?php echo $september->jml_september; ?>;
    var oktober = <?php echo $oktober->jml_oktober; ?>;
    var november = <?php echo $november->jml_november; ?>;
    var desember = <?php echo $desember->jml_desember; ?>;

    var ctx = document.getElementById('pembelian').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', ' Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'Jumlah',

                data: [januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',

                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',

                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


<!-- grafik pembelian-->
<script>
    <?php
    $db = \Config\Database::connect();
    date_default_timezone_set("Asia/Jakarta");
    $year = date("Y"); //tahun sekarang
    $januari1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_januari FROM `detail_obat_keluar` AS a
    JOIN `obat_keluar` AS b ON b.`kd_obat_keluar` = a.`kd_obat_keluar` WHERE MONTH(b.`tanggal_keluar`) = '01' AND YEAR(b.`tanggal_keluar`) = '$year'");
    $januari = $januari1->getRow();

    $februari1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_februari FROM `detail_obat_keluar` AS a
    JOIN `obat_keluar` AS b ON b.`kd_obat_keluar` = a.`kd_obat_keluar` WHERE MONTH(b.`tanggal_keluar`) = '02'  AND YEAR(b.`tanggal_keluar`) = '$year'");
    $februari = $februari1->getRow();

    $maret1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_maret FROM `detail_obat_keluar` AS a
    JOIN `obat_keluar` AS b ON b.`kd_obat_keluar` = a.`kd_obat_keluar` WHERE MONTH(b.`tanggal_keluar`) = '03'  AND YEAR(b.`tanggal_keluar`) = '$year'");
    $maret = $maret1->getRow();

    $april1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_april FROM `detail_obat_keluar` AS a
    JOIN `obat_keluar` AS b ON b.`kd_obat_keluar` = a.`kd_obat_keluar` WHERE MONTH(b.`tanggal_keluar`) = '04'  AND YEAR(b.`tanggal_keluar`) = '$year'");
    $april = $april1->getRow();

    $mei1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_mei FROM `detail_obat_keluar` AS a
    JOIN `obat_keluar` AS b ON b.`kd_obat_keluar` = a.`kd_obat_keluar` WHERE MONTH(b.`tanggal_keluar`) = '05' AND YEAR(b.`tanggal_keluar`) = '$year'");
    $mei = $mei1->getRow();

    $juni1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_juni FROM `detail_obat_keluar` AS a
    JOIN `obat_keluar` AS b ON b.`kd_obat_keluar` = a.`kd_obat_keluar` WHERE MONTH(b.`tanggal_keluar`) = '06' AND YEAR(b.`tanggal_keluar`) = '$year'");
    $juni = $juni1->getRow();

    $juli1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_juli FROM `detail_obat_keluar` AS a
    JOIN `obat_keluar` AS b ON b.`kd_obat_keluar` = a.`kd_obat_keluar` WHERE MONTH(b.`tanggal_keluar`) = '07' AND YEAR(b.`tanggal_keluar`) = '$year'");
    $juli = $juli1->getRow();

    $agustus1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_agustus FROM `detail_obat_keluar` AS a
    JOIN `obat_keluar` AS b ON b.`kd_obat_keluar` = a.`kd_obat_keluar` WHERE MONTH(b.`tanggal_keluar`) = '08' AND YEAR(b.`tanggal_keluar`) = '$year'");
    $agustus = $agustus1->getRow();

    $september1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_september FROM `detail_obat_keluar` AS a
    JOIN `obat_keluar` AS b ON b.`kd_obat_keluar` = a.`kd_obat_keluar` WHERE MONTH(b.`tanggal_keluar`) = '09' AND YEAR(b.`tanggal_keluar`) = '$year'");
    $september = $september1->getRow();

    $oktober1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_oktober FROM `detail_obat_keluar` AS a
    JOIN `obat_keluar` AS b ON b.`kd_obat_keluar` = a.`kd_obat_keluar` WHERE MONTH(b.`tanggal_keluar`) = '10' AND YEAR(b.`tanggal_keluar`) = '$year'");
    $oktober = $oktober1->getRow();

    $november1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_november FROM `detail_obat_keluar` AS a
    JOIN `obat_keluar` AS b ON b.`kd_obat_keluar` = a.`kd_obat_keluar` WHERE MONTH(b.`tanggal_keluar`) = '11' AND YEAR(b.`tanggal_keluar`) = '$year'");
    $november = $november1->getRow();

    $desember1 = $db->query("SELECT COUNT(a.`kode_detail`) AS jml_desember FROM `detail_obat_keluar` AS a
    JOIN `obat_keluar` AS b ON b.`kd_obat_keluar` = a.`kd_obat_keluar` WHERE MONTH(b.`tanggal_keluar`) = '12' AND YEAR(b.`tanggal_keluar`) = '$year'");
    $desember = $desember1->getRow();
    ?>

    var januari = <?php echo $januari->jml_januari; ?>;
    var februari = <?php echo $februari->jml_februari; ?>;
    var maret = <?php echo $maret->jml_maret; ?>;
    var april = <?php echo $april->jml_april; ?>;
    var mei = <?php echo $mei->jml_mei; ?>;
    var juni = <?php echo $juni->jml_juni; ?>;
    var juli = <?php echo $juli->jml_juli; ?>;
    var agustus = <?php echo $agustus->jml_agustus; ?>;
    var september = <?php echo $september->jml_september; ?>;
    var oktober = <?php echo $oktober->jml_oktober; ?>;
    var november = <?php echo $november->jml_november; ?>;
    var desember = <?php echo $desember->jml_desember; ?>;

    var ctx = document.getElementById('penjualan').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', ' Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'Jumlah',

                data: [januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',

                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',

                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</html>