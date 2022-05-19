<?php

namespace App\Controllers;

use App\Models\obatmodel;


class dt_obat extends BaseController
{
    protected $obat_model;
    public function __construct()
    {
        $this->obat_model = new obatmodel();
    }
    //menampilkan data obat
    public function viewobat()
    {

        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");
        $db = \Config\Database::connect();
        $ambil_detail = $db->query("SELECT `kode_obat` as kd, MIN(`expired`) as xp FROM `detail_obat_masuk` 
        WHERE `expired` >= '$date' GROUP BY `kode_obat` ")->getResultArray();
        foreach ($ambil_detail as $ct) {
            // echo "kd = " . $ct['kd'] . "    tanggal exp = " . $ct['kd'] . "<br>";
            $queryy = $this->obat_model->tampil_obat();
            foreach ($queryy as $ctt) {
                if ($ct['kd'] == $ctt['kode_obat']) {
                    //model Update
                    $this->obat_model->update_exp_obat($ct['xp'], $ct['kd']);
                }
            }
        }

        // $stok = $db->query("SELECT kode_obat, nama_obat, jenis_obat, satuan, komposisi, penyimpanan,harga_beli, harga_jual, deskripsi_obat, stok, DATE_FORMAT(expired, '%d-%m-%Y') AS expired, foto FROM `is_obat`")->getResultArray();
        $stok = $db->query("SELECT * FROM `is_obat`
        JOIN `golongan` ON `golongan`.`id_golongan` = `is_obat`.`id_golongan`
        JOIN `satuan` ON `satuan`.`id_satuan` = `is_obat`.`id_satuan`")->getResultArray();

        $data = [
            'title' => 'Daftar Obat',
            'join' => $stok
            // 'join' => $this->obat_model->tampil_obat()
        ];
        return view('data_obat/view', $data);
    }


    //menambah data obat
    public function inputobat()
    {
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");

        //mengambil kode transaksi dengan kode paling besar
        $db = \Config\Database::connect();
        $q1 = $db->query("SELECT MAX(SUBSTRING(`kode_obat`, 10)) AS maxKode FROM `is_obat`")->getResultArray();
        foreach ($q1 as $ct) {
            $aa = $ct['maxKode'];
        }

        $noUrut = $aa;
        $noUrut++;
        $char = "B";
        // 2020-10-17 = 10 karakter
        //setelah karakter ke 2 ambil 2 karakter
        $tahun = substr($date, 2, 2);
        //setelah karakter ke 5 ambil 2 karakter
        $bulan = substr($date, 5, 2);
        //setelah karakter ke 8 ambil 2 karakter
        $tgl = substr($date, 8, 2);
        $id_Order = $char . "-" . $tgl . $bulan . $tahun . "-" . sprintf("%06s", $noUrut);

        $query1 = $db->query('SELECT * FROM golongan')->getResultArray();
        $query2 = $db->query('SELECT * FROM satuan')->getResultArray();

        $data = [
            'title' => 'Daftar Obat',
            'kdobat' => $id_Order,
            'golongan' => $query1,
            'satuan' => $query2,
        ];

        return view('data_obat/input', $data);
    }

    //menampilkan data di form ubah
    public function ubahobat($kode_obat)
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM golongan')->getResultArray();
        $query2 = $db->query('SELECT * FROM satuan')->getResultArray();
        $data = [
            'title' => 'Ubah Obat',
            'obat' => $this->obat_model->go_ubahobat($kode_obat),
            'golongan' => $query,
            'satuan' => $query2,


            // 'obat' => $query
        ];
        return view('data_obat/ubah', $data);
    }

    //menyimpan data update
    public function updateobat()
    {

        if (!$this->validate([
            'ftobat' => [
                'rules' => 'mime_in[ftobat,image/jpg,image/jpeg,image/png]|is_image[ftobat]|max_size[ftobat,1024]',
                'errors' => [
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1MB',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]


        ])) {
            $validation = \Config\Services::validation();
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('/data_obat/view')->withInput();
        }

        $filefoto = $this->request->getFile('ftobat');

        //cek gambar, apakah gambar lama
        if ($filefoto->getError() == 4) {
            $namafoto = $this->request->getVar('fotolama');
        } else {
            $namafoto = $filefoto->getName();
            //pindahkan gambar
            $filefoto->move('img/obat', $namafoto);
            //hapus file lama
            // unlink('img/' . $this->request->getVar('fotolama'));
        }

        $beli = $this->request->getVar('beli');
        $beli1 = str_replace(".", "", $beli);
        $jual = $this->request->getVar('jual');
        $jual1 = str_replace(".", "", $jual);

        $k_obat = $this->request->getVar('kode_obat');
        $data = [
            'nama_obat' => $this->request->getVar('nama_obat'),
            'id_golongan' => $this->request->getVar('id_golongan'),
            'id_satuan' => $this->request->getVar('id_satuan'),
            'komposisi' => $this->request->getVar('komposisi'),
            'penyimpanan' => $this->request->getVar('penyimpanan'),
            'harga_beli' => $beli1,
            'harga_jual' => $jual1,
            'deskripsi_obat' => $this->request->getVar('deskripsi_obat'),
            'foto' => $namafoto
        ];
        $this->obat_model->ubah_obat($data, $k_obat);
        //menampilkan data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Berhasil diubah.');
        // //kembali ke data supplier view  
        return redirect()->to('/data_obat/view');
    }

    // menyimpan data obat
    public function save()
    {
        if (!$this->validate([
            'ftobat' => [
                'rules' => 'mime_in[ftobat,image/jpg,image/jpeg,image/png]|is_image[ftobat]|max_size[ftobat,1024]',
                'errors' => [
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1MB',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]


        ])) {

            $validation = \Config\Services::validation();
            session()->setFlashdata('error', $validation->listErrors());

            return redirect()->to('/data_obat/input')->withInput();
        }

        //KELOLA GAMBAR
        $fotoobat = $this->request->getFile('ftobat');

        //jika user tidak meng upload gambar
        if ($fotoobat->getError() == 4) {
            $namafoto = 'default.png';
        } else {
            //pindahkan file ke folder tujuan
            $fotoobat->move('img/obat');
            //ambil nama file
            $namafoto = $fotoobat->getName();
        }

        $beli = $this->request->getVar('beli');
        $beli1 = str_replace(".", "", $beli);
        $jual = $this->request->getVar('jual');
        $jual1 = str_replace(".", "", $jual);
        $data = [
            'kode_obat' => $this->request->getVar('kode_obat'),
            'nama_obat' => $this->request->getVar('nama_obat'),
            'id_golongan' => $this->request->getVar('id_golongan'),
            'id_satuan' => $this->request->getVar('id_satuan'),
            'komposisi' => $this->request->getVar('komposisi'),
            'expired' => '0000-00-00',
            'penyimpanan' => $this->request->getVar('penyimpanan'),
            'harga_beli' => $beli1,
            'harga_jual' => $jual1,
            'deskripsi_obat' => $this->request->getVar('deskripsi_obat'),
            'foto' => $namafoto
        ];
        $this->obat_model->simpan_obat($data);

        //menampilkan data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Berhasil Disimpan.');
        //kembali ke data obat view  
        return redirect()->to('/data_obat/view');
    }
    //hapus data obat
    public function delete($kode_obat)
    {

        //cek apakah data obat ada di transaksi
        $hasil = $this->obat_model->cekk_obat($kode_obat);
        foreach ($hasil as $nn) {
            $bebas = $nn['kode_obat'];
        }

        $stok = $this->obat_model->cekk_stok($kode_obat);
        foreach ($stok as $ss) {
            $jml_stok = $ss['stok'];
        }
        //jika tidak ada hapus obat
        if ($bebas == 0 && $jml_stok < 1) {

            $this->obat_model->hapus_obat($kode_obat);
            session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        } else if ($bebas > 0) {
            session()->setFlashdata('gagal', 'Data Obat Sedang Digunakan Pada Transaksi');
        } else {
            session()->setFlashdata('gagal', 'Stok Obat Masih Tersedia');
            session()->setFlashdata('gagal2', $jml_stok);
        }
        //kembali ke data obat view  
        return redirect()->to('/data_obat/view');
    }
}
