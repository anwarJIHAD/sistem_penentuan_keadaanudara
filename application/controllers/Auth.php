<?php
defined('BASEPATH') or exit('No direct script access allowed');
class auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}
	function index()
	{
		log_message('debug', 'C_Dashboard index method called');
		if ($this->session->userdata('is_login')) {
			redirect('C_Dashboard_user');
		}
		$this->form_validation->set_rules('email', 'email', 'trim|required', [
			'required' => 'email Wajib di isi'
		]);
		$this->form_validation->set_rules('password', 'password', 'trim|required', [
			'required' => 'password Wajib di isi'
		]);
		$this->form_validation->set_rules('unit', 'unit', 'trim|required', [
			'required' => 'unit Wajib di isi'
		]);
		if ($this->form_validation->run() == false) {
			$this->load->view("pages/Auth/login");
		} else {
			$this->cek_login();
		}
	}
	function portal(){
		if ($this->session->userdata('is_admin')) {
			redirect('C_Dashboard_user');
		}
		$this->form_validation->set_rules('email', 'email', 'trim|required', [
			'required' => 'email Wajib di isi'
		]);
		$this->form_validation->set_rules('password', 'password', 'trim|required', [
			'required' => 'password Wajib di isi'
		]);
	if ($this->form_validation->run() == false) {
		$this->load->view("pages/Auth/login_admin");
	} else {
		$this->cek_login_admin();
	}
}
	function registrasi()
	{
		if ($this->session->userdata('NIP')) {
			redirect('auth/registrasi');
		}
		$this->form_validation->set_rules('nama', 'nama', 'required|trim');
		$this->form_validation->set_rules('NIP', 'NIP', 'required|trim|is_unique[user.NIP]', [
			'is_unique' => 'NIP ini sudah terdaftar!',
			'required' => 'NIP Wajib di isi'
		]);
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'required|trim|min_length[5]|matches[password2]',
			[
				'matches' => 'Password Tidak Sama',
				'min_length' => 'Password Terlalu Pendek',
				'required' => 'Password harus diisi'
			]
		);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if ($this->form_validation->run() == false) {
			$this->load->view('auth/registrasi');
		} else {
			$data = [
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'NIP' => htmlspecialchars($this->input->post('NIP', true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'gambar' => 'default.png',
				'role' => "User",
			];
			$this->userrole->insert($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat!Akunmu telah berhasil terdaftar, Silahkan Login! </div>');
			redirect('auth');
		}
	}

	// public function cek_regis()
	// {
	//     $data = [
	//         'nama' => htmlspecialchars($this->input->post('nama', true)),
	//         'NIP' => htmlspecialchars($this->input->post('NIP', true)),
	//         'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
	//         'gambar' => 'default.jpg',
	//         'role' => 'User',
	//     ];
	//     $this->userrole->insert($data);
	//     $this->session->set_flashdata('message', '<div class="alert alert-success" role="elert"> Selamat Akunmu telah berhasil terdaftar, Silahkan Login!</div>');
	//     redirect('auth');
	// }

	public function cek_login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$unit = $this->input->post('unit');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			if (password_verify($password, $user['password'])) {
			if ($user['id_alat'] == $unit) {
				if ($user['status'] == '1') {
					$data = [
						'is_member' => 1,
						'is_login' => true,	
						'login_type' => 'admin', 
						'nama_komunitas' => $user['nama_komunitas'],
						'id_alat' => $user['id_alat'],	
						'data_login' => [
							'id_alat' => $user->id_alat,
							'id_user' => $user->id_user,
							'email' => $user->email,
							'nama_komunitas' => $user['nama_komunitas'],
						]
					];
					$this->session->set_userdata($data);
					redirect('C_Dashboard_user');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="elert">
                    Akun Tidak Aktif</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="elert">
                    Unit alat tidak ditemukan</div>');
				redirect('auth');
			}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="elert">
			Password Salah!</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="elert">
            Akun Belum Terdaftar</div>');
			redirect('auth');
		}
	}

	public function cek_login_admin()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			if (password_verify($password, $user['password'])) {
			if ($user['role'] == 'admin') {
				if ($user['status'] == '1') {
					$data = [
						'is_admin' => 1,
						'is_login' => true,	
						'login_type' => 'admin', 
						'nama_komunitas' => $user['nama_komunitas'],
						'id_alat' => $user['id_alat'],	
						'data_login' => [
							'id_alat' => $user->id_alat,
							'id_user' => $user->id_user,
							'email' => $user->email,
							'nama_komunitas' => $user['nama_komunitas'],
						]
					];
					$this->session->set_userdata($data);
					redirect('C_Dashboard_user');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="elert">
                    Akun admin Tidak Aktif</div>');
					redirect('portal-admin');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="elert">
                    Akun tidak terdaftar dengan role admin</div>');
				redirect('portal-admin');
			}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="elert">
			Password admin Salah!</div>');
				redirect('portal-admin');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="elert">
            Akun Belum Terdaftar</div>');
			redirect('portal-admin');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Logout! </div>');
		redirect('auth');
	}
}
