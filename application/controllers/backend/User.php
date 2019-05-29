<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('backend/m_usermanagement');
	}

	public function index()
	{
		$title			= 'Menu Management';
		$sub_title		= 'Menu';
		$this->header($title, $sub_title);

		$isi['menu']		= $this->m_menumanagement->getmenu();
		$isi['mastermenu']	= $this->m_menumanagement->getmastermenu();
		// $isi['aksesmenu']	= $this->m_menumanagement->getaksesmenu();
		$this->load->view('backend/menu/v_menu', $isi);

		$this->footer();
	}


	public function role()
	{
		$title			= 'User Management';
		$sub_title		= 'Role';
		$this->header($title, $sub_title);

		$isi['role']	= $this->m_usermanagement->getrole();
		$this->load->view('backend/user/v_role', $isi);

		$this->footer();
	}
}
