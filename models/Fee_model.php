<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
Class Fee_model extends CI_Model {

    public function get_batch_students($batch_id) {
        $result = $this->db->select('students.*')
                    ->from('students')
                    ->where('batch_no',$batch_id)
                    ->order_by('first_name')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function add_payment($data) {
        if(isset($data['payment_id'])&&(!empty($data['payment_id'])) ){
            $payment_id = $data['payment_id'];
            $update_data = array(
                                'batch_id'=>$data['batch_id'],
                                'student_id'=>$data['student_id'],
                                'title'=>$data['title'],
                                'description'=>$data['description'],
                                'date'=>$data['date'],
                                'amount'=>$data['amount'],
                                'amount_paid'=>$data['amount_paid'],
                                'status'=>$data['status'],
                                'fee_type_id'=>$data['fee_type_id'],
                            );
            $this->db->where('id', $data['payment_id'])->update('student_fee', $update_data);
            return $this->db->affected_rows();
        }else{
            //unset($data['payment_id']);
            $this->db->insert('student_fee', $data);
            return $this->db->insert_id();
        }

    }

    public function get_payments(){
        $user_data = $this->session->userdata('userdata');
        $user_name = $user_data['name'];
        $query = $this->db->select('*')->from('students')->where('username',$user_name)->limit(1)->get();
        $result = $query->row_array();
        $student_id = $result['student_id'];

        $gquery = $this->db->select('s.student_id')->from('guardians')
                ->join('student_guardians sg','sg.guardian_id = guardians.guardian_id','left')
                ->join('students s','sg.student_id = s.student_id','left')
                ->where('guardians.username',$user_name)->get();
        $guardian_result = $gquery->result_array();
        $student_ids = array();
        foreach ($guardian_result as $r){

            $student_ids[] = $r['student_id'];
        }
        $student_ids = implode(',', $student_ids);

        $this->db->select('sf.*,sf.id as student_fee_id,s.first_name,s.last_name,b.*,c.code,fee_type.name as fee_type');
        $this->db->from('student_fee sf');
        $this->db->join('students s', 's.student_id=sf.student_id', 'left');
        $this->db->join('batches b', 'b.id=s.batch_no', 'left');
        $this->db->join('classes c', 'c.id=b.course_id', 'left');
        $this->db->join('fee_type', 'fee_type.id=sf.fee_type_id', 'left');
        if($query->num_rows()>0){
            $this->db->where('sf.student_id',$student_id);
        }
        if($gquery->num_rows()>0){
            $this->db->where("sf.student_id IN ($student_ids)");
        }
        $result = $this->db->get();
        //echo $this->db->last_query();
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_fees(){
        $result = $this->db->select('fee_type.*')
                    ->from('fee_type')
                    ->get();

        if($result){
            return $result->result_array();
        } else {
            return array();
        }

    }


    public function delete_income($id) {
        $this->db->where('id', $id)->delete('student_fee');
        return $this->db->affected_rows();
    }

    public function get_student_fee_status($form_data){
        if(!empty($form_data['batch_no'])){
            $batch_no = $form_data['batch_no'];
        }else{
            $batch_no = 0;
        }
        if(!empty($form_data['fee_from']) && !empty($form_data['fee_to'])){
            $fee_from = $form_data['fee_from'];
            $fee_to = $form_data['fee_to'];
        }else{
            $fee_from = 0;
            $fee_to = 0;

        }
        if(!empty($form_data['fee_status'])){
            $fee_status = $form_data['fee_status'];
        }else{
            $fee_status = 0;
        }
        if(!empty($form_data['fee_paid_filter']) && !empty($form_data['fee_paid'])){
            $fee_paid = $form_data['fee_paid'];
            $fee_paid_filter = $form_data['fee_paid_filter']=='greater'?'>':'<';
        }else{
            $fee_paid = 0;
            $fee_paid_filter = '=';
        }

       $query = "SELECT sf.*, sf.id as student_fee_id, s.first_name, s.last_name, b.*, c.code, fee_type.name as fee_type
                    FROM students s
                    LEFT JOIN student_fee sf ON s.student_id=sf.student_id
                    LEFT JOIN batches b ON b.id=s.batch_no
                    LEFT JOIN classes c ON c.id=b.course_id
                    LEFT JOIN fee_type ON fee_type.id=sf.fee_type_id
                    WHERE 1 
                    AND($batch_no = 0 OR s.batch_no = '$batch_no') 
                    AND ($fee_from = 0  OR sf.date BETWEEN '$fee_from' AND '$fee_to')
                    AND($fee_status = 0 OR CASE WHEN $fee_status = 3  THEN sf.status IS NULL
                                            ELSE sf.status = '$fee_status' END)
                    AND($fee_paid = 0 OR sf.amount_paid $fee_paid_filter $fee_paid)
                  ";

        $result = $this->db->query($query);
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_fee_status(){
        $result = $this->db->select('*')
                    ->from('fee_status')
                    ->get();

        if($result){
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function create_fee($data) {
        if(isset($data['payment_id'])&&(!empty($data['payment_id'])) ){
            $payment_id = $data['payment_id'];
            $update_data = array(
                'batch_id'=>$data['batch_id'],
                'description'=>$data['description'],
                'start_date'=>date('y-m-d',strtotime($data['start_date'])),
                'due_date'=>date('y-m-d',strtotime($data['due_date'])),
                'amount'=>$data['amount'],
                'fee_type_id'=>$data['fee_type_id'],
            );
            $this->db->where('id', $data['payment_id'])->update('fee_management', $update_data);
            return $this->db->affected_rows();
        }else{

            $batch_id = $data['batch_id'];
            $result = $this->db->select('*')->from('students')->where('batch_no',$batch_id)->get();
            $batch_students = $result->result_array();


            unset($data['created_by']);
            $this->db->insert('fee_management', $data);
            $fee_mangement_id =  $this->db->insert_id();


            //create discount for batch student
            if(!$result){
                foreach ($batch_students as $student){
                    $this->db->insert('student_discount', array('student_id',$student['student_id'],
                        'batch_id'=>$student['batch_no'],'assign'=>1,'fee_management_id'=>$fee_mangement_id));
                }
            }
            return $fee_mangement_id;
        }

    }

    public function get_all_fee() {
        $result = $this->db->select('fm.*, ft.name as fee_name,b.arm,b.session,c.code')
                    ->from('fee_management fm')
                    ->join('fee_type ft','ft.id=fm.fee_type_id','left')
                    ->join('batches b','b.id=fm.batch_id','left')
                    ->join('classes c', 'c.id=b.course_id', 'left')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

}