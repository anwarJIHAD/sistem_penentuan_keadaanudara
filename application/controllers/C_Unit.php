<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Unit extends SDA_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');

		$this->requiredLogin();
		preventAccessPengguna(
			array(
				AD
			)
		);
	}
	public function index()
	{

		$data['judul'] = "Halaman Unit";
		$data['Unit'] = $this->User_model->get();
		$this->load->view('pages/layout/header', $data);
		$this->load->view("pages/Unit/Unit", $data);
		$this->load->view('pages/layout/footer', $data);
	}
	public function tambah()
	{
		$data['judul'] = "Halaman Tambah Unit";
		$this->form_validation->set_rules('nama', 'nama', 'required|trim|is_unique[user.nama_komunitas]', [
			'is_unique' => 'nama komunitas ini sudah terdaftar!',
			'required' => 'nama Unit Wajib di isi',
		]);

		$this->form_validation->set_rules('unit_alat', 'unit_alat', 'required|trim|is_unique[user.id_alat]', [
			'is_unique' => 'unit alat ini sudah terdaftar!',
			'required' => 'unit_alat Wajib di isi',
		]);
		$this->form_validation->set_rules(
			'password',
			'Password',
			[
				'required' => 'required',
				'trim' => 'trim',
				'min_length' => 'min_length[8]',
				'max_length' => 'max_length[20]',
				'regex_match[/^(?=.*[a-z])(?=.*[A-Z]).+$/]' => 'regex_match[/^(?=.*[a-z])(?=.*[A-Z]).+$/]'
			],
			[
				'required' => 'Password wajib di isi',
				'min_length' => 'Password minimal 8 karakter',
				'max_length' => 'Password maksimal 20 karakter',
				'regex_match' => 'Password harus mengandung huruf besar dan huruf kecil'
			]
		);

		$this->form_validation->set_rules('email', 'email', 'required|trim|is_unique[user.email]', [
			'is_unique' => 'email ini sudah terdaftar!',
			'required' => 'email Wajib di isi',
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('pages/layout/header', $data);
			$this->load->view("pages/Unit/tambah_unit", $data);
			$this->load->view('pages/layout/footer', $data);
		} else {
			$now = new DateTime();

			// Mendapatkan timestamp saat ini
			$current_timestamp = $now->getTimestamp();

			$data = [
				'nama_komunitas' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'id_alat' => $this->input->post('unit_alat'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role' => 'customer',
				'status' => 1,
				//  'date_create' => $current_timestamp,
			];
			if ($this->User_model->insert($data)) {
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
				Data Unit Berhasil di tambahkan
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
				redirect('C_Unit');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
			Data Unit gagal di tambahkan
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
				redirect('C_Unit');
			}



		}
	}
	public function edit($id)
	{
		$data['judul'] = "Halaman Tambah Unit";
		$data['Unit'] = $this->User_model->getById($id);

		$this->form_validation->set_rules('nama', 'nama', 'required|trim', [
			'required' => 'nama Unit Wajib di isi',
		]);

		$this->form_validation->set_rules('unit_alat', 'unit_alat', 'required|trim', [
			'required' => 'unit_alat Wajib di isi',
		]);
		$this->form_validation->set_rules(
			'password',
			'Password',
			[
				'trim',
				'min_length[8]',
				'max_length[20]',
				'callback_password_check'
			],
			[
				'min_length' => 'Password minimal 8 karakter',
				'max_length' => 'Password maksimal 20 karakter',
				'password_check' => 'Password harus mengandung huruf besar dan huruf kecil'
			]
		);

		$this->form_validation->set_rules('email', 'email', 'required|trim', [
			'required' => 'email Wajib di isi',
		]);


		if ($this->form_validation->run() == false) {
			$this->load->view('pages/layout/header', $data);
			$this->load->view("pages/Unit/edit_unit", $data);
			$this->load->view('pages/layout/footer', $data);
		} else {
			$now = new DateTime();

			// Mendapatkan timestamp saat ini
			$current_timestamp = $now->getTimestamp();

			$data = [
				'nama_komunitas' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'id_alat' => $this->input->post('unit_alat'),
				'role' => 'customer',
				'status' => 1,
				//  'date_create' => $current_timestamp,
			];

			if ($this->input->post('password') !== '0') {
				$data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			}
			$this->User_model->update(['id_user' => $id], $data);

			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
			Data Unit Berhasil di Edit
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>');
			redirect('C_Unit');

		}
	}
	public function password_check($password)
	{
		// Jika password kosong, lewati validasi ini
		if (empty($password)) {
			return true;
		}

		// Memeriksa apakah password mengandung huruf besar dan huruf kecil
		if (preg_match('/^(?=.*[a-z])(?=.*[A-Z]).+$/', $password)) {
			return true;
		} else {
			$this->form_validation->set_message('password_check', 'Password harus mengandung huruf besar dan huruf kecil');
			return false;
		}
	}

	public function hapus($id)
	{
		$this->User_model->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
		Data Unit Berhasil dihapus!!
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  </div>');
		redirect('C_Unit');
	}
	function fetch()
	{
		$output = '';
		$query = '';
		$this->load->model('User_model');
		$data = $this->User_model->fetch_data($query);

		if ($this->input->post('query')) {
			$query = $this->input->post('query');
			$data = $this->User_model->fetch_data($query);

		}


		if (!empty($data)) {
			$i = 1;
			foreach ($data->result_array() as $us) {
				$output .= '
				<tr>
				<td class="small">
				' . $i . '
				</td>
				<td>' . $us['nama_komunitas'] . '</td>
				<td>' . $us['id_alat'] . '</td>
				<td>' . $us['email'] . '</td>
				<td>' . $us['password'] . '</td>
				<td class="text-center">
					<button style="padding: 0; border: none; background: none;"><a
							onclick="edit(' . $us['id_user'] . ', ' . '\'Unit\'' . ')"
							class="btn btn-sm btn-outline-warning text"
							style="color:#ffc107; font-size:10px;">
							Edit</a></button>
					<button style="padding: 0; border: none; background: none;"><a
							onclick="hapus(' . $us['id_user'] . ', ' . '\'Unit\'' . ')"
							class="btn btn-sm btn-outline-danger text-danger"
							style=" font-size:10px;">hapus</a></button>



				</td>
				
			</tr>
';
				$i += 1;
			}
		} else {
			$output .= '<tr>
							<td colspan="5">No Data Found</td>
						</tr>';
		}

		echo $output;
	}
	public function get()
	{
		$units = $this->User_model->get('datatables');
		// $data = array('data' => $units);
		// var_dump($units);
		// die;
		$start = 0;
		$data = array();
		foreach ($units as $value) {
			$td = array();
			$td['no'] = ++$start;
			$td['email'] = $value['email'] ?? '-';
			$td['nama_komunitas'] = $value['nama_komunitas'] ?? '-';
			$td['id_alat'] = $value['id_alat'] ?? '-';
			$td['password'] = $value['password'] ?? '-';
			$td['actions'] = '<button style="padding: 0; border: none; background: none;"><a
						onclick="edit(' . $value['id_user'] . ', ' . '\'Unit\'' . ')"
						class="btn btn-sm btn-outline-warning text"
						style="color:#ffc107; font-size:10px;">
						Edit</a></button>
				<button style="padding: 0; border: none; background: none;"><a
						onclick="hapus(' . $value['id_user'] . ', ' . '\'Unit\'' . ')"
						class="btn btn-sm btn-outline-danger text-danger"
						style=" font-size:10px;">hapus</a></button>
			';
			$data[] = $td;
		}
		$dt['data'] = $data;

		echo json_encode($dt);
		die;
	}
}
