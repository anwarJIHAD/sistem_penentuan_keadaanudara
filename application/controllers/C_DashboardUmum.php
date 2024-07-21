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

	public function index()
	{
		$bulan = array(
			"Januari",
			"Februari",
			"Maret",
			"April",
			"Mei",
			"Juni",
			"Juli",
			"Agustus",
			"September",
			"Oktober",
			"November",
			"Desember"
		);
		$tahun_sekarang = date('Y');
		$tahun_range = range($tahun_sekarang, $tahun_sekarang - 20, -1);
		$data['tahun'] = $tahun_range;
		$data['bulan'] = $bulan;
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
			// Panggil fungsi model dengan semua argumen yang diperlukan
			$data = $this->Dashboard_model->getbyhari($latitude, $longitude, $tahun, $bulan);

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
