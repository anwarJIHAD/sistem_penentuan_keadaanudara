<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_DashboardUmum extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');

		// $this->requiredLogin();
		// preventAccessPengguna(array(
		//     AD
		// ));
	}

	public function index()
	{
		$data['judul'] = "Halaman Dashboard";
		// $this->load->view('pages/layout/header', $data);
		$this->load->view('pages/Dashboard', $data);
		// $this->load->view('pages/layout/footer', $data);
	}
	public function coba()
	{
		$this->load->view('pages/Dashboardcoba');

	}
}
