<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller 
{
	public function index()
	{
		$title			= 'Dashboard';
		$sub_title		= '';
		$this->header($title, $sub_title);

		$this->load->view('backend/v_dashboard');

		$this->footer();
	}
}
