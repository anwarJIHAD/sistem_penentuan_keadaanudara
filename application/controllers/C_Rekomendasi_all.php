<?php
defined('BASEPATH') or exit('No direct script access allowed');
class C_Rekomendasi_all extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Sensor_model');
		$this->load->model('Wilayah_model');

		// $this->requiredLogin();
		// preventAccessPengguna(array(
		//     AD
		// ));
	}
    public function index(){
        $this->load->view('pages/recommendation_view');
    }
   public function dataload(){
    $this->load->model('Sensor_model');

    // Ambil semua data sensor dalam periode 1 bulan
    $sensor_data = $this->Sensor_model->get_all_sensor_data_for_last_month();
    // var_dump($sensor_data);
    // die;
    if (!empty($sensor_data)) {
        // Klasifikasikan data sensor berdasarkan radius 1 km
        $regions = $this->classify_region($sensor_data, $radius_km = 0.5);
    
        // Kirim hasil ke view atau response API
        $data['regions'] = $regions;
		echo json_encode($data['regions']);
        
    } else {
        // Jika tidak ada data
        $data['regions'] = array(
            array(
                'latitude' => null,
                'longitude' => null,
                'recommendation' => 'Tidak Ada Data'
            )
        );
        echo json_encode($data['regions']);
    }
}

function classify_region($data, $radius_km = 1) {
    // Mengelompokkan data dalam radius
    $groups = $this->group_by_radius($data, $radius_km);

    $regions = array();

    foreach ($groups as $group) {
        $recommendation = $this->calculate_group_recommendation($group);
        $sensorbyLat=$this->Sensor_model->sensorbyLat($group['center_lat']);
        

        $regions[] = array(
            'latitude' => $group['center_lat'],
            'longitude' => $group['center_lon'],
            'recommendation' => $recommendation
        );
    }

    return $regions;
}


    


// Fungsi untuk mendapatkan data dari titik pusat dalam radius
// Fungsi untuk mendapatkan data dari titik pusat dalam radius
function get_center_data($data, $center_lat, $center_lon, $radius_km) {
    $filtered_data = array();

    foreach ($data as $point) {
        $distance = calculate_distance($center_lat, $center_lon, $point['latitude'], $point['longitude']);
        if ($distance <= $radius_km) {
            $filtered_data[] = $point;
        }
    }

    return $filtered_data;
}

// Fungsi untuk mengklasifikasikan data berdasarkan titik pusat menggunakan KNN
function classify_by_knn_with_center($data, $center_lat, $center_lon, $k = 5) {
    $distances = array();

    // Hitung jarak setiap titik dari titik tengah
    foreach ($data as $point) {
        $distance = $this->calculate_distance($center_lat, $center_lon, $point['latitude'], $point['longitude']);
        $point['distance'] = $distance;
        $distances[] = $point;
    }

    // Urutkan berdasarkan jarak
    usort($distances, function($a, $b) {
        return $a['distance'] - $b['distance'];
    });

    // Ambil K tetangga terdekat
       $neighbors = array_slice($distances, 0, $k);

    // Klasifikasi berdasarkan mayoritas pm25
    $baik_count = 0;
    $tidak_baik_count = 0;

    foreach ($neighbors as $neighbor) {
        if ($neighbor['pm25'] > 50) {
            $baik_count++;
        } else {
            $tidak_baik_count++;
        }
    }

    // Klasifikasikan berdasarkan mayoritas
    return $baik_count > $tidak_baik_count ? 'Direkomendasikan' : 'Tidak Direkomendasikan';
}

// Fungsi untuk menemukan titik sensor yang paling dekat dengan titik tengah
function find_nearest_sensor_point($data, $center_lat, $center_lon) {
    $nearest_point = null;
    $shortest_distance = PHP_INT_MAX;

    foreach ($data as $point) {
        $distance = $this->calculate_distance($center_lat, $center_lon, $point['latitude'], $point['longitude']);
        if ($distance < $shortest_distance) {
            $shortest_distance = $distance;
            $nearest_point = $point;
        }
    }

    return $nearest_point;
}


// Fungsi untuk mengelompokkan titik sensor berdasarkan radius
function group_by_radius($data, $radius_km) {
    $groups = array();

    foreach ($data as $point) {
        $group_found = false;

        foreach ($groups as &$group) {
            // Cek jarak dari titik ini ke titik grup pusat
            $distance = $this->calculate_distance($point['latitude'], $point['longitude'], $group['center_lat'], $group['center_lon']);
            
            if ($distance <= $radius_km) {
                $group['points'][] = $point;
                $group_found = true;
                break;
            }
        }

        if (!$group_found) {
            // Buat grup baru
            $groups[] = array(
                'center_lat' => $point['latitude'],
                'center_lon' => $point['longitude'],
                'points' => array($point)
            );
        }
    }

    return $groups;
}

// Fungsi untuk menghitung titik pusat dari sekumpulan data
function calculate_center_point($data) {
    if (empty($data)) return array('latitude' => null, 'longitude' => null);

    $lat_sum = 0;
    $lon_sum = 0;
    $count = count($data);

    foreach ($data as $point) {
        $lat_sum += $point['latitude'];
        $lon_sum += $point['longitude'];
    }

    $center_lat = $lat_sum / $count;
    $center_lon = $lon_sum / $count;

    return array('latitude' => $center_lat, 'longitude' => $center_lon);
}

// Fungsi untuk menghitung rekomendasi kelompok
function calculate_group_recommendation($group) {
    $recommendations = array();
    
    // Klasifikasi setiap titik dalam kelompok
    foreach ($group['points'] as $point) {
        $recommendations[] = $point['pm25'] < 100 ? 'Direkomendasikan' : 'Tidak Direkomendasikan';
    }

    // Hitung jumlah rekomendasi
    $baik_count = array_count_values($recommendations)['Direkomendasikan'] ?? 0;
    $total_count = count($recommendations);

    // Klasifikasikan berdasarkan mayoritas
    return ($baik_count / $total_count) > 0.5 ? 'Direkomendasikan' : 'Tidak Direkomendasikan';
}

// Fungsi untuk menghitung jarak antara dua titik
function calculate_distance($lat1, $lon1, $lat2, $lon2) {
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

}
