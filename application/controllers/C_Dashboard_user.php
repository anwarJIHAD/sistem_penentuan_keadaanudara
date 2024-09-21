<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Dashboard_user extends SDA_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Wilayah_model');
		$this->load->model('Sensor_model');

		$this->requiredLogin();
		preventAccessPengguna(
			array(
				AD
			)
		);
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
		$data['wilayah'] = $this->Wilayah_model->get();
		$data['judul'] = "Halaman Dashboard";
		$data['routes']  = $this->group_routes($this->Sensor_model->get_all_routes('', ''));
		$jml_route=0;
		foreach ($data['routes'] as $key => $value){
			$jml_route++;
		}
		$data['jml_route'] = $jml_route;
		$jaraktotal = $this->Sensor_model->calculateTotalDistance();
		$data['jarak_total']=round($jaraktotal,1);
		$data['tercemar'] = $maxPm25Wilayah;
	
		$this->load->view('pages/layout/header', $data);
		$this->load->view('pages/dashboard/dashboard_user', $data);
		$this->load->view('pages/layout/footer', $data);
	}
	private function group_routes($records)
	{
		$routes = [];
		$current_route = [];
		foreach ($records as $record) {
			if ($record->sign == 'start') {
				if (!empty($current_route)) {
					$routes[] = $current_route;
				}
				$current_route = [];
			}
			$current_route[] = $record;
			if ($record->sign == 'finish') {
				$routes[] = $current_route;
				$current_route = [];
			}
		}
		return $routes;
	}

}
