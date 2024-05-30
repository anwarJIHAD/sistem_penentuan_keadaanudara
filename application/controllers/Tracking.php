<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tracking extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sensor_model');
	}

	public function index()
	{
		$data['locations'] = $this->Sensor_model->get();

		$this->load->view('pages/tracking/tracking_view', $data);
	}
	public function data()
	{
		$data = $this->Sensor_model->get();
		echo json_encode($data);
	}
}
