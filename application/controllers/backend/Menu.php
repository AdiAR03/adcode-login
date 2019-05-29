<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('backend/m_menumanagement');
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

	// MASTER MENU
	public function mastermenu()
	{
		$title			= 'Menu Management';
		$sub_title		= 'Master Menu';
		$this->header($title, $sub_title);

		$isi['mastermenu']	= $this->m_menumanagement->getmastermenu();
		$this->load->view('backend/menu/v_mastermenu', $isi);

		$this->footer();
	}

	public function submenu()
	{
		$title			= 'Menu Management';
		$sub_title		= 'Sub Menu';
		$this->header($title, $sub_title);

		$isi['submenu']		= $this->m_menumanagement->getsubmenu();
		$isi['menu']		= $this->m_menumanagement->getmenu();
		$this->load->view('backend/menu/v_submenu', $isi);

		$this->footer();
	}
}
