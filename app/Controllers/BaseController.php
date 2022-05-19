<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		session();


		$db = \Config\Database::connect();
		//cek jmlh stok awal
		// menjumlah data obat dengan stok dibawah 10
		$jml = $db->query("SELECT COUNT(stok) AS jmlstok FROM is_obat WHERE stok <= '10'")->getResultArray();
		foreach ($jml as $stok) {
			$jmlstok = $stok['jmlstok'];
		}
		//cek data obat dengan jumlah kurang dr 10
		$cekobat = $db->query("SELECT * FROM is_obat where stok <= '10'")->getResultArray();
		session()->set('nma', $cekobat);
		//cek jmlh stok akhir

		date_default_timezone_set("Asia/Jakarta");
		$date1 = date("Y-m-d");
		$date2 = date("Y-m-d"); //tanggal sekarang

		// //menambah 60 hr pada tanggal sekarang
		$date3    = date('Y-m-d', strtotime('+60 days', strtotime($date1)));
		$jmlexp = $db->query("SELECT COUNT(kode_obat) AS jmlexp FROM is_obat where expired BETWEEN '$date2' and '$date3'")->getResultArray();
		foreach ($jmlexp as $exp) {
			$expp = $exp['jmlexp'];
		}
		$total = $jmlstok + $expp;
		session()->set('jumlah', $total);

		$cekexp = $db->query("SELECT kode_obat,nama_obat,DATE_FORMAT(expired, '%d-%m-%Y') AS expired FROM is_obat where expired BETWEEN '$date2' and '$date3' order by kode_obat asc")->getResultArray();
		session()->set('exp', $cekexp);

		$data = array(

			'nama_obat' => $cekobat,
			'expired' => $cekexp,
		);
		return view('layout/bl', $data);
	}
}
