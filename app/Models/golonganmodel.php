<?php

namespace App\Models;

use CodeIgniter\Model;


class golonganmodel extends Model
{
    protected $tabel = 'golongan';
    protected $obat = 'is_obat';

    public function tampil_golongan()
    {
        return $this->db->table($this->tabel)
            ->select('*')
            ->get()->getResultArray();
    }

    public function simpan_golongan($data)
    {
        return $this->db->table($this->tabel)
            ->insert($data);
    }

    public function tampil_golongan2($id_golongan)
    {
        return $this->db->table($this->tabel)
            ->select('*')
            ->where('id_golongan', $id_golongan)
            ->get()->getResultArray();
    }

    public function ubah_golongan($data, $id_golongan)
    {
        return $this->db->table($this->tabel)
            ->update($data, ['id_golongan' => $id_golongan]);
    }

    public function hapus_golongan($id_golongan)
    {
        return $this->db->table($this->tabel)
            ->delete(['id_golongan' => $id_golongan]);
    }

    public function cek_golongan($id_golongan)
    {
        return $this->db->table($this->obat)
            ->select('*')
            ->where('id_golongan', $id_golongan)
            ->get()->getResultArray();
    }
}
