<?php
defined('BASEPATH') or exit('No direct script access
allowed');
class Wilayah_model extends CI_Model
{
	public $table = 'wilayah';
	public $NIP = 'wilayah.id_wilayah';
	public function __construct()
	{
		parent::__construct();
	}
	public function get()
	{
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getMaxPm25ByWilayahWithTolerance()
{
    $this->db->select('wilayah.nama_wilayah, wilayah.latitude, wilayah.longitude, IFNULL(MAX(datasensor.pm25), 0) as maxpm25');
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

	

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function getById($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_wilayah', $id);
		$query = $this->db->get();
		$result = $query->row_array();

		if (empty($result)) {
			return [];
		}

		return $result;
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
}
