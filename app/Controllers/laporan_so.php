<?php

namespace App\Controllers;

// use App\Models\obat_masukModel;

class laporan_so extends BaseController
{
    public function view_lap_so()
    {
        $db = \Config\Database::connect();
        $stok = $db->query("SELECT b.`nama_obat`, a.`jumlah_sistem`,a.`jumlah_rill`,a.`status`,a.`selisih`,c.`tindakan`,
        c.`jumlah`,c.`status` AS tindakan_akhir,d.`nama_satuan`,c.`keterangan` 
        FROM `detail_so` AS a
        JOIN `is_obat` AS b ON b.`kode_obat` = a.`kode_obat`
        JOIN penyesuaian AS c ON c.`det_kd_so` = a.`det_kd_so`
        JOIN satuan AS d ON d.`id_satuan` = b.`id_satuan`")->getResultArray();
        $data = [
            'title' => 'Laporan stok opname',
            'stok' => $stok

        ];

        return view('lap_so/view', $data);
    }
}
