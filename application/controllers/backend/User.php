<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('backend/m_usermanagement');
		$this->load->model('backend/m_menumanagement');
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]|matches[username]',
			[
				'required'	=> 'Username Tidak Boleh Kosong',
				'is_unique'	=> 'Username telah digunakan sebelumnya'
			]);
		$this->form_validation->set_rules('fullname', 'Username', 'required|trim|matches[fullname]',
			[
				'required'	=> 'Fullname Tidak Boleh Kosong',
			]);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|trim|matches[password]',
			[
				'required'	=> 'Fullname Tidak Boleh Kosong',
				'min_length'=> 'Password Minimal 8 Karakter'
			]);

		if ($this->form_validation->run() == false) 
		{
			$title			= 'User Management';
			$sub_title		= 'User';
			$this->header($title, $sub_title);

			$isi['user']	= $this->m_usermanagement->getuser();
			$isi['role']	= $this->m_usermanagement->getrole();
			$this->load->view('backend/user/v_user', $isi);

			$this->footer();
		}
		else
		{
			$data 	= array (
								'username'	=> $this->input->post('username'),
								'fullname'	=> $this->input->post('fullname'),
								'image'		=> 'default.png',
								'password'	=> password_hash($this->input->post('password'), PASSWORD_DEFAULT) ,
								'role_id'	=> $this->input->post('role_id'),
								'is_active'	=> $this->input->post('is_active'),
								'date_created'	=> time(),
							);

			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', 'User Berhasil di tambahkan');
			redirect('backend/user/view-user');
		}
	}

	public function deleteuser()
	{
		$id = decrypt_url($this->uri->segment(4));
		$query = $this->db->where('username', $id)->get('user');
        $row_query = $query->row_array();
        $link_file = 'files/img_profile/'.$row_query['image'];
        if ($row_query['image'] != 'default.png') 
        {
        	unlink ($link_file);
        }
		$this->db->where('username', $id)->delete('user');
		$this->session->set_flashdata('message', 'Hapus User Berhasil');

		redirect('backend/user/view-user');
	}

	public function edituser()
	{
		$this->form_validation->set_rules('fullname', 'Fullname', 'required|trim|matches[fullname]',
			[
				'required'	=> 'Fullname Tidak Boleh Kosong',
				'is_unique'	=> 'Fullname telah digunakan'
			]);
		if ($this->form_validation->run() == false) 
		{
			$this->session->set_flashdata('error', 'Perbaharui User GAGAL...');
			redirect('backend/user/view-user');
		}
		else
		{
			$update = array (
								'fullname'	=> $this->input->post('fullname'),
								'role_id'	=> $this->input->post('role_id'),
								'is_active'	=> $this->input->post('is_active'),
						    );
			
			$this->db->where('username', $this->input->post('username'))->update('user', $update);
			$this->session->set_flashdata('message', 'Perbaharui User Berhasil...');
			redirect('backend/user/view-user');
		}
	}

	public function role()
	{
		$this->form_validation->set_rules('role', 'Role', 'required|trim|is_unique[user_role.role]|matches[role]',
			[
				'required'	=> 'Role Tidak Boleh Kosong',
				'is_unique'	=> 'Role telah digunakan sebelumnya'
			]);
		if ($this->form_validation->run() == false) 
		{
			$title			= 'User Management';
			$sub_title		= 'Role';
			$this->header($title, $sub_title);

			$isi['role']	= $this->m_usermanagement->getrole();
			$this->load->view('backend/user/v_role', $isi);

			$this->footer();
		}
		else
		{
			$data 	= array (
								'role'	=> $this->input->post('role'),
							);
			$this->db->insert('user_role', $data);
			$this->session->set_flashdata('message', 'Role User Berhasil di tambahkan');
			redirect('backend/user/view-role');
		}
	}

	public function settingaccess()
	{
		$role_id 		= decrypt_url($this->uri->segment(4));
		$title			= 'User Management';
		$sub_title		= 'Role';
		$this->header($title, $sub_title);

		$isi['menu']	= $this->m_menumanagement->getmenu();
		$isi['submenu']	= $this->m_menumanagement->getsubmenu();
		$isi['role']	= $this->m_usermanagement->getroleid($role_id);
		$this->load->view('backend/user/v_settingaccess', $isi);

		$this->footer();
	}

	public function changeaccess()
    {
        $menu_id = decrypt_url($this->uri->segment(5));
        $role_id = decrypt_url($this->uri->segment(4));

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) 
        {
            $this->db->insert('user_access_menu', $data);
        } 
        else 
        {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', 'Setting akses berhasil diubah');
        if ($this->uri->segment(6) == 'menu') 
        {
        	redirect('backend/menu/view-menu');
        }
        redirect('backend/user/setting-access/'.$this->uri->segment(4));
    }

    public function changesubaccess()
    {
        $submenu_id = decrypt_url($this->uri->segment(5));
        $role_id = decrypt_url($this->uri->segment(4));

        $data = [
            'role_id' 		=> $role_id,
            'submenu_id' 	=> $submenu_id
        ];

        $result = $this->db->get_where('user_access_submenu', $data);

        if ($result->num_rows() < 1) 
        {
            $this->db->insert('user_access_submenu', $data);
        } 
        else 
        {
            $this->db->delete('user_access_submenu', $data);
        }

        $this->session->set_flashdata('message', 'Setting akses Sub Menu berhasil diubah');
        if ($this->uri->segment(6) == 'submenu') 
        {
        	redirect('backend/menu/view-submenu');
        }
        redirect('backend/user/setting-access/'.$this->uri->segment(4));
    }

	public function deleterole()
	{
		$id = decrypt_url($this->uri->segment(4));

		$this->db->where('id_role', $id)->delete('user_role');
		$this->session->set_flashdata('message', 'Hapus Role User Berhasil');

		redirect('backend/user/view-role');
	}

	public function editrole()
	{
		$this->form_validation->set_rules('role', 'Nama', 'required|trim|matches[role]',
			[
				'required'	=> 'Role Tidak Boleh Kosong',
			]);
		if ($this->form_validation->run() == false) 
		{
			$this->session->set_flashdata('error', 'Perbaharui Role User GAGAL...');
			redirect('backend/user/view-role');
		}
		else
		{
			$update = array (
								'role'	=> $this->input->post('role')
						    );
			
			$this->db->where('id_role', $this->input->post('id_role'))->update('user_role', $update);
			$this->session->set_flashdata('message', 'Perbaharui Role User Berhasil...');
			redirect('backend/user/view-role');
		}
	}

	public function profile()
	{
		$this->form_validation->set_rules('fullname', 'Fullname', 'required|trim|matches[fullname]',
			[
				'required'	=> 'Fullname Tidak Boleh Kosong'
			]);
		if ($this->form_validation->run() == false) 
		{
			$title			= 'User Management';
			$sub_title		= 'Profile';
			$this->header($title, $sub_title);

			$isi['profile']	= $this->m_usermanagement->getprofile();
			$this->load->view('backend/user/v_profile', $isi);

			$this->footer();
		}
		else
		{
			$this->updateprofile();
		}
	}

	private function updateprofile()
	{
		$config['upload_path']   = './files/img_profile/';
        $config['file_name']     = $_FILES['foto']['name'];
        $config['allowed_types'] = 'pdf|jpg|png|jpeg';
        $config['max_size']      = 1024;

        $this->load->library('upload');
        $this->upload->initialize($config);

		if (!$this->upload->do_upload('foto')) 
		{
			$update = array (
								'fullname' => $this->input->post('fullname'),
							);
			$this->db->where('username', $this->input->post('username'))->update('user', $update);
			$this->session->set_flashdata('message', 'Perbaharui Profile Berhasil...');
			redirect('backend/user/view-profile');
		}
		else
		{
			$media     		= $this->upload->data();
            $foto     		= $media['file_name'];

            $query = $this->db->where('username', $this->input->post('username'))->get('user');
	        $row_query = $query->row_array();
	        $link_file = 'files/img_profile/'.$row_query['image'];
	        if ($row_query['image'] != 'default.png') 
	        {
	        	unlink ($link_file);
	        }
	        
	        $update = array (
								'fullname' 	=> $this->input->post('fullname'),
								'image'		=> $foto,
						    );
	        $this->db->where('username', $this->input->post('username'))->update('user', $update);

			$this->session->set_flashdata('message', 'Perbaharui Profile Berhasil...');
			redirect('backend/user/view-profile');
		}
	}

	public function changepassword()
	{
		$isi['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('current_password', 'Password Lama', 'required|trim',
			[
				'required'	=> 'Password Lama Tidak Boleh Kosong'
			]);
		$this->form_validation->set_rules('new_password1', 'Password Baru', 'required|trim|min_length[5]',
			[
				'required'	 => 'Password Baru Tidak Boleh Kosong',
				'min_length' => 'Password Baru Kurang dari 3 Karakter',
			]);
		$this->form_validation->set_rules('new_password2', 'Konfirmasi Password Baru', 'required|trim|min_length[5]|matches[new_password1]',
			[
				'required'	 => 'Konfirmasi Password Baru Tidak Boleh Kosong',
				'min_length' => 'Konfirmasi Password Baru Kurang dari 3 Karakter',
				'matches'	 => 'Konfirmasi Password baru tidak sama'
			]);
		if ($this->form_validation->run() == false) 
		{
			$title			= 'User Management';
			$sub_title		= 'Change Password';
			$this->header($title, $sub_title);

			$isi['profile']	= $this->m_usermanagement->getprofile();
			
			$this->load->view('backend/user/v_changepassword', $isi);

			$this->footer();
		}
		else
		{
			$current_password 	= $this->input->post('current_password');
            $new_password 		= $this->input->post('new_password1');

            if (!password_verify($current_password, $isi['user']['password'])) 
            {
                $this->session->set_flashdata('error', 'Password Lama Salah!');
                redirect('backend/user/changepassword');
            } else 
            {
                if ($current_password == $new_password) 
                {
                    $this->session->set_flashdata('error', 'Password Lama Anda Sama dengan Password Baru');
                    redirect('backend/user/view-changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', 'Password Berhasil di Ubah');
                    redirect('backend/user/view-changepassword');
                }
            }
		}
	}
}
