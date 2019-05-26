<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller 
{
	public function index()
	{
		$title			= 'Dashboard';
		$this->header($title);

		$this->load->view('backend/v_dashboard');

		$this->footer();
	}
}
