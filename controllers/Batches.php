<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batches extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->model('Batches_model');
        $this->load->helper('content-type');

    }

    public function index(){
        $record['batches'] = $this->Batches_model->get_all_batches();
        $record['sessions'] = $this->Batches_model->get_all_sessions();
        $record['classes'] = $this->Batches_model->get_all_classes();
        $this->load->view('batches/index', $record);
    }

    public function batches()
    {
        $record['batches'] = $this->Batches_model->get_all_batches();
        $record['sessions'] = $this->Batches_model->get_all_sessions();
        $record['classes'] = $this->Batches_model->get_all_classes();
        $json['batch_html'] = $this->load->view('batches/list', $record, true);
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function save() {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('arm', 'arm', 'required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            $json['message'] = validation_errors();
        } else {
            $batch_data = $this->input->post();
            if(isset($batch_data['id']) && ($batch_data['id']>0)){
                $id = $batch_data['id'];
                $data = array('arm'=>$batch_data['arm'],'course_id'=>$batch_data['course_id']
                        ,'session'=>$batch_data['session']);
                $result = $this->Batches_model->update_batch($data,$id);
            }else{
                $result = $this->Batches_model->save_batch($batch_data);
            }

            if ($result) {
                $json['success'] = true;
                $json['message'] = "Batch save successfully ";
                $record['batches'] = $this->Batches_model->get_all_batches();
                $json['batch_html'] = $this->load->view('batches/list', $record, true);
            } else {
                $json['error'] = true;
                $json['message'] = "Seems to an error. Please try again.";
                $record['batches'] = $this->Batches_model->get_all_batches();
                $json['batch_html'] = $this->load->view('batches/list', $record, true);
            }
        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function edit($id){
        $record['batch'] = $this->Batches_model->get_batch_by_id($id);
        $record['sessions'] = $this->Batches_model->get_all_sessions();
        $record['classes'] = $this->Batches_model->get_all_classes();
        $json['batch_html'] = $this->load->view('batches/edit', $record, true);
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function delete($id){
        $result = $this->Batches_model->delete_batch($id);
        if ($result) {
            $json['success'] = true;
            $json['message'] = "Batch successfully deleted.";
            $record['batches'] = $this->Batches_model->get_all_batches();
            $json['batch_html'] = $this->load->view('batches/list', $record, true);

        } else {
            $json['error'] = true;
            $json['message'] = "Seems to an error";
            $record['batches'] = $this->Batches_model->get_all_batches();
            $json['batch_html'] = $this->load->view('batches/list', $record, true);
        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function demographics($id){
        $data['students']=$this->Batches_model->get_demographics($id);
        $data['employees']=$this->Batches_model->get_all_employees($id);
        $data['assigned_employee']=$this->Batches_model->get_assigned_employees($id);
        $data['batches']=$this->Batches_model->get_all_batches();
        $data['batch_id']=$id;;
        $data['screen'] = 'batch_students';
        $this->load->view('batches/demographics', $data);
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
            $result = $this->Batches_model->assign_new_employee($data);


            if($result) {
                $json['success'] = true;
                $json['message'] = "Employees assign  successfully!";
                $record['batches'] = $this->Batches_model->get_all_batches();
                $json['batch_html'] = $this->load->view('batches/list', $record, true);

            } else {
                $json['error'] = true;
                $json['message'] = "Seems to an error in assigning employee.";
                $record['batches'] = $this->Batches_model->get_all_batches();
                $json['batch_html'] = $this->load->view('batches/list', $record, true);
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



}