<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class model_menu extends CI_Model
{

    function fetch_menu()
    {
        $user_data = $this->session->userdata('userdata');
        $login_rights_group_id = $user_data['login_rights_group_id'];
        $query = "SELECT menu.*,mg.menu_group_id,lrg.login_rights_group_id from menu
                    LEFT JOIN menu_group_detail mgd on mgd.menu_id=menu.menu_id
                    LEFT JOIN user_priviliges up on up.menu_id=menu.menu_id
                    LEFT JOIN menu_group mg on mg.menu_group_id=mgd.menu_group_id  or mg.menu_group_id=up.menu_group_id
                    LEFT JOIN login_rights_group lrg on lrg.menu_group_id=mg.menu_group_id
                    where lrg.login_rights_group_id=$login_rights_group_id AND menu.status=1
                    ORDER BY menu.menu_id";
        $result = $query = $this->db->query($query);
        if ($result) {
            return $result->result();
        } else {
            return array();
        }
    }

    function fetch_menu_search($menu)
    {
        $user_data = $this->session->userdata('userdata');
        $login_rights_group_id = $user_data['login_rights_group_id'];
        $query = "SELECT menu.*,mg.menu_group_id,lrg.login_rights_group_id from menu
                        LEFT JOIN menu_group_detail mgd on mgd.menu_id=menu.menu_id
                        LEFT JOIN user_priviliges up on up.menu_id=menu.menu_id
                        LEFT JOIN menu_group mg on mg.menu_group_id=mgd.menu_group_id  or mg.menu_group_id=up.menu_group_id
                        LEFT JOIN login_rights_group lrg on lrg.menu_group_id=mg.menu_group_id
                        where lrg.login_rights_group_id=$login_rights_group_id AND menu.status=1 
                        AND menu_name LIKE '%$menu%' 
                        ORDER BY menu.menu_id";
        $result = $query = $this->db->query($query);
        if ($result) {
            return $result->result();
        } else {
            return array();
        }
    }

    function fetch_menu_by_id($id,$setting_menu)
    {
        if(isset($setting_menu[0]) && !empty($setting_menu[0])){
            $where = "menu.menu_id IN ($id) OR menu.parent_id IN ($id) OR menu.menu_id=$setting_menu[0]";
        }else{
            $where ="menu.menu_id IN ($id) OR menu.parent_id IN ($id)";
        }
        $query = "SELECT menu.*,mg.menu_group_id,lrg.login_rights_group_id from menu
                        LEFT JOIN menu_group_detail mgd on mgd.menu_id=menu.menu_id
                        LEFT JOIN user_priviliges up on up.menu_id=menu.menu_id
                        LEFT JOIN menu_group mg on mg.menu_group_id=mgd.menu_group_id  or mg.menu_group_id=up.menu_group_id
                        LEFT JOIN login_rights_group lrg on lrg.menu_group_id=mg.menu_group_id
                        WHERE $where
                        GROUP BY menu.menu_id
                        ORDER BY menu.menu_id";
        $result = $query = $this->db->query($query);
        if ($result) {
            return $result->result();
        } else {
            return array();
        }
    }
}

?>