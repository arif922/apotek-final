<?php

namespace App\Controllers;

use App\Models\usersmodel;

class dt_user extends BaseController
{
    protected $users_model;
    public function __construct()
    {
        $this->users_model = new usersmodel();
    }
    public function view_user()
    {
        // $aa =  $this->users_model->tampil_user();
        // foreach ($aa as $bb) {
        //     $cc = $bb['id_user'];
        // }
        // $cek = $this->users_model->cekk_user($cc);
        // session()->set('hasil', $cek);

        $data = [
            'title' => 'Daftar User',
            'user' => $this->users_model->tampil_user()
        ];
        return view('data_user/view', $data);
    }

    public function go_inputuser()
    {
        $data = [
            'title' => 'Tambah User',
            'validation' => \Config\Services::validation()
        ];
        return view('data_user/input', $data);
    }
    // menyimpan data user
    public function save_user()
    {
        if (!$this->validate([
            'ftuser' => [
                'rules' => 'mime_in[ftuser,image/jpg,image/jpeg,image/png]|is_image[ftuser]|max_size[ftuser,1024]',
                'errors' => [
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1MB',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'username' => [
                'rules' => 'is_unique[is_users.username]',
                'errors' => [
                    'is_unique' => 'Username sudah terdaftar'

                ]
            ],

            'email' => [
                'rules' => 'is_unique[is_users.email]',
                'errors' => [
                    'is_unique' => 'Email sudah terdaftar'

                ]
            ]

        ])) {
            $validation = \Config\Services::validation();
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('/data_user/input')->withInput();
        }

        //KELOLA GAMBAR
        $fotouser = $this->request->getFile('ftuser');

        //jika user tidak meng upload gambar
        if ($fotouser->getError() == 4) {
            $namafoto = 'default.png';
        } else {

            //pindahkan file ke folder tujuan
            $fotouser->move('img');
            //ambil nama file
            $namafoto = $fotouser->getName();
        }

        $pas1 = $this->request->getVar('password');
        $pas2 = md5($pas1);

        $data = [
            'username' => $this->request->getVar('username'),
            'alamat' => $this->request->getVar('alamat'),
            'password' => $pas2,
            'email' => $this->request->getVar('email'),
            'telepon' => $this->request->getVar('telepon'),
            'foto' => $namafoto,
            'hak_akses' => $this->request->getVar('hak_akses')
        ];

        $this->users_model->simpan_user($data);
        session()->setFlashdata('pesan', 'Data Berhasil Disimpan.');
        //kembali ke data user view  
        return redirect()->to('/data_user/view');
    }

    //menampilkan data di form ubah
    public function go_edituser($id_user)
    {

        // $db = \Config\Database::connect();
        // $query = $db->query("SELECT * FROM `is_users` where id_user = '$id_user'");

        $data = [
            'title' => 'Ubah user',
            'user' => $this->users_model->go_ubahuser($id_user)
        ];
        return view('data_user/ubah', $data);
    }

    //menyimpan data update
    public function update_user()
    {

        if (!$this->validate([
            'ftuser' => [
                'rules' => 'mime_in[ftuser,image/jpg,image/jpeg,image/png]|is_image[ftuser]|max_size[ftuser,1024]',
                'errors' => [
                    'is_image' => 'Yang Anda Pilih Bukan Gambar',
                    'max_size' => 'Ukuran Gambar Tidak Boleh Lebih Dari 1MB',
                    'mime_in' => 'Yang Anda Pilih Bukan Gambar'
                ]
            ]




        ])) {
            $validation = \Config\Services::validation();
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('/data_user/view');
        }

        $filefoto = $this->request->getFile('ftuser');

        //cek gambar, apakah gambar lama
        if ($filefoto->getError() == 4) {
            $namafoto = $this->request->getVar('fotolama');
        } else {
            $namafoto = $filefoto->getName();
            //pindahkan gambar
            $filefoto->move('img', $namafoto);
            //hapus file lama
            // unlink('img/' . $this->request->getVar('fotolama'));
        }

        $id_user = $this->request->getVar('id_user');
        $passs1 = $this->request->getVar('password1');
        if ($passs1 == null) {

            $data = [
                'username' => $this->request->getVar('username'),
                'alamat' => $this->request->getVar('alamat'),
                // 'password' => $pass3,
                'email' => $this->request->getVar('email'),
                'telepon' => $this->request->getVar('telepon'),
                'foto' => $namafoto,
                'hak_akses' => $this->request->getVar('hak_akses')

            ];
        } else {
            $pass3 = md5($passs1);
            $data = [
                'username' => $this->request->getVar('username'),
                'alamat' => $this->request->getVar('alamat'),
                'password' => $pass3,
                'email' => $this->request->getVar('email'),
                'telepon' => $this->request->getVar('telepon'),
                'foto' => $namafoto,
                'hak_akses' => $this->request->getVar('hak_akses')

            ];
        }

        $this->users_model->ubah_user($data, $id_user);
        // return view('data_user/ubah', $data);

        //menampilkan data berhasil disimpan
        session()->setFlashdata('pesan', 'Data Berhasil diubah.');
        // //kembali ke data supplier view  
        return redirect()->to('/data_user/view');
    }

    public function delete($id_user)
    {

        //cek apakah data user ada di transaksi
        $hasil = $this->users_model->cekk_user($id_user);
        foreach ($hasil as $nn) {
            $bebas = $nn['id_user'];
        }
        //jika tidak ada hapus user
        if ($bebas == 0) {
            //cari gambar berdasarkan id
            $user = $this->users_model->cari_gambar($id_user);
            foreach ($user as $us) {
                $dt_us = $us['foto'];
                //cek jika gambar default.png
                if ($dt_us != 'default.png') {

                    //hapus gambar
                    unlink('img/' . $dt_us);
                }
            }

            $this->users_model->hapus_user($id_user);
            session()->setFlashdata('pesan', 'Data Berhasil Dihapus.');
        } else {
            session()->setFlashdata('eror2', 'Data User Sedang Digunakan Pada Transaksi');
        }

        //kembali ke data user view  
        return redirect()->to('/data_user/view');
    }

    public function profil()
    {
        $data = [
            'title' => 'Profil User'
        ];

        return view('data_user/profil', $data);
    }
}
