<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
Class Assessment_model extends CI_Model {

    public function get_assessments(){
        $result = $this->db->select('*')
                    ->from('assessment_categories')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }
    public function save_assessment_category($data){
        $this->db->insert('assessment_categories', $data);
        return $this->db->insert_id();
    }

    public function update_assessment_category($data, $id) {
        $this->db->where('id', $id)->update('assessment_categories', $data);
        return $this->db->affected_rows();
    }

    public function delete_assessment_category($id) {
        $this->db->where('id', $id)->delete('assessment_categories');
        return $this->db->affected_rows();
    }

    public function get_institute_banks(){
        $result = $this->db->select('*')
                    ->from('banks')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function add_bank_institution($data) {
        $this->db->insert('bank_accounts', $data);
        return $this->db->insert_id();
    }



    public function delete_institute_bank_account($id) {
        $this->db->where('id', $id)->delete('bank_accounts');
        return $this->db->affected_rows();
    }

    public function get_fees(){
        $result = $this->db->select('*')->from('fees')->get();
        if($result){
            return $result->result_array();
        }else{
            return array();
        }
    }

    public function add_fee($data){
        $this->db->insert('fees',$data);
        return $this->db->insert_id();
    }

    public function update_fee($data,$id){
        $this->db->where('id',$id)->update('fees',$data);
        return $this->db->affected_rows();
    }

    public function delete_fee($id) {
        $this->db->where('id', $id)->delete('fees');
        return $this->db->affected_rows();
    }

    public function get_payments(){
        $result = $this->db->select('*')->from('payments')->get();
        if($result){
            return $result->result_array();
        }else{
            return array();
        }
    }

    public function add_payment($data){
        $this->db->insert('payments',$data);
        return $this->db->insert_id();
    }

    public function update_payment($data,$id){
        $this->db->where('id',$id)->update('payments',$data);
        return $this->db->affected_rows();
    }

    public function delete_payment($id) {
        $this->db->where('id', $id)->delete('payments');
        return $this->db->affected_rows();
    }

}