<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_role extends CI_model 
{
	public function getrole()
	{
		return $this->db->get('user_role');
	}
}