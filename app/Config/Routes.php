<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Auth::dashboard');

//user
if (session()->get('hak_akses') == 'APA') {
	$routes->get('/data_user/view', 'dt_user::view_user');

	$routes->get('/delete_user/(:segment)', 'dt_user::delete/$1');
	$routes->get('/data_user/input', 'dt_user::go_inputuser');
	$routes->get('/go_ubahuser/(:segment)', 'dt_user::go_edituser/$1');
	$routes->get('/ubah_user/(:segment)', 'dt_user::ubahuser/$1');
} else {
	$routes->get('/data_user/view', 'Auth::gagal');
	$routes->get('/delete_user/(:segment)', 'Auth::gagal');
	$routes->get('/data_user/input', 'Auth::gagal');
	$routes->get('/go_ubahuser/(:segment)', 'Auth::gagal');
	$routes->get('/ubah_user/(:segment)', 'Auth::gagal');
}
$routes->get('/user/profil', 'dt_user::profil');
//supplier
$routes->get('/data_supplier/view', 'dt_supplier::viewsupplier');
$routes->get('/delete_supplier/(:segment)', 'dt_supplier::delete/$1');
$routes->get('/data_supplier/input', 'dt_supplier::inputsupplier');
// $routes->get('/data_supplier/ubah', 'dt_supplier::ubahsupplier');
$routes->get('/ubah_supplier/(:segment)', 'dt_supplier::go_ubahsupplier/$1');

//customer
$routes->get('/customer/view', 'dt_customer::viewcustomer');
$routes->get('/customer/input', 'dt_customer::go_inputcustomer');
$routes->get('/customer/save', 'dt_customer::savecustomer');
$routes->get('/delete_customer/(:segment)', 'dt_customer::delete/$1');
$routes->get('/customer/ubah/(:segment)', 'dt_customer::go_ubahcustomer/$1');


//data obat
$routes->get('/data_obat/view', 'dt_obat::viewobat');
$routes->get('/delete_obat/(:segment)', 'dt_obat::delete/$1');
$routes->get('/data_obat/input', 'dt_obat::inputobat');
$routes->get('/data_obat/ubah', 'dt_obat::ubahobat');
$routes->get('/ubah_obat/(:segment)', 'dt_obat::ubahobat/$1');

//data golongan
$routes->get('/golongan/view', 'dt_golongan::view_golongan');
$routes->get('/golongan/input', 'dt_golongan::go_inputgolongan');
$routes->get('/golongan/ubah/(:segment)', 'dt_golongan::go_ubahgolongan/$1');
$routes->get('/delete_golongan/(:segment)', 'dt_golongan::delete/$1');

//data satuan
$routes->get('/satuan/view', 'dt_satuan::view_satuan');
$routes->get('/satuan/input', 'dt_satuan::go_inputsatuan');
$routes->get('/satuan/ubah/(:segment)', 'dt_satuan::go_ubahsatuan/$1');
$routes->get('/delete_satuan/(:segment)', 'dt_satuan::delete/$1');

//obat masuk
$routes->get('/obat_masuk/view', 'ob_masuk::view_ob_masuk');
$routes->get('/obat_masuk/input', 'ob_masuk::input_ob_masuk');
$routes->get('/hapus_obat/(:segment)', 'ob_masuk::delete/$1');
$routes->get('/hapus_dtobat/(:segment)', 'ob_masuk::hapus_ob_masuk/$1');
$routes->get('/detail_dtobat/(:segment)', 'ob_masuk::detail_ob_masuk/$1');

//obat keluar
$routes->get('/obat_keluar/view', 'ob_keluar::view');
$routes->get('/obat_keluar/input', 'ob_keluar::input_ob_keluar');
$routes->get('/hapus_dump/(:segment)', 'ob_keluar::delete/$1');
$routes->get('/hapus_obat_keluar/(:segment)', 'ob_keluar::hapus_ob_keluar/$1');
$routes->get('/detail_obat_keluar/(:segment)', 'ob_keluar::detail_ob_keluar/$1');

//retur penjualan
$routes->get('/returjual/view', 'retur_penjualan::view_returjual');
$routes->get('/returjuall/tambah/(:segment)', 'retur_penjualan::go_inpreturjual2/$1');
$routes->get('/returjual/tambah', 'retur_penjualan::go_inpreturjual');
$routes->get('/hapus_dump_rj/(:segment)', 'retur_penjualan::delete_dump/$1');
$routes->get('/detail_returjual/(:segment)', 'retur_penjualan::detail_rj/$1');

//retur pembelian
$routes->get('/returbeli/view', 'retur_pembelian::view_returbeli');
$routes->get('/returbeli/tambah/(:segment)', 'retur_pembelian::go_inpreturbeli2/$1');
$routes->get('/returbeli/tambah', 'retur_pembelian::go_inpreturbeli');
$routes->get('/hapus_dump_rb/(:segment)', 'retur_pembelian::delete_dump/$1');
$routes->get('/detail_returbeli/(:segment)', 'retur_pembelian::detail_rb/$1');

//STOK OPNAME
$routes->get('/so/view', 'stok_opname::view_so');
$routes->get('/so/tambah', 'stok_opname::go_inpso');
$routes->get('/hapus_so/(:segment)', 'stok_opname::delete_dump_so/$1');
$routes->get('/detail_so/(:segment)', 'stok_opname::detail_so/$1');

//penysuaian
$routes->get('/penyesuaian', 'j_penyesuaian::view1');
$routes->get('/penyesuaian/kembali/(:segment)', 'j_penyesuaian::kembali/$1');
$routes->get('/penyesuaian2/(:segment)', 'j_penyesuaian::view2/$1');
$routes->get('/det_penyesuaian/(:segment)', 'j_penyesuaian::detail1/$1');
$routes->get('/det_penyesuaian2/(:segment)', 'j_penyesuaian::detail2/$1');
$routes->post('/penyesuaian/tambah/(:segment)', 'j_penyesuaian::save1/$1');
$routes->get('/penyesuaian/simpan/(:segment)/(:segment)', 'j_penyesuaian::simpann/$1/$2');
$routes->get('/penyesuaian/batal/(:segment)/(:segment)', 'j_penyesuaian::batal/$1/$2');
$routes->post('/hapus_penyesuaian/(:segment)', 'j_penyesuaian::delete_penyesuaian/$1');
$routes->get('/save/penyesuaian/(:segment)', 'j_penyesuaian::save_penyesuaian/$1');

//pesetujuan
$routes->get('/persetujuan', 'j_penyesuaian::view_setuju');
$routes->get('/persetujuann/(:segment)', 'j_penyesuaian::view_setujuu/$1');
$routes->get('/det_persetujuan/(:segment)', 'j_penyesuaian::setuju1/$1');
$routes->get('/det_persetujuan2/(:segment)', 'j_penyesuaian::setuju2/$1');
$routes->post('/det_persetujuan2/(:segment)', 'j_penyesuaian::setuju2/$1');
$routes->post('/disetujui/(:segment)', 'j_penyesuaian::disetujuii/$1');
$routes->post('/tidak-disetujui/(:segment)', 'j_penyesuaian::tidak_disetujuii/$1');

//laporan
$routes->get('/lap_stok/view', 'laporan_stok::view_lap_stok');
$routes->get('/lap_obmasuk/view', 'laporan_masuk::view_lap_masuk');
$routes->get('/lap_obkeluar/view', 'laporan_keluar::view_lap_keluar');
$routes->get('/lap_returbeli/view', 'laporan_rb::view_lap_rb');
$routes->get('/lap_retur/view', 'laporan_rj::view_lap_rj');
$routes->get('/lap_so/view', 'laporan_so::view_lap_so');

//grafik
$routes->get('/grafik/pembelian', 'con_grafik::pembelian');
$routes->get('/grafik/penjualan', 'con_grafik::penjualan');


//lupa password
$routes->get('/lupa_password', 'Auth::lupa');
$routes->get('/ubah_password', 'Auth::ubahpas');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
