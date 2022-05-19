<?php

namespace App\Models;

use CodeIgniter\Model;

class model_fifo extends Model
{
    protected $fifo = 'detail_obat_masuk';

    public function count_get_fifo_data($kondisi1, $kondisi2)
    {
        return $this->db->table($this->fifo)
            ->select('kode_obat, jumlah_masuk, keluar, sisa')
            ->where($kondisi1)
            ->where($kondisi2)
            ->orderBy('kode_detail', 'ASC')
            ->countAllResults();
    }
    public function get_fifo_data($kondisi1, $kondisi2)
    {
        return $this->db->table($this->fifo)
            ->select('kode_detail,kode_obat, jumlah_masuk, keluar, sisa')
            ->where($kondisi1)
            ->where($kondisi2)
            ->orderBy('expired', 'ASC')
            ->get()->getResultArray();
    }
    public function update_fifo_data($data, $kondisi)
    {
        return $this->db->table($this->fifo)
            ->update($data, $kondisi);
    }
}
