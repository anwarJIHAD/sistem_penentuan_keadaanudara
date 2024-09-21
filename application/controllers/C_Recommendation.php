<?php
defined('BASEPATH') or exit('No direct script access allowed');
class C_Recommendation extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Dashboard_model');
		$this->load->model('Wilayah_model');

		// $this->requiredLogin();
		// preventAccessPengguna(array(
		//     AD
		// ));
	}
    public function knn_recommendation() {
        $this->load->model('Sensor_model');

        // Dapatkan data wilayah
        $wilayah_data = $this->Sensor_model->get_wilayah();

        $recommendations = array();

        // Loop setiap wilayah
        foreach ($wilayah_data as $wilayah) {
            // Ambil tetangga terdekat menggunakan KNN
            $neighbors = $this->Sensor_model->get_nearest_neighbors($wilayah['latitude'], $wilayah['longitude']);
            
            if (!empty($neighbors)) {
                // Klasifikasikan berdasarkan tetangga terdekat
                $recommendation = $this->classify_by_knn($neighbors);

                $recommendations[] = array(
                    'nama_wilayah' => $wilayah['nama_wilayah'],
                    'status' => $recommendation
                );
            } else {
                $recommendations[] = array(
                    'nama_wilayah' => $wilayah['nama_wilayah'],
                    'status' => 'Tidak Ada Data'
                );
            }
        }

        // Kirim hasil rekomendasi ke view
        $data['recommendations'] = $recommendations;
        var_dump( $data['recommendations'] );
        die;
        $this->load->view('recommendation_view', $data);
    }

    function classify_by_knn($neighbors) {
        $baik_count = 0;
        $tidak_baik_count = 0;
    
        foreach ($neighbors as $neighbor) {
            if ($neighbor['pm25'] > 50) {
                $tidak_baik_count++;
            } else {
                $baik_count++;
            }
        }
    
        // Klasifikasi berdasarkan mayoritas
        if ($baik_count > $tidak_baik_count) {
            return 'Direkomendasikan';
        } else {
            return 'Tidak Direkomendasikan';
        }
    }
    
}
