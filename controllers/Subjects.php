<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subjects extends MY_Controller
{
    protected $user_name;
    function __construct() {
        parent::__construct();

        $this->load->model('Subject_model');
        $this->load->model('Student_model');
        $this->load->model('Batches_model');
        $this->load->helper('content-type');
        $user_data = $this->session->userdata('userdata');
        $this->user_name = $user_data['name'];
    }

    public function index(){
        $record['batches'] = $this->Subject_model->get_all_batches();
        $record['groups'] = $this->Subject_model->get_elective_group();
        $record['classes'] = $this->Subject_model->get_all_classes();
        $this->load->view('batches/index', $record);
    }

    public function subjects()
    {
        $detail = $this->Subject_model->get_subjects_detail();
        $record['elective_subjects'] = array();//$detail['elective_subjects'];
        $record['core_subjects'] = array(); //$detail['core_subjects'];
        $record['groups'] = $this->Subject_model->get_elective_group();
        $record['subjects'] = $this->Subject_model->get_all_subjects();
        $record['batches'] = $this->Subject_model->get_all_batches();
        $record['employees'] = $this->Subject_model->get_all_employees();
        $json['subject_html'] = $this->load->view('subjects/list', $record, true);
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function batch_subject()
    {
        $data = $this->input->post();
        $batch_no = $data['batch_no'];
        $detail = $this->Subject_model->get_batch_subject($batch_no);
        $record['elective_subjects'] = $detail['elective_subjects'];
        $record['core_subjects'] = $detail['core_subjects'];
        $record['groups'] = $this->Subject_model->get_elective_group();
        $record['subjects'] = $this->Subject_model->get_all_subjects();
        $record['batches'] = $this->Subject_model->get_all_batches();
        $record['employees'] = $this->Subject_model->get_all_employees();
        $record['batch_no'] = $data['batch_no'];
        $json['subject_html'] = $this->load->view('subjects/list', $record, true);
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function save_elective_group(){
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('name', 'group name', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            $json['message'] = validation_errors();
        } else {
            $subject = $this->input->post();
            $result = $this->Subject_model->save_elective_subject($subject);
            if ($result) {
                $json['success'] = true;
                $json['message'] = "Elective subject save successfully";
            } else {
                $json['error'] = true;
                $json['message'] = "Seems to an error.";
            }
        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function save() {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('subject_id', 'subject', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            $json['message'] = validation_errors();
        } else {
            $data = $this->input->post();
            if(isset($data['subject_detail_id'])){
                $update_data = array('subject_id'=>$data['subject_id'],'max_weekly_class'=>$data['max_weekly_class'],
                              'elective_group_id'=>$data['elective_group_id'],'batch_id'=>$data['batch_id']);
                $result = $this->Subject_model->update_subject($update_data,$data['subject_detail_id']);
            }else{
                $result = $this->Subject_model->save_subject($data);
            }
            if ($result) {
                $json['success'] = true;
                $json['message'] = "Subject save successfully ";
                $detail = $this->Subject_model->get_subjects_detail();
                $record['elective_subjects'] = $detail['elective_subjects'];
                $record['core_subjects'] = $detail['core_subjects'];
                $record['groups'] = $this->Subject_model->get_elective_group();
                $record['subjects'] = $this->Subject_model->get_all_subjects();
                $record['batches'] = $this->Subject_model->get_all_batches();
                $record['employees']=$this->Batches_model->get_all_employees();
                $json['subject_html'] = $this->load->view('subjects/list', $record, true);
            } else {
                $json['error'] = true;
                $json['message'] = "Seems to an error.";
                $detail = $this->Subject_model->get_subjects_detail();
                $record['elective_subjects'] = $detail['elective_subjects'];
                $record['core_subjects'] = $detail['core_subjects'];
                $record['groups'] = $this->Subject_model->get_elective_group();
                $record['subjects'] = $this->Subject_model->get_all_subjects();
                $record['batches'] = $this->Subject_model->get_all_batches();
                $record['employees']=$this->Batches_model->get_all_employees();
                $json['subject_html'] = $this->load->view('subjects/list', $record, true);
            }
        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function edit($id){
        $record['subject_detail'] = $this->Subject_model->get_subject_by_id($id);
        $detail = $this->Subject_model->get_subjects_detail();
        $record['elective_subjects'] = $detail['elective_subjects'];
        $record['core_subjects'] = $detail['core_subjects'];
        $record['groups'] = $this->Subject_model->get_elective_group();
        $record['subjects'] = $this->Subject_model->get_all_subjects();
        $record['batches'] = $this->Subject_model->get_all_batches();
        $record['employees']=$this->Batches_model->get_all_employees();
        $json['subject_html'] = $this->load->view('subjects/edit', $record, true);
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function edit_assessment($id){
        $record['subject_detail'] = $this->Subject_model->get_subject_by_id($id);
        $record['assessment'] = $this->Subject_model->get_subject_assessments_by_id($id);
        $record['categories']=$this->Subject_model->get_assessment_categories();
        $record['subject_assessment_id']=$id;
        $json['subject_html'] = $this->load->view('subjects/edit_assessment', $record, true);
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function delete($id){
        $result = $this->Subject_model->delete_subject($id);
        if ($result) {
            $json['success'] = true;
            $json['message'] = "Subject successfully deleted.";
            $detail = $this->Subject_model->get_subjects_detail();
            $record['elective_subjects'] = $detail['elective_subjects'];
            $record['core_subjects'] = $detail['core_subjects'];
            $record['groups'] = $this->Subject_model->get_elective_group();
            $record['subjects'] = $this->Subject_model->get_all_subjects();
            $record['batches'] = $this->Subject_model->get_all_batches();
            $record['employees']=$this->Batches_model->get_all_employees();
            $json['subject_html'] = $this->load->view('subjects/list', $record, true);

        } else {
            $json['error'] = true;
            $json['message'] = "Seems to an error in deleting subject.";
        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function subject_detail($id){
        $data['assessments']=$this->Subject_model->get_subject_assessments($id);
        $data['employees']=$this->Batches_model->get_all_employees();
        $data['assigned_employee']=$this->Batches_model->get_assigned_employees($id);
        $data['categories']=$this->Subject_model->get_assessment_categories();
        $result=$this->Subject_model->get_score_sheet($id);
        //echo "<pre>"; print_r($data['assessments']); die();
        $data['score_sheet']=$result;
        if(isset($result[0]['score_term'])){
            $data['score_term']=$result[0]['score_term'];
            $data['asses_id']=$result[0]['asses_id'];
        }else{
            $data['score_term'] = '';
            $data['asses_id'] = '';
        }

        if(isset($result[0]['score_points'])){
            $data['score_points'] = $result[0]['score_points'];
        }else{
            $data['score_points'] = '';
        }

        if(isset($result[0]['bacth_id'])){
            $batch_id = $result[0]['bacth_id'];
            $data['batch_info']=$this->Batches_model->get_all_batches_by_id($batch_id);
        }

        $data['subject_detail_id']=$id;
        $json['result_html']=$this->load->view('subjects/subject_detail',$data,true);
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }
    public function assign_employees(){

        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('employee[]', 'employee', 'required|xss_clean');
        $this->form_validation->set_rules('role[]', 'role', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            $json['message'] = validation_errors();
        }else{

            $data = $this->input->post();
            $result = $this->Subject_model->assign_new_employee($data);
            if($result) {
                $json['success'] = true;
                $json['message'] = "Employees assign  successfully!";
                $detail = $this->Subject_model->get_subjects_detail();
                $record['elective_subjects'] = $detail['elective_subjects'];
                $record['core_subjects'] = $detail['core_subjects'];
                $record['groups'] = $this->Subject_model->get_elective_group();
                $record['subjects'] = $this->Subject_model->get_all_subjects();
                $record['batches'] = $this->Subject_model->get_all_batches();
                $record['employees']=$this->Batches_model->get_all_employees();
                $json['batch_html'] = $this->load->view('subjects/list', $record, true);

            } else {
                $json['error'] = true;
                $json['message'] = "Seems to an error in assigning employee.";
                $detail = $this->Subject_model->get_subjects_detail();
                $record['elective_subjects'] = $detail['elective_subjects'];
                $record['core_subjects'] = $detail['core_subjects'];
                $record['groups'] = $this->Subject_model->get_elective_group();
                $record['subjects'] = $this->Subject_model->get_all_subjects();
                $record['batches'] = $this->Subject_model->get_all_batches();
                $record['employees']=$this->Batches_model->get_all_employees();
                $json['batch_html'] = $this->load->view('subjects/list', $record, true);
            }

        }

        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }


    }

    public function transfer_batch(){
        $this->load->library('form_validation');
        $this->load->helper('security');

        $this->form_validation->set_rules('ids', 'select student', 'required|xss_clean');
        $this->form_validation->set_rules('last_day_in_batch', 'Last day in batch', 'required|xss_clean');
        $this->form_validation->set_rules('reason_to_leave_batch', 'Reason to leave batch', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            $json['message'] = validation_errors();
        }else{

            $data = $this->input->post();
            $result = $this->Batches_model->transfer_student_batch($data);
            if($result) {
                $json['success'] = true;
                $json['message'] = "Student batch transfer successfully!";

            } else {
                $json['error'] = true;
                $json['message'] = "Seems to an error while transferring batch";
            }

        }

        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function assigned_employees($subj_detail_id){
        $data['assigned_employee']=$this->Subject_model->get_assigned_employees($subj_detail_id);
        $data['employees']=$this->Batches_model->get_all_employees();
        $data['subject_detail_id']=$subj_detail_id;
        $json['subject_html'] = $this->load->view('subjects/assigned_employee', $data, true);
        $json['success'] = true;
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function save_assessment(){
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('assessment_name', 'Name', 'required|xss_clean');
        $this->form_validation->set_rules('abbreviation', 'Abbreviation', 'required|xss_clean');
        $this->form_validation->set_rules('points', 'Possible points', 'required|xss_clean');
        $this->form_validation->set_rules('extra_points', 'Extra points', 'required|xss_clean');
        $this->form_validation->set_rules('due_date', 'Due date', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            $json['message'] = validation_errors();
        }else{
            $data = $this->input->post();
            if(isset($data['subject_detail_id'])&&(isset($data['subject_assessment_id']))){
                $id = $data['subject_assessment_id'];
                $update_fields = array(
                    'assessment_category_id'=>$data['assessment_category_id'],
                    'assessment_name'=>$data['assessment_name'],
                    'abbreviation'=>$data['abbreviation'],
                    'points'=>$data['points'],
                    'extra_points'=>$data['extra_points'],
                    'due_date'=>$data['due_date'],
                    'include_final_grade'=>isset($data['include_final_grade'])?$data['include_final_grade']:0,
                    'publish'=>$data['publish'],
                    'score_display_as'=>$data['score_display_as'],
                    'publish_score'=>isset($data['publish_score'])?$data['publish_score']:0,
                    'description'=>$data['description'],
                    'term_id'=>$data['term_id'],
                );
                $result = $this->Subject_model->update_subject_assessments($update_fields,$id);
            }else{
                $result = $this->Subject_model->save_subject_assessments($data);
            }

            if($result) {
                $json['success'] = true;
                $json['message'] = "Assessment save successfully!";
                $data['assessments']=$this->Subject_model->get_subject_assessments($data['subject_detail_id']);
                $json['subject_html'] = $this->load->view('subjects/subject_assessments', $data, true);
            } else {
                $json['error'] = true;
                $json['message'] = "Seems to an error while saving assessment.";
                $data['assessments']=$this->Subject_model->get_subject_assessments($data['subject_detail_id']);
                $json['subject_html'] = $this->load->view('subjects/subject_assessments', $data, true);
            }

        }

        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }

    }

    public function delete_assessment(){
        $data = $this->input->post();
        $id = $data['assessment_id'];
        $subject_detail_id = $data['subject_detail_id'];
        $result = $this->Subject_model->delete_subject_assessment($id);
        if ($result) {
            $json['success'] = true;
            $json['message'] = "Assessment successfully deleted.";
            $data['assessments']=$this->Subject_model->get_subject_assessments($subject_detail_id);
            $json['subject_html'] = $this->load->view('subjects/subject_assessments', $data, true);

        } else {
            $json['error'] = true;
            $json['message'] = "Seems to an error in deleting assessment.";
        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }


    public function update_publish_grade(){
        $data = $this->input->post();
        $result = $this->Subject_model->update_publish_grade($data);
        if($result){
            $json['success'] = true;
            $json['message'] = "Data save successfully!";
        }else{
            $json['error'] = true;
            $json['message'] = "Seem to be an error";
        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }

    }

    public function saveStudentScoreSheet(){
        $data = $this->input->post();  //print_r($data);
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('score', 'Score', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            $json['message'] = validation_errors();
        }elseif($data['score']>$data['points']){
            $json['error'] = true;
            $json['message'] = "Score must be less then or equal to assessment.";
        }else {
           $result =  $this->Subject_model->saveStudentScore($data);
            if($result){
                $json['success'] = true;
                $json['message'] = "Score save successfully!";
            }
        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function get_term_scores(){
        $data = $this->input->post(); //print_r($data);
        $id = $data['subject_detail_id'];
        $term_id = $data['term'];
        $data['assessments']=$this->Subject_model->get_subject_assessments($id);
        $data['employees']=$this->Batches_model->get_all_employees();
        $data['assigned_employee']=$this->Batches_model->get_assigned_employees($id);
        $data['categories']=$this->Subject_model->get_assessment_categories();
        $result=$this->Subject_model->get_term_score_sheet($id,$term_id);
        $data['score_sheet']=$result;
        if(isset($result[0]['score_term'])){
            $data['score_term']=$result[0]['score_term'];
            $data['asses_id']=$result[0]['asses_id'];
        }else{
            $data['score_term'] = '';
            $data['asses_id'] = '';
        }
        if(isset($result[0]['score_points'])){
            $data['score_points'] = $result[0]['score_points'];
        }else{
            $data['score_points'] = '';
        }
        $data['subject_detail_id']=$id;
        $json['result_html'] = $this->load->view('subjects/score_sheet', $data,true);
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function student_assessments(){
        $student = $this->Student_model->logged_user_info();
        if(!empty($student)){
            $student_id = $student['student_id'];
        }else{
            $student =  $this->Student_model->get_guardian_student();
            $student_id = $student['st_id'];
        }
        $filter = $this->input->post();
        $data['assessments']=$this->Subject_model->get_student_assessments($student_id,$filter);
        $data['subjects'] = $this->Subject_model->get_all_subjects();
        $data['academic_sessions'] = $this->Subject_model->get_all_sessions();
        $data['student'] = $student;
        $data['filter'] = $filter;
        $json['result_html'] = $this->load->view('subjects/assessment', $data,true);
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function student_subject_assessment(){
        $student = $this->Student_model->logged_user_info();
        if(!empty($student)){
            $student_id = $student['student_id'];
            $student =  $this->Student_model->get_student_by_id($student_id);
        }else{
            $student =  $this->Student_model->get_guardian_student();
            $student_id = $student['st_id'];
        }
        $filter = $this->input->post();
        $data['assessments']=$this->Subject_model->get_student_subject_assessments($student_id,$filter);
        $data['subjects'] = $this->Subject_model->get_all_subjects();
        $data['academic_sessions'] = $this->Subject_model->get_all_sessions();
        $data['student'] = $student;
        $data['filter'] = $filter;
        $json['result_html'] = $this->load->view('subjects/subject_assessment', $data,true);
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function add_subject_assessment_view(){
        $data['subject_detail_id'] = $this->input->post('sbj_detail_id');
        $data['categories']=$this->Subject_model->get_assessment_categories();
        $json['result_html'] = $this->load->view('subjects/subject_assessment_form', $data,true);
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }

    }
}