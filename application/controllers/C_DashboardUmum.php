<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_DashboardUmum extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Dashboard_model');
		$this->load->model('Wilayah_model');

		// $this->requiredLogin();
		// preventAccessPengguna(array(
		//     AD
		// ));
	}
	public function datamap()
	{
		$data = $this->Dashboard_model->datamap();
		// var_dump($data);
		// die;
		echo json_encode($data);
	}
	public function rekomendasi()
	{
		$data['judul'] = 'rekomendasi';
		$this->load->view('pages/rekomendasi', $data);

	}
	public function index()
	{
		$bulan = array(
			"1" => "Januari",
			"2" => "Februari",
			"3" => "Maret",
			"4" => "April",
			"5" => "Mei",
			"6" => "Juni",
			"7" => "Juli",
			"8" => "Agustus",
			"9" => "September",
			"10" => "Oktober",
			"11" => "November",
			"12" => "Desember"
		);
		$wilayahPm25 = $this->Wilayah_model->getMaxPm25ByWilayahWithTolerance();

		$maxPm25Wilayah = null; // Untuk menyimpan data wilayah dengan pm25 tertinggi
		$maxPm25 = 0; // Untuk menyimpan nilai pm25 tertinggi
		foreach ($wilayahPm25 as $wilayah) {
			if ($wilayah['maxpm25'] > $maxPm25) {
				$maxPm25 = $wilayah['maxpm25'];
				$maxPm25Wilayah = $wilayah; // Simpan wilayah dengan pm25 tertinggi
			}
		}
		
		
		$tahun_sekarang = date('Y');
		$tahun_range = range($tahun_sekarang, $tahun_sekarang - 20, -1);
		$data['tahun'] = $tahun_range;
		$data['bulan'] = $bulan;
		$data['tercemar'] = $maxPm25Wilayah;
		$data['wilayah'] = $this->Wilayah_model->get();
		$data['judul'] = "Halaman Dashboard";
		// $this->load->view('pages/layout/header', $data);
		$this->load->view('pages/dashboard', $data);
		// $this->load->view('pages/layout/footer', $data);
	}
	public function getbybulan()
	{
		$tahun = $this->input->get('tahun'); // Ambil tahun dari permintaan GET
		$wilayah = $this->input->get('wilayah'); // Ambil tahun dari permintaan GET
		$koordinate = $this->Wilayah_model->getById($wilayah);
		if ($koordinate) {
			$latitude = $koordinate['latitude'];
			$longitude = $koordinate['longitude'];
		} else {
			$latitude = '';
			$longitude = '';
		}
		try {

			// Lakukan filter data sesuai dengan tahun untuk cuti
			$month_1 = '01';
			$month_2 = '02';
			$month_3 = '03';
			$month_4 = '04';
			$month_5 = '05';
			$month_6 = '06';
			$month_7 = '07';
			$month_8 = '08';
			$month_9 = '09';
			$month_10 = '10';
			$month_11 = '11';
			$month_12 = '12';

			// Debugging
			log_message('debug', 'Latitude: ' . $latitude);
			log_message('debug', 'Longitude: ' . $longitude);
			log_message('debug', 'Tahun: ' . $tahun);
			log_message('debug', 'Month: ' . $month_6);

			// Panggil fungsi model dengan semua argumen yang diperlukan
			$data['month_1'] = $this->Dashboard_model->getbybulan($latitude, $longitude, $tahun, $month_1);
			$data['month_2'] = $this->Dashboard_model->getbybulan($latitude, $longitude, $tahun, $month_2);
			$data['month_3'] = $this->Dashboard_model->getbybulan($latitude, $longitude, $tahun, $month_3);
			$data['month_4'] = $this->Dashboard_model->getbybulan($latitude, $longitude, $tahun, $month_4);
			$data['month_5'] = $this->Dashboard_model->getbybulan($latitude, $longitude, $tahun, $month_5);
			$data['month_6'] = $this->Dashboard_model->getbybulan($latitude, $longitude, $tahun, $month_6);
			$data['month_7'] = $this->Dashboard_model->getbybulan($latitude, $longitude, $tahun, $month_7);
			$data['month_8'] = $this->Dashboard_model->getbybulan($latitude, $longitude, $tahun, $month_8);
			$data['month_9'] = $this->Dashboard_model->getbybulan($latitude, $longitude, $tahun, $month_9);
			$data['month_10'] = $this->Dashboard_model->getbybulan($latitude, $longitude, $tahun, $month_10);
			$data['month_11'] = $this->Dashboard_model->getbybulan($latitude, $longitude, $tahun, $month_11);
			$data['month_12'] = $this->Dashboard_model->getbybulan($latitude, $longitude, $tahun, $month_12);

			// var_dump($data);
			// die;

			// Kirim data dalam format JSON
			header('Content-Type: application/json');
			echo json_encode($data);
		} catch (Exception $e) {
			// Tangkap kesalahan dan kirim pesan kesalahan dalam format JSON
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json');
			echo json_encode(array('error' => $e->getMessage()));
		}
	}
	public function getbyhari()
	{
		$tahun = $this->input->get('tahun'); // Ambil tahun dari permintaan GET
		$bulan = $this->input->get('bulan'); // Ambil bulan dari permintaan GET
		$wilayah = $this->input->get('wilayah'); // Ambil wilayah dari permintaan GET

		// Ambil koordinat dari model
		$koordinate = $this->Wilayah_model->getById($wilayah);
		if ($koordinate) {
			$latitude = $koordinate['latitude'];
			$longitude = $koordinate['longitude'];
		} else {
			$latitude = '';
			$longitude = '';
		}

		try {
			// Tentukan jumlah hari dalam bulan berdasarkan bulan yang dipilih
			if ($bulan == '') {
				$jumlahHari = '31';
			} else {
				if ($tahun == '') {
					$jumlahHari = '31';
				} else {
					$jumlahHari = date('t', strtotime($tahun . '-' . $bulan . '-01'));
				}
			}

			for ($i = 1; $i <= $jumlahHari; $i++) {
				$hari = $this->Dashboard_model->getbyhari($latitude, $longitude, $tahun, $bulan, str_pad($i, 2, '0', STR_PAD_LEFT));
				$data['hari_' . $i] = $hari;
			}

			// Kirim data dalam format JSON
			header('Content-Type: application/json');
			echo json_encode($data);
		} catch (Exception $e) {
			// Tangkap kesalahan dan kirim pesan kesalahan dalam format JSON
			header('HTTP/1.1 500 Internal Server Error');
			header('Content-Type: application/json');
			echo json_encode(array('error' => $e->getMessage()));
		}
	}

	

}
