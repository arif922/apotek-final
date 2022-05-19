<?php

namespace App\Controllers;


class laporan_keluar extends BaseController
{
    public function view_lap_keluar()
    {
        session()->remove('awal2');
        session()->remove('akhir2');
        $db = \Config\Database::connect();
        $lapkeluar = $db->query("SELECT `obat_keluar`.`kd_obat_keluar`,`is_obat`.`kode_obat`,`nama_satuan`,`kode_detail`,
        DATE_FORMAT(`obat_keluar`.`tanggal_keluar`, '%d-%m-%Y') AS tanggal_keluar,`nama_obat`,`username`,`nama_customer`,
        `detail_obat_keluar`.`harga_jual`,`jumlah_keluar`,`detail_obat_keluar`.`total`
        FROM `detail_obat_keluar` 
        JOIN `is_obat` ON `is_obat`.`kode_obat`=`detail_obat_keluar`.`kode_obat`
        JOIN `satuan` ON `satuan`.`id_satuan` = `is_obat`.`id_satuan`
        JOIN `obat_keluar` ON `obat_keluar`.`kd_obat_keluar`=`detail_obat_keluar`.`kd_obat_keluar`
        JOIN `is_users` ON `is_users`.`id_user`=`obat_keluar`.`id_user`
        JOIN `customer` ON `customer`.`id_customer` = `obat_keluar`.`id_customer`")->getResultArray();

        $data = [
            'title' => 'Laporan obat keluar',
            'lapkeluar' => $lapkeluar

        ];

        return view('lapobat_keluar/view', $data);
    }

    public function lihat_lap_keluar()
    {

        $awal = $this->request->getPost('awal');
        $akhir = $this->request->getPost('akhir');
        session()->set('awal2', $awal);
        session()->set('akhir2', $akhir);
        if ($awal > $akhir) {
            session()->setFlashdata('error', 'Tanggal awal lebih besar dari tanggal akhir');
            return redirect()->to('/lap_obkeluar/view');
        } else {


            $db = \Config\Database::connect();
            $lapkeluar = $db->query("SELECT `obat_keluar`.`kd_obat_keluar`,`is_obat`.`kode_obat`,`nama_satuan`,`kode_detail`,
            DATE_FORMAT(`obat_keluar`.`tanggal_keluar`, '%d-%m-%Y') AS tanggal_keluar,`nama_obat`,`username`,`nama_customer`,
            `detail_obat_keluar`.`harga_jual`,`jumlah_keluar`,`detail_obat_keluar`.`total`
            FROM `detail_obat_keluar` 
            JOIN `is_obat` ON `is_obat`.`kode_obat`=`detail_obat_keluar`.`kode_obat`
            JOIN `satuan` ON `satuan`.`id_satuan` = `is_obat`.`id_satuan`
            JOIN `obat_keluar` ON `obat_keluar`.`kd_obat_keluar`=`detail_obat_keluar`.`kd_obat_keluar`
            JOIN `is_users` ON `is_users`.`id_user`=`obat_keluar`.`id_user`
            JOIN `customer` ON `customer`.`id_customer` = `obat_keluar`.`id_customer` WHERE `tanggal_keluar` BETWEEN '$awal' and '$akhir' order by `tanggal_keluar` asc ")->getResultArray();

            $data = [
                'title' => 'Laporan obat keluar',
                'lapkeluar' => $lapkeluar

            ];

            return view('/lapobat_keluar/view', $data);
        }
    }
}
