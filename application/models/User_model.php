<?php
defined('BASEPATH') or exit('No direct script access
allowed');
class User_model extends CI_Model
{
	public $table = 'user';
	public $NIP = 'user.id_user';
	public function __construct()
	{
		parent::__construct();
	}
	public function get()
	{
		$this->db->from($this->table);
		$this->db->order_by('date_create', 'desc');
		$query = $this->db->get();

		return $query->result_array();
	}
	public function getById($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_user', $id);
		$this->db->order_by('date_create', 'desc');
		$query = $this->db->get();
		return $query->row_array();
	}
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function getById_()
	{
		$this->db->select('a.*,u.*');
		$this->db->from('akses a');
		$this->db->join('user u', 'a.NIP = u.NIP');
		$this->db->where('u.status_user2', 'aktif');
		$this->db->order_by('u.date_create', 'desc'); // Mengurutkan hasil berdasarkan kolom 'tanggal' secara ascending

		$query = $this->db->get();
		return $query->result_array();
	}
	function fetch_data($query)
	{
		$this->db->select("*");
		$this->db->from($this->table);
		if ($query != '') {
			$this->db->like('email', $query);
			$this->db->or_like('nama_komunitas', $query);
			$this->db->or_like('id_alat', $query);
			$this->db->or_like('password', $query);

		}
		$this->db->order_by('nama_komunitas', 'DESC');
		return $this->db->get();


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
