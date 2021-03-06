<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class General_setting extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
            $this->load->model('General_model');
            $this->load->model('Employee_model');
            $this->load->helper('content-type');
            $this->load->model('General_model');
            $this->load->model('Batches_model');
            $institution = $this->General_model->get_institution();
            $this->session->set_userdata('institution_detail', $institution);
		}

        public function classes(){
            $data['classes'] = $this->General_model->get_classes();
            $json['classes_html'] = $this->load->view('settings/classes', $data, true);
            if($this->input->is_ajax_request()) {
              set_content_type($json);
            }
        }

        public function add_class(){
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('name', 'class name', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {
                $class = $this->input->post();
                $result = $this->General_model->add_new_class($class);
                if ($result) {
                    $json['success'] = true;
                    $json['message'] = "Class successfully added.";
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error.";
                }
                $data['classes'] = $this->General_model->get_classes();
                $json['classes_html'] = $this->load->view('settings/classes', $data, true);
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function update_class() {
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('name', 'class name', 'required|xss_clean');
            $data = $this->input->post();
            //print_r($data); die();

            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {
                $enable = isset($data['enable'])?$data['enable']:0;
                $update_fields = array('name'=>$data['name'],'code'=>$data['code'],'enable'=>$enable);
                $result = $this->General_model->update_class($update_fields,$data['class_id']);
                if ($result) {
                    $data['classes'] = $this->General_model->get_classes();
                    $json['classes_html'] = $this->load->view('settings/classes', $data, true);
                    $json['success'] = true;
                    $json['message'] = "Class successfully updated.";
                } else {
                    $data['classes'] = $this->General_model->get_classes();
                    $json['classes_html'] = $this->load->view('settings/classes', $data, true);
                    $json['error'] = true;
                    $json['message'] = "Seems to an error.";
                }
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function delete_class($student_id) {
            $result = $this->General_model->delete_class($student_id);
            if ($result) {
                $data['classes'] = $this->General_model->get_classes();
                $json['classes_html'] = $this->load->view('settings/classes', $data, true);
                $json['success'] = true;
                $json['message'] = "Class successfully deleted.";
            } else {
                $json['success'] = true;
                $json['message'] = "Seems to an error in delete student record.";
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function institution_details(){
            $data['countries'] = $this->Employee_model->get_all_countries();
            $data['institution_detail'] = $this->General_model->get_institution();
            $json['settings_html'] = $this->load->view('settings/institution_details', $data, true);
            if($this->input->is_ajax_request()) {
              set_content_type($json);
            }
        }

        public function subject_name(){
            $data['subjects'] = $this->General_model->get_all_subjects();
            $json['setting_html'] = $this->load->view('settings/subject_names', $data, true);
            if($this->input->is_ajax_request()) {
              set_content_type($json);
            }
        }

        public function add_subject(){
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('name', 'subject name', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {
                $subject = $this->input->post();

                $result = $this->General_model->add_new_subject($subject);
                if ($result) {
                    $json['success'] = true;
                    $json['message'] = "Subject successfully added.";
                    $data['subjects'] = $this->General_model->get_all_subjects();
                    $json['setting_html'] = $this->load->view('settings/subject_names', $data, true);
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error while adding class.";
                }

            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function update_subject() {
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('name', 'class name', 'required|xss_clean');
            $data = $this->input->post();
            //print_r($data); die();

            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {
                $update_fields = array('name'=>$data['name'],'code'=>$data['code']);
                $result = $this->General_model->update_subject($update_fields,$data['subject_id']);
                if ($result) {
                    $json['success'] = true;
                    $json['message'] = "Subject successfully updated.";

                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error.";
                }
                $data['subjects'] = $this->General_model->get_all_subjects();
                $json['setting_html'] = $this->load->view('settings/subject_names', $data, true);
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function delete_subject($id) {
            $result = $this->General_model->delete_subject($id);
            if ($result) {
                $json['success'] = true;
                $json['message'] = "Subject successfully deleted.";
            } else {
                $json['success'] = true;
                $json['message'] = "Seems to an error in delete student record.";
            }
            $data['subjects'] = $this->General_model->get_all_subjects();
            $json['setting_html'] = $this->load->view('settings/subject_names', $data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function add_institution(){
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('name', 'institution name', 'required|xss_clean');
            $this->form_validation->set_rules('code', 'institution code', 'required|xss_clean');
            $this->form_validation->set_rules('subdomain', 'Subdomain name', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {
                $institution = $this->input->post();
                if (!empty($_FILES['logo']['name'])) {
                    $upload_path = 'assets/uploads/institution';
                    $config = array(
                        'upload_path' => $upload_path,
                        'allowed_types' => "gif|jpg|png|jpeg",
                        'overwrite' => TRUE,
                        'file_name' => strtolower(str_replace(' ', '-', $this->input->post('code') . '-'.uniqid()))
                        );

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('logo')) {
                        $json['error'] = true;
                        $json['message'] = $this->upload->display_errors();
                    } else {
                        $imageDetailArray = $this->upload->data();
                        $photo = $imageDetailArray['file_name'];
                    }
                    if ($photo) {
                        $institution['logo'] = $imageDetailArray['file_name'];
                    } else {
                        $json['error'] = true;
                        $json['message'] = "Seems to an error in image uploading.";
                    }

                }
                $result = $this->General_model->save_institution($institution);
                if ($result) {
                    $json['success'] = true;
                    $json['message'] = "Institution save successfully!";
                    redirect('/general_setting/institutions');
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error while saving institution.";
                }
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function institutions(){
		    $data['institution_detail'] = $this->General_model->get_institution_detail();
            $data['countries'] = $this->Employee_model->get_all_countries();
            $this->load->view('parts/header');
            $this->load->view('parts/topbar');
            $this->load->view('parts/sidebar');
            $this->load->view('settings/institution_details',$data);
            $this->load->view('parts/footer');

        }

        public function academic_sessions(){
            $data['sessions'] = $this->General_model->get_all_sessions();
            $json['setting_html'] = $this->load->view('settings/academic_sessions', $data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function add_session(){
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('name', 'Session Name', 'required|xss_clean');
            $this->form_validation->set_rules('first_term_start', 'First term start', 'required|xss_clean');
            $this->form_validation->set_rules('first_term_end', 'First term end', 'required|xss_clean');
            $this->form_validation->set_rules('second_term_start', 'Second term start', 'required|xss_clean');
            $this->form_validation->set_rules('second_term_end', 'Second term end', 'required|xss_clean');
            $this->form_validation->set_rules('third_term_start', 'Third term start', 'required|xss_clean');
            $this->form_validation->set_rules('third_term_end', 'Third term end', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {
                $session = $this->input->post();
                $result = $this->General_model->add_new_session($session);
                if ($result) {
                    $json['success'] = true;
                    $json['message'] = "Session successfully added.";
                    $data['sessions'] = $this->General_model->get_all_sessions();
                    $json['session_html'] = $this->load->view('settings/academic_sessions', $data, true);
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error.";
                }
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function update_session() {
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('first_term_start', 'First Term', 'required|xss_clean');
            $data = $this->input->post();

            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {
                $update_fields = array(
                    'first_term_start'=>date('Y-m-d',strtotime($data['first_term_start'])),
                    'first_term_end'=>date('Y-m-d',strtotime($data['first_term_end'])),
                    'second_term_start'=>date('Y-m-d',strtotime($data['second_term_start'])),
                    'second_term_end'=>date('Y-m-d',strtotime($data['second_term_end'])),
                    'third_term_start'=>date('Y-m-d',strtotime($data['third_term_start'])),
                    'third_term_end'=>date('Y-m-d',strtotime($data['third_term_end'])),
                    'name'=>$data['name']
                );
                $result = $this->General_model->update_session($update_fields,$data['session_id']);
                if ($result) {
                    $json['success'] = true;
                    $json['message'] = "Session successfully updated.";

                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error.";

                }
                $data['sessions'] = $this->General_model->get_all_sessions();
                $json['session_html'] = $this->load->view('settings/academic_sessions', $data, true);
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function delete_session($id) {
            $result = $this->General_model->delete_session($id);
            if ($result) {
                $json['success'] = true;
                $json['message'] = "Session successfully deleted.";
            } else {
                $json['success'] = true;
                $json['message'] = "Seems to an error.";

            }
            $data['sessions'] = $this->General_model->get_all_sessions();
            $json['session_html'] = $this->load->view('settings/academic_sessions', $data, true);

            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function class_sets(){
            $data['batches'] = $this->General_model->get_class_set();
            $json['result_html'] = $this->load->view('settings/class_set', $data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function get_learning_domains(){
            $fdata = $this->input->post();
            $data['domain'] = $this->General_model->get_all_domains();
            $data['batch'] = $this->Batches_model->get_batches_course_session($fdata['course_id'],$fdata['session']);
            $class_set_domain = $this->General_model->get_class_set_domain($fdata['course_id'],$fdata['session']);
            $result = array();
            foreach ($class_set_domain as $domain){
                $result[] = $domain['domain_group_id'];
            }
            $data['class_set_domains'] = $result;
            $data['session'] = $fdata['session'];
            $data['course_id'] = $fdata['course_id'];
            $json['result_html'] = $this->load->view('settings/edit_learning_domain', $data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function update_class_set_domain(){
            $data = $this->input->post();
            $result = $this->General_model->update_class_set_domain($data);
            if($result){
                $json['success'] = true;
                $json['message'] = "Class Set was successfully updated.";
            }else{
                $json['error'] = true;
                $json['message'] = "Seem to be an error.";
            }

            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function lga_origin(){
            $data['origins'] = $this->General_model->get_lga_origin();
            $data['states'] = $this->General_model->get_states();
            $json['result_html'] = $this->load->view('settings/lga', $data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function add_origin(){
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('name', 'Class name', 'required|xss_clean');
            $this->form_validation->set_rules('state_id', 'State name', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {
                $fdata = $this->input->post();
                if(isset($fdata['city_id']) && (!empty($fdata['city_id']))){
                    $result = $this->General_model->update_state_origin($fdata);
                }else{
                    $result = $this->General_model->add_state_origin($fdata);
                }
                if ($result) {
                    $json['success'] = true;
                    $json['message'] = "Lga origin successfully added.";
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error.";
                }
                $data['origins'] = $this->General_model->get_lga_origin();
                $data['states'] = $this->General_model->get_states();
                $json['result_html'] = $this->load->view('settings/lga', $data, true);
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function edit_origin($id){
            $data['origin'] = $this->General_model->get_origin_by_id($id);
            $data['states'] = $this->General_model->get_states();
            $json['result_html'] = $this->load->view('settings/edit_lga', $data,true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function delete_origin($id) {
            $result = $this->General_model->delete_origin($id);
            if ($result) {
                $data['origins'] = $this->General_model->get_lga_origin();
                $data['states'] = $this->General_model->get_states();
                $json['result_html'] = $this->load->view('settings/lga', $data, true);
                $json['success'] = true;
                $json['message'] = "Origin successfully deleted.";
            } else {
                $json['success'] = true;
                $json['message'] = "Seems to an error.";
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

}

?>