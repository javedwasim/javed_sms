<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportcard extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->model('Reportcard_model');
        $this->load->model('Batches_model');
        $this->load->model('General_model');
        $this->load->model('Attendance_model');
        $this->load->helper('content-type');
        $this -> load -> library('form_validation');

    }

    public function report_card()
    {
        $record['student'] = $this->Student_model->logged_user_info();
        $record['class_set'] = $this->Reportcard_model->get_class_set();
        $record['reports'] = $this->Reportcard_model->get_report_card_group();
        $record['report'] = '';
        $json['result_html'] = $this->load->view('reports/list', $record, true);
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function save()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('name', 'Group Name', 'required|xss_clean');
        $this->form_validation->set_rules('course_set_id', 'Class Set', 'required|xss_clean');
        $this->form_validation->set_rules('report_card_group_for', 'Report Group For', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            $json['message'] = validation_errors();
        } else {
            $data = $this->input->post();
            if(isset($data['report_id'])){
                $result = $this->Reportcard_model->update_report_card_group($data);
            }else{
                $result = $this->Reportcard_model->save_report_card_group($data);
            }
            if ($result) {
                $json['success'] = true;
                $json['message'] = "Report card group save successfully.";
            } else {
                $json['error'] = true;
                $json['message'] = "Seem to be an error.";
            }
            $record['batches'] = $this->Batches_model->get_all_batches();
            $record['reports'] = $this->Reportcard_model->get_report_card_group();
            $json['result_html'] = $this->load->view('reports/list', $record, true);
        }
        if ($this->input->is_ajax_request()) {
            set_content_type($json);

        }
    }

    public function edit($id)
    {
        $record['class_set'] = $this->Reportcard_model->get_class_set();
        $record['report'] = $this->Reportcard_model->get_report_card_group_bY_id($id);
        $json['result_html'] = $this->load->view('reports/edit', $record, true);
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function delete($id)
    {
        $result = $this->Reportcard_model->delete_report_card_group($id);
        if ($result) {
            $json['error'] = true;
            $json['message'] = "Report Card Group successfully deleted.";
        } else {
            $json['error'] = true;
            $json['message'] = "Seems to an error.";
        }
        $record['batches'] = $this->Batches_model->get_all_batches();
        $record['reports'] = $this->Reportcard_model->get_report_card_group();
        $json['result_html'] = $this->load->view('reports/list', $record, true);
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function get_class_set_student(){
        $data = $this->input->post();
        $class_set_id = $data['class_set_id'];
        if($data['term_id']=='first_term'){
            $term_id = 1;
        }elseif($data['term_id']=='second_term'){
            $term_id = 2;
        }elseif($data['term_id']=='third_term'){
            $term_id = 3;
        }
        $result = $this->Reportcard_model->get_class_set_student($class_set_id);
        if ($result) {
            $record['students'] = $result['students'];
            $record['batch'] = $result['batch'];
            $record['term_id'] = $term_id;
            $json['result_html'] = $this->load->view('reports/student_report', $record, true);
        } else {
            $json['error'] = true;
            $json['message'] = "Seems to an error.";
        }
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }

    }

    public function get_student_subjects_report(){
        $data = $this->input->post();
        $student_id = $data['student_id'];
        $term_id = $data['term_id'];
        $result = $this->Reportcard_model->get_batch_subjects($student_id,$term_id);
        $score = $this->Reportcard_model->get_bahaviour_score_sheet($student_id,$term_id);
        $scale=$this->Batches_model->get_grade_scale_level(2);
        $student = $this->Student_model->get_student_by_id($student_id);
        $attendance = $this->Attendance_model->get_student_attendance_term_report($term_id,$student);
        $comment = $this->Reportcard_model->get_report_comment($student,$term_id);
        $record['class_teacher'] = $this->Reportcard_model->get_class_teacher($student);
        //print_r($record['class_teacher']);
        if($result){
            $record['subjects'] = $result;
            $record['student'] = $student;
            $record['behaviour_score'] = $score;
            $record['scale'] = $scale;
            $record['term_id'] = $term_id;
            $record['attendance_record'] = $attendance;
            $record['comment'] = $comment;
            $json['result_html'] = $this->load->view('reports/student_subjects_report', $record, true);
            $json['student_info'] = $this->load->view('reports/student_info', $record, true);
        }else{
            $json['error'] = true;
            $json['message'] = "Seems to an error.";
        }

        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }


    public function save_comment()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('comment', 'Group Name', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            $json['message'] = validation_errors();
        } else {
            $data = $this->input->post();
            $result = $this->Reportcard_model->save_report_comment($data);
            if ($result) {
                $json['success'] = true;
                $json['message'] = "Comment save successfully.";
                $json['result_html'] = $data['comment'];
                $json['comment_by'] = $data['commented_by'];
            } else {
                $json['error'] = true;
                $json['message'] = "Seem to be an error.";
            }
        }
        if ($this->input->is_ajax_request()) {
            set_content_type($json);

        }
    }

    public function createPdf()
    {
        $this->load->library('Pdf');
        $data = $this->input->post();
        $student_id = $data['student_id'];
        $term_id = $data['term_id'];
        $result = $this->Reportcard_model->get_batch_subjects($student_id,$term_id);
        $score = $this->Reportcard_model->get_bahaviour_score_sheet($student_id,$term_id);
        $scale=$this->Batches_model->get_grade_scale_level(2);
        $student = $this->Student_model->get_student_by_id($student_id);
        $attendance = $this->Attendance_model->get_student_attendance_term_report($term_id,$student);
        $comment = $this->Reportcard_model->get_report_comment($student,$term_id);
        $report_summary = $this->Reportcard_model->get_report_summary($student_id,$term_id);
        $record['class_teacher'] = $this->Reportcard_model->get_class_teacher($student);
        $institution = $this->General_model->get_institution();
        //print_r($record['class_teacher']);
        if($result){
            $record['subjects'] = $result;
            $record['student'] = $student;
            $record['behaviour_score'] = $score;
            $record['scale'] = $scale;
            $record['term_id'] = $term_id;
            $record['attendance_record'] = $attendance;
            $record['comment'] = $comment;
            $record['summary'] = $report_summary;
            $record['institution'] = $institution;
            $this->load->view('reports/pdf_report', $record);
        }else{
            $json['error'] = true;
            $json['message'] = "Seems to an error.";
        }

    }

    public function get_guardian_student(){
        $data = $this->input->post();
        $class_set_id = $data['class_set_id'];
        $user_name = $data['user_name'];
        if($data['term_id']=='first_term'){
            $term_id = 1;
        }elseif($data['term_id']=='second_term'){
            $term_id = 2;
        }elseif($data['term_id']=='third_term'){
            $term_id = 3;
        }
        $result = $this->Reportcard_model->get_guardian_student($class_set_id,$user_name);
        if ($result) {
            $record['students'] = $result['students'];
            $record['batch'] = $result['batch'];
            $record['term_id'] = $term_id;
            $json['result_html'] = $this->load->view('reports/student_report', $record, true);
        } else {
            $json['error'] = true;
            $json['message'] = "Seems to an error.";
        }
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }

    }

}
