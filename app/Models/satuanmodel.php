<?php

namespace App\Models;

use CodeIgniter\Model;

class satuanmodel extends Model
{
    protected $tabel = 'satuan';
    protected $obat = 'is_obat';
    public function tampil_satuan()
    {
        return $this->db->table($this->tabel)
            ->select('*')
            ->get()->getResultArray();
    }

    public function simpan_satuan($data)
    {
        return $this->db->table($this->tabel)
            ->insert($data);
    }

    public function tampil_satuan2($id_satuan)
    {
        return $this->db->table($this->tabel)
            ->select('*')
            ->where('id_satuan', $id_satuan)
            ->get()->getResultArray();
    }

    public function ubah_satuan($data, $id_satuan)
    {
        return $this->db->table($this->tabel)
            ->update($data, ['id_satuan' => $id_satuan]);
    }

    public function hapus_satuan($id_satuan)
    {
        return $this->db->table($this->tabel)
            ->delete(['id_satuan' => $id_satuan]);
    }

    public function cek_satuan($id_satuan)
    {
        return $this->db->table($this->obat)
            ->select('*')
            ->where('id_satuan', $id_satuan)
            ->get()->getResultArray();
    }
}
