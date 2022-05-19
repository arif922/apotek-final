<?php

namespace App\Controllers;

use App\Models\satuanmodel;

class dt_satuan extends BaseController
{
    protected $satuan_model;
    public function __construct()
    {
        $this->satuan_model = new satuanmodel();
    }
    public function view_satuan()
    {
        $data = [
            'title' => 'Data Satuan',
            'satuan' => $this->satuan_model->tampil_satuan()
        ];
        return view('data_satuan/view', $data);
    }

    public function go_inputsatuan()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT MAX(`id_satuan`) AS max_id FROM `satuan`')->getResultArray();
        foreach ($query as $aa) {
            $bb = $aa['max_id'];
        }
        $cc = $bb + 1;
        $data = [
            'id_gol' => $cc,
            'title' => 'Tambah Data Satuan'
        ];
        return view('data_satuan/input', $data);
    }

    public function savesatuan()
    {
        $data = [
            'id_satuan' => $this->request->getVar('id_satuan'),
            'nama_satuan' => $this->request->getVar('nama_satuan'),
        ];

        $this->satuan_model->simpan_satuan($data);
        session()->setFlashdata('berhasil', 'Data Berhasil Disimpan.');
        return redirect()->to(base_url('/satuan/view'));
    }

    public function go_ubahsatuan($id_satuan)
    {
        $data = [
            'title' => 'Ubah Data Satuan',
            'satuan' => $this->satuan_model->tampil_satuan2($id_satuan)
        ];
        return view('data_satuan/ubah', $data);
    }

    public function update_satuan()
    {
        $id_satuan = $this->request->getVar('id_satuan');
        $data = [
            'nama_satuan' => $this->request->getVar('nama_satuan')
        ];
        $this->satuan_model->ubah_satuan($data, $id_satuan);
        session()->setFlashdata('berhasil', 'Data Berhasil Diubah.');
        return redirect()->to(base_url('/satuan/view'));
    }

    public function delete($id_satuan)
    {

        $q1 = $this->satuan_model->cek_satuan($id_satuan);
        if ($q1 == null) {

            $this->satuan_model->hapus_satuan($id_satuan);
            session()->setFlashdata('berhasil', 'Data Berhasil Dihapus.');
        } else {
            session()->setFlashdata('gagal', 'Data Satuan Sedang Digunakan.');
        }
        return redirect()->to(base_url('/satuan/view'));
    }
}
