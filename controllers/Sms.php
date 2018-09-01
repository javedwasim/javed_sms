<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms extends CI_Controller
{

     public function __construct() {
        Parent::__construct();
        $this->load->model("Sms_model");
        $this->load->model("Calendar_model");
         $this->load->model('Batches_model');
         $this->load->model('Student_model');
         $this->load->model('Employee_model');
    }

     public function index()
     {
        $data['screen'] = 'calendar';
        $this->load->view("calendar/index", $data);
          
     }
     
     public function Calendar(){
        $data['classes'] = $this->Batches_model->get_all_classes();
        $json['calendar_html'] = $this->load->view('calendar/Calendar', $data, true);
        if($this->input->is_ajax_request()) {
          set_content_type($json);
        }
     } 
     
     public function sms(){
        $data['messages'] = $this->Sms_model->get_sms_list();
        $data['userdata'] = $this->session->userdata('userdata');
        $data['screen'] = 'sms';
        $json['sms_html'] = $this->load->view('sms/sms_list',$data , true);
        if($this->input->is_ajax_request()) {
          set_content_type($json);
        }
     }

    public function sms_view(){
        $data = $this->input->post();
        $id = $data['sms_id'];
        $data['sms_detail'] = $this->Sms_model->get_sms_detail($id);
        $json['sms_html'] = $this->load->view('sms/view',$data, true);
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }
     
     public function add_sms(){
        $json['sms_html'] = $this->load->view('sms/add_sms', '', true);
        if($this->input->is_ajax_request()) {
          set_content_type($json);
        }
     }


    public function send_sms(){
        $this->load->library('form_validation');
        $this->load->helper('security');
        //rules for required fields e.g email should be unique
        $this->form_validation->set_rules('sender_name', 'Sender Name', 'required|xss_clean');
        $this->form_validation->set_rules('recipients[]', 'Message Recipients', 'required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $json['sms_html'] = $this->load->view('sms/add_sms','', true);
            $json['message'] = validation_errors();
        }else{
            $form_data = $this->input->post();
            $user_data = $this->session->userdata('userdata');
            if($user_data['name'] == 'admin'){
                $created_by = 'admin';
            }else{
                $result =  $this->db->select('*')->from('employees')->where('username',$user_data['name'])->limit(1)->get();
                $employee = $result->row_array();
                $created_by = $employee['first_name']. ' '. $employee['middle_name'];
            }
            $sms_data = array('sender_name'=>$form_data['sender_name'],'message'=>$form_data['message'],'created_by'=>$created_by);
            $result = $this->Sms_model->add_sms($sms_data,$form_data['recipients']);

            if($result){
                $data['messages'] = $this->Sms_model->get_sms_list();
                $json['sms_html'] = $this->load->view('sms/sms_list',$data , true);
                $json['success'] = true;
                $json['message'] = "Message send successfully!";
            }else{
                $json['error'] = true;
                $json['message'] = "Please select user to send message.";
            }
        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
        
    }
    public function edit_view($id){
        $data['event'] = $this->Calendar_model->get_eventby_id($id);
        $data['classes'] = $this->Batches_model->get_all_classes();
        $data['categories'] = $this->Student_model->get_all_student_categories();
        $data['ecategories'] = $this->Employee_model->get_employee_categories();
        $data['departments'] = $this->Employee_model->get_employee_departments();
        $data['positions'] = $this->Employee_model->get_employee_positions();
        $json['add_event_html'] = $this->load->view('calendar/add_event', $data, true);
        if($this->input->is_ajax_request()) {
          set_content_type($json);
        }
    }
     
    public function delete(){
        $data = $this->input->post();
        $id = $data['event_id'];
        $result = $this->Calendar_model->delete_event($id);
        if ($result) {
            $json['success'] = true;
            $json['message'] = "Event successfully deleted.";
            $data['events'] = $this->Calendar_model->get_event_list();
            $json['calendar_html'] = $this->load->view('calendar/events_list',$data , true);

        } else {
            $json['error'] = true;
            $json['message'] = "Seem to be an error while deleting event";
            $data['events'] = $this->Calendar_model->get_event_list();
            $json['calendar_html'] = $this->load->view('calendar/events_list',$data , true);
        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

}

?>