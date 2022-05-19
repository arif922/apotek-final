<?php

namespace App\Controllers;
// use App\Models\contohmodel;
class j_penyesuaian extends BaseController
{
    protected $contoh_model;
    public function __construct()
    {
        // $this->contoh_model = new contohmodel();
    }
    public function view1()
    {
        $db = \Config\Database::connect();
        $qy2 = $db->query("DELETE FROM dump_penyesuaian");


        $q1 = $db->query("SELECT `kd_so`, `username`, a.`tanggal`, a.`status` FROM `stok_opname` AS a
        JOIN `is_users` AS b ON b.`id_user` = a.`id_user` WHERE `status` = 'belum'")->getResultArray();

        $q2 = $db->query("SELECT `kd_so`, `username`, a.`tanggal`, a.`status` FROM `stok_opname` AS a
JOIN `is_users` AS b ON b.`id_user` = a.`id_user` WHERE `status` = 'disesuaikan'")->getResultArray();

        $data = [
            'title' => 'Penyesuaian Stok Opname',
            'so' => $q1,
            'so2' => $q2,
        ];
        return view('penyesuaian/view', $data);
    }

    public function view2($kd_so)
    {
        $db = \Config\Database::connect();
        //cek dump penyesuaian
        $cek_dump = $db->query("SELECT COUNT(`det_kd_so`) AS det_so FROM `detail_so` WHERE `kd_so` = '$kd_so' AND `keterangan` = 'belum'")->getResultArray();
        foreach ($cek_dump as $aa) {
            $bb = $aa['det_so'];
        }
        if ($bb >= 1) {

            session()->setFlashdata('gagal', 'Terdapat Data Yang Belum Disesuaikan');
            $db = \Config\Database::connect();
            $query2 = $db->query(
                "SELECT a.`det_kd_so`, a.`kd_so`, b.`nama_obat`, b.`kode_obat` , a.`jumlah_sistem`, a.`jumlah_rill`, a.`status`, a.`selisih`, c.`nama_satuan`, a.`keterangan`
            FROM `detail_so` AS a
            JOIN `is_obat` AS b ON b.`kode_obat` = a.`kode_obat`
            JOIN `satuan` AS c ON c.`id_satuan` = b.`id_satuan` WHERE `kd_so` = '$kd_so' AND `status` IN ('lebih', 'kurang')"
            )->getResultArray();
            $data = [
                'title' => 'Draf Jurnal Penyesuaian',
                'detailso' => $query2
            ];
            return view('penyesuaian/detail', $data);
        } else {
            //memindahkan data dr dump ke penyesuaian
            $qy1 = $db->query("INSERT INTO `penyesuaian` SELECT * FROM `dump_penyesuaian`");
            //hapus dump
            $qy2 = $db->query("DELETE FROM dump_penyesuaian");

            $qy3 = $db->query("UPDATE `stok_opname` SET `status` = 'disesuaikan' WHERE `kd_so` = '$kd_so'");

            $q1 = $db->query("SELECT `kd_so`, `username`, a.`tanggal`, a.`status` FROM `stok_opname` AS a
            JOIN `is_users` AS b ON b.`id_user` = a.`id_user` WHERE `status` = 'belum'")->getResultArray();

            $q2 = $db->query("SELECT `kd_so`, `username`, a.`tanggal`, a.`status` FROM `stok_opname` AS a
JOIN `is_users` AS b ON b.`id_user` = a.`id_user` WHERE `status` = 'disesuaikan'")->getResultArray();

            $data = [
                'title' => 'Jurnal Penyesuaian',
                'so' => $q1,
                'so2' => $q2,

            ];
            return view('penyesuaian/view', $data);
        }
    }

    public function detail1($kd_so)
    {
        $db = \Config\Database::connect();
        $query2 = $db->query(
            "SELECT a.`det_kd_so`, a.`kd_so`, b.`nama_obat`, b.`kode_obat` , a.`jumlah_sistem`, a.`jumlah_rill`, a.`status`, a.`selisih`, c.`nama_satuan`, a.`keterangan`
            FROM `detail_so` AS a
            JOIN `is_obat` AS b ON b.`kode_obat` = a.`kode_obat`
            JOIN `satuan` AS c ON c.`id_satuan` = b.`id_satuan` WHERE `kd_so` = '$kd_so' AND `status` IN ('lebih', 'kurang')"
        )->getResultArray();
        $data = [
            'title' => 'Draf Jurnal Penyesuaian',
            'detailso' => $query2
        ];
        return view('penyesuaian/detail', $data);
    }

    public function detail2($det_kd_so)
    {

        $db = \Config\Database::connect();

        //menampilkan draf obat stok opname
        $query2 = $db->query(
            "SELECT a.`det_kd_so`, a.`kd_so`, b.`nama_obat`, b.`kode_obat` , a.`jumlah_sistem`, a.`jumlah_rill`, a.`status`, a.`selisih`, c.`nama_satuan`
            FROM `detail_so` AS a
            JOIN `is_obat` AS b ON b.`kode_obat` = a.`kode_obat`
            JOIN `satuan` AS c ON c.`id_satuan` = b.`id_satuan` WHERE `det_kd_so` = '$det_kd_so'"
        )->getResultArray();

        //menampilkan dump penyesuaian
        $query3 = $db->query("SELECT p.`kd_penyesuaian`, p.`det_kd_so`, username, p.`tindakan`, p.`jumlah`, p.`keterangan` FROM `dump_penyesuaian` AS p
        JOIN `detail_so` ON `detail_so`.`det_kd_so` = p.`det_kd_so`
        JOIN `is_users` ON `is_users`.`id_user` = p.`id_user` WHERE p.`det_kd_so` = '$det_kd_so'")->getResultArray();

        //mengambil kode DETAIL RETUR JUAL dengan kode paling besar
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");
        $date2 = date("h-i-s");

        $char = "PNY";
        // 2020-10-17 = 10 karakter
        //setelah karakter ke 2 ambil 2 karakter
        $tahun = substr($date, 2, 2);
        //setelah karakter ke 5 ambil 2 karakter
        $bulan = substr($date, 5, 2);
        //setelah karakter ke 8 ambil 2 karakter
        $tgl = substr($date, 8, 2);
        $kddet = $char . "-" . $tgl . $bulan . $tahun . "-" . $date2;


        $data = [
            'title' => 'Draf Obat Stok Opname',
            'detailso' => $query2,
            'penyesuaian' => $query3,
            'kd_pen' => $kddet
        ];
        return view('penyesuaian/detail2', $data);
    }

    //tombol tambah (penyesuaian draf obat stok opname)
    public function save1($det_kd_so)
    {

        $db = \Config\Database::connect();
        //menampilkan draf obat stok opname
        $query2 = $db->query(
            "SELECT a.`det_kd_so`, a.`kd_so`, b.`nama_obat`, b.`kode_obat` , a.`jumlah_sistem`, a.`jumlah_rill`, a.`status`, a.`selisih`, c.`nama_satuan`
            FROM `detail_so` AS a
            JOIN `is_obat` AS b ON b.`kode_obat` = a.`kode_obat`
            JOIN `satuan` AS c ON c.`id_satuan` = b.`id_satuan` WHERE `det_kd_so` = '$det_kd_so'"
        )->getResultArray();

        //mengambil kode DETAIL RETUR JUAL dengan kode paling besar
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");
        $date2 = date("h-i-s");

        $char = "PNY";
        // 2020-10-17 = 10 karakter
        //setelah karakter ke 2 ambil 2 karakter
        $tahun = substr($date, 2, 2);
        //setelah karakter ke 5 ambil 2 karakter
        $bulan = substr($date, 5, 2);
        //setelah karakter ke 8 ambil 2 karakter
        $tgl = substr($date, 8, 2);
        $kddet = $char . "-" . $tgl . $bulan . $tahun . "-" . $date2;

        $kd_penyesuaian = $this->request->getVar('kd_penyesuaian');
        $det_kd_so = $this->request->getVar('det_kd_so');
        $id_user = $this->request->getVar('id_user');
        $tindakan = $this->request->getVar('tindakan');
        $jumlah = $this->request->getVar('jumlah');
        $keterangan = $this->request->getVar('keterangan');
        $status = 'dalam proses';

        if (!$this->validate([
            'kd_penyesuaian' => [
                'rules' => 'is_unique[dump_penyesuaian.kd_penyesuaian]',
                'errors' => [
                    'is_unique' => 'Kode Penyesuaian Sudah Ada.'
                ]
            ]


        ])) {
            $validation = \Config\Services::validation();
            if ($validation) {
                session()->setFlashdata('gagal', $validation->listErrors());

                //menampilkan dump penyesuaian
                $query3 = $db->query("SELECT p.`kd_penyesuaian`, p.`det_kd_so`, username, p.`tindakan`, p.`jumlah`, p.`keterangan` FROM `dump_penyesuaian` AS p
        JOIN `detail_so` ON `detail_so`.`det_kd_so` = p.`det_kd_so`
        JOIN `is_users` ON `is_users`.`id_user` = p.`id_user` WHERE p.`det_kd_so` = '$det_kd_so'")->getResultArray();

                $data = [
                    'title' => 'Draf Obat Stok Opname',
                    'detailso' => $query2,
                    'penyesuaian' => $query3,
                    'kd_pen' => $kddet
                ];
                return view('penyesuaian/detail2', $data);
            }
        }

        $db = \Config\Database::connect();
        $query = $db->query("INSERT INTO dump_penyesuaian values('$kd_penyesuaian','$det_kd_so','$id_user','$tindakan','$jumlah','$keterangan','$status')");

        //menampilkan dump penyesuaian
        $query3 = $db->query("SELECT p.`kd_penyesuaian`, p.`det_kd_so`, username, p.`tindakan`, p.`jumlah`, p.`keterangan` FROM `dump_penyesuaian` AS p
      JOIN `detail_so` ON `detail_so`.`det_kd_so` = p.`det_kd_so`
      JOIN `is_users` ON `is_users`.`id_user` = p.`id_user` WHERE p.`det_kd_so` = '$det_kd_so'")->getResultArray();

        $data = [
            'title' => 'Draf Obat Stok Opname',
            'detailso' => $query2,
            'penyesuaian' => $query3,
            'kd_pen' => $kddet
        ];
        //menampilkan data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Berhasil Ditambah.');
        return view('penyesuaian/detail2', $data);
    }

    //tombol simpan (penyesuaian draf obat stok opname)
    public function simpann($kd_so, $det_kd_so)
    {

        // var_dump($kd_so, '-', $det_kd_so);
        // die;
        $db = \Config\Database::connect();
        $q1 = $db->query("SELECT count(kd_penyesuaian) as pen FROM dump_penyesuaian where det_kd_so = '$det_kd_so'")->getResultArray();
        foreach ($q1 as $aa) {
            $bb = $aa['pen'];
        }
        if ($bb == 0) {
            session()->setFlashdata('gagal', 'Data Masih Kosong.');
            return redirect()->to(base_url('det_penyesuaian2/' . $det_kd_so));
        } else {
            $q2 = $db->query("UPDATE `detail_so` SET `keterangan` = 'sudah' WHERE `det_kd_so` = '$det_kd_so'");

            return redirect()->to(base_url('det_penyesuaian/' . $kd_so));
        }
    }

    //tombol batal (penyesuaian draf obat stok opname)
    public function batal($kd_so, $det_kd_so)
    {

        $db = \Config\Database::connect();
        $q1 = $db->query("DELETE FROM dump_penyesuaian where det_kd_so = '$det_kd_so'")->getResultArray();

        return redirect()->to(base_url('det_penyesuaian/' . $kd_so));
    }

    //tombol kembali (draf jurnal penyesuaian)
    public function kembali($kd_so)
    {

        $db = \Config\Database::connect();
        $q1 = $db->query("SELECT count(kd_penyesuaian) as pen FROM `dump_penyesuaian`")->getResultArray();
        foreach ($q1 as $aa) {
            $bb = $aa['pen'];
        }
        if ($bb == 0) {
            return redirect()->to(base_url('/penyesuaian'));
        } else {
            session()->setFlashdata('gagal', 'Anda Harus Menyelesaikan Penyesuaian Terlebih Dahulu.');
            return redirect()->to(base_url('det_penyesuaian/' . $kd_so));
        }
    }

    public function delete_penyesuaian($kd_penyesuaian)
    {

        $db = \Config\Database::connect();
        $query4 = $db->query("DELETE FROM dump_penyesuaian WHERE kd_penyesuaian = '$kd_penyesuaian'");

        $det_kd_so = $this->request->getVar('det_kd_so');

        //menampilkan dras obat stok opname
        $query2 = $db->query(
            "SELECT a.`det_kd_so`, a.`kd_so`, b.`nama_obat`, b.`kode_obat` , a.`jumlah_sistem`, a.`jumlah_rill`, a.`status`, a.`selisih`, c.`nama_satuan`
            FROM `detail_so` AS a
            JOIN `is_obat` AS b ON b.`kode_obat` = a.`kode_obat`
            JOIN `satuan` AS c ON c.`id_satuan` = b.`id_satuan` WHERE `det_kd_so` = '$det_kd_so'"
        )->getResultArray();

        //mengambil kode DETAIL RETUR JUAL dengan kode paling besar
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");
        $date2 = date("h-i-s");

        $char = "PNY";
        // 2020-10-17 = 10 karakter
        //setelah karakter ke 2 ambil 2 karakter
        $tahun = substr($date, 2, 2);
        //setelah karakter ke 5 ambil 2 karakter
        $bulan = substr($date, 5, 2);
        //setelah karakter ke 8 ambil 2 karakter
        $tgl = substr($date, 8, 2);
        $kddet = $char . "-" . $tgl . $bulan . $tahun . "-" . $date2;

        //menampilkan dump penyesuaian
        $query3 = $db->query("SELECT p.`kd_penyesuaian`, p.`det_kd_so`, username, p.`tindakan`, p.`jumlah`, p.`keterangan` FROM `dump_penyesuaian` AS p
      JOIN `detail_so` ON `detail_so`.`det_kd_so` = p.`det_kd_so`
      JOIN `is_users` ON `is_users`.`id_user` = p.`id_user` WHERE p.`det_kd_so` = '$det_kd_so'")->getResultArray();


        $data = [
            'title' => 'Draf Obat Stok Opname',
            'detailso' => $query2,
            'penyesuaian' => $query3,
            'kd_pen' => $kddet
        ];
        //menampilkan data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        return view('penyesuaian/detail2', $data);
    }

    public function save_penyesuaian($kd_so)
    {
        $db = \Config\Database::connect();
        // $query1 = $db->query("INSERT INTO `penyesuaian` SELECT * FROM `dump_penyesuaian`");
        // $query2 = $db->query("DELETE FROM dump_penyesuaian");


        $query3 = $db->query(
            "SELECT a.`det_kd_so`, a.`kd_so`, b.`nama_obat`, b.`kode_obat` , a.`jumlah_sistem`, a.`jumlah_rill`, a.`status`, a.`selisih`, c.`nama_satuan`
            FROM `detail_so` AS a
            JOIN `is_obat` AS b ON b.`kode_obat` = a.`kode_obat`
            JOIN `satuan` AS c ON c.`id_satuan` = b.`id_satuan` WHERE `kd_so` = '$kd_so' AND `status` IN ('lebih', 'kurang')"
        )->getResultArray();
        $data = [
            'title' => 'Draf Jurnal Penyesuaian',
            'detailso' => $query3
        ];
        return view('penyesuaian/detail', $data);
    }


    //persetujuannn
    public function setuju1($kd_so)
    {
        $db = \Config\Database::connect();
        $query2 = $db->query(
            "SELECT a.`det_kd_so`, a.`kd_so`, b.`nama_obat`, b.`kode_obat` , a.`jumlah_sistem`, a.`jumlah_rill`, a.`status`, a.`selisih`, c.`nama_satuan`
            FROM `detail_so` AS a
            JOIN `is_obat` AS b ON b.`kode_obat` = a.`kode_obat`
            JOIN `satuan` AS c ON c.`id_satuan` = b.`id_satuan` WHERE `kd_so` = '$kd_so' AND `status` IN ('lebih', 'kurang')"
        )->getResultArray();
        $data = [
            'title' => 'Draf Jurnal Persetujuan',
            'detailso' => $query2
        ];
        return view('penyesuaian/detail-setuju', $data);
    }

    public function setuju2($det_kd_so)
    {

        $db = \Config\Database::connect();

        //menampilkan draf persetujuan
        $query2 = $db->query(
            "SELECT a.`det_kd_so`, a.`kd_so`, b.`nama_obat`, b.`kode_obat` , a.`jumlah_sistem`, a.`jumlah_rill`, a.`status`, a.`selisih`, c.`nama_satuan`
            FROM `detail_so` AS a
            JOIN `is_obat` AS b ON b.`kode_obat` = a.`kode_obat`
            JOIN `satuan` AS c ON c.`id_satuan` = b.`id_satuan` WHERE `det_kd_so` = '$det_kd_so'"
        )->getResultArray();

        //menampilkan penyesuaian
        $query3 = $db->query("SELECT `kd_penyesuaian`, `det_kd_so`, `username`, `tindakan`, `jumlah`, `keterangan`, `status` FROM `penyesuaian` AS a
        JOIN `is_users` AS b ON b.`id_user` = a.`id_user` WHERE `det_kd_so` = '$det_kd_so'")->getResultArray();


        $data = [
            'title' => 'Draf Persetujuan',
            'detailso' => $query2,
            'penyesuaian' => $query3,
        ];
        return view('penyesuaian/detail2-setuju', $data);
    }

    public function disetujuii($kd_penyesuaian)
    {
        $kd_obat = $this->request->getPost('kd_obat');
        $det_kd_so = $this->request->getPost('det_kd_so');

        $db = \Config\Database::connect();
        //mengambil stok obat
        $q1 = $db->query("SELECT * FROM `is_obat` WHERE `kode_obat` = '$kd_obat' ")->getResultArray();
        foreach ($q1 as $k_ob) {
            $stok_ob = $k_ob['stok'];
        }

        //mengambil jumlah di tabel penyesuaian
        $q2 = $db->query("SELECT * FROM `penyesuaian` WHERE `kd_penyesuaian` = '$kd_penyesuaian'")->getResultArray();
        foreach ($q2 as $jml_p) {
            $jml_pny = $jml_p['jumlah'];
            $tindakan = $jml_p['tindakan'];
        }

        if ($tindakan == 'Tambah') {
            $update_status = $db->query("UPDATE `penyesuaian` SET `status`='Disetujui-tambah' WHERE kd_penyesuaian='$kd_penyesuaian'");
            $hasil = $stok_ob + $jml_pny;
        } else if ($tindakan == 'Kurangi') {
            $update_status = $db->query("UPDATE `penyesuaian` SET `status`='Disetujui-kurangi' WHERE kd_penyesuaian='$kd_penyesuaian'");
            $hasil = $stok_ob - $jml_pny;
        } else if ($tindakan == 'Obat Expired') {
            $update_status = $db->query("UPDATE `penyesuaian` SET `status`='Disetujui-expired' WHERE kd_penyesuaian='$kd_penyesuaian'");
            $hasil = $stok_ob - $jml_pny;
        } else if ($tindakan == 'Tidak Dilakukan Tindakan') {
            $hasil = $stok_ob;
            $update_status = $db->query("UPDATE `penyesuaian` SET `status`='Disetujui-tidak dilakukan tindakan' WHERE kd_penyesuaian='$kd_penyesuaian'");
        } else {
            $update_status = $db->query("UPDATE `penyesuaian` SET `status`='tidak desutujui' WHERE kd_penyesuaian='$kd_penyesuaian'");
        }
        // update
        $queryupdatestok = $db->query("UPDATE is_obat SET stok='$hasil' WHERE kode_obat='$kd_obat'");



        //menampilkan draf persetujuan
        $query2 = $db->query(
            "SELECT a.`det_kd_so`, a.`kd_so`, b.`nama_obat`, b.`kode_obat` , a.`jumlah_sistem`, a.`jumlah_rill`, a.`status`, a.`selisih`, c.`nama_satuan`
        FROM `detail_so` AS a
        JOIN `is_obat` AS b ON b.`kode_obat` = a.`kode_obat`
        JOIN `satuan` AS c ON c.`id_satuan` = b.`id_satuan` WHERE `det_kd_so` = '$det_kd_so'"
        )->getResultArray();

        //menampilkan penyesuaian
        $query3 = $db->query("SELECT `kd_penyesuaian`, `det_kd_so`, `username`, `tindakan`, `jumlah`, `keterangan`, `status` FROM `penyesuaian` AS a
        JOIN `is_users` AS b ON b.`id_user` = a.`id_user` WHERE `det_kd_so` = '$det_kd_so'")->getResultArray();


        $data = [
            'title' => 'Draf Persetujuan',
            'detailso' => $query2,
            'penyesuaian' => $query3,
        ];

        // session()->setFlashdata('berhasil', 'Data Disetujui.');
        return view('penyesuaian/detail2-setuju', $data);
    }

    public function tidak_disetujuii($kd_penyesuaian)
    {
        $kd_obat = $this->request->getPost('kd_obat');
        $det_kd_so = $this->request->getPost('det_kd_so');

        $db = \Config\Database::connect();

        $update_status = $db->query("UPDATE `penyesuaian` SET `status`='tidak disetujui' WHERE kd_penyesuaian='$kd_penyesuaian'");

        //menampilkan draf persetujuan
        $query2 = $db->query(
            "SELECT a.`det_kd_so`, a.`kd_so`, b.`nama_obat`, b.`kode_obat` , a.`jumlah_sistem`, a.`jumlah_rill`, a.`status`, a.`selisih`, c.`nama_satuan`
        FROM `detail_so` AS a
        JOIN `is_obat` AS b ON b.`kode_obat` = a.`kode_obat`
        JOIN `satuan` AS c ON c.`id_satuan` = b.`id_satuan` WHERE `det_kd_so` = '$det_kd_so'"
        )->getResultArray();

        //menampilkan penyesuaian
        $query3 = $db->query("SELECT `kd_penyesuaian`, `det_kd_so`, `username`, `tindakan`, `jumlah`, `keterangan`, `status` FROM `penyesuaian` AS a
        JOIN `is_users` AS b ON b.`id_user` = a.`id_user` WHERE `det_kd_so` = '$det_kd_so'")->getResultArray();


        $data = [
            'title' => 'Draf Persetujuan',
            'detailso' => $query2,
            'penyesuaian' => $query3,
        ];

        // session()->setFlashdata('berhasil', 'Data Disetujui.');
        return view('penyesuaian/detail2-setuju', $data);
    }

    public function view_setuju()
    {
        $db = \Config\Database::connect();
        $qy2 = $db->query("DELETE FROM dump_penyesuaian");


        $q1 = $db->query("SELECT `kd_so`, `username`, a.`tanggal`, a.`status` FROM `stok_opname` AS a
        JOIN `is_users` AS b ON b.`id_user` = a.`id_user` WHERE `status` = 'belum'")->getResultArray();

        $q2 = $db->query("SELECT `kd_so`, `username`, a.`tanggal`, a.`status`, a.`keterangan` FROM `stok_opname` AS a
JOIN `is_users` AS b ON b.`id_user` = a.`id_user` WHERE `status` = 'disesuaikan'")->getResultArray();

        $data = [
            'title' => 'Persetujuan Stok Opname',
            'so' => $q1,
            'so2' => $q2,
        ];
        return view('penyesuaian/view-setuju', $data);
    }

    public function view_setujuu($kd_so)
    {
        $db = \Config\Database::connect();
        $qy2 = $db->query("DELETE FROM dump_penyesuaian");

        $q3 = $db->query("SELECT b.`kd_so`, a.`det_kd_so`, a.`status`, COUNT(a.`status`) AS jml_status FROM `penyesuaian` AS a 
        JOIN `detail_so` AS b ON b.`det_kd_so` = a.`det_kd_so` WHERE a.`status` = 'dalam proses' AND b.`kd_so` = '$kd_so'")->getResultArray();
        foreach ($q3 as $aa) {
            $bebas = $aa['jml_status'];
        }
        if ($bebas == 0) {
            $q4 = $db->query("UPDATE stok_opname SET keterangan = 'disetujui' WHERE kd_so = '$kd_so'");
        }

        $q1 = $db->query("SELECT `kd_so`, `username`, a.`tanggal`, a.`status` FROM `stok_opname` AS a
        JOIN `is_users` AS b ON b.`id_user` = a.`id_user` WHERE `status` = 'belum'")->getResultArray();

        $q2 = $db->query("SELECT `kd_so`, `username`, a.`tanggal`, a.`status`, a.`keterangan` FROM `stok_opname` AS a
JOIN `is_users` AS b ON b.`id_user` = a.`id_user` WHERE `status` = 'disesuaikan'")->getResultArray();

        $data = [
            'title' => 'Persetujuan Stok Opname',
            'so' => $q1,
            'so2' => $q2,
        ];
        return view('penyesuaian/view-setuju', $data);
    }
}
