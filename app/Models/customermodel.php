<?php

namespace App\Models;

use CodeIgniter\Model;

class customermodel extends Model
{
    protected $tabel = 'customer';
    public function tampil_customer()
    {
        return $this->db->table($this->tabel)
            ->select('*')
            ->get()->getResultArray();
    }

    public function simpan_customer($data)
    {
        return $this->db->table($this->tabel)
            ->insert($data);
    }

    public function tampil_customer2($id_customer)
    {
        return $this->db->table($this->tabel)
            ->select('*')
            ->where('id_customer', $id_customer)
            ->get()->getResultArray();
    }

    public function ubah_customer($data, $id_customer)
    {
        return $this->db->table($this->tabel)
            ->update($data, ['id_customer' => $id_customer]);
    }

    public function hapus_customer($id_customer)
    {
        return $this->db->table($this->tabel)
            ->delete(['id_customer' => $id_customer]);
    }

    //cek apakah data customer ada di transaksi
    public function cekk_customer($id_customer)
    {
        return $this->db->table('obat_keluar')
            ->selectCount('id_customer', 'jml_customer')
            ->where(['id_customer' => $id_customer])
            ->get()->getResultArray();
    }
}
