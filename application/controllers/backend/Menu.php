<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('backend/m_menumanagement');
		$this->load->model('backend/m_usermanagement');
	}

	public function index()
	{
		$this->form_validation->set_rules('judul_menu', 'Judul', 'required|trim|is_unique[user_menu.judul_menu]|matches[judul_menu]',
			[
				'required'	=> 'Menu Tidak Boleh Kosong',
				'is_unique'	=> 'Menu telah digunakan'
			]);
		$this->form_validation->set_rules('url_menu', 'URL', 'trim|is_unique[user_menu.url_menu]|matches[url_menu]',
			[
				'is_unique'	=> 'Url Menu telah digunakan'
			]);
		$this->form_validation->set_rules('master_menu_id', 'Master Menu', 'required|trim|matches[master_menu_id]',
			[
				'required'	=> 'Master Menu Tidak Boleh Kosong',
			]);

		$this->form_validation->set_rules('is_active', 'Nama', 'required|trim|matches[is_active]',
			[
				'required'	=> 'Status Tidak Boleh Kosong',
			]);
		if ($this->form_validation->run() == false) 
		{
			$title			= 'Menu Management';
			$sub_title		= 'Menu';
			$this->header($title, $sub_title);

			$isi['menu']		= $this->m_menumanagement->getmenu();
			$isi['mastermenu']	= $this->m_menumanagement->getmastermenu();
			$isi['role']		= $this->m_usermanagement->getrole();
			$isi['aksesmenu']	= $this->m_menumanagement->getaksesmenu();
			$this->load->view('backend/menu/v_menu', $isi);

			$this->footer();
		}
		else
		{
			$data 	= array (
								'judul_menu'	=> $this->input->post('judul_menu'),
								'url_menu'		=> $this->input->post('url_menu'),
								'icon_menu'		=> $this->input->post('icon_menu'),
								'master_menu_id'=> $this->input->post('master_menu_id'),
								'is_active'		=> $this->input->post('is_active'),
							);
			$this->db->insert('user_menu', $data);
			$this->session->set_flashdata('message', 'Menu berhasil ditambahkan');
			redirect('backend/menu/view-menu');
		}
	}

	public function deletemenu()
	{
		$id 	= decrypt_url($this->uri->segment(4));

		$this->db->where('id_menu', $id)->delete('user_menu');
		$this->session->set_flashdata('message', 'Hapus Menu Berhasil');
		redirect('backend/menu/view-menu');
	}

	public function editmenu()
	{
		$this->form_validation->set_rules('judul_menu', 'Judul', 'required|trim|matches[judul_menu]',
			[
				'required'	=> 'Menu Tidak Boleh Kosong',
				'is_unique'	=> 'Menu telah digunakan'
			]);
		$this->form_validation->set_rules('master_menu_id', 'Master Menu', 'required|trim|matches[master_menu_id]',
			[
				'required'	=> 'Master Menu Tidak Boleh Kosong',
			]);

		$this->form_validation->set_rules('is_active', 'Nama', 'required|trim|matches[is_active]',
			[
				'required'	=> 'Status Tidak Boleh Kosong',
			]);
		if ($this->form_validation->run() == false) 
		{
			$this->session->set_flashdata('error', 'Perbaharui Menu GAGAL...');
			redirect('backend/menu/view-menu');
		}
		else
		{
			$update = array (
								'judul_menu'	=> $this->input->post('judul_menu'),
								'url_menu'		=> $this->input->post('url_menu'),
								'icon_menu'		=> $this->input->post('icon_menu'),
								'master_menu_id'=> $this->input->post('master_menu_id'),
								'is_active'		=> $this->input->post('is_active'),
						    );
			
			$this->db->where('id_menu', $this->input->post('id_menu'))->update('user_menu', $update);
			$this->session->set_flashdata('message', 'Perbaharui Menu Berhasil...');
			redirect('backend/menu/view-menu');
			
		}
	}

	// MASTER MENU
	public function mastermenu()
	{
		$this->form_validation->set_rules('master_menu', 'Nama', 'required|trim|is_unique[user_master_menu.master_menu]|matches[master_menu]',
			[
				'required'	=> 'Nama Tidak Boleh Kosong',
				'is_unique'	=> 'Nama telah digunakan'
			]);
		if ($this->form_validation->run() == false) 
		{
			$title			= 'Menu Management';
			$sub_title		= 'Master Menu';
			$this->header($title, $sub_title);

			$isi['mastermenu']	= $this->m_menumanagement->getmastermenu();
			$this->load->view('backend/menu/v_mastermenu', $isi);

			$this->footer();
		}
		else
		{
			$data 	= array (
								'master_menu'	=> $this->input->post('master_menu'),
							);
			$this->db->insert('user_master_menu', $data);
			$this->session->set_flashdata('message', 'Master Menu/Controller Berhasil di tambahkan');
			redirect('backend/menu/view-mastermenu');
		}
	}

	public function deletemastermenu()
	{
		$id = decrypt_url($this->uri->segment(4));

		$this->db->where('id_master_menu', $id)->delete('user_master_menu');
		$this->session->set_flashdata('message', 'Hapus Master Menu/Controller Berhasil');

		redirect('backend/menu/view-mastermenu');
	}

	public function editmastermenu()
	{
		$this->form_validation->set_rules('master_menu', 'Nama', 'required|trim|is_unique[user_master_menu.master_menu]|matches[master_menu]',
			[
				'required'	=> 'Nama Tidak Boleh Kosong',
				'is_unique'	=> 'Nama telah digunakan'
			]);
		if ($this->form_validation->run() == false) 
		{
			$this->session->set_flashdata('error', 'Perbaharui Master Menu/Controller GAGAL...');
			redirect('backend/menu/view-mastermenu');
		}
		else
		{
			$update = array (
								'master_menu'	=> $this->input->post('master_menu')
						    );
			
			$this->db->where('id_master_menu', $this->input->post('id_master_menu'))->update('user_master_menu', $update);
			$this->session->set_flashdata('message', 'Perbaharui Master Menu/Controller Berhasil...');
			redirect('backend/menu/view-mastermenu');
		}
	}

	public function submenu()
	{
		$this->form_validation->set_rules('judul_submenu', 'Judul', 'required|trim|is_unique[user_sub_menu.judul_submenu]|matches[judul_submenu]',
			[
				'required'	=> 'Sub Menu Tidak Boleh Kosong',
				'is_unique'	=> 'Sub Menu telah digunakan'
			]);
		$this->form_validation->set_rules('url_submenu', 'URL', 'trim|is_unique[user_sub_menu.url_submenu]|matches[url_submenu]',
			[
				'is_unique'	=> 'Url Sub Menu telah digunakan'
			]);
		$this->form_validation->set_rules('menu_id', 'Menu', 'required|trim|matches[menu_id]',
			[
				'required'	=> 'Menu Tidak Boleh Kosong',
			]);

		$this->form_validation->set_rules('is_active_submenu', 'Status', 'required|trim|matches[is_active_submenu]',
			[
				'required'	=> 'Status Tidak Boleh Kosong',
			]);
		if ($this->form_validation->run() == false) 
		{
			$title			= 'Menu Management';
			$sub_title		= 'Sub Menu';
			$this->header($title, $sub_title);

			$isi['submenu']		= $this->m_menumanagement->getsubmenu();
			$isi['menu']		= $this->m_menumanagement->getmenunull();
			$isi['role']		= $this->m_usermanagement->getrole();
			$isi['aksessubmenu']= $this->m_menumanagement->getaksessubmenu();
			$this->load->view('backend/menu/v_submenu', $isi);

			$this->footer();
		}
		else
		{
			$data 	= array (
								'judul_submenu'		=> $this->input->post('judul_submenu'),
								'url_submenu'		=> $this->input->post('url_submenu'),
								'menu_id'			=> $this->input->post('menu_id'),
								'is_active_submenu'	=> $this->input->post('is_active_submenu'),
							);
			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata('message', 'Sub menu berhasil ditambahkan');
			redirect('backend/menu/view-submenu');
		}
	}

	public function deletesubmenu()
	{
		$id = decrypt_url($this->uri->segment(4));

		$this->db->where('id_submenu', $id)->delete('user_sub_menu');
		$this->session->set_flashdata('message', 'Hapus Sub Menu Berhasil');

		redirect('backend/menu/view-submenu');
	}

	public function editsubmenu()
	{
		$this->form_validation->set_rules('judul_submenu', 'Judul', 'required|trim|matches[judul_submenu]',
			[
				'required'	=> 'Sub Menu Tidak Boleh Kosong',
			]);
		$this->form_validation->set_rules('menu_id', 'Menu', 'required|trim|matches[menu_id]',
			[
				'required'	=> 'Menu Tidak Boleh Kosong',
			]);

		$this->form_validation->set_rules('is_active_submenu', 'Status', 'required|trim|matches[is_active_submenu]',
			[
				'required'	=> 'Status Tidak Boleh Kosong',
			]);
		if ($this->form_validation->run() == false) 
		{
			$this->session->set_flashdata('error', 'Perbaharui SUb Menu GAGAL...');
			redirect('backend/menu/view-submenu');
		}
		else
		{
			$update = array (
								'judul_submenu'	=> $this->input->post('judul_submenu'),
								'url_submenu'	=> $this->input->post('url_submenu'),
								'menu_id'		=> $this->input->post('menu_id'),
								'is_active_submenu'		=> $this->input->post('is_active_submenu'),
						    );
			
			$this->db->where('id_submenu', $this->input->post('id_submenu'))->update('user_sub_menu', $update);
			$this->session->set_flashdata('message', 'Perbaharui Sub Menu Berhasil...');
			redirect('backend/menu/view-submenu');
		}
	}
}
