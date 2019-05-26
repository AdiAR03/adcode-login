<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
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
			redirect('authentication');
		}	
	}

	private function cek_login()
	{
		$captcha = $this->input->post('security_code');
		if($captcha != $this->session->userdata('myCap'))
        {
        	$this->session->set_flashdata('message', 
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
					if ($user['password']==md5($password)) {
						$data = [
									'fullname'	=> $user['fullname'],
									'username'	=> $user['username'],
									'role_id'	=> $user['role_id']
						];
						$this->session->set_userdata($data);
						redirect('dashboard');
					}
					else {
						$this->session->set_flashdata('message', '
							Password salah,Silahkan cek kembali !!!
							');
						redirect('authentication');
					}
				}
				else {
					$this->session->set_flashdata('message', '
						Username belum di aktivasi, Silahkan hubungi admin !!!
						');
					redirect('authentication');
				}
			}
			else {
				$this->session->set_flashdata('message', '
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
}
