<?php

namespace App\Controllers;

// use App\Models\obat_masukModel;

class laporan_masuk extends BaseController
{
    public function view_lap_masuk()
    {
        session()->remove('awal');
        session()->remove('akhir');

        $db = \Config\Database::connect();
        $lapmasuk = $db->query("SELECT obat_masuk.`kd_obat_masuk`,`kode_detail`,DATE_FORMAT(`obat_masuk`.`tanggal_masuk`, '%d-%m-%Y') AS tanggal_masuk,
        `faktur`,is_obat.`nama_obat`,`is_obat`.`kode_obat`,`is_users`.`username`,supplier.`nama_supplier`,`jumlah_masuk`, `detail_obat_masuk`.`harga`,`diskon`,`total`
                FROM `detail_obat_masuk` 
                JOIN is_obat ON is_obat.`kode_obat`=`detail_obat_masuk`.`kode_obat` 
                JOIN `obat_masuk` ON `obat_masuk`.`kd_obat_masuk`=`detail_obat_masuk`.`kd_obat_masuk` 
                JOIN is_users ON `is_users`.`id_user` = `obat_masuk`.`id_user`
                JOIN `supplier` ON `supplier`.`id_supplier` = `obat_masuk`.`id_supplier`")->getResultArray();

        $data = [
            'title' => 'Laporan obat masuk',
            'lapmasuk' => $lapmasuk

        ];

        return view('lapobat_masuk/view', $data);
    }

    public function lihat_lap_masuk()
    {

        $awal = $this->request->getPost('awal');
        $akhir = $this->request->getPost('akhir');
        session()->set('awal', $awal);
        session()->set('akhir', $akhir);
        if ($awal > $akhir) {
            session()->setFlashdata('salah', 'Tanggal awal lebih besar dari tanggal akhir');
            return redirect()->to('/lap_obmasuk/view');
        } else {


            $db = \Config\Database::connect();
            $lapmasuk = $db->query("SELECT obat_masuk.`kd_obat_masuk`,`kode_detail`,DATE_FORMAT(`obat_masuk`.`tanggal_masuk`, '%d-%m-%Y') AS tanggal_masuk,
            `faktur`,is_obat.`nama_obat`,`is_obat`.`kode_obat`,`is_users`.`username`,supplier.`nama_supplier`,`jumlah_masuk`, `detail_obat_masuk`.`harga`,`diskon`,`total`
                    FROM `detail_obat_masuk` 
                    JOIN is_obat ON is_obat.`kode_obat`=`detail_obat_masuk`.`kode_obat` 
                    JOIN `obat_masuk` ON `obat_masuk`.`kd_obat_masuk`=`detail_obat_masuk`.`kd_obat_masuk` 
                    JOIN is_users ON `is_users`.`id_user` = `obat_masuk`.`id_user`
                    JOIN `supplier` ON `supplier`.`id_supplier` = `obat_masuk`.`id_supplier` WHERE `obat_masuk`.`tanggal_masuk` BETWEEN '$awal' and '$akhir' order by `obat_masuk`.`tanggal_masuk` asc ")->getResultArray();

            $data = [
                'title' => 'Laporan obat masuk',
                'lapmasuk' => $lapmasuk

            ];

            return view('/lapobat_masuk/view', $data);
        }
    }
}
