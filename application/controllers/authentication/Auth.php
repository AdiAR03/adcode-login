<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller 
{
	public function index()
	{
		if ($this->session->userdata('username') == NULL) {
			$this->form_validation->set_rules('username', 'Username', 'required|trim|matches[username]',
			[
				'required'	=> 'Username Tidak Boleh Kosong'
			]);
			$this->form_validation->set_rules('password', 'Password', 'required|trim|matches[password]',
				[
					'required'	=> 'Password Tidak Boleh Kosong'
				]);

			if ($this->form_validation->run() == false) 
			{
				$data['title']	= 'Selamat Datang';
				$this->load->view('backend/v_login', $data);
			}
			else
			{
				$this->cek_login();
			}
		}
		else {
			redirect('backend/dashboard');
		}	
	}

	private function cek_login()
	{
		$captcha = $this->input->post('security_code');
		if($captcha != $this->session->userdata('myCap'))
        {
        	$this->session->set_flashdata('error', 
											'Kode Keamanan Salah!');
            redirect('authentication');
        }
        else
        {
			$username 	= $this->input->post('username');
			$password 	= $this->input->post('password');

			$user 		= $this->db->where('username', $username)->get('user')->row_array();
			if ($user) {
				if ($user['is_active'] == 1) {
					if (password_verify($password, $user['password'])) 
					{
						$data = [
									'fullname'	=> $user['fullname'],
									'username'	=> $user['username'],
									'role_id'	=> $user['role_id']
						];
						$this->session->set_userdata($data);
						redirect('backend/dashboard');
					}
					else {
						$this->session->set_flashdata('error', '
							Password salah,Silahkan cek kembali !!!
							');
						redirect('authentication');
					}
				}
				else {
					$this->session->set_flashdata('error', '
						Username belum di aktivasi, Silahkan hubungi admin !!!
						');
					redirect('authentication');
				}
			}
			else {
				$this->session->set_flashdata('error', '
	                    Username yang anda masukan belum terdaftar, Silahkan cek kembali !!!
					');
				redirect('authentication');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('fullname');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '
			Anda keluar dari Aplikasi, Terima Kasih Telah Berkunjung
			');
		redirect('authentication');
	}

	public function blocked()
	{
		$title			= 'Bloked';
		$sub_title		= '';
		$this->header($title, $sub_title);

		$this->load->view('backend/v_403');

		$this->footer();
	}

	public function resetpass()
	{
		$data = array(
						'password' => password_hash('admin', PASSWORD_DEFAULT)
						);
		$this->db->where('role_id', 1)->update('user', $data);
		redirect('authentication');
	}
}
