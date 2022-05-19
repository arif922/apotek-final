<?php

namespace App\Controllers;

use App\Models\suppliermodel;

class dt_supplier extends BaseController
{
    protected $supplier_model;
    public function __construct()
    {
        $this->supplier_model = new suppliermodel();
    }
    public function viewsupplier()
    {
        $data = [
            'title' => 'Daftar supplier',
            'supplier' => $this->supplier_model->tampil_supplier()
        ];
        // $supplier = new \App\Models\supplier();
        return view('data_supplier/view', $data);
    }

    public function inputsupplier()
    {
        return view('data_supplier/input');
    }

    //menampilkan data di form ubah
    public function go_ubahsupplier($id_supplier)
    {
        $data = [
            'title' => 'Ubah Supplier',
            'supplier' => $this->supplier_model->go_ubahsupplier($id_supplier)
        ];
        return view('data_supplier/ubah', $data);
    }

    //menyimpan data update
    public function updatesupplier()
    {
        $id = $this->request->getVar('id');
        $data = [
            'nama_supplier' => $this->request->getVar('nm'),
            'alamat' => $this->request->getVar('alm'),
            'kota' => $this->request->getVar('kt'),
            'telepon' => $this->request->getVar('telp')
        ];
        $this->supplier_model->ubah_supplier($data, $id);

        //menampilkan data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Berhasil ubah.');
        // //kembali ke data supplier view  
        return redirect()->to('/data_supplier/view');
    }

    //menyimpan data suplier
    public function save()
    {
        $data = [
            'nama_supplier' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'kota' => $this->request->getVar('kota'),
            'telepon' => $this->request->getVar('telp')
        ];
        $this->supplier_model->simpan_supplier($data);
        //menampilkan data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Berhasil Disimpan.');
        //kembali ke data user view  
        return redirect()->to('/data_supplier/view');
    }
    //hapus
    public function delete($id)
    {
        //cek apakah data supplier ada di transaksi
        $hasil = $this->supplier_model->cekk_supplier($id);
        foreach ($hasil as $nn) {
            $bebas = $nn['id_supplier'];
        }
        //jika tidak ada hapus supplier
        if ($bebas == 0) {

            $this->supplier_model->hapus_supplier($id);
            session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        } else {
            session()->setFlashdata('eror2', 'Data supplier Sedang Digunakan Pada Transaksi');
        }
        //kembali ke data supplier view  
        return redirect()->to('/data_supplier/view');
    }
}
