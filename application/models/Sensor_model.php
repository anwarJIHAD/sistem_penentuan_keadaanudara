<?php
defined('BASEPATH') or exit('No direct script access
allowed');
class Sensor_model extends CI_Model
{
	public $table = 'datasensor';
	public $id = 'datasensor.id';
	public function __construct()
	{
		parent::__construct();
	}
		public function get_all_routes($start_date = '', $end_date = '')
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('id_alat', $this->session->userdata('id_alat'));
			if ($start_date && $end_date) {
				$start_date_db = date('Y-m-d', strtotime($start_date));
				$end_date_db = date('Y-m-d', strtotime($end_date));

				$this->db->where('datetime >=', $start_date_db . ' 00:00:00');
				$this->db->where('datetime <=', $end_date_db . ' 23:59:59');
			}
			$this->db->order_by('id', 'ASC');
			$query = $this->db->get();
			return $query->result();
		}
		public function get_route_details($start_id, $finish_id)
		{
			// Query to fetch all records between start_id and finish_id
			$query = $this->db->select('*')
				->from($this->table)
				->where('id >=', $start_id)
				->where('id <=', $finish_id)
				->order_by('id', 'asc')
				->get();
			return $query->result();
		}
	
		public function sensorbyLat($lat)
	{
		$this->db->from($this->table);
		$this->db->where('latitude', $lat);
		$query = $this->db->get();
		return $query->row_array();
	}
	public function jaraktotal(){
		$this->db->select('latitude, longitude');
		$this->db->from($this->table);
		$this->db->where('id_alat', $this->session->userdata('id_alat'));
		$query = $this->db->get();
    	return $query->result();

	}
	public function calculateTotalDistance()
{
    // Ambil semua data latitude dan longitude dari database
    $coordinates = $this->jaraktotal();
  
    $totalDistance = 0;

    // Loop melalui setiap data latitude dan longitude
    for ($i = 0; $i < count($coordinates) - 1; $i++) {
        // Ambil titik pertama dan titik berikutnya
        $lat1 = $coordinates[$i]->latitude;
        $lon1 = $coordinates[$i]->longitude;
        $lat2 = $coordinates[$i + 1]->latitude;
        $lon2 = $coordinates[$i + 1]->longitude;

        // Hitung jarak menggunakan fungsi Haversine
        $distance = $this->haversineDistance($lat1, $lon1, $lat2, $lon2);

        // Tambahkan jarak ke total
        $totalDistance += $distance;
    }

    return $totalDistance;
}

private function haversineDistance($lat1, $lon1, $lat2, $lon2)
{
    $earth_radius = 6371; // Radius bumi dalam kilometer

    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $a = sin($dLat / 2) * sin($dLat / 2) +
        cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
        sin($dLon / 2) * sin($dLon / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $earth_radius * $c; // Jarak dalam kilometer

    return $distance;
}

		public function get()
		{
			$this->db->from($this->table);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function update($where, $data)
		{
			$this->db->update($this->table, $data, $where);
			return $this->db->affected_rows();
		}

		public function insert($data)
		{
			$this->db->insert($this->table, $data);
			return $this->db->affected_rows();
		}
		public function delete($NIP)
		{
			$this->db->where($this->NIP, $NIP);
			$this->db->delete($this->table);
			return $this->db->affected_rows();
		}
		public function tuser()
		{
			$this->db->from($this->table);
			$query = $this->db->get();
			return $query->num_rows();
		}
		public function get_wilayah() {
			$this->db->select('id_wilayah, nama_wilayah, latitude, longitude');
			$this->db->from('wilayah');
			$query = $this->db->get();
			return $query->result_array();
		}
		
		public function get_nearest_neighbors($latitude, $longitude, $k = 5) {
			$last_month = date('Y-m-d H:i:s', strtotime('-1 month'));
			$this->db->select('latitude, longitude, pm25, datetime');
			$this->db->from('datasensor');
			$this->db->where('datetime >=', $last_month);
			$query = $this->db->get();
			$datasensor = $query->result_array();
		
			$distances = array();
		
			// Hitung jarak setiap titik sensor dari titik pusat (latitude, longitude)
			foreach ($datasensor as $data) {
				$distance = $this->calculate_distance($latitude, $longitude, $data['latitude'], $data['longitude']);
				$data['distance'] = $distance;
				$distances[] = $data;
			}
		
			// Urutkan data berdasarkan jarak
			usort($distances, function($a, $b) {
				return $a['distance'] - $b['distance'];
			});
		
			// Ambil K tetangga terdekat
			return array_slice($distances, 0, $k);
		}
		


		// Fungsi untuk mengambil semua data sensor dalam periode 1 bulan
		public function get_all_sensor_data_for_last_month() {
			$last_month = date('Y-m-d H:i:s', strtotime('-1 month'));
			$this->db->select('*');
			$this->db->from('datasensor');
			$this->db->where('datetime >=', $last_month);
			$query = $this->db->get();
			return $query->result_array();  // Kembalikan semua baris hasil
		}
	
		// Fungsi untuk menghitung jarak antara dua titik koordinat
		private function calculate_distance($lat1, $lon1, $lat2, $lon2) {
			$earth_radius = 6371; // Radius bumi dalam kilometer
			$d_lat = deg2rad($lat2 - $lat1);
			$d_lon = deg2rad($lon2 - $lon1);
			$a = sin($d_lat / 2) * sin($d_lat / 2) +
				 cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * 
				 sin($d_lon / 2) * sin($d_lon / 2);
			$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
			$distance = $earth_radius * $c;
			return $distance;
		}
	
		// Fungsi untuk mengambil data sensor dalam radius tertentu dari titik koordinat
		public function get_sensor_data_within_radius($latitude, $longitude, $radius_km = 0.2) {
			$all_data = $this->get_all_sensor_data_for_last_month();
			$filtered_data = array();
	
			// Filter data berdasarkan radius
			foreach ($all_data as $data) {
				$distance = $this->calculate_distance($latitude, $longitude, $data['latitude'], $data['longitude']);
				if ($distance <= $radius_km) {
					$filtered_data[] = $data;
				}
			}
	
			return $filtered_data;
		}

		//function
		

		
}
