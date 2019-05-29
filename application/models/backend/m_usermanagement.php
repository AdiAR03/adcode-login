<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_usermanagement extends CI_model 
{
	public function getrole()
	{
		return $this->db->order_by('id_role', 'ASC')->get('user_role');
	}
}