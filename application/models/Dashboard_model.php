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

		$this->db->select('datasensor.pm25, datasensor.latitude, datasensor.longitude, datasensor.datetime');

		// Jika latitude dan longitude kosong, hitung rata-rata pm25
		if (empty($latitude) || empty($longitude)) {
			$this->db->select_avg('datasensor.pm25');
		} else {
			$this->db->select("datasensor.pm25, datasensor.latitude, datasensor.longitude, datasensor.datetime, $haversine AS distance");
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

	public function getbyhari($latitude, $longitude, $tahun, $month)
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
    if (!empty($latitude) && !empty($longitude)) {
        $this->db->select("DATE(datasensor.datetime) as date, AVG(datasensor.pm25) as avg_pm25, $haversine AS distance");
        $this->db->where("$haversine <=", $tolerance);
    } else {
        $this->db->select('DATE(datasensor.datetime) as date, AVG(datasensor.pm25) as avg_pm25');
    }

    $this->db->from('datasensor');

    // Filter berdasarkan tahun
    if (!empty($tahun)) {
        $this->db->where('YEAR(datasensor.datetime)', $tahun);
    }

    // Jika bulan tidak kosong, filter berdasarkan bulan dan ambil data rata-rata per hari
    if (!empty($month)) {
        $this->db->where('MONTH(datasensor.datetime)', $month);
    }

    // Group dan order berdasarkan tanggal
    $this->db->group_by('DATE(datasensor.datetime)');
    $this->db->order_by('DATE(datasensor.datetime)', 'ASC');

    log_message('debug', 'SQL Query: ' . $this->db->get_compiled_select()); // Log query sebelum eksekusi

    $query = $this->db->get();

    // Cek apakah query berhasil
    if ($query === false) {
        log_message('error', 'Query failed: ' . $this->db->last_query()); // Log error query
        return false; // Atau bisa mengembalikan array kosong atau nilai default
    }

    log_message('debug', 'SQL Query Executed: ' . $this->db->last_query()); // Log query yang dieksekusi

    // Ambil hasil query
    $result = $query->result_array();

    // Inisialisasi array untuk hasil akhir
    $final_result = [];
    $days_in_month = !empty($month) ? cal_days_in_month(CAL_GREGORIAN, $month, $tahun) : 31;

    for ($day = 1; $day <= $days_in_month; $day++) {
        $date = $tahun . '-' . (!empty($month) ? sprintf("%02d", $month) : '01') . '-' . sprintf("%02d", $day);
        $found = false;

        foreach ($result as $row) {
            if (date('Y-m-d', strtotime($row['date'])) == $date) {
                $final_result[] = $row;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $final_result[] = [
                'date' => $date,
                'avg_pm25' => 0
            ];
        }
    }

    log_message('debug', 'Query Result: ' . print_r($final_result, true));

    return $final_result;
}





}
