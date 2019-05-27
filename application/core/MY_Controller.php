<?php

class MY_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_master');
	}

	public function header($title, $sub_title)
	{
		$isi['title']		= $title;
		$isi['sub_title']	= $sub_title;
		$isi['users']		= $this->m_master->getusers();
		$isi['application']	= $this->m_master->getapplication();	
		$isi['menu']		= $this->m_master->getmenu();
		$isi['submenu']		= $this->m_master->getsubmenu();	
		$this->load->view('backend/v_masterheader', $isi);
	}

	public function footer()
	{
		// $isi['pengunjung']		= $this->m_statistik->getPengunjung();
		// $isi['semuapengunjung']	= $this->m_statistik->getAllPengunjung();
		$this->load->view('backend/v_masterfooter');
	}
}