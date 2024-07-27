<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Dashboard_user extends SDA_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Wilayah_model');

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
		$tahun_sekarang = date('Y');
		$tahun_range = range($tahun_sekarang, $tahun_sekarang - 20, -1);
		$data['tahun'] = $tahun_range;
		$data['bulan'] = $bulan;
		$data['wilayah'] = $this->Wilayah_model->get();
		$data['judul'] = "Halaman Dashboard";
		$this->load->view('pages/layout/header', $data);
		$this->load->view('pages/dashboard/dashboard_user', $data);
		$this->load->view('pages/layout/footer', $data);
	}

}
