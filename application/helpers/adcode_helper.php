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

            $userAccessSub = $ci->db->get_where('user_access_submenu', [
                'role_id' => $role_id,
                'submenu_id' => $submenu_id

                
            ]);
            die($submenu_id);
            if ($userAccessSub->num_rows() < 1) 
            {
                redirect('authentication/blocked');
            }
        }
        // else
        // {
        //     $querySubMenu = $ci->db->from('user_sub_menu')->join('user_menu', 'user_sub_menu.menu_id=user_menu.id_menu')->join('user_master_menu', 'user_menu.master_menu_id=user_master_menu.id_master_menu')->where('user_master_menu.master_menu', $menu)->get()->row_array();
        //     $submenu_id = $querySubMenu['id_submenu'];

        //     $userAccessSub = $ci->db->get_where('user_access_submenu', [
        //         'role_id' => $role_id,
        //         'submenu_id' => $submenu_id
        //     ]);


        //     if ($userAccessSub->num_rows() < 1) 
        //     {
        //         die($submenu_id. $role_id);
        //         redirect('authentication/blocked');
        //     }
        // }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id)->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check_subaccess($role_id, $submenu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id)->where('submenu_id', $submenu_id);
    $result = $ci->db->get('user_access_submenu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}