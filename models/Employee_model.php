<?php
    if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class Employee_model extends CI_Model
    {
        
        function __construct()
        {
            parent::__construct();
        }

        public function get_all_employees() {
            $result = $this->db->select('*')
                ->from('employees')
                ->get();
            if($result) {
                return $result->result_array();
            } else {
                return array();
            }
        }

        public function get_all_conutries() {
            $result = $this->db->select('*')
                            ->from('countries_list')
                            ->get();
            if ($result) {
                return $result->result_array();
            } else {
                return array();
            }
        
        }

        public function add_new_employee($data) {
            $this->db->insert('employees', $data);
            return $this->db->insert_id();
        }

        public function get_employee_by_id($id) {
            $result = $this->db->select('*')
                ->from('employees')
                ->where('employee_id', $id)
                ->limit(1)
                ->get();
            if ($result) {
                return $result->row_array();
            } else {
                return array();
            }
        }

        public function update_employee($data, $id) {
            $this->db->where('employee_id', $id)->update('employees', $data);
            return $this->db->affected_rows();
        }


         public function update_employee_form_fields($data){
            $update_data = array();
            $employee_fields = $this->get_form_fields(3);
            foreach ($data as $key=>$value){
                $update_data[] = $key;
            }
 
            foreach ($employee_fields as $field){
                if(array_search($field['field_name'],$update_data)){
                    $this->db->where('field_name', $field['field_name'])->where('profile_setting_id', 3)->update('profile_group_detail', array('add_view'=>1));
                }else{
                    $this->db->where('field_name', $field['field_name'])->where('profile_setting_id', 3)->update('profile_group_detail', array('add_view'=>0));
                }
            }
            return $this->db->affected_rows();
        }

        public function get_form_fields($id) {
            $result = $this->db->select('*')
                        ->from('profile_group_detail')
                        ->where('profile_setting_id',$id)
                        ->get();
            if ($result) {
                return $result->result_array();
            } else {
                return array();
            }
        
        }

        public function get_employee_categories() {
        $result = $this->db->select('*')
            ->from('employee_categories')
            ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function add_employee_category($data) {
        $this->db->insert('employee_categories', $data);
        return $this->db->insert_id();
    }
    public function update_category($data, $id) {
        $this->db->where('id', $id)->update('employee_categories', array('category'=>$data));
        return $this->db->affected_rows();
    }
    public function delete_employee_category($id) {
        $this->db->where('id', $id)->delete('employee_categories');
        return $this->db->affected_rows();
    }
    public function get_employee_departments() {
        $result = $this->db->select('*')
            ->from('departments')
            ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

        public function add_employee_department($data) {
        $this->db->insert('departments', $data);
        return $this->db->insert_id();
    }
    public function update_department($data, $id) {
        $this->db->where('id', $id)->update('departments', $data);
        return $this->db->affected_rows();
    }
    public function delete_employee_department($id) {
        $this->db->where('id', $id)->delete('departments');
        return $this->db->affected_rows();
    }
    public function get_employee_positions() {
        $result = $this->db->select('*')
            ->from('positions')
            ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }
    public function add_employee_position($data) {
        $this->db->insert('positions', $data);
        return $this->db->insert_id();
    }
    public function update_position($data, $id) {
        $this->db->where('id', $id)->update('positions', $data);
        return $this->db->affected_rows();
    }
    public function delete_employee_position($id) {
        $this->db->where('id', $id)->delete('positions');
        return $this->db->affected_rows();
    }
        
    }


?>