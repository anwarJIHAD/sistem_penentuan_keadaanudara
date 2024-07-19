<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Dashboard_user extends SDA_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');

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
		$data['wilayah_sample'] = ['indonesia'];
		$data['judul'] = "Halaman Dashboard";
		$this->load->view('pages/layout/header', $data);
		$this->load->view('pages/dashboard/dashboard_user', $data);
		$this->load->view('pages/layout/footer', $data);
	}

}
