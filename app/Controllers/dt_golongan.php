<?php

namespace App\Controllers;

use App\Models\golonganmodel;

class dt_golongan extends BaseController
{
    protected $golongan_model;
    public function __construct()
    {
        $this->golongan_model = new golonganmodel();
    }
    public function view_golongan()
    {
        $data = [
            'title' => 'Data Golongan',
            'golongan' => $this->golongan_model->tampil_golongan()
        ];
        return view('data_golongan/view', $data);
    }

    public function go_inputgolongan()
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT MAX(`id_golongan`) AS max_id FROM `golongan`')->getResultArray();
        foreach ($query as $aa) {
            $bb = $aa['max_id'];
        }
        $cc = $bb + 1;
        $data = [
            'id_gol' => $cc,
            'title' => 'Tambah Data Golongan'
        ];
        return view('data_golongan/input', $data);
    }

    public function savegolongan()
    {
        $data = [
            'id_golongan' => $this->request->getVar('id_golongan'),
            'nama_golongan' => $this->request->getVar('nama_golongan'),
        ];

        $this->golongan_model->simpan_golongan($data);
        session()->setFlashdata('berhasil', 'Data Berhasil Disimpan.');
        return redirect()->to(base_url('/golongan/view'));
    }

    public function go_ubahgolongan($id_golongan)
    {
        $data = [
            'title' => 'Ubah Data Golongan',
            'golongan' => $this->golongan_model->tampil_golongan2($id_golongan)
        ];
        return view('data_golongan/ubah', $data);
    }

    public function update_golongan()
    {
        $id_golongan = $this->request->getVar('id_golongan');
        $data = [
            'nama_golongan' => $this->request->getVar('nama_golongan')
        ];
        $this->golongan_model->ubah_golongan($data, $id_golongan);
        session()->setFlashdata('berhasil', 'Data Berhasil Diubah.');
        return redirect()->to(base_url('/golongan/view'));
    }

    public function delete($id_golongan)
    {

        $q1 = $this->golongan_model->cek_golongan($id_golongan);
        if ($q1 == null) {
            $this->golongan_model->hapus_golongan($id_golongan);
            session()->setFlashdata('berhasil', 'Data Berhasil Dihapus.');
        } else {
            session()->setFlashdata('gagal', 'Data Golongan Sedang Digunakan.');
        }

        return redirect()->to(base_url('/golongan/view'));
    }
}
