<?php 

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) 
    {
        redirect('authentication');
    }
    else 
    {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(2);

        $queryMenu = $ci->db->from('user_menu')->join('user_master_menu', 'user_menu.master_menu_id=user_master_menu.id_master_menu')->where('user_master_menu.master_menu', $menu)->get()->row_array();
        $menu_id = $queryMenu['id_menu'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) 
        {
            $querySubMenu = $ci->db->from('user_sub_menu')->join('user_menu', 'user_sub_menu.menu_id=user_menu.id_menu')->join('user_master_menu', 'user_menu.master_menu_id=user_master_menu.id_master_menu')->where('user_master_menu.master_menu', $menu)->get()->row_array();
            $submenu_id = $querySubMenu['id_submenu'];

            $userAccessSub = $ci->db->get_where('user_access_menu', [
                'role_id' => $role_id,
                'menu_id' => $menu_id
            ]);


            if ($userAccessSub->num_rows() < 1) 
            {
                redirect('authentication/blocked');
            }
        }

        // $queryMenu = $ci->db->get_where('user_menu', ['master' => $menu])->row_array();
        // $menu_id = $queryMenu['id'];

        // $userAccess = $ci->db->get_where('user_access_menu', [
        //     'role_id' => $role_id,
        //     'menu_id' => $menu_id
        // ]);

        // if ($userAccess->num_rows() < 1) {
        //     redirect('authentication/blocked');
        // }
    }
}