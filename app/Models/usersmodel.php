<?php

namespace App\Models;

use CodeIgniter\Model;

class usersmodel extends Model
{
    protected $user = 'is_users';

    public function tampil_user()
    {
        return $this->db->table($this->user)
            ->select('*')
            ->get()->getResultArray();
    }

    public function simpan_user($data)
    {
        return $this->db->table($this->user)
            ->insert($data);
    }

    public function go_ubahuser($id_user)
    {
        return $this->db->table($this->user)
            ->select('*')
            ->where(['id_user' => $id_user])
            ->get()->getResultArray();
    }

    public function ubah_user($data, $id_user)
    {
        return $this->db->table($this->user)
            ->update($data, ['id_user' => $id_user]);
    }

    //cari gambar berdasarkan id
    public function cari_gambar($id_user)
    {
        return $this->db->table($this->user)
            ->select('*')
            ->where(['id_user' => $id_user])
            ->get()->getResultArray();
    }

    public function hapus_user($id_user)
    {
        return $this->db->table($this->user)
            ->delete(['id_user' => $id_user]);
    }

    //cek apakah data user ada di transaksi
    public function cekk_user($id_user)
    {
        return $this->db->table('obat_masuk')
            ->selectCount('id_user')
            ->where(['id_user' => $id_user])
            ->get()->getResultArray();
    }
}
