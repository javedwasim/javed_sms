<?php

class Dashboard_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        

    }

    function index()
    {

        
        
    }

    public function get_user_by_email($email)
    {
        $result = $this->db->select("*")
                ->from("login")
                ->where("email", $email)
                ->get();
        if($result) {
            return $result->row_array();
        }else{

            $result = $this->db->select("*")
                        ->from("login")
                        ->where("name", $email)
                        ->get();
            return $result->row_array();
        }
    }

    public function dasboard_menus(){
        $query = $this->db->select("*")
                ->from("menu")
                ->get();
        $result = $query->result();
        return $result;

    }






}

?>