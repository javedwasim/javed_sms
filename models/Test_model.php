<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model');
        $this->load->model('Batches_model');
    }

    public function get_subjects(){
        $result = $this->db->select('exam_subjects.*,classes.name as course_name')
                    ->from('exam_subjects')
                    ->join('classes','classes.id=exam_subjects.course_id','left')
                    ->get();

        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function get_subject_detail(){
        $result = $this->db->select('sd.*,subjects.name')
                    ->from('subjects_detail sd')
                    ->join('subjects','subjects.id = sd.subject_id','left')
                    ->join('batches','batches.id = sd.batch_id','left')
                    ->join('classes','classes.id = batches.course_id','left')
                    ->group_by('sd.subject_id')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_subject_details($id){
        $result = $this->db->select('sd.*,subjects.name')
            ->from('subjects_detail sd')
            ->join('subjects','subjects.id = sd.subject_id','left')
            ->join('batches','batches.id = sd.batch_id','left')
            ->join('classes','classes.id = batches.course_id','left')
            ->where("sd.subject_id IN ($id)")
            ->group_by('sd.subject_id')
            ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_course_subjects($filter){
        $result = $this->db->select('exam_subjects.*')
                    ->from('exam_subjects')
                    ->where('id',$filter['subject_id'])
                    ->where('course_id',$filter['course_id'])
                    ->limit(1)
                    ->get();

        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    public function get_subjects_by_course($id){
        $result = $this->db->select('exam_subjects.*')
                    ->from('exam_subjects')
                    ->where('course_id',$id)
                    ->get();

        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function get_classes(){
        $result = $this->db->select('*')
                    ->from('classes')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function add_exam_subjects($data) {
        $this->db->insert('exam_subjects', $data);
        return $this->db->insert_id();
    }

    public function save_exam_subjects($data) {
        $this->db->where('id', $data['subject_id'])->update('exam_subjects',
            array('course_id'=>$data['course_id'],'subject_name'=>$data['subject_name']));
        return $this->db->affected_rows();
    }

    public function update_exam($data) {
        $subject_detail = $this->get_subject_detail_by_id($data['subject_id']);
        $data['batch_no'] = $subject_detail['batch_id'];
        $data['course_id'] = $subject_detail['course_id'];
        $this->db->where('id', $data['exam_id'])
            ->update('examination',
                array(
                    'exam_name'=>$data['exam_name'],
                    'course_id'=>$data['course_id'],
                    'batch_no'=>$data['batch_no'],
                    'subject_id'=>$data['subject_id'],
                    'exam_date'=>$data['exam_date'],
                    'start_time'=>$data['start_time'],
                    'end_time'=>$data['end_time'],
                    'no_of_question'=>$data['no_of_question'],
                    'marks_per_question'=>$data['marks_per_question'],
                    'duration'=>$data['duration'],
                ));
        return $this->db->affected_rows();
    }

    public function delete_subject($id) {
        $this->db->where('id', $id)->delete('exam_subjects');
        return $this->db->affected_rows();
    }

    public function get_examination(){
        $userdata = $this->session->userdata('userdata');
        $user_name = $userdata['name'];
        $query = $this->db->select('*')->from('students')->where('username',$user_name)->limit(1)->get();
        if(($user_name == 'admin') || ($query->num_rows()==0)){
            $result = $this->db->select('examination.*,classes.name as class_name, subjects.name as subject_name')
                        ->from('examination')
                        ->join('classes','classes.id=examination.course_id','left')
                        ->join('subjects_detail sd','sd.id=examination.subject_id','left')
                        ->join('subjects','subjects.id=sd.subject_id','left')
                        ->get();
        }
        //student examination
        elseif($query->num_rows()>0){
            $student = $query->row_array();
            $result = $this->db->select('examination.*,classes.name as class_name, subjects.name as subject_name')
                        ->from('examination')
                        ->join('classes','classes.id=examination.course_id','left')
                        ->join('subjects_detail sd','sd.id=examination.subject_id','left')
                        ->join('subjects','subjects.id=sd.subject_id','left')
                        ->where('examination.batch_no',$student['batch_no'])
                        ->where('examination.exam_date',date("Y-m-d"))
                        ->get();
        }
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_class_teacher_exam(){
        $batch = $this->Batches_model->get_class_teacher_subject();
        $batch_no = $batch['batch_id'];
        $result = $this->db->select('examination.*,classes.name as class_name, subjects.name as subject_name')
                ->from('examination')
                ->join('classes','classes.id=examination.course_id','left')
                ->join('subjects_detail sd','sd.id=examination.subject_id','left')
                ->join('subjects','subjects.id=sd.subject_id','left')
                ->where("examination.batch_no IN ($batch_no)")
                ->where('examination.exam_date',date("Y-m-d"))
                ->get();
       // echo $this->db->last_query();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function get_subject_detail_by_id($id){
        $result = $this->db->select('sd.*,subjects.name,classes.id as course_id')
                    ->from('subjects_detail sd')
                    ->join('subjects','subjects.id = sd.subject_id','left')
                    ->join('batches','batches.id = sd.batch_id','left')
                    ->join('classes','classes.id = batches.course_id','left')
                    ->where('sd.id',$id)
                    ->limit(1)
                    ->get();

        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }


    public function add_exam($data) {
        $subject_detail = $this->get_subject_detail_by_id($data['subject_id']);
        $data['batch_no'] = $subject_detail['batch_id'];
        $data['course_id'] = $subject_detail['course_id'];
        $this->db->insert('examination', $data);
        return $this->db->insert_id();
    }

    public function get_exams($filter){
        $result = $this->db->select('examination.*')
                    ->from('examination')
                    ->where('id',$filter['exam_id'])
                    ->limit(1)
                    ->get();

        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    public function delete_exam($id) {
        $this->db->where('id', $id)->delete('examination');
        return $this->db->affected_rows();
    }

    public function add_exam_question($data) {
        $result = $this->db->select('examination.*')->from('examination')->where('id',$data['exam_id'])->limit(1)->get();
        $examination = $result->row_array();
        $total_questions = $examination['no_of_question'];

        $exam_question = $this->db->select('*')->from('exam_question')->where('exam_id',$data['exam_id'])->get();
        $exam_question_entered = $exam_question->num_rows();
        if($total_questions == $exam_question_entered){
            return false;
            exit();
        }

        if(isset($data['answer_option']) && !empty($data['answer_option'])){
            $this->db->insert('exam_question',array('exam_id'=>$data['exam_id'],'question'=>$data['question']));
            $question_id = $this->db->insert_id();
            for($j=0;$j<count($data['answer_option']);$j++){
                $this->db->insert('exam_question_options',
                    array(
                        'exam_question_id'=>$question_id,
                        'answer_option'=>$data['answer_option'][$j],
                        'correct_ans'=>($j+1 == $data['correct_ans'])?$data['correct_ans']:'',
                    ));
            }
        }
        return $this->db->insert_id();
    }

    public function get_exam_questions(){
        $query = "SELECT exam_question.* ,q_option.answer_options,q_option.correct_answer,q_option.correct_answer_value,
                    examination.exam_name
                    FROM exam_question 
                    LEFT JOIN(
                        SELECT exam_question_options.*,GROUP_CONCAT(answer_option) as answer_options,
                        GROUP_CONCAT(CONCAT(answer_option,'-',correct_ans)) as correct_answer,
                        GROUP_CONCAT(CASE WHEN correct_ans>0 THEN answer_option END)  as correct_answer_value
                        FROM exam_question_options
                        GROUP BY exam_question_options.exam_question_id                    
                    )q_option ON q_option.exam_question_id = exam_question.id
                    LEFT JOIN examination on examination.id = exam_question.exam_id                    
                    ";
        $result = $query = $this->db->query($query);
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_exam_question($id){
        $query = "SELECT exam_question.* ,q_option.answer_options,q_option.correct_answer,q_option.correct_answer_value,
                    examination.exam_name,q_option.correct_answer_id
                    FROM exam_question 
                    LEFT JOIN(
                        SELECT exam_question_options.*,GROUP_CONCAT(answer_option) as answer_options,
                        GROUP_CONCAT(CONCAT(answer_option,'-',correct_ans)) as correct_answer,
                        GROUP_CONCAT(CASE WHEN correct_ans>0 THEN answer_option END)  as correct_answer_value,
                        GROUP_CONCAT(CASE WHEN correct_ans>0 THEN exam_question_options.correct_ans END)  as correct_answer_id
                        FROM exam_question_options
                        GROUP BY exam_question_options.exam_question_id                    
                    )q_option ON q_option.exam_question_id = exam_question.id
                    LEFT JOIN examination on examination.id = exam_question.exam_id
                    WHERE exam_question.id = $id limit 1";
        $result = $query = $this->db->query($query);
        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    public function update_exam_question($data) {
        $this->db->where('id', $data['question_id'])->update('exam_question',
                array(
                    'exam_id'=>$data['exam_id'],
                    'question'=>$data['question'],
                ));

        $this->db->where('exam_question_id', $data['question_id'])->delete('exam_question_options');

        for($j=0;$j<count($data['answer_option']);$j++){
            $this->db->insert('exam_question_options',
                array(
                    'exam_question_id'=>$data['question_id'],
                    'answer_option'=>$data['answer_option'][$j],
                    'correct_ans'=>($j+1 == $data['correct_ans'])?$data['correct_ans']:'',
                ));
        }
        return $this->db->affected_rows();
    }

    public function delete_exam_question($id) {
        $this->db->where('id', $id)->delete('exam_question');
        $this->db->where('exam_question_id', $id)->delete('exam_question_options');
        return $this->db->affected_rows();
    }

    public function get_student_exam($exam_id){
         $query = "SELECT exam_question.* ,q_option.answer_options,q_option.correct_answer,q_option.correct_answer_value,
                    examination.exam_name,q_option.correct_answer_id
                    FROM exam_question 
                    LEFT JOIN(
                        SELECT exam_question_options.*,GROUP_CONCAT(answer_option ORDER BY exam_question_options.id ASC) as answer_options,
                        GROUP_CONCAT(CONCAT(answer_option,'-',correct_ans)) as correct_answer,
                        GROUP_CONCAT(CASE WHEN correct_ans>0 THEN answer_option END)  as correct_answer_value,
                        GROUP_CONCAT(CASE WHEN correct_ans>0 THEN exam_question_options.correct_ans END)  as correct_answer_id
                        FROM exam_question_options
                        GROUP BY exam_question_options.exam_question_id                    
                    )q_option ON q_option.exam_question_id = exam_question.id
                    LEFT JOIN examination on examination.id = exam_question.exam_id
                    WHERE exam_question.exam_id = $exam_id";
        $result = $query = $this->db->query($query);
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function save_student_exam($data){
        $student_id = $data['student_id'];
        $total_questions = $data['total_questions'];
        $exam_id = $data['exam_id'];

        $this->db->insert('student_exam',
        array(
            'student_id'=>$student_id,
            'exam_id'=>$exam_id,
            'total_questions'=>$total_questions,
        ));
        $student_exam_id = $this->db->insert_id();

        unset($data['student_id']);
        unset($data['exam_id']);
        unset($data['total_questions']);
        foreach ($data as $key=>$value){
           $this->db->insert('student_exam_option',
           array(
               'question_id'=>$key,
               'student_option'=>$value,
               'student_exam_id'=>$student_exam_id,
           ));
        }
    }

    public function get_student_test($data){
        $student_id = $data['student_id'];
        $exam_id = $data['exam_id'];
        $result = $this->db->select('student_exam.*')
                    ->from('student_exam')
                    ->where('student_id',$student_id)
                    ->where('exam_id',$exam_id)
                    ->limit(1)
                    ->get();

        if($result->num_rows() == 0){
            return true;
        } else {
            return false;
        }

    }
    public function get_student_result($student_id,$exam_id){
        $query = "SELECT se.*,seq.question_id,seq.student_option,eq.question,eqo.correct_answer_id,examination.exam_name,students.first_name,students.last_name 
                    FROM student_exam se
                    LEFT JOIN student_exam_option seq  ON seq.student_exam_id = se.id
                    LEFT JOIN exam_question eq ON eq.id = seq.question_id
                    LEFT JOIN examination on examination.id = se.exam_id
                    LEFT JOIN students on students.student_id = se.student_id
                    LEFT JOIN(
                        SELECT exam_question_options.*,
                        GROUP_CONCAT(CASE WHEN correct_ans>0 THEN answer_option END)  as correct_answer_value,
                        GROUP_CONCAT(CASE WHEN correct_ans>0 THEN exam_question_options.correct_ans END)  as correct_answer_id
                        FROM exam_question_options
                        GROUP BY exam_question_options.exam_question_id 
                    )eqo on eqo.exam_question_id = eq.id
                    WHERE se.student_id = $student_id AND se.exam_id = $exam_id";
        $result = $query = $this->db->query($query);
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_all_students(){
        $result = $this->db->select('*')
                    ->from('students')
                    ->get();

        if($result){
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function create_payment($chargeJson,$data){

        $amount = $chargeJson['amount'];
        $balance_transaction = $chargeJson['balance_transaction'];
        $currency = $chargeJson['currency'];
        $status = $chargeJson['status'];
        //insert tansaction data into the database
        $dataDB = array(
            'student_id' => $data['student_id'],
            'email' => $data['email'],
            'card_num' => $data['card_num'],
            'card_cvc' => $data['cvc'],
            'card_exp_month' => $data['exp_month'],
            'card_exp_year' => $data['exp_year'],
            'item_price' => $data['amount_paid'],
            'item_price_currency' => $currency,
            'paid_amount' => $amount,
            'paid_amount_currency' => $currency,
            'txn_id' => $balance_transaction,
            'payment_status' => $status,
        );

        $this->db->insert('orders', $dataDB);
        $order_id = $this->db->insert_id();

        $fee_data = array(
            'batch_id'=>$data['batch_id'],
            'student_id'=>$data['student_id'],
            'title'=>$data['title'],
            'description'=>$data['description'],
            'date'=>$data['date'],
            'amount'=>$data['amount'],
            'amount_paid'=>$data['amount_paid'],
            'status'=>$data['status'],
            'method'=>$data['method'],
            'fee_type_id'=>$data['fee_type_id'],
        );
        $this->db->insert('student_fee', $fee_data);
        $student_fee = $this->db->insert_id();
        return array('order_id'=>$order_id,'student_fee'=>$student_fee);

    }

    public function get_logged_student(){
        $userdata = $this->session->userdata('userdata');
        $user_name = $userdata['name'];
        $result = $this->db->select('*')->from('students')->where('username',$user_name)->limit(1)->get();
        if($result){
            return $result->row_array();
        } else {
            return array();
        }

    }

    public function get_batch_students($batch_no){
        $result = $this->db->select('*')
                    ->from('students')
                    ->where('batch_no',$batch_no)
                    ->get();

        if($result){
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function get_teacher_exam_id(){
        $batch = $this->Batches_model->get_class_teacher_subject();
        $batch_id = $batch['batch_id'];
        $result = $this->db->select('examination.*,GROUP_CONCAT(examination.id) as exam_id,
                    classes.name as class_name, subjects.name as subject_name')
                    ->from('examination')
                    ->join('classes','classes.id=examination.course_id','left')
                    ->join('subjects_detail sd','sd.id=examination.subject_id','left')
                    ->join('subjects','subjects.id=sd.subject_id','left')
                    ->where("examination.batch_no IN ($batch_id)")
                    ->where('examination.exam_date',date("Y-m-d"))
                    ->get();
        //echo $this->db->last_query();
        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }

    }

    public function get_teacher_exam_questions($exam_id){
        $query = "SELECT exam_question.* ,q_option.answer_options,q_option.correct_answer,q_option.correct_answer_value,
                    examination.exam_name
                    FROM exam_question 
                    LEFT JOIN(
                        SELECT exam_question_options.*,GROUP_CONCAT(answer_option) as answer_options,
                        GROUP_CONCAT(CONCAT(answer_option,'-',correct_ans)) as correct_answer,
                        GROUP_CONCAT(CASE WHEN correct_ans>0 THEN answer_option END)  as correct_answer_value
                        FROM exam_question_options
                        GROUP BY exam_question_options.exam_question_id                    
                    )q_option ON q_option.exam_question_id = exam_question.id
                    LEFT JOIN examination on examination.id = exam_question.exam_id   
                    WHERE exam_id IN ($exam_id) 
                    ";
        $result = $query = $this->db->query($query);
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

}

?>