<?php

namespace App\Controllers;

//use App\Models\AuthModel;
use App\Models\model_auth;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->model_auth = new model_auth();
    }

    public function dashboard()
    {

        $db = \Config\Database::connect();
        date_default_timezone_set("Asia/Jakarta");
        $tgl_sekarang = date("Y-m-d");
        //bulan sekarang
        $date1 = date("m");
        //tahun sekarang
        $tahun = date("Y");
        //jumlah data user
        $user = $db->query(
            "SELECT COUNT(id_user) AS jml_user FROM is_users"
        )->getResultArray();

        //jumlah data supplier
        $supplier = $db->query(
            "SELECT COUNT(id_supplier) AS jml_supplier FROM supplier"
        )->getResultArray();

        //jumlah data customer
        $customer = $db->query(
            "SELECT COUNT(id_customer) AS jml_customer FROM customer"
        )->getResultArray();

        //jumlah data obat
        $obat = $db->query(
            "SELECT COUNT(kode_obat) AS jumlah FROM is_obat"
        )->getResultArray();

        //jumlah data obat masuk
        $obmasuk = $db->query(
            "SELECT COUNT(kd_obat_masuk) AS jml_masuk FROM obat_masuk"
        )->getResultArray();

        //jumlah data obat keluar
        $obkeluar = $db->query(
            "SELECT COUNT(kd_obat_keluar) AS jml_keluar FROM obat_keluar"
        )->getResultArray();

        //jumlah data retur jual
        $rj = $db->query(
            "SELECT COUNT(kd_returjual) AS jml_rj FROM retur_jual"
        )->getResultArray();

        //jumlah data stok opname
        $so = $db->query(
            "SELECT COUNT(kd_so) AS jml_so FROM stok_opname"
        )->getResultArray();

        //jumlah penjualan per hari
        $t_hari = $db->query(
            "SELECT SUM(`total`) AS total FROM `obat_keluar` WHERE `tanggal_keluar` = '$tgl_sekarang' and YEAR(`tanggal_keluar`) = '$tahun'"
        )->getResultArray();

        //jumlah penjualan per bulan
        $t_bulan = $db->query(
            "SELECT SUM(`total`) AS total FROM `obat_keluar` WHERE MONTH(`tanggal_keluar`) = '$date1' and YEAR(`tanggal_keluar`) = '$tahun'"
        )->getResultArray();

        // // menjumlah data obat dengan stok dibawah 10
        // $jml = $db->query("SELECT COUNT(stok) AS jml FROM is_obat WHERE stok <= '10'")->getResultArray();
        // //cek data obat dengan jumlah kurang dr 10
        // $cekobat = $db->query("SELECT * FROM is_obat where stok <= '10'")->getResultArray();

        // $bulan = $this->request->getVar('bulan');

        // var_dump($bulan);
        // die;

        $q1 = $db->query("SELECT `nama_obat`, SUM(`detail_obat_keluar`.`jumlah_keluar`) AS jml_keluar
        FROM `obat_keluar`
        JOIN `detail_obat_keluar` ON `detail_obat_keluar`.`kd_obat_keluar` = `obat_keluar`.`kd_obat_keluar`
        JOIN `is_obat` ON `is_obat`.`kode_obat` = `detail_obat_keluar`.`kode_obat` where month(tanggal_keluar) = '$date1' AND YEAR(tanggal_keluar) = '$tahun' GROUP BY `nama_obat` ORDER BY jml_keluar DESC LIMIT 10")->getResultArray();

        $q2 = $db->query("SELECT `nama_obat`, SUM(`detail_obat_keluar`.`jumlah_keluar`) AS jml_keluar
FROM `obat_keluar`
JOIN `detail_obat_keluar` ON `detail_obat_keluar`.`kd_obat_keluar` = `obat_keluar`.`kd_obat_keluar`
JOIN `is_obat` ON `is_obat`.`kode_obat` = `detail_obat_keluar`.`kode_obat` where tanggal_keluar = '$tgl_sekarang' GROUP BY `nama_obat` ORDER BY jml_keluar")->getResultArray();

        $data = array(
            'title' => 'Dashboard',
            'user' => $user,
            'supplier' => $supplier,
            'customer' => $customer,
            'obat' => $obat,
            'obmasuk' => $obmasuk,
            'obkeluar' => $obkeluar,
            'rj' => $rj,
            'so' => $so,
            'top10' => $q1,
            'pen_hariini' => $q2,
            't_hari' => $t_hari,
            't_bulan' => $t_bulan
            // 'jumlah' => $jml,
            // 'nama_obat' => $cekobat

        );
        return view('layout/dashboard', $data);
    }

    public function register()
    {
        $data = array(
            'title' => 'Register',
        );
        return view('ly_register', $data);
    }

    public function save_register()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi dan tidak boleh kosong'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi dan tidak boleh kosong'
                ]
            ],
            'nama_user' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi dan tidak boleh kosong'
                ]
            ],
            'hak_akses' => [
                'label' => 'Hak akses',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi dan tidak boleh kosong'
                ]
            ]
        ])) {
            $data = array(
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'nama_user' => $this->request->getPost('nama_user'),
                'hak_akses' => $this->request->getPost('hak_akses')

            );
            $this->model_auth->save_register($data);
            session()->setFlashdata('pesan', 'data berhasil disimpan');
            return redirect()->to(base_url('Auth/register'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Auth/register'));
        }
    }
    public function login()
    {
        $data = array(
            'title' => 'Login',
        );
        return view('ly_login', $data);
    }

    public function cek_login()
    {

        if ($this->validate([
            // 'email' => [
            //     'label' => 'Email',
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => '{field} wajib di isi dan tidak boleh kosong'
            //     ]
            // ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi dan tidak boleh kosong'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi dan tidak boleh kosong'
                ]
            ],
        ])) {
            //jika valid
            // $email = $this->request->getPost('email');
            $username = $this->request->getPost('username');
            $password1 = $this->request->getPost('password');
            $password = md5($password1);
            $cek = $this->model_auth->login($username, $password);
            // $cek = $this->model_auth->login($email, $password);
            if ($cek) {
                //jika datanya cocok
                session()->set('log', true);
                session()->set('username', $cek['username']);
                session()->set('id_user', $cek['id_user']);
                session()->set('email', $cek['email']);
                session()->set('telepon', $cek['telepon']);
                session()->set('alamat', $cek['alamat']);
                session()->set('hak_akses', $cek['hak_akses']);
                session()->set('foto', $cek['foto']);


                return redirect()->to(base_url('/dashboard'));
            } else {
                //jika data tidak cocok
                session()->setFlashdata('eror', 'Username Atau Password Salah!');
                return redirect()->to(base_url(''));
            }
        } else {
            //jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url(''));
        }
    }
    public function logout()
    {

        session()->remove('log');
        session()->remove('id_user');
        session()->remove('email');
        session()->remove('telepon');
        session()->remove('username');
        session()->remove('alamat');
        session()->remove('hak_akses');
        session()->remove('foto');

        session()->remove('jml');
        session()->remove('stok');
        session()->remove('nama_obat');

        session()->setFlashdata('pesan', 'Berhasil Logout');
        return redirect()->to(base_url(''));
    }

    public function lupa()
    {
        return view('/password/lupa_password');
    }
    //email
    // public function cek_email()
    // {
    //     $email = $this->request->getPost('email');
    //     $cek = $this->model_auth->emaill($email);
    //     if ($cek) {

    //         session()->setFlashdata('email', $email);
    //         session()->setFlashdata('terdaftar', 'email terdaftar');
    //         return view('/password/ubah_password');
    //     } else {
    //         session()->setFlashdata('error', 'email tidak terdaftar');
    //         return view('/password/lupa_password');
    //     }
    // }
    //username
    public function cek_username()
    {
        $username = $this->request->getPost('username');
        $cek = $this->model_auth->usernamee($username);
        if ($cek) {

            session()->setFlashdata('username', $username);
            session()->setFlashdata('terdaftar', 'username terdaftar');
            return view('/password/ubah_password');
        } else {
            session()->setFlashdata('error', 'Username tidak terdaftar');
            return view('/password/lupa_password');
        }
    }
    //email
    // public function ubahpass()
    // {
    //     $email = $this->request->getPost('email');
    //     $pass1 = $this->request->getPost('pass');
    //     $pass = md5($pass1);

    //     $db = \Config\Database::connect();
    //     $update = $db->query("UPDATE is_users SET password='$pass' WHERE email='$email'");
    //     if ($update) {
    //         session()->setFlashdata('pesan', 'Password berhasil di ubah');
    //         return redirect()->to(base_url(''));
    //     } else {
    //         session()->setFlashdata('error', 'Password gagal di ubah');
    //         return view('/password/ubah_password');
    //     }
    // }
    //username
    public function ubahpass()
    {
        $username = $this->request->getPost('username');
        $pass1 = $this->request->getPost('pass');
        $pass = md5($pass1);

        $db = \Config\Database::connect();
        $update = $db->query("UPDATE is_users SET password='$pass' WHERE username='$username'");
        if ($update) {
            session()->setFlashdata('pesan', 'Password berhasil di ubah');
            return redirect()->to(base_url(''));
        } else {
            session()->setFlashdata('error', 'Password gagal di ubah');
            return view('/password/ubah_password');
        }
    }

    public function gagal()
    {
        return view('/errors/gagal');
    }
}
