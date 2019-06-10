<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_setting extends CI_model 
{
	public function getsetting()
	{
		return $this->db->get('config_application', 1);
	}
}