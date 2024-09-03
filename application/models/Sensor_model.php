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
}
