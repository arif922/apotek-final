<?php

namespace App\Models;

use CodeIgniter\Model;

class obatmodel extends Model
{
    protected $obat = 'is_obat';


    public function update_exp_obat($x, $kd)
    {
        return $this->db->table('is_obat')
            ->update(['expired' => $x], ['kode_obat' => $kd]);
    }

    public function tampil_obat()
    {
        return $this->db->table($this->obat)
            ->select('*')
            ->get()->getResultArray();
    }

    public function go_ubahobat($kode_obat)
    {
        return $this->db->table($this->obat)
            ->select('*')
            ->join('golongan', 'golongan.id_golongan = is_obat.id_golongan')
            ->join('satuan', 'satuan.id_satuan = is_obat.id_satuan')
            ->where(['kode_obat' => $kode_obat])
            ->get()->getResultArray();
    }


    public function ubah_obat($data, $k_obat)
    {
        return $this->db->table($this->obat)
            ->update($data, ['kode_obat' => $k_obat]);
    }

    public function simpan_obat($data)
    {
        return $this->db->table($this->obat)
            ->insert($data);
    }

    public function hapus_obat($kode_obat)
    {
        return $this->db->table($this->obat)
            ->delete(['kode_obat' => $kode_obat]);
    }

    //cek apakah data obat ada di transaksi
    public function cekk_obat($kd_obat)
    {
        return $this->db->table('detail_obat_masuk')
            ->selectCount('kode_obat')
            ->where(['kode_obat' => $kd_obat])
            ->get()->getResultArray();
    }

    //cek stok
    public function cekk_stok($kd_obat)
    {
        return $this->db->table('is_obat')
            ->select('stok')
            ->where(['kode_obat' => $kd_obat])
            ->get()->getResultArray();
    }
}
