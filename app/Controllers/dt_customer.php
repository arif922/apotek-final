<?php

namespace App\Controllers;

use App\Models\customermodel;

class dt_customer extends BaseController
{
    protected $customer_model;
    public function __construct()
    {
        $this->customer_model = new customermodel();
    }
    public function viewcustomer()
    {
        $data = [
            'title' => 'Data Customer',
            'customer' => $this->customer_model->tampil_customer()
        ];
        return view('data_customer/view', $data);
    }

    public function go_inputcustomer()
    {
        return view('data_customer/input');
    }

    public function savecustomer()
    {
        $data = [
            'nama_customer' => $this->request->getVar('nama_customer'),
            'alamat' => $this->request->getVar('alamat'),
            'telepon' => $this->request->getVar('telepon'),
        ];

        $this->customer_model->simpan_customer($data);

        session()->setFlashdata('berhasil', 'Data Berhasil Disimpan.');

        return redirect()->to(base_url('/customer/view'));
    }

    public function go_ubahcustomer($id_customer)
    {
        $data = [
            'customer' => $this->customer_model->tampil_customer2($id_customer)
        ];
        return view('data_customer/ubah', $data);
    }

    public function update_customer()
    {
        $id_customer = $this->request->getVar('id_customer');
        $data = [
            'nama_customer' => $this->request->getVar('nama_customer'),
            'alamat' => $this->request->getVar('alamat'),
            'telepon' => $this->request->getVar('telepon')
        ];
        $this->customer_model->ubah_customer($data, $id_customer);
        session()->setFlashdata('berhasil', 'Data Berhasil Diubah');
        return redirect()->to(base_url('/customer/view'));
    }

    public function delete($id_customer)
    {
        $cek_customer = $this->customer_model->cekk_customer($id_customer);
        foreach ($cek_customer as $cs) {
            $bebas = $cs['jml_customer'];
        }
        if ($bebas == 0) {

            $this->customer_model->hapus_customer($id_customer);
            session()->setFlashdata('berhasil', 'Data Berhasil Dihapus.');
        } else {
            session()->setFlashdata('gagal', 'Data Customer Sedang Digunakan Pada Transaksi');
        }
        return redirect()->to(base_url('/customer/view'));
    }
}
