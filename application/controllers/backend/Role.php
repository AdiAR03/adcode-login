<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('backend/m_role');
	}

	public function index()
	{
		$title			= 'Role';
		$sub_title		= '';
		$this->header($title, $sub_title);

		$isi['role']	= $this->m_role->getrole();
		$this->load->view('backend/v_role', $isi);

		$this->footer();
	}
}
