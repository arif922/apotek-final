<?php

namespace App\Controllers;

// use App\Models\obat_masukModel;

class laporan_rj extends BaseController
{
    public function view_lap_rj()
    {
        session()->remove('rj_awal');
        session()->remove('rj_akhir');

        $db = \Config\Database::connect();
        $laprj = $db->query("SELECT det.`kd_returjual`,det.`det_kd_returjual`, rj.`tanggal_retur`, usr.`username`, cs.`nama_customer`,
        ob.`nama_obat`,det.`harga`,det.`jumlah_rj`,det.`sub_total`,det.`keterangan` 
        FROM `detail_returjual` AS det
        JOIN `retur_jual` AS rj ON rj.`kd_returjual` = det.`kd_returjual`
        JOIN `is_users` AS usr ON usr.`id_user` = rj.`id_user`
        JOIN `customer` AS cs ON cs.`id_customer` = rj.`id_customer`
        JOIN `is_obat` AS ob ON ob.`kode_obat` = det.`kode_obat`")->getResultArray();

        $data = [
            'title' => 'Laporan Retur Penjualan',
            'laprj' => $laprj

        ];

        return view('lap_returjual/view', $data);
    }

    public function lihat_lap_rj()
    {

        $rj_awal = $this->request->getPost('rj_awal');
        $rj_akhir = $this->request->getPost('rj_akhir');
        session()->set('rj_awal', $rj_awal);
        session()->set('rj_akhir', $rj_akhir);
        if ($rj_awal > $rj_akhir) {
            session()->setFlashdata('salah', 'Tanggal awal lebih besar dari tanggal akhir');
            return redirect()->to('/lap_retur/view');
        } else {


            $db = \Config\Database::connect();
            $laprj = $db->query("SELECT det.`kd_returjual`,det.`det_kd_returjual`, rj.`tanggal_retur`, usr.`username`, cs.`nama_customer`,
            ob.`nama_obat`,det.`harga`,det.`jumlah_rj`,det.`sub_total`,det.`keterangan` 
            FROM `detail_returjual` AS det
            JOIN `retur_jual` AS rj ON rj.`kd_returjual` = det.`kd_returjual`
            JOIN `is_users` AS usr ON usr.`id_user` = rj.`id_user`
            JOIN `customer` AS cs ON cs.`id_customer` = rj.`id_customer`
            JOIN `is_obat` AS ob ON ob.`kode_obat` = det.`kode_obat` WHERE rj.`tanggal_retur` BETWEEN '$rj_awal' and '$rj_akhir' order by rj.`tanggal_retur` asc ")->getResultArray();

            $data = [
                'title' => 'Laporan Retur Penjualan',
                'laprj' => $laprj

            ];

            return view('/lap_returjual/view', $data);
            // return redirect()->to(base_url('/lap_retur/view'))->withInput($data);
        }
    }
}
