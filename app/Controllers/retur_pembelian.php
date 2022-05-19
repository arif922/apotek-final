<?php

namespace App\Controllers;

use CodeIgniter\Database\Query;
use CodeIgniter\Session\Session;

// use App\Models\contohmodel;
class retur_pembelian extends BaseController
{
    // protected $contoh_model;
    public function __construct()
    {
        // $this->contoh_model = new contohmodel();
    }
    public function view_returbeli()
    {
        session()->remove('nama');
        session()->remove('id');
        $db = \Config\Database::connect();
        $q1 = $db->query("SELECT `kd_returbeli`,DATE_FORMAT(tanggal_returbeli, '%d-%m-%Y') AS tanggal_retur,`username`,`nama_supplier`
        FROM `retur_beli`
        JOIN `is_users` ON `is_users`.`id_user` = `retur_beli`.`id_user`
        JOIN `supplier` ON `supplier`.`id_supplier` = `retur_beli`.`id_supplier`")->getResultArray();

        //delet dump obat masuk
        $query2 = $db->query("DELETE FROM `dump_returbeli`");




        $data = [
            'title' => 'Retur pembelian',
            'dt_retur' => $q1,


        ];
        return view('retur_beli/view', $data);
    }

    public function go_inpreturbeli()
    {
        //MEMBUAT KODE retur beli
        // AWAL
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        //mengambil kode RETUR beli dengan kode paling besar

        $db = \Config\Database::connect();
        $qq1 = $db->query("SELECT MAX(SUBSTRING(kd_returbeli, 11)) AS maxKode FROM retur_beli;")->getResultArray();
        foreach ($qq1 as $aaa) {
            $bbb = $aaa['maxKode'];
        }

        // $noOrder = $bbb;
        // $noUrut = (int) substr($noOrder, 10, 6);

        $noUrut = $bbb;
        $noUrut++;
        $char = "RB";
        // 2020-10-17 = 10 karakter
        //setelah karakter ke 2 ambil 2 karakter
        $tahun = substr($date, 2, 2);
        //setelah karakter ke 5 ambil 2 karakter
        $bulan = substr($date, 5, 2);
        //setelah karakter ke 8 ambil 2 karakter
        $tgl = substr($date, 8, 2);
        $kdtrans = $char . "-" . $tgl . $bulan . $tahun . "-" . sprintf("%06s", $noUrut);
        // AKHIR

        //MEMBUAT KODE DETAIL RETURbeli
        // AWAL
        //mengambil kode DETAIL RETUR beli dengan kode paling besar

        $qq2 = $db->query("SELECT max(det_kd_returbeli) as maxKode FROM detail_returbeli")->getResultArray();
        foreach ($qq2 as $aaaa) {
            $bbbb = $aaaa['maxKode'];
        }

        $noOrder = $bbbb;
        $noUrut = (int) substr($noOrder, 10, 0);
        $noUrut++;
        $char = "DRB";
        // 2020-10-17 = 10 karakter
        //setelah karakter ke 2 ambil 2 karakter
        $tahun = substr($date, 2, 2);
        //setelah karakter ke 5 ambil 2 karakter
        $bulan = substr($date, 5, 2);
        //setelah karakter ke 8 ambil 2 karakter
        $tgl = substr($date, 8, 2);
        $kddet = $char . "-" . $tgl . $bulan . $tahun . "-" . sprintf("", $noUrut);
        // AKHIR

        //MENAMPILKAN DATA OBAT PADA DROPDOWN dengan jumlah stok lbih dr 0
        $obat = $db->query("SELECT * FROM is_obat JOIN satuan ON satuan.`id_satuan` = `is_obat`.`id_satuan`")->getResultArray();

        //menampilkan nama supplier pada dropdown rincian retur beli
        $supplier = $db->query("SELECT `supplier`.`id_supplier`, `supplier`.`nama_supplier` FROM `obat_masuk` 
        JOIN `detail_obat_masuk` ON `obat_masuk`.`kd_obat_masuk` = `detail_obat_masuk`.`kd_obat_masuk`
        JOIN `supplier` ON `supplier`.`id_supplier` = `obat_masuk`.`id_supplier` GROUP BY `supplier`.`id_supplier`")->getResultArray();

        $dump = $db->query("SELECT `det_kd_returbeli`, `kd_returbeli`,`dump_returbeli`.`kode_obat`, `nama_obat`,`harga`, `jumlah_rb`, `sub_total`, `keterangan`
        FROM `dump_returbeli`
        JOIN `is_obat` ON `is_obat`.`kode_obat` = `dump_returbeli`.`kode_obat`")->getResultArray();

        //menjumlahkan di dump returbeli
        $total = $db->query("SELECT SUM(`harga`) AS total_harga, SUM(`jumlah_rb`) AS total_rb, SUM(`sub_total`) AS total 
        FROM `dump_returbeli`")->getResultArray();

        //menjumlahkan subtotal di dump returbeli
        $jml_dump = $db->query("SELECT SUM(`sub_total`) AS jml_kembali FROM `dump_returbeli`")->getResultArray();

        $cari_obat = $db->query("SELECT a.`kd_obat_masuk`, b.`kode_detail`,`obat_masuk`.`faktur`, a.`tanggal_masuk`, d.`nama_supplier`, c.`nama_obat`, c.`harga_beli`, b.`jumlah_masuk` FROM `obat_masuk` AS a
        JOIN `detail_obat_masuk` AS b ON a.`kd_obat_masuk` = b.`kd_obat_masuk`
        JOIN `obat_masuk` ON `obat_masuk`.`kd_obat_masuk` = a.`kd_obat_masuk`
        JOIN `is_obat` AS c ON c.`kode_obat` = b.`kode_obat`
        JOIN `supplier` AS d ON d.`id_supplier` = a.`id_supplier`")->getResultArray();

        $cari_obat2 = $db->query("SELECT a.`kd_obat_masuk`, b.`kode_detail`,`obat_masuk`.`faktur`, a.`tanggal_masuk`, d.`nama_supplier`, c.`nama_obat`, c.`harga_beli`, b.`jumlah_masuk` FROM `obat_masuk` AS a
        JOIN `detail_obat_masuk` AS b ON a.`kd_obat_masuk` = b.`kd_obat_masuk`
        JOIN `obat_masuk` ON `obat_masuk`.`kd_obat_masuk` = a.`kd_obat_masuk`
        JOIN `is_obat` AS c ON c.`kode_obat` = b.`kode_obat`
        JOIN `supplier` AS d ON d.`id_supplier` = a.`id_supplier` WHERE	b.`kode_detail` = 'DT-020521-03-35-54'")->getResultArray();

        $data = [
            'title' => 'Tambah Retur pembelian',
            'kdtrans' => $kdtrans,
            'kddet' => $kddet,
            'obat' => $obat,
            'supplier' => $supplier,
            'viewdump' => $dump,
            'jml_dump' => $jml_dump,
            'total' => $total,
            'cari_obat' => $cari_obat,
            'cari_obat2' => $cari_obat2,
        ];
        return view('retur_beli/input', $data);
    }

    public function go_inpreturbeli2($kode_detail)
    {
        //MEMBUAT KODE retur beli
        // AWAL
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        //mengambil kode RETUR beli dengan kode paling besar

        $db = \Config\Database::connect();
        $qq1 = $db->query("SELECT MAX(SUBSTRING(kd_returbeli, 11)) AS maxKode FROM retur_beli;")->getResultArray();
        foreach ($qq1 as $aaa) {
            $bbb = $aaa['maxKode'];
        }

        // $noOrder = $bbb;
        // $noUrut = (int) substr($noOrder, 10, 6);

        $noUrut = $bbb;
        $noUrut++;
        $char = "rb";
        // 2020-10-17 = 10 karakter
        //setelah karakter ke 2 ambil 2 karakter
        $tahun = substr($date, 2, 2);
        //setelah karakter ke 5 ambil 2 karakter
        $bulan = substr($date, 5, 2);
        //setelah karakter ke 8 ambil 2 karakter
        $tgl = substr($date, 8, 2);
        $kdtrans = $char . "-" . $tgl . $bulan . $tahun . "-" . sprintf("%06s", $noUrut);
        // AKHIR

        //MEMBUAT KODE DETAIL RETURbeli
        // AWAL
        //mengambil kode DETAIL RETUR beli dengan kode paling besar

        $qq2 = $db->query("SELECT max(det_kd_returbeli) as maxKode FROM detail_returbeli")->getResultArray();
        foreach ($qq2 as $aaaa) {
            $bbbb = $aaaa['maxKode'];
        }

        $noOrder = $bbbb;
        $noUrut = (int) substr($noOrder, 10, 0);
        $noUrut++;
        $char = "Drb";
        // 2020-10-17 = 10 karakter
        //setelah karakter ke 2 ambil 2 karakter
        $tahun = substr($date, 2, 2);
        //setelah karakter ke 5 ambil 2 karakter
        $bulan = substr($date, 5, 2);
        //setelah karakter ke 8 ambil 2 karakter
        $tgl = substr($date, 8, 2);
        $kddet = $char . "-" . $tgl . $bulan . $tahun . "-" . sprintf("", $noUrut);
        // AKHIR

        //MENAMPILKAN DATA OBAT PADA DROPDOWN dengan jumlah stok lbih dr 0
        $obat = $db->query("SELECT * FROM is_obat JOIN satuan ON satuan.`id_satuan` = `is_obat`.`id_satuan`")->getResultArray();

        $supplier = $db->query("SELECT * FROM supplier")->getResultArray();

        $dump = $db->query("SELECT `det_kd_returbeli`, `kd_returbeli`,`dump_returbeli`.`kode_obat`, `nama_obat`,`harga`, `jumlah_rb`, `sub_total`, `keterangan`
        FROM `dump_returbeli`
        JOIN `is_obat` ON `is_obat`.`kode_obat` = `dump_returbeli`.`kode_obat`")->getResultArray();

        //menjumlahkan di dump returbeli
        $total = $db->query("SELECT SUM(`harga`) AS total_harga, SUM(`jumlah_rb`) AS total_rb, SUM(`sub_total`) AS total 
        FROM `dump_returbeli`")->getResultArray();

        //menjumlahkan subtotal di dump returbeli
        $jml_dump = $db->query("SELECT SUM(`sub_total`) AS jml_kembali FROM `dump_returbeli`")->getResultArray();

        $cari_obat = $db->query("SELECT a.`kd_obat_masuk`, b.`kode_detail`,`obat_masuk`.`faktur`, a.`tanggal_masuk`, d.`nama_supplier`, d.`id_supplier`, c.`nama_obat`, c.`kode_obat`, c.`harga_beli`, b.`jumlah_masuk` FROM `obat_masuk` AS a
        JOIN `detail_obat_masuk` AS b ON a.`kd_obat_masuk` = b.`kd_obat_masuk`
        JOIN `obat_masuk` ON `obat_masuk`.`kd_obat_masuk` = a.`kd_obat_masuk`
        JOIN `is_obat` AS c ON c.`kode_obat` = b.`kode_obat`
        JOIN `supplier` AS d ON d.`id_supplier` = a.`id_supplier`")->getResultArray();

        $cari_obat2 = $db->query("SELECT a.`kd_obat_masuk`, b.`kode_detail`,`obat_masuk`.`faktur`, a.`tanggal_masuk`, d.`nama_supplier`, d.`id_supplier`, c.`nama_obat`, c.`kode_obat`, c.`harga_beli`, b.`jumlah_masuk` FROM `obat_masuk` AS a
        JOIN `detail_obat_masuk` AS b ON a.`kd_obat_masuk` = b.`kd_obat_masuk`
        JOIN `obat_masuk` ON `obat_masuk`.`kd_obat_masuk` = a.`kd_obat_masuk`
        JOIN `is_obat` AS c ON c.`kode_obat` = b.`kode_obat`
        JOIN `supplier` AS d ON d.`id_supplier` = a.`id_supplier` WHERE	b.`kode_detail` = '$kode_detail'")->getResultArray();

        $data = [
            'title' => 'Tambah Retur pembelian',
            'kdtrans' => $kdtrans,
            'kddet' => $kddet,
            'obat' => $obat,
            'supplier' => $supplier,
            'viewdump' => $dump,
            'jml_dump' => $jml_dump,
            'total' => $total,
            'cari_obat' => $cari_obat,
            'cari_obat2' => $cari_obat2,
        ];
        return view('retur_beli/input2', $data);
    }

    public function tambahdump_rb()
    {
        // $id_supplier = $this->request->getVar('id_supplier');


        $kd_det = $this->request->getVar('det_kd_returbeli');
        $kd = $this->request->getVar('kd_returbeli');
        // $nm = $this->request->getVar('nm_obat');
        $kdobt = $this->request->getVar('kode_obat');
        $h_beli1 = $this->request->getVar('harga_beli');
        $h_beli = str_replace(".", "", $h_beli1);
        $jml = $this->request->getVar('jumlah_rb');
        $sub_total1 = $this->request->getVar('sub_total');
        $sub_total = str_replace(".", "", $sub_total1);
        $keterangan = $this->request->getVar('keterangan');

        $db = \Config\Database::connect();
        //cek dump
        $cek_dump = $db->query("SELECT * FROM dump_returbeli where kode_obat = '$kdobt'")->getResultArray();
        if ($cek_dump == null) {
            $query = $db->query("INSERT INTO dump_returbeli values('$kd_det','$kd','$kdobt','$h_beli','$jml','$sub_total','$keterangan')");
            // } elseif ($id_supplier != session()->get('id')) {
            //     session()->setFlashdata('eror', 'Nama supplier tidak sama.');
            //     return redirect()->to(base_url('/returbeli/tambah'));
        } else {
            $cek_dump = $db->query("SELECT * FROM dump_returbeli where kode_obat = '$kdobt'")->getResultArray();
            foreach ($cek_dump as $a) {
                $jml_rb = $a['jumlah_rb'];
                $ttl = $a['sub_total'];
            }
            $hasil1 = $jml_rb + $jml;
            $hasil2 = $ttl + $sub_total;
            // $update = $db->query("UPDATE dump_obrbuk SET jumlah_rbuk='$hasil1', diskon = '$diskon', total = '$hasil2' WHERE kode_obat='$kdobt'");
            $update = $db->query("UPDATE dump_returbeli SET jumlah_rb='$hasil1', sub_total = '$hasil2' WHERE kode_obat='$kdobt'");
        }
        //menampilkan data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Berhasil Ditambah.');
        return redirect()->to(base_url('/returbeli/tambah'));
    }

    //delet dump retur
    public function delete_dump($kode_detail)
    {
        $db = \Config\Database::connect();
        $db->query("DELETE FROM dump_returbeli where det_kd_returbeli = '$kode_detail'");

        // dd($kode_obat);
        //menampilkan data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        //kembali ke data obat view  
        return redirect()->to(base_url('/returbeli/tambah'));
    }

    public function simpan_returbeli()
    {
        $db = \Config\Database::connect();
        $g =  $db->query("SELECT COUNT('det_kd_returbeli') as kd_det FROM dump_returbeli")->getResultArray();
        foreach ($g as $t) {
            $hasil = $t['kd_det'];
        }

        if ($hasil < 1) {
            //menampilkan data berhasil disimpan
            session()->setFlashdata('eror', 'Data masih kosong');
            return redirect()->to(base_url('/returbeli/tambah'));
        } else {


            // dd($this->request->getVar());
            $kode = $this->request->getVar('kode_returbeli');
            $user = $this->request->getVar('id_user');
            $supplier = $this->request->getVar('id_supplier');
            $tanggal = $this->request->getVar('tgl1');
            // $kembali1 = $this->request->getVar('u_kembali');
            // $kembali = str_replace(".", "", $kembali1);


            $query = $db->query("INSERT INTO retur_beli VALUES ('$kode', '$tanggal', '$user', '$supplier')");

            //query update stok
            //ambil semua data dr dump returbeli
            $querydumpdet = $db->query("SELECT * FROM dump_returbeli")->getResultArray();
            foreach ($querydumpdet as $a) {
                // ambil kode obat dan jumlah masuknya
                $kd_obat = $a['kode_obat'];
                $jml_rb = $a['jumlah_rb'];


                //ambil data obat berdasarkan kode obat di atas
                $cekobat = $db->query("SELECT * FROM is_obat where kode_obat='$kd_obat'")->getResultArray();
                foreach ($cekobat as $b) {
                    //ambil data stok nya
                    $stok = $b['stok'];
                }

                //menjumlah obat masuk dengan stok saat ini
                $stokupdate = $stok - $jml_rb;
                //update stok obat berdasarkan kode obat diatas
                $queryupdatestok = $db->query("UPDATE is_obat SET stok='$stokupdate' WHERE kode_obat='$kd_obat'");
            }


            $query2 = $db->query("INSERT INTO detail_returbeli select * from `dump_returbeli`");

            // $querydumpdet = $db->query("SELECT * FROM dump_obmasuk")->getResultArray();
            // foreach ($querydumpdet as $a) {
            //     $kd_obat = $a['kode_obat'];
            //     $jml_masuk = $a['jumlah_masuk'];

            //     $cekobat = $db->query("SELECT * FROM is_obat where kode_obat='$kd_obat'")->getResultArray();
            //     foreach ($cekobat as $b) {
            //         $stok = $b['stok'];
            //     }
            //     $stokupdate =  $stok - $jml_masuk;

            //     $queryupdatestok = $db->query("UPDATE is_obat SET stok='$stokupdate' WHERE kode_obat='$kd_obat'");
            // }

            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
            return redirect()->to(base_url('/returbeli/view'));
        }
    }

    public function detail_rb($kd_returbeli)
    {
        $db = \Config\Database::connect();
        $query2 = $db->query(
            "SELECT `kd_returbeli`, `det_kd_returbeli`, `detail_returbeli`.`kode_obat`, `nama_obat`, `detail_returbeli`.`harga`, `jumlah_rb`, `detail_returbeli`.`sub_total`, keterangan 
            FROM `detail_returbeli`
            JOIN `is_obat` ON `is_obat`.`kode_obat` = `detail_returbeli`.`kode_obat` WHERE `kd_returbeli` = '$kd_returbeli'"
        )->getResultArray();

        //jumlah detail
        $query3 = $db->query("SELECT SUM(`harga`) AS total_harga, SUM(`jumlah_rb`) AS total_rb, SUM(`sub_total`) AS total 
        FROM `detail_returbeli` WHERE `kd_returbeli` = '$kd_returbeli'")->getResultArray();

        //untuk cetak
        $query4 = $db->query("SELECT a.`kd_returbeli`,DATE_FORMAT(b.`tanggal_returbeli`, '%d-%m-%Y') AS tanggal_retur, c.`username`, d.`nama_supplier` FROM `detail_returbeli` AS a
        JOIN `retur_beli` AS b ON b.`kd_returbeli` = a.`kd_returbeli`
        JOIN `is_users` AS c ON c.`id_user` = b.`id_user`
        JOIN `supplier` AS d ON d.`id_supplier` = b.`id_supplier` WHERE a.`kd_returbeli` = '$kd_returbeli' GROUP BY a.`kd_returbeli`")->getResultArray();

        $data = [
            'title' => 'Rincian Retur pembelian',
            'detailreturbeli' => $query2,
            'total' => $query3,
            'cetak' => $query4
        ];
        return view('retur_beli/detail', $data);
    }
}
