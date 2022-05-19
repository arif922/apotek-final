<?php

namespace App\Controllers;
// use App\Models\contohmodel;
class con_grafik extends BaseController
{
    protected $contoh_model;
    public function __construct()
    {
        // $this->contoh_model = new contohmodel();
    }
    public function pembelian()
    {
        $data = [
            'title' => 'Data contoh',
            // 'contoh' => $this->contoh_model->tampil_contoh()
        ];
        return view('grafik/g-pembelian', $data);
    }

    public function penjualan()
    {
        $data = [
            'title' => 'Data contoh',
            // 'contoh' => $this->contoh_model->tampil_contoh()
        ];
        return view('grafik/g-penjualan', $data);
    }
}
