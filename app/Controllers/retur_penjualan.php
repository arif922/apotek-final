<?php

namespace App\Controllers;

use CodeIgniter\Database\Query;
use CodeIgniter\Session\Session;

// use App\Models\contohmodel;
class retur_penjualan extends BaseController
{
    // protected $contoh_model;
    public function __construct()
    {
        // $this->contoh_model = new contohmodel();
    }
    public function view_returjual()
    {
        session()->remove('nama');
        session()->remove('id');
        $db = \Config\Database::connect();
        $q1 = $db->query("SELECT `kd_returjual`,DATE_FORMAT(tanggal_retur, '%d-%m-%Y') AS tanggal_retur,`username`,`nama_customer`
        FROM `retur_jual`
        JOIN `is_users` ON `is_users`.`id_user` = `retur_jual`.`id_user`
        JOIN `customer` ON `customer`.`id_customer` = `retur_jual`.`id_customer`")->getResultArray();

        //delet dump obat masuk
        $query2 = $db->query("DELETE FROM `dump_returjual`");




        $data = [
            'title' => 'Retur Penjualan',
            'dt_retur' => $q1,


        ];
        return view('retur_jual/view', $data);
    }

    public function go_inpreturjual()
    {
        //MEMBUAT KODE retur jual
        // AWAL
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        //mengambil kode RETUR JUAL dengan kode paling besar

        $db = \Config\Database::connect();
        $qq1 = $db->query("SELECT MAX(SUBSTRING(kd_returjual, 11)) AS maxKode FROM retur_jual;")->getResultArray();
        foreach ($qq1 as $aaa) {
            $bbb = $aaa['maxKode'];
        }

        // $noOrder = $bbb;
        // $noUrut = (int) substr($noOrder, 10, 6);

        $noUrut = $bbb;
        $noUrut++;
        $char = "RJ";
        // 2020-10-17 = 10 karakter
        //setelah karakter ke 2 ambil 2 karakter
        $tahun = substr($date, 2, 2);
        //setelah karakter ke 5 ambil 2 karakter
        $bulan = substr($date, 5, 2);
        //setelah karakter ke 8 ambil 2 karakter
        $tgl = substr($date, 8, 2);
        $kdtrans = $char . "-" . $tgl . $bulan . $tahun . "-" . sprintf("%06s", $noUrut);
        // AKHIR

        //MEMBUAT KODE DETAIL RETURJUAL
        // AWAL
        //mengambil kode DETAIL RETUR JUAL dengan kode paling besar

        $qq2 = $db->query("SELECT max(det_kd_returjual) as maxKode FROM detail_returjual")->getResultArray();
        foreach ($qq2 as $aaaa) {
            $bbbb = $aaaa['maxKode'];
        }

        $noOrder = $bbbb;
        $noUrut = (int) substr($noOrder, 10, 0);
        $noUrut++;
        $char = "DRJ";
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

        //menampilkan nama customer pada dropdown rincian retur jual
        $customer = $db->query("SELECT `customer`.`id_customer`, `customer`.`nama_customer` FROM `obat_keluar` 
        JOIN `detail_obat_keluar` ON `obat_keluar`.`kd_obat_keluar` = `detail_obat_keluar`.`kd_obat_keluar`
        JOIN `customer` ON `customer`.`id_customer` = `obat_keluar`.`id_customer` GROUP BY `customer`.`id_customer`")->getResultArray();

        $dump = $db->query("SELECT `det_kd_returjual`, `kd_returjual`,`dump_returjual`.`kode_obat`, `nama_obat`,`harga`, `jumlah_rj`, `sub_total`, `keterangan`
        FROM `dump_returjual`
        JOIN `is_obat` ON `is_obat`.`kode_obat` = `dump_returjual`.`kode_obat`")->getResultArray();

        //menjumlahkan di dump returjual
        $total = $db->query("SELECT SUM(`harga`) AS total_harga, SUM(`jumlah_rj`) AS total_rj, SUM(`sub_total`) AS total 
        FROM `dump_returjual`")->getResultArray();

        //menjumlahkan subtotal di dump returjual
        $jml_dump = $db->query("SELECT SUM(`sub_total`) AS jml_kembali FROM `dump_returjual`")->getResultArray();

        $cari_obat = $db->query("SELECT a.`kd_obat_keluar`, b.`kode_detail`, a.`tanggal_keluar`, d.`nama_customer`, c.`nama_obat`, b.`harga_jual`, b.`jumlah_keluar` FROM `obat_keluar` AS a
        JOIN `detail_obat_keluar` AS b ON a.`kd_obat_keluar` = b.`kd_obat_keluar`
        JOIN `is_obat` AS c ON c.`kode_obat` = b.`kode_obat`
        JOIN `customer` AS d ON d.`id_customer` = a.`id_customer`")->getResultArray();

        $cari_obat2 = $db->query("SELECT a.`kd_obat_keluar`, b.`kode_detail`, b.`kode_obat`, a.`tanggal_keluar`,d.`id_customer`, d.`nama_customer`, c.`nama_obat`, b.`harga_jual`, b.`jumlah_keluar` FROM `obat_keluar` AS a
        JOIN `detail_obat_keluar` AS b ON a.`kd_obat_keluar` = b.`kd_obat_keluar`
        JOIN `is_obat` AS c ON c.`kode_obat` = b.`kode_obat`
        JOIN `customer` AS d ON d.`id_customer` = a.`id_customer` WHERE	b.`kode_detail` = 'DT-020521-03-35-54'")->getResultArray();

        $data = [
            'title' => 'Tambah Retur Penjualan',
            'kdtrans' => $kdtrans,
            'kddet' => $kddet,
            'obat' => $obat,
            'customer' => $customer,
            'viewdump' => $dump,
            'jml_dump' => $jml_dump,
            'total' => $total,
            'cari_obat' => $cari_obat,
            'cari_obat2' => $cari_obat2,
        ];
        return view('retur_jual/input', $data);
    }

    public function go_inpreturjual2($kode_detail)
    {
        //MEMBUAT KODE retur jual
        // AWAL
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        //mengambil kode RETUR JUAL dengan kode paling besar

        $db = \Config\Database::connect();
        $qq1 = $db->query("SELECT MAX(SUBSTRING(kd_returjual, 11)) AS maxKode FROM retur_jual;")->getResultArray();
        foreach ($qq1 as $aaa) {
            $bbb = $aaa['maxKode'];
        }

        // $noOrder = $bbb;
        // $noUrut = (int) substr($noOrder, 10, 6);

        $noUrut = $bbb;
        $noUrut++;
        $char = "RJ";
        // 2020-10-17 = 10 karakter
        //setelah karakter ke 2 ambil 2 karakter
        $tahun = substr($date, 2, 2);
        //setelah karakter ke 5 ambil 2 karakter
        $bulan = substr($date, 5, 2);
        //setelah karakter ke 8 ambil 2 karakter
        $tgl = substr($date, 8, 2);
        $kdtrans = $char . "-" . $tgl . $bulan . $tahun . "-" . sprintf("%06s", $noUrut);
        // AKHIR

        //MEMBUAT KODE DETAIL RETURJUAL
        // AWAL
        //mengambil kode DETAIL RETUR JUAL dengan kode paling besar

        $qq2 = $db->query("SELECT max(det_kd_returjual) as maxKode FROM detail_returjual")->getResultArray();
        foreach ($qq2 as $aaaa) {
            $bbbb = $aaaa['maxKode'];
        }

        $noOrder = $bbbb;
        $noUrut = (int) substr($noOrder, 10, 0);
        $noUrut++;
        $char = "DRJ";
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

        $customer = $db->query("SELECT * FROM customer")->getResultArray();

        $dump = $db->query("SELECT `det_kd_returjual`, `kd_returjual`,`dump_returjual`.`kode_obat`, `nama_obat`,`harga`, `jumlah_rj`, `sub_total`, `keterangan`
        FROM `dump_returjual`
        JOIN `is_obat` ON `is_obat`.`kode_obat` = `dump_returjual`.`kode_obat`")->getResultArray();

        //menjumlahkan di dump returjual
        $total = $db->query("SELECT SUM(`harga`) AS total_harga, SUM(`jumlah_rj`) AS total_rj, SUM(`sub_total`) AS total 
        FROM `dump_returjual`")->getResultArray();

        //menjumlahkan subtotal di dump returjual
        $jml_dump = $db->query("SELECT SUM(`sub_total`) AS jml_kembali FROM `dump_returjual`")->getResultArray();

        $cari_obat = $db->query("SELECT a.`kd_obat_keluar`, b.`kode_detail`, a.`tanggal_keluar`, d.`nama_customer`, c.`nama_obat`, b.`harga_jual`, b.`jumlah_keluar` FROM `obat_keluar` AS a
        JOIN `detail_obat_keluar` AS b ON a.`kd_obat_keluar` = b.`kd_obat_keluar`
        JOIN `is_obat` AS c ON c.`kode_obat` = b.`kode_obat`
        JOIN `customer` AS d ON d.`id_customer` = a.`id_customer`")->getResultArray();

        $cari_obat2 = $db->query("SELECT a.`kd_obat_keluar`, b.`kode_detail`, b.`kode_obat`, a.`tanggal_keluar`,d.`id_customer`, d.`nama_customer`, c.`nama_obat`, b.`harga_jual`, b.`jumlah_keluar` FROM `obat_keluar` AS a
        JOIN `detail_obat_keluar` AS b ON a.`kd_obat_keluar` = b.`kd_obat_keluar`
        JOIN `is_obat` AS c ON c.`kode_obat` = b.`kode_obat`
        JOIN `customer` AS d ON d.`id_customer` = a.`id_customer` WHERE	b.`kode_detail` = '$kode_detail'")->getResultArray();

        $data = [
            'title' => 'Tambah Retur Penjualan',
            'kdtrans' => $kdtrans,
            'kddet' => $kddet,
            'obat' => $obat,
            'customer' => $customer,
            'viewdump' => $dump,
            'jml_dump' => $jml_dump,
            'total' => $total,
            'cari_obat' => $cari_obat,
            'cari_obat2' => $cari_obat2,
        ];
        return view('retur_jual/input2', $data);
    }

    public function tambahdump_rj()
    {
        // $id_customer = $this->request->getVar('id_customer');


        $kd_det = $this->request->getVar('det_kd_returjual');
        $kd = $this->request->getVar('kd_returjual');
        // $nm = $this->request->getVar('nm_obat');
        $kdobt = $this->request->getVar('kode_obat');
        $h_jual1 = $this->request->getVar('harga_jual');
        $h_jual = str_replace(".", "", $h_jual1);
        $jml = $this->request->getVar('jumlah_rj');
        $sub_total1 = $this->request->getVar('sub_total');
        $sub_total = str_replace(".", "", $sub_total1);
        $keterangan = $this->request->getVar('keterangan');

        $db = \Config\Database::connect();
        //cek dump
        $cek_dump = $db->query("SELECT * FROM dump_returjual where kode_obat = '$kdobt'")->getResultArray();
        if ($cek_dump == null) {
            $query = $db->query("INSERT INTO dump_returjual values('$kd_det','$kd','$kdobt','$h_jual','$jml','$sub_total','$keterangan')");
            // } elseif ($id_customer != session()->get('id')) {
            //     session()->setFlashdata('eror', 'Nama customer tidak sama.');
            //     return redirect()->to(base_url('/returjual/tambah'));
        } else {
            $cek_dump = $db->query("SELECT * FROM dump_returjual where kode_obat = '$kdobt'")->getResultArray();
            foreach ($cek_dump as $a) {
                $jml_rj = $a['jumlah_rj'];
                $ttl = $a['sub_total'];
            }
            $hasil1 = $jml_rj + $jml;
            $hasil2 = $ttl + $sub_total;
            // $update = $db->query("UPDATE dump_obrjuk SET jumlah_rjuk='$hasil1', diskon = '$diskon', total = '$hasil2' WHERE kode_obat='$kdobt'");
            $update = $db->query("UPDATE dump_returjual SET jumlah_rj='$hasil1', sub_total = '$hasil2' WHERE kode_obat='$kdobt'");
        }
        //menampilkan data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Berhasil Ditambah.');
        return redirect()->to(base_url('/returjual/tambah'));
    }

    //delet dump retur
    public function delete_dump($kode_detail)
    {
        $db = \Config\Database::connect();
        $db->query("DELETE FROM dump_returjual where det_kd_returjual = '$kode_detail'");

        // dd($kode_obat);
        //menampilkan data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        //kembali ke data obat view  
        return redirect()->to(base_url('/returjual/tambah'));
    }

    public function simpan_returjual()
    {
        $db = \Config\Database::connect();
        $g =  $db->query("SELECT COUNT('det_kd_returjual') as kd_det FROM dump_returjual")->getResultArray();
        foreach ($g as $t) {
            $hasil = $t['kd_det'];
        }

        if ($hasil < 1) {
            //menampilkan data berhasil disimpan
            session()->setFlashdata('eror', 'Data masih kosong');
            return redirect()->to(base_url('/returjual/tambah'));
        } else {


            // dd($this->request->getVar());
            $kode = $this->request->getVar('kode_returjual');
            $user = $this->request->getVar('id_user');
            $customer = $this->request->getVar('id_customer');
            $tanggal = $this->request->getVar('tgl1');
            // $kembali1 = $this->request->getVar('u_kembali');
            // $kembali = str_replace(".", "", $kembali1);


            $query = $db->query("INSERT INTO retur_jual VALUES ('$kode', '$tanggal', '$user', '$customer')");

            //query update stok
            //ambil semua data dr dump returjual
            $querydumpdet = $db->query("SELECT * FROM dump_returjual")->getResultArray();
            foreach ($querydumpdet as $a) {
                // ambil kode obat dan jumlah masuknya
                $kd_obat = $a['kode_obat'];
                $jml_rj = $a['jumlah_rj'];


                //ambil data obat berdasarkan kode obat di atas
                $cekobat = $db->query("SELECT * FROM is_obat where kode_obat='$kd_obat'")->getResultArray();
                foreach ($cekobat as $b) {
                    //ambil data stok nya
                    $stok = $b['stok'];
                }

                //menjumlah obat masuk dengan stok saat ini
                $stokupdate = $jml_rj + $stok;
                //update stok obat berdasarkan kode obat diatas
                $queryupdatestok = $db->query("UPDATE is_obat SET stok='$stokupdate' WHERE kode_obat='$kd_obat'");
            }


            $query2 = $db->query("INSERT INTO detail_returjual select * from `dump_returjual`");

            // $querydumpdet = $db->query("SELECT * FROM dump_obkeluar")->getResultArray();
            // foreach ($querydumpdet as $a) {
            //     $kd_obat = $a['kode_obat'];
            //     $jml_keluar = $a['jumlah_keluar'];

            //     $cekobat = $db->query("SELECT * FROM is_obat where kode_obat='$kd_obat'")->getResultArray();
            //     foreach ($cekobat as $b) {
            //         $stok = $b['stok'];
            //     }
            //     $stokupdate =  $stok - $jml_keluar;

            //     $queryupdatestok = $db->query("UPDATE is_obat SET stok='$stokupdate' WHERE kode_obat='$kd_obat'");
            // }

            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
            return redirect()->to(base_url('/returjual/view'));
        }
    }

    public function detail_rj($kd_returjual)
    {
        $db = \Config\Database::connect();
        $query2 = $db->query(
            "SELECT `kd_returjual`, `det_kd_returjual`, `detail_returjual`.`kode_obat`, `nama_obat`, `detail_returjual`.`harga`, `jumlah_rj`, `detail_returjual`.`sub_total`, keterangan 
            FROM `detail_returjual`
            JOIN `is_obat` ON `is_obat`.`kode_obat` = `detail_returjual`.`kode_obat` WHERE `kd_returjual` = '$kd_returjual'"
        )->getResultArray();

        //jumlah detail
        $query3 = $db->query("SELECT SUM(`harga`) AS total_harga, SUM(`jumlah_rj`) AS total_rj, SUM(`sub_total`) AS total 
        FROM `detail_returjual` WHERE `kd_returjual` = '$kd_returjual'")->getResultArray();

        //untuk cetak
        $query4 = $db->query("SELECT a.`kd_returjual`,DATE_FORMAT(b.`tanggal_retur`, '%d-%m-%Y') AS tanggal_retur, c.`username`, d.`nama_customer` FROM `detail_returjual` AS a
        JOIN `retur_jual` AS b ON b.`kd_returjual` = a.`kd_returjual`
        JOIN `is_users` AS c ON c.`id_user` = b.`id_user`
        JOIN `customer` AS d ON d.`id_customer` = b.`id_customer` WHERE a.`kd_returjual` = '$kd_returjual' GROUP BY a.`kd_returjual`")->getResultArray();

        $data = [
            'title' => 'Rincian Retur Penjualan',
            'detailreturjual' => $query2,
            'total' => $query3,
            'cetak' => $query4
        ];
        return view('retur_jual/detail', $data);
    }
}
