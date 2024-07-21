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
