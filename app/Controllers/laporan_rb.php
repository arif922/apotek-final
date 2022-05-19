<?php

namespace App\Controllers;

// use App\Models\obat_masukModel;

class laporan_rb extends BaseController
{
    public function view_lap_rb()
    {
        session()->remove('rb_awal');
        session()->remove('rb_akhir');

        $db = \Config\Database::connect();
        $laprb = $db->query("SELECT det.`kd_returbeli`, DATE_FORMAT(rb.tanggal_returbeli, '%d-%m-%Y') AS tanggal_retur,
        usr.username, sup.nama_supplier, ob.nama_obat, det.`jumlah_rb`,det.`keterangan` 
        FROM `detail_returbeli` AS det
        JOIN `retur_beli` AS rb ON rb.`kd_returbeli` = det.`kd_returbeli`
        JOIN `is_users` AS usr ON usr.`id_user` = rb.`id_user`
        JOIN `supplier` AS sup ON sup.`id_supplier` = rb.`id_supplier`
        JOIN `is_obat` AS ob ON ob.`kode_obat` = det.`kode_obat`")->getResultArray();

        $data = [
            'title' => 'Laporan Retur Pembelian',
            'laprb' => $laprb

        ];

        return view('lap_returbeli/view', $data);
    }

    public function lihat_lap_rb()
    {

        $rb_awal = $this->request->getPost('rb_awal');
        $rb_akhir = $this->request->getPost('rb_akhir');
        session()->set('rb_awal', $rb_awal);
        session()->set('rb_akhir', $rb_akhir);
        if ($rb_awal > $rb_akhir) {
            session()->setFlashdata('salah', 'Tanggal awal lebih besar dari tanggal akhir');
            return redirect()->to('/lap_returbeli/view');
        } else {


            $db = \Config\Database::connect();
            $laprb = $db->query("SELECT det.`kd_returbeli`, DATE_FORMAT(rb.tanggal_returbeli, '%d-%m-%Y') AS tanggal_retur,
            usr.username, sup.nama_supplier, ob.nama_obat, det.`jumlah_rb`,det.`keterangan` 
            FROM `detail_returbeli` AS det
            JOIN `retur_beli` AS rb ON rb.`kd_returbeli` = det.`kd_returbeli`
            JOIN `is_users` AS usr ON usr.`id_user` = rb.`id_user`
            JOIN `supplier` AS sup ON sup.`id_supplier` = rb.`id_supplier`
            JOIN `is_obat` AS ob ON ob.`kode_obat` = det.`kode_obat` WHERE rb.`tanggal_returbeli` BETWEEN '$rb_awal' and '$rb_akhir' order by rb.`tanggal_returbeli` asc ")->getResultArray();

            $data = [
                'title' => 'Laporan Retur Pembelian',
                'laprb' => $laprb

            ];

            return view('/lap_returbeli/view', $data);
            // return redirect()->to(base_url('/lap_retur/view'))->withInput($data);
        }
    }
}
