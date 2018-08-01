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

		public function employee(){
            $data['employees'] = $this->Employee_model->get_all_employees();
			$json['employee_html'] = $this->load->view('employee/employee_listing', $data, true);

			if($this->input->is_ajax_request()) {
		      set_content_type($json);
		    }
		}

		public function employee_add(){
			$data['countries'] = $this->Employee_model->get_all_conutries();
            $employee_fields = $this->Employee_model->get_form_fields(3);
            $fields = array();
            foreach ($employee_fields as $field){
                $fields[$field['field_name']] = $field['add_view'];
            }
            $data['employee_fields'] = $fields;
			$json['employee_html'] = $this->load->view('employee/add_employee', $data,true);
			if($this->input->is_ajax_request()) {
		      set_content_type($json);
		    }
		}

		public function profile(){
			$this->load->view('parts/header');
			$this->load->view('parts/topbar');
			$this->load->view('parts/sidebar');
			$this->load->view('employee/employee_profile');
			$this->load->view('parts/footer');
			
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
                $result = $this->Employee_model->add_new_employee($employee_data);
                if ($result) {
                    $record['employees'] = $this->Employee_model->get_all_employees();
                    $json['employee_html'] = $this->load->view('employee/employee_listing', $record, true);
                    $json['success'] = true;
                    $json['message'] = "Employee added successfully.";
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error in image uploading.";
                }
            }

            if($this->input->is_ajax_request()) {
                set_content_type($json);

            }

        }

        public function edit($id) {
            $record['employee'] = $this->Employee_model->get_employee_by_id($id);
            $data['countries'] = $this->Employee_model->get_all_conutries();
            $record['form_action'] = site_url('employee/update_employee/').$id;
            $record['update_employee_button'] = 'update_employee';
            //print_r($record);
            if ($record['employee']) {
                $json['success'] = true;
                $json['student_html'] = $this->load->view('employee/add_employee', $record, true);
            } else {
                $json['error'] = true;
                $json['message'] = "No record found for this student.";
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
                $student_data = $this->input->post();
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
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        $photo = false;
                    } else {
                        $imageDetailArray = $this->upload->data();
                        $photo = $imageDetailArray['file_name'];
                    }
                    if ($photo) {
                        $student_data['photo'] = $imageDetailArray['file_name'];
                    } else {
                        $json['error'] = true;
                        $json['message'] = "Seems to an error in image upload.";
                    }
                }
                //unset($student_data['guardian_length']);
                $result = $this->Employee_model->update_employee($student_data, $id);
                if ($result) {
                    $data['employees'] = $this->Employee_model->get_all_employees();
                    $json['employee_html'] = $this->load->view('employee/employee_listing', $data, true);
                    $json['success'] = true;
                    $json['message'] = "Employee successfully updated.";
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error in update student record.";
                }
            }
            if ($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }
	}

?>