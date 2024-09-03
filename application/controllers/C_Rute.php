<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Rute extends SDA_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sensor_model');

		$this->requiredLogin();
		preventAccessPengguna(
			array(
				AD
			)
		);
	}

	public function index($start_date = '', $end_date = '')
	{
		if ($start_date == '' || $end_date == '') {
			$start_date = '';
			$end_date = '';
			$start_input = '';
			$end_input = '';
		} else {
			$tanggal_start = substr($start_date, 3, 2);
			$bulan_start = substr($start_date, 0, 2);
			$tahun_start = substr($start_date, 6, 4);
			$start_date = $tahun_start . '-' . $bulan_start . '-' . $tanggal_start;
			$start_input = $bulan_start . '/' . $tanggal_start . '' . $tahun_start;
			$tanggal_end = substr($end_date, 3, 2);
			$bulan_end = substr($end_date, 0, 2);
			$tahun_end = substr($end_date, 6, 4);
			$end_date = $tahun_end . '-' . $bulan_end . '-' . $tanggal_end;
			$end_input = $bulan_end . '/' . $tanggal_end . '' . $tahun_end;


		}


		$data['routes'] = $this->group_routes($this->Sensor_model->get_all_routes($start_date, $end_date));
		// var_dump($data['routes']);
		// die;
		$data['judul'] = "Halaman Dashboard";
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['start_input'] = $start_input;
		$data['end_input'] = $end_input;
		$this->load->view('pages/layout/header', $data);
		$this->load->view('pages/Perjalanan/perjalanan', $data);
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
	public function get()
	{

		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$routes = $this->group_routes($this->Sensor_model->get_all_routes($start_date, $end_date));

		$data = array();

		foreach ($routes as $value => $route) {
			$td = array();
			$td['no'] = $value + 1;
			$td['rute'] = 'Rute ' . $value + 1 ?? '-';
			$td['start'] = $route[0]->datetime ?? '-';
			$td['finish'] = end($route)->datetime ?? '-';
			$td['actions'] = '<button style="padding: 0; border: none; background: none;"><a
						onclick="detail(' . $route[0]->id . ', ' . end($route)->id . ')"
						class="btn btn-sm btn-outline-warning text"
						style="color:#ffc107; font-size:10px;">
						Detail</a></button>
			';
			$data[] = $td;
		}
		$dt['data'] = $data;

		echo json_encode($dt);
		die;
	}
	public function detail($start_id, $finish_id)
	{

		$data['details'] = $this->Sensor_model->get_route_details($start_id, $finish_id);
		// var_dump($data['details']);
		// die;
		$data['start_id'] = $start_id;
		$data['finish_id'] = $finish_id;
		$data['start_date'] = $data['details'][0]->datetime;
		// $data['avg_all'] = $this->Sensor_model->get_avg($start_id, $finish_id);
		$this->load->view('pages/layout/header', $data);
		$this->load->view('pages/Perjalanan/detail_perjalanan', $data);
		$this->load->view('pages/layout/footer', $data);
	}
	public function get_detail($start_id, $finish_id)
	{
		$data = $this->Sensor_model->get_route_details($start_id, $finish_id);
		echo json_encode($data);
		die;
	}
}
