<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_usermanagement extends CI_model 
{
	public function getrole()
	{
		return $this->db->order_by('id_role', 'ASC')->get('user_role');
	}

	public function getroleid($role_id)
	{
		return $this->db->where('id_role', $role_id)->order_by('id_role', 'ASC')->get('user_role');
	}

	public function getprofile()
	{
		return $this->db->from('user')->join('user_role', 'user.role_id=user_role.id_role')->where('user.username', $this->session->userdata['username'])->get();
	}

	public function getuser()
	{
		return $this->db->from('user')->join('user_role', 'user.role_id=user_role.id_role')->order_by('username', 'ASC')->get();
	}
}