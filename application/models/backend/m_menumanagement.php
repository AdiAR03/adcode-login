<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_menumanagement extends CI_model 
{
	public function getmastermenu()
	{
		return $this->db->order_by('id_master_menu', 'DESC')->get('user_master_menu');
	}

	public function getmenu()
	{
		return $this->db->order_by('id_menu', 'ASC')->get('user_menu');
	}

	public function getmenunull()
	{
		return $this->db->where('url_menu', '')->order_by('id_menu', 'ASC')->get('user_menu');
	}

	public function getaksesmenu()
	{
		return $this->db->order_by('id_access_menu', 'DESC')->get('user_access_menu');
	}

	public function getaksessubmenu()
	{
		return $this->db->order_by('id_access_submenu', 'DESC')->get('user_access_submenu');
	}

	public function getsubmenu()
	{
		return $this->db->from('user_sub_menu')->join('user_menu', 'user_sub_menu.menu_id=user_menu.id_menu')->order_by('id_submenu', 'DESC')->get();
	}
}