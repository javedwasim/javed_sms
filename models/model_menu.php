<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class model_menu extends CI_Model
{

    function fetch_menu()
    {

        $this->db->select("*");
        $this->db->from("menu");
        $q = $this->db->get();
        $result = $q->result();
        return $result;
    }
}

?>