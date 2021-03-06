<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_master extends CI_model 
{
	public function getusers()
	{
		return $this->db->from('user')->join('user_role', 'user.role_id=user_role.id_role')->where('username', $this->session->userdata['username'])->get();
	}

	public function getapplication()
	{
		return $this->db->get('config_application', 1);
	}

	public function getmenu()
	{
		return $this->db->from('user_menu')->join('user_access_menu', 'user_menu.id_menu=user_access_menu.menu_id')->where('user_access_menu.role_id', $this->session->userdata['role_id'])->order_by('user_access_menu.menu_id', 'ASC')->get()->result();
	}

	public function getsubmenu()
	{
		return $this->db->from('user_sub_menu')->join('user_access_submenu', 'user_sub_menu.id_submenu=user_access_submenu.submenu_id')->where('user_sub_menu.is_active_submenu', 1)->where('user_access_submenu.role_id', $this->session->userdata['role_id'])->order_by('user_sub_menu.id_submenu', 'ASC')->get();
	}
}