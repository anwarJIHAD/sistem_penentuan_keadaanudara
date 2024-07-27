<?php
defined('BASEPATH') or exit('No direct script access
allowed');
class Dashboard_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	public function getbybulan($latitude, $longitude, $tahun, $month)
	{
		// Radius bumi dalam meter
		$tolerance = 50; // Toleransi jarak dalam meter
		$earth_radius = 6371000; // Radius bumi dalam meter

		// Query untuk menghitung jarak menggunakan rumus haversine
		$haversine = "( 
        $earth_radius * acos(
            cos(radians($latitude)) * cos(radians(datasensor.latitude)) * 
            cos(radians(datasensor.longitude) - radians($longitude)) + 
            sin(radians($latitude)) * sin(radians(datasensor.latitude))
        )
    )";

		$this->db->select('datasensor.pm25, datasensor.latitude, datasensor.longitude, datasensor.datetime,datasensor.temperature,datasensor.humidity,datasensor.pressure,datasensor.lux');

		// Jika latitude dan longitude kosong, hitung rata-rata pm25
		if (empty($latitude) || empty($longitude)) {
			$this->db->select('avg(datasensor.pm25) as pm25,avg(datasensor.temperature) as temperature,avg(datasensor.humidity) as humidity,avg(datasensor.pressure) as pressure,avg(datasensor.lux) as lux');
		} else {
			$this->db->select("datasensor.pm25, datasensor.latitude, datasensor.longitude, datasensor.datetime, $haversine AS distance,datasensor.temperature,datasensor.humidity,datasensor.pressure,datasensor.lux");
			$this->db->where("$haversine <=", $tolerance);
		}

		$this->db->from('datasensor');

		// Filter berdasarkan tahun dan bulan
		if ($tahun != '') {
			$this->db->where('YEAR(datasensor.datetime)', $tahun);
		}
			if ($month != '') {
				$this->db->where('MONTH(datasensor.datetime)', $month);
		}

		// Urutkan berdasarkan datetime secara descending
		if (!empty($latitude) && !empty($longitude)) {
			$this->db->order_by('datasensor.datetime', 'DESC');
			$this->db->limit(1);
		}

		$query = $this->db->get();

		// Ambil hasil query
		if (empty($latitude) || empty($longitude)) {
			$result = $query->row_array();
		} else {
			$result = $query->row_array();
		}

		log_message('debug', 'Query Result: ' . print_r($result, true));
		log_message('debug', 'Query Last: ' . $this->db->last_query());

		return $result;
	}

	public function getbyhari($latitude, $longitude, $tahun, $month, $day)
	{
		// Radius bumi dalam meter
		$tolerance = 50; // Toleransi jarak dalam meter
		$earth_radius = 6371000; // Radius bumi dalam meter

		// Query untuk menghitung jarak menggunakan rumus haversine
		$haversine = "( 
        $earth_radius * acos(
            cos(radians($latitude)) * cos(radians(datasensor.latitude)) * 
            cos(radians(datasensor.longitude) - radians($longitude)) + 
            sin(radians($latitude)) * sin(radians(datasensor.latitude))
        )
    )";

		// Jika latitude dan longitude kosong, hitung rata-rata pm25
		if (empty($latitude) || empty($longitude)) {
			$this->db->select('avg(datasensor.pm25) as pm25,avg(datasensor.temperature) as temperature,avg(datasensor.humidity) as humidity,avg(datasensor.pressure) as pressure,avg(datasensor.lux) as lux');
		} else {
			$this->db->select("datasensor.pm25, datasensor.latitude, datasensor.longitude, datasensor.datetime, $haversine AS distance,datasensor.temperature,datasensor.humidity,datasensor.pressure,datasensor.lux");
			$this->db->where("$haversine <=", $tolerance);
		}

		$this->db->from('datasensor');

		// Filter berdasarkan tahun dan bulan
		if ($tahun != '') {
			$this->db->where('YEAR(datasensor.datetime)', $tahun);
		}
		if ($month != '') {
			$this->db->where('MONTH(datasensor.datetime)', $month);
		}
		if ($day != '') {
			$this->db->where('DAY(datasensor.datetime)', $day);
		}

		// Urutkan berdasarkan datetime secara descending
		if (!empty($latitude) && !empty($longitude)) {
			$this->db->order_by('datasensor.datetime', 'DESC');
			$this->db->limit(1);
		}

		$query = $this->db->get();

		// Ambil hasil query
		if (empty($latitude) || empty($longitude)) {
			$result = $query->row_array();
		} else {
			$result = $query->row_array();
		}

		log_message('debug', 'Query Result: ' . print_r($result, true));
		log_message('debug', 'Query Last: ' . $this->db->last_query());

		return $result;
	}
	function datamap() {
		$this->db->select('wilayah.nama_wilayah, wilayah.latitude, wilayah.longitude, IFNULL(datasensor.pm25, 0) as pm25, IFNULL(datasensor.datetime, 0) as datetime, datasensor.temperature, datasensor.humidity, datasensor.pressure, datasensor.lux');
		$this->db->from('wilayah');
		$this->db->join('datasensor', '(
			6371 * acos(
				cos(radians(wilayah.latitude)) * cos(radians(datasensor.latitude)) * 
				cos(radians(datasensor.longitude) - radians(wilayah.longitude)) + 
				sin(radians(wilayah.latitude)) * sin(radians(datasensor.latitude))
			) * 1000 <= 100
		)', 'left', false);
		$this->db->order_by('datasensor.datetime', 'DESC');
		$this->db->group_by('wilayah.nama_wilayah');
		$query = $this->db->get();
		
		// Debugging: Print query
		// echo $this->db->last_query();
	
		if ($query) {
			return $query->result_array();
		} else {
			// Handle error
			log_message('error', 'Query error: ' . $this->db->_error_message());
			return [];
		}
	}
	





}
