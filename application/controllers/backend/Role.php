<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
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
