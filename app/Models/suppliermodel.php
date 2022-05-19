<?php

namespace App\Models;

use CodeIgniter\Model;

class suppliermodel extends Model
{
    protected $supplier = 'supplier';

    public function tampil_supplier()
    {
        return $this->db->table($this->supplier)
            ->select('*')
            ->get()->getResultArray();
    }

    public function simpan_supplier($data)
    {
        return $this->db->table($this->supplier)
            ->insert($data);
    }

    public function go_ubahsupplier($id_supplier)
    {
        return $this->db->table($this->supplier)
            ->select('*')
            ->where(['id_supplier' => $id_supplier])
            ->get()->getResultArray();
    }

    public function ubah_supplier($data, $id)
    {
        return $this->db->table($this->supplier)
            ->update($data, ['id_supplier' => $id]);
    }

    public function hapus_supplier($id)
    {
        return $this->db->table($this->supplier)
            ->delete(['id_supplier' => $id]);
    }

    //cek apakah data supplier ada di transaksi
    public function cekk_supplier($id)
    {
        return $this->db->table('obat_masuk')
            ->selectCount('id_supplier')
            ->where(['id_supplier' => $id])
            ->get()->getResultArray();
    }
}
