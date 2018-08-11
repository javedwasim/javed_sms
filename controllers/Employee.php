<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * 
	 */
	class Employee extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('Employee_model');
		}

        public function index(){
            $data['departments'] = $this->Employee_model->get_employee_departments();
            $data['positions'] = $this->Employee_model->get_employee_positions();
            $data['categories'] = $this->Employee_model->get_employee_categories();
            $data['employees'] = $this->Employee_model->get_all_employees();

            $this->load->view('parts/header');
            $this->load->view('parts/topbar');
            $this->load->view('parts/sidebar');
            $this->load->view('employee/employee_listing', $data);
            $this->load->view('parts/footer');

        }

		public function employee(){
            $data['departments'] = $this->Employee_model->get_employee_departments();
            $data['positions'] = $this->Employee_model->get_employee_positions();
            $data['categories'] = $this->Employee_model->get_employee_categories();
            $data['employees'] = $this->Employee_model->get_all_employees();
			$json['employee_html'] = $this->load->view('employee/employee_listing', $data, true);

			if($this->input->is_ajax_request()) {
		      set_content_type($json);
		    }
		}

		public function employee_add(){
			$data['countries'] = $this->Employee_model->get_all_countries();
            $data['employee_fields'] = $this->get_employee_setting_fields();
            $data['departments'] = $this->Employee_model->get_employee_departments();
            $data['positions'] = $this->Employee_model->get_employee_positions();
            $data['categories'] = $this->Employee_model->get_employee_categories();
			$json['employee_html'] = $this->load->view('employee/add_employee', $data,true);
			if($this->input->is_ajax_request()) {
		      set_content_type($json);
		    }
		}

		public function profile($id){
		    $data['Emp_profile'] = $this->Employee_model->get_employee_by_id($id);
			$this->load->view('parts/header');
			$this->load->view('parts/topbar');
			$this->load->view('parts/sidebar');
			$this->load->view('employee/employee_profile',$data);
			$this->load->view('parts/footer');
			
		}

		public function get_employee_setting_fields(){
            $employee_fields = $this->Employee_model->get_form_fields(3);
            $fields = array();
            foreach ($employee_fields as $field){
                $fields[$field['field_name']] = $field['add_view'];
            }
            return $fields;
        }

        public function add_new_employee() {
            $this->load->library('form_validation');
            $this->load->helper('security');
            //rules for required fields e.g email should be unique
            $this->form_validation->set_rules('surname', 'surname', 'required|xss_clean');
            $this->form_validation->set_rules('first_name', 'first name', 'required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[employees.email]|xss_clean');
            //if validation passed
            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {
                $employee_data = $this->input->post();
                if (!empty($_FILES['photo']['name'])) {
                    $upload_path = 'assets/uploads/student_images';
                    $config = array(
                        'upload_path' => $upload_path,
                        'allowed_types' => "gif|jpg|png|jpeg",
                        'overwrite' => TRUE,
                        'file_name' => strtolower(str_replace(' ', '-', $this->input->post('surname') . '-' . $this->input->post('first_name'))) . '-' . uniqid()
                    );
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('photo')) {
                        $json['error'] = true;
                        $json['message'] = $this->upload->display_errors();
                    } else {
                        $imageDetailArray = $this->upload->data();
                        $photo = $imageDetailArray['file_name'];
                    }
                    if ($photo) {
                        $employee_data['photo'] = $imageDetailArray['file_name'];
                    } else {
                        $json['error'] = true;
                        $json['message'] = "Seems to an error in image uploading.";
                    }
                }
                $employee_data['status']=1; //by default user is active
                $result = $this->Employee_model->add_new_employee($employee_data);
                if ($result) {
                    $this->session->set_flashdata('success', 'Employee successfully added.');
                    redirect('employee/');
                } else {
                    $this->session->set_flashdata('error', 'Seems to an error in update student record.');
                    redirect('employee/');
                }
            }

            if($this->input->is_ajax_request()) {
                set_content_type($json);

            }

        }

        public function edit($id) {
            $record['employee'] = $this->Employee_model->get_employee_by_id($id);
            $data['countries'] = $this->Employee_model->get_all_countries();
            $record['form_action'] = site_url('employee/update_employee/').$id;
            $record['employee_fields'] = $this->get_employee_setting_fields();
            $record['departments'] = $this->Employee_model->get_employee_departments();
            $record['positions'] = $this->Employee_model->get_employee_positions();
            $record['categories'] = $this->Employee_model->get_employee_categories();
            $record['countries'] = $this->Employee_model->get_all_countries();
            $record['states'] = $this->Employee_model->get_all_states();

            $record['update_employee_button'] = 'update_employee';
            //print_r($record);
            if ($record['employee']) {
                $json['success'] = true;
                $this->load->view('parts/header');
                $this->load->view('parts/topbar');
                $this->load->view('parts/sidebar');
                $json['student_html'] = $this->load->view('employee/add_employee', $record);
                $this->load->view('parts/footer');
            } else {
                $json['error'] = true;
                $this->load->view('parts/header');
                $this->load->view('parts/topbar');
                $this->load->view('parts/sidebar');
                $json['student_html'] = $this->load->view('employee/add_employee', $record);
                $this->load->view('parts/footer');
            }

            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function update_employee($id)
        {
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('surname', 'surname', 'required|xss_clean');
            $this->form_validation->set_rules('first_name', 'first name', 'required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {
                $employee_data = $this->input->post();
                if (!empty($_FILES['photo']['name'])) {
                    $upload_path = 'assets/uploads/employee_images';
                    $config = array(
                        'upload_path' => $upload_path,
                        'allowed_types' => "gif|jpg|png|jpeg",
                        'overwrite' => TRUE,
                        'file_name' => strtolower(str_replace(' ', '-', $this->input->post('surname') . '-' . $this->input->post('first_name'))) . '-' . uniqid()
                    );
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('photo')) {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        $photo = false;
                    } else {
                        $imageDetailArray = $this->upload->data();
                        $photo = $imageDetailArray['file_name'];
                    }
                    if ($photo) {
                        $employee_data['photo'] = $imageDetailArray['file_name'];
                    } else {
                        $json['error'] = true;
                        $json['message'] = "Seems to an error in image upload.";
                    }
                }
                //print_r($employee_data); die();
                //unset($employee_data['guardian_length']);
                $result = $this->Employee_model->update_employee($employee_data, $id);
                if ($result) {
                    $this->session->set_flashdata('success', 'Employee successfully updated.');
                    redirect('employee/');
                } else {
                    $this->session->set_flashdata('error', 'Seems to an error in update student record.');
                    $json['message'] = "Seems to an error in update student record.";
                    redirect('employee/');
                }
            }
            if ($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function employee_filters(){
            $filters = $this->input->post();
            $data['filters'] = $filters;
            $data['departments'] = $this->Employee_model->get_employee_departments();
            $data['positions'] = $this->Employee_model->get_employee_positions();
            $data['categories'] = $this->Employee_model->get_employee_categories();
            $data['employees'] = $this->Employee_model->get_employee_by_filters($filters);
            $json['employee_html'] = $this->load->view('employee/employee_listing', $data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function change_pwd(){
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('current_pwd', 'current password', 'required|xss_clean');
            $this->form_validation->set_rules('new_pwd', 'new password', 'required|xss_clean');
            $this->form_validation->set_rules('c_pwd', 'confirm password', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            }else{
                $student = $this->input->post();
                $user_email = $this->input->post('email');
                $result = $this->Dashboard_model->get_user_by_email($user_email);
                if($result) {
                    if (password_verify ( $this->input->post('current_pwd') , $result['password'] )) {
                        $result = $this->Employee_model->change_pwd($student);
                        if($result){
                            $json['success'] = true;
                            $json['message'] = "Password change successfully!";
                        }else{
                            $json['error'] = true;
                            $json['message'] = "Seems to be an error while updating password.";
                        }

                    } else {

                        $json['error'] = true;
                        $json['message'] = "Wrong current password!";
                    }

                } else {
                    $json['error'] = true;
                    $json['message'] = "User not found!";
                }

            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function archive_employee(){
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('status_updated_at', 'archive date', 'required|xss_clean');
            $this->form_validation->set_rules('reason', 'reason to leave', 'required|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            }else{
                $data = $this->input->post();
                $result = $this->Employee_model->archive_employee($data);
                if($result){
                    $json['success'] = true;
                    $json['message'] = "Employee move to archive successfully!";
                }else{
                    $json['error'] = true;
                    $json['message'] = "Seems to be an error";
                }

            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function delete_user($id) {
            $result = $this->Student_model->delete_employee($id);
            if ($result) {

                $data['departments'] = $this->Employee_model->get_employee_departments();
                $data['positions'] = $this->Employee_model->get_employee_positions();
                $data['categories'] = $this->Employee_model->get_employee_categories();
                $data['employees'] = $this->Employee_model->get_all_employees();
                $json['employee_html'] = $this->load->view('employee/employee_listing', $data, true);
                $json['success'] = true;
                $json['message'] = "Employee successfully deleted.";

            } else {
                $data['departments'] = $this->Employee_model->get_employee_departments();
                $data['positions'] = $this->Employee_model->get_employee_positions();
                $data['categories'] = $this->Employee_model->get_employee_categories();
                $data['employees'] = $this->Employee_model->get_all_employees();
                $json['employee_html'] = $this->load->view('employee/employee_listing', $data, true);
                $json['error'] = true;
                $json['message'] = "Seems to an error in deleting employee record.";
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }


	}

?>