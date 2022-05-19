<?php

namespace App\Controllers;
// use App\Models\contohmodel;
class stok_opname extends BaseController
{
    protected $contoh_model;
    public function __construct()
    {
        // $this->contoh_model = new contohmodel();
    }
    public function view_so()
    {
        $db = \Config\Database::connect();
        $q1 = $db->query("SELECT `kd_so`, `username`, a.`tanggal`, a.`status` FROM `stok_opname` AS a
        JOIN `is_users` AS b ON b.`id_user` = a.`id_user`")->getResultArray();

        //delet dump obat masuk
        $query2 = $db->query("DELETE FROM `dump_so`");

        $data = [
            'title' => 'Data Stok Opname',
            'so' => $q1,
        ];
        return view('so/view', $data);
    }

    public function go_inpso()
    {
        //MEMBUAT KODE so
        // AWAL
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        //mengambil kode so dengan kode paling besar

        $db = \Config\Database::connect();
        $qq1 = $db->query("SELECT MAX(SUBSTRING(kd_so, 11)) AS maxKode FROM stok_opname;")->getResultArray();
        foreach ($qq1 as $aaa) {
            $bbb = $aaa['maxKode'];
        }

        // $noOrder = $bbb;
        // $noUrut = (int) substr($noOrder, 10, 6);

        $noUrut = $bbb;
        $noUrut++;
        $char = "SO";
        // 2020-10-17 = 10 karakter
        //setelah karakter ke 2 ambil 2 karakter
        $tahun = substr($date, 2, 2);
        //setelah karakter ke 5 ambil 2 karakter
        $bulan = substr($date, 5, 2);
        //setelah karakter ke 8 ambil 2 karakter
        $tgl = substr($date, 8, 2);
        $kdtrans = $char . "-" . $tgl . $bulan . $tahun . "-" . sprintf("%06s", $noUrut);
        // AKHIR

        //MEMBUAT KODE DETAIL so
        // AWAL
        //mengambil kode DETAIL so dengan kode paling besar

        $qq2 = $db->query("SELECT max(det_kd_so) as maxKode FROM detail_so")->getResultArray();
        foreach ($qq2 as $aaaa) {
            $bbbb = $aaaa['maxKode'];
        }

        $noOrder = $bbbb;
        $noUrut = (int) substr($noOrder, 10, 0);
        $noUrut++;
        $char = "DSO";
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


        $dump = $db->query("SELECT a.`det_kd_so`, a.`kd_so`, b.`nama_obat`, b.`kode_obat` , a.`jumlah_sistem`, a.`jumlah_rill`, a.`status`, a.`selisih`, c.`nama_satuan`
        FROM `dump_so` AS a
        JOIN `is_obat` AS b ON b.`kode_obat` = a.`kode_obat`
        JOIN `satuan` AS c ON c.`id_satuan` = b.`id_satuan`")->getResultArray();



        $data = [
            'title' => 'Tambah Stok Opname',
            'kdtrans' => $kdtrans,
            'kddet' => $kddet,
            'obat' => $obat,
            'viewdump' => $dump,
        ];
        return view('so/input', $data);
    }

    public function tambahdump_so()
    {

        if (!$this->validate([
            'kode_obat' => [
                'rules' => 'is_unique[dump_so.kode_obat]',
                'errors' => [
                    'is_unique' => 'Kode obat sudah ada'
                ]
            ]


        ])) {
            $validation = \Config\Services::validation();
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to(base_url('/so/tambah'));
        }

        $kd_det = $this->request->getVar('det_kd_so');
        $kd = $this->request->getVar('kd_so');
        // $nm = $this->request->getVar('nm_obat');
        $kdobt = $this->request->getVar('kode_obat');
        $sistem = $this->request->getVar('jumlah_sistem');
        $rill = $this->request->getVar('jumlah_rill');
        $status = $this->request->getVar('status');
        $selisih = $this->request->getVar('selisih');
        $keterangan = 'belum';


        $db = \Config\Database::connect();
        $query = $db->query("INSERT INTO dump_so values('$kd_det','$kd','$kdobt','$sistem','$rill','$status','$selisih','$keterangan')");

        //menampilkan data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Berhasil Ditambah.');
        return redirect()->to(base_url('/so/tambah'));
    }

    public function simpan_so()
    {
        $db = \Config\Database::connect();
        $g =  $db->query("SELECT COUNT('det_kd_so') as kd_det FROM dump_so")->getResultArray();
        foreach ($g as $t) {
            $hasil = $t['kd_det'];
        }

        if ($hasil < 1) {
            //menampilkan data berhasil disimpan
            session()->setFlashdata('eror', 'Data masih kosong');
            return redirect()->to(base_url('/so/tambah'));
        } else {


            // dd($this->request->getVar());
            $kode = $this->request->getVar('kd_so');
            $user = $this->request->getVar('id_user');
            $tanggal = $this->request->getVar('tgl1');
            $status = 'belum';
            $keterangan = 'belum';


            $query = $db->query("INSERT INTO stok_opname VALUES ('$kode', '$user', '$tanggal', '$status', '$keterangan')");
            $query2 = $db->query("INSERT INTO detail_so select * from `dump_so`");

            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
            return redirect()->to(base_url('/so/view'));
        }
    }

    public function detail_so($kd_so)
    {
        $db = \Config\Database::connect();
        $query2 = $db->query(
            "SELECT a.`det_kd_so`, a.`kd_so`, b.`nama_obat`, b.`kode_obat` , a.`jumlah_sistem`, a.`jumlah_rill`, a.`status`, a.`selisih`, c.`nama_satuan`
            FROM `detail_so` AS a
            JOIN `is_obat` AS b ON b.`kode_obat` = a.`kode_obat`
            JOIN `satuan` AS c ON c.`id_satuan` = b.`id_satuan` WHERE `kd_so` = '$kd_so'"
        )->getResultArray();
        $data = [
            'title' => 'Rincian Stok Opname',
            'detailso' => $query2
        ];
        return view('so/detail', $data);
    }

    //delet dump retur
    public function delete_dump_so($kode_detail)
    {
        $db = \Config\Database::connect();
        $db->query("DELETE FROM dump_so where det_kd_so = '$kode_detail'");

        // dd($kode_obat);
        //menampilkan data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        //kembali ke data obat view  
        return redirect()->to(base_url('/so/tambah'));
    }
}
