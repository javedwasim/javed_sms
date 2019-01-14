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

       $query ="SELECT sf.*, sf.id as student_fee_id, s.first_name, s.last_name,
                fm.b_id,fm.arm,fm.course_id,fm.session, fm.code,
                fee_type.name as fee_type,fm.fee_due_amount,fm.student_paid_fee
                FROM students s 
                LEFT JOIN student_fee sf ON s.student_id=sf.student_id 
                LEFT JOIN fee_type ON fee_type.id=sf.fee_type_id 
                LEFT JOIN(
                    SELECT fm.amount as fee_due_amount,SUM(sf.amount) as 	student_paid_fee,sf.student_id,sf.fee_management_id,fm.id,fm.batch_id,c.code,
                    b.id as b_id,b.arm,b.course_id,b.session
                    FROM fee_management fm
                    LEFT JOIN student_fee sf ON sf.fee_management_id = fm.id
                    LEFT JOIN batches b ON b.id=fm.batch_id 
                    LEFT JOIN classes c ON c.id=b.course_id 
                    WHERE  sf.student_id IS NOT NULL
                    GROUP BY sf.student_id,sf.fee_management_id
                
                )fm ON fm.student_id = sf.student_id and fm.id = sf.fee_management_id
                WHERE 1 AND sf.id IS NOT NULL
                AND($batch_no = 0 OR s.batch_no = '$batch_no') 
                AND ($fee_from = 0  OR sf.date BETWEEN '$fee_from' AND '$fee_to')
                AND($fee_status = 0 OR CASE WHEN $fee_status = 3  THEN sf.status IS NULL ELSE sf.status = '$fee_status' END)
                AND($fee_paid = 0 OR sf.amount $fee_paid_filter $fee_paid)
                ORDER BY `sf`.`id` ASC ";

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

    public function get_all_fee($filter) {
        $balance_filter = '>';
        if(!empty($filter['fee_type'])){
            $fee_type = $filter['fee_type'];
        }else{
            $fee_type = 0;
        }
        if(!empty($filter['due_balance'])){
            $due_balance = $filter['due_balance'];
            $balance_filter = $filter['balance_filter']=='greater'?'>':'<';
        }else{
            $due_balance = 0;

        }
        if(!empty($filter['fee_status'])){
            $fee_status = $filter['fee_status'];
        }else{
            $fee_status = 0;
        }
        if(!empty($filter['due_date'])){
            $due_date = $filter['due_date'];
        }else{
            $due_date = 0;
        }
        if(!empty($filter['start_date'])){
            $start_date = $filter['start_date'];
        }else{
            $start_date = 0;
        }
        $query = "SELECT fm.*, ft.name as fee_name, b.arm, b.session, c.code
                    FROM fee_management fm
                    LEFT JOIN fee_type ft ON ft.id=fm.fee_type_id
                    LEFT JOIN batches b ON b.id=fm.batch_id
                    LEFT JOIN classes c ON c.id=b.course_id
                    WHERE 1 
                    AND($fee_type = 0 OR fm.fee_type_id = $fee_type)
                    AND($due_balance = 0 OR fm.amount $balance_filter= $due_balance)
                    AND($fee_status = 0 OR fm.status = $fee_status) 
                    AND($due_date = 0 OR fm.due_date = '$due_date')
                    AND($start_date = 0 OR fm.start_date = '$start_date')";
        //echo $this->db->last_query();
        $result = $this->db->query($query);
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function delete_fee_group($id) {
        $this->db->where('id', $id)->delete('fee_management');
        return $this->db->affected_rows();
    }

    public function get_fee_group_by_id($id) {
        $result = $this->db->select('fm.*')
                    ->from('fee_management fm')
                    ->where('fm.id',$id)
                    ->limit(1)
                    ->get();
        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }

    }

    public function update_fee_group($data){
        $id = $data['fee_group_id'];
        unset($data['fee_group_id']);
        unset($data['created_by']);
        $this->db->where('id', $id)->update('fee_management', $data);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

}