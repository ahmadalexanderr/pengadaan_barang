<?php 
    function is_logged_in()
    {
        $ci = get_instance();
        if (!$ci->session->userdata('username')){
            redirect('auth');
        } else {
            $level = $ci->session->userdata('level');
            $menu = $ci->uri->segment(1);

            $queryMenu = $ci->db->get_where('user_menu', array('menu' => $menu))->row_array();
            $menu_id = $queryMenu['id'];

            $userAccess = $ci->db->get_where('user_access_menu', array('level' => $level, 'menu_id' => $menu_id));

                if ($userAccess->num_rows() < 1){
                redirect('auth/blocked');
                }
        }
    }
?>