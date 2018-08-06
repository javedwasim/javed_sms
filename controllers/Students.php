<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Student_model');
        $this->load->helper('content-type');

	}

	public function index() {
		$data['students'] = $this->Student_model->get_all_students();
		$this->load->view('student/index', $data);
	}

  public function students() {
    $data['students'] = $this->Student_model->get_all_students();
    $data['batches'] = $this->Student_model->get_all_batches();
    $json['student_html'] = $this->load->view('parts/student_listing', $data, true);
    if($this->input->is_ajax_request()) {
      set_content_type($json);
    }
  }

  public function createPdf(){
      $this->load->library('Pdf');
      $data['students'] = $this->Student_model->get_all_students();

      $this->load->view('student/pdf_view',$data);
  }

	public function student_fields() {
		$data['student_form_fields'] = $this->Student_model->get_form_fields('student');
		$data['guardian_form_fields'] = $this->Student_model->get_form_fields('guardian');
        $fields = $this->Student_model->get_form_fields(1);
        $student_fields = array();
        foreach ($fields as $field){
            $student_fields[$field['field_name']]=$field['add_view'];
        }
        $student_fields_arr = array();
        $guardian_fields = $this->Student_model->get_form_fields(2);
        foreach ($guardian_fields as $field){
            $student_fields_arr[$field['field_name']]=$field['add_view'];
        }
        $data['student_fields'] = $student_fields;
        $data['guardian_fields'] = $student_fields_arr;

		$json['student_html'] = $this->load->view('student/student_fields', $data, true);
		if($this->input->is_ajax_request()) {
			set_content_type($json);
		}
		 
	}

	public function add_student_fields() {
		$student_fields = array();
		$guardian_fields = array();
        $json = array();
		$student_fields_list = $this->input->post('student_form_fields');
		$guardian_fields_list = $this->input->post('guardian_info');
        $fields = $this->Student_model->get_form_fields(1);
		if ($student_fields_list) {
			foreach ($student_fields_list as $key => $student_field) {
				$student_fields[$student_field] = 1;
			}
            $result_student = $this->Student_model->update_student_form_fields($student_fields, 'student');

            if (!$result_student) {
                $json['message'] = 'Fields successfully added/updated.';
                $json['success'] = true;
            }

		}

        if ($guardian_fields_list) {
            foreach ($guardian_fields_list as $key => $guardian_field) {
                $guardian_fields[$guardian_field] = 1;
            }
            $result_guardian = $this->Student_model->update_guardian_form_fields($guardian_fields, 'guardian');
            if (!$result_guardian) {
                $json['message'] = 'Fields successfully added/updated.';
                $json['success'] = true;
            }
        }
		if($this->input->is_ajax_request()) {
			set_content_type($json);
		}
	}

	public function add_student() {
		$fields = $this->get_fields_setting();
        $data['student_fields'] = $fields;
        //echo "<pre>"; print_r($data['student_fields']); die();
		$json['student_html'] = $this->load->view('student/add_student', $data, true);
		if($this->input->is_ajax_request()) {
			set_content_type($json);
		}

	}

    public function add_student_form() {
        $data['countries'] = $this->Student_model->get_all_conutries();
        $student_fields = $this->Student_model->get_form_fields(1);
        $data['guardian_fields'] = $this->Student_model->get_form_fields(2);
        $data['guardians'] = $this->Student_model->get_all_guardians();
        $data['batches'] = $this->Student_model->get_all_batches();
        $data['errors']=$this->session->flashdata('errors');
        //print_r($data['errors']); die();
        $fields = array();
        foreach ($student_fields as $field){
            $fields[$field['field_name']] = $field['add_view'];
        }
        $data['student_fields'] = $fields;
        //echo "<pre>"; print_r($data['student_fields']); die();
        $this->load->view('parts/header');
        $this->load->view('parts/topbar');
        $this->load->view('parts/sidebar');
        $this->load->view('student/add_student', $data);
        $this->load->view('parts/footer');
    }

	public function add_new_student() {
		$this->load->library('form_validation');
		$this->load->helper('security');
		//rules for required fields e.g email should be unique
		$this->form_validation->set_rules('surname', 'surname', 'required|xss_clean');
		$this->form_validation->set_rules('first_name', 'first name', 'required|xss_clean');
		$this->form_validation->set_rules('admission_no', 'admission number', 'required|xss_clean');
		$this->form_validation->set_rules('admission_date', 'admission date', 'required|xss_clean');
		$this->form_validation->set_rules('batch_no', 'batch number', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[students.email]|xss_clean');
		//if validation passed
		if ($this->form_validation->run() == FALSE) {
			$data['error'] = true;
            $validation_errors = validation_errors();
            $this->session->set_flashdata('errors', $validation_errors);
            redirect('students/add_student_form');
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
					$json['error'] = true;
					$json['message'] = $this->upload->display_errors();
				} else {
					$imageDetailArray = $this->upload->data();
					$photo = $imageDetailArray['file_name'];
				}
				if ($photo) {
					$student_data['photo'] = $imageDetailArray['file_name'];
				} else {
					$json['error'] = true;
					$json['message'] = "Seems to an error in image uploading.";
				}
			}
			//unset guardian _length
            unset($student_data['guardian_length']);
			$result = $this->Student_model->add_new_student($student_data);

			if ($result) {
                redirect('students/student_guardian_list/'.$result);
			} else {
                $this->session->set_flashdata('error', 'Seem to be an error while saving student!');
                redirect('students/add_new_student/');
			}
		}

        if($this->input->is_ajax_request()) {
            set_content_type($json);

        }

	}

	public function get_fields_setting(){
        $data['countries'] = $this->Student_model->get_all_conutries();
        $student_fields = $this->Student_model->get_form_fields(1);
        $data['guardian_fields'] = $this->Student_model->get_form_fields(2);
        $data['guardians'] = $this->Student_model->get_all_guardians();
        $data['batches'] = $this->Student_model->get_all_batches();

        $fields = array();
        foreach ($student_fields as $field){
            $fields[$field['field_name']] = $field['add_view'];
        }
        return $fields;
    }

	public function student_guardian_list($student_id){
        $fields = $this->get_fields_setting();
        $data['student_fields'] = $fields;
	    $data['student_id'] = $student_id;
        $data['guardians'] = $this->Student_model->get_all_guardians();

        $this->load->view('parts/header');
        $this->load->view('parts/topbar');
        $this->load->view('parts/sidebar');
        $this->load->view('student/student_guardian_listing',$data);
        $this->load->view('parts/footer');

    }

	public function edit($student_id) {
		$record['student'] = $this->Student_model->get_student_by_id($student_id);
		$record['countries'] = $this->Student_model->get_all_conutries();
        $student_fields = $this->Student_model->get_form_fields('student');
		$record['guardian_fields'] = $this->Student_model->get_form_fields('guardian');
		$record['guardians'] = $this->Student_model->get_all_guardians();
        $record['batches'] = $this->Student_model->get_all_batches();
       // echo "<pre>"; print_r($record['batches']); die();
        $fields = array();
        foreach ($student_fields as $field){
            $fields[$field['field_name']] = $field['add_view'];
        }
        $record['student_fields'] = $fields;
		if ($record['student']) {
          $json['success'] = true;
                $json['student_html'] = $this->load->view('student/edit_student', $record, true);
           } else {
          $json['error'] = true;
          $json['message'] = "No record found for this student.";
		}

        if($this->input->is_ajax_request()) {
          set_content_type($json);
        }
	}

	public function assign_guardian(){
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('relation', 'relation with student', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            $json['message'] = validation_errors();
        }else{
            $guardian = $this->input->post();
            $result = $this->Student_model->save_student_guardian($guardian);
            if ($result) {
                $data['student_id'] = $guardian['student_id'];
                $data['guardians'] = $this->Student_model->get_all_guardians();
                $json['guardian_html'] = $this->load->view('student/student_guardian_table', $data, true);
                $json['success'] = true;
                $json['message'] = "Guardian assigned to student successfully!";
            } else {
                $data['student_id'] = $guardian['student_id'];
                $data['guardians'] = $this->Student_model->get_all_guardians();
                $json['guardian_html'] = $this->load->view('student/student_guardian_table', $data, true);
                $json['error'] = true;
                $json['message'] = "Seems to an error while assigning guardian.";
            }

        }

        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function add_new_guardian(){
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('surname', 'Surname', 'required|xss_clean');
        $this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $json['error'] = true;
            $json['message'] = validation_errors();
        }else{
            $guardian = $this->input->post();

            if (!empty($_FILES['photo']['name'])) {
                $upload_path = 'assets/uploads/guardian_images';
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
                    $guardian['photo'] = $imageDetailArray['file_name'];
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error in image uploading.";
                }
            }
            $guardian_fields = array('surname'=>$guardian['surname'],
                                    'first_name'=>$guardian['first_name'],
                                    'middle_name'=>$guardian['middle_name'],
                                    'photo'=>$guardian['photo'],
                                    'title'=>$guardian['title'],
                                    'email'=>$guardian['email'],
                                    'gender'=>$guardian['gender'],
                                    'phone'=>$guardian['phone'],
                                    'mobile_phone'=>$guardian['mobile_phone'],
                                    'address_line'=>$guardian['address_line'],
                                    'country'=>$guardian['country'],
                                    'state'=>$guardian['state'],
                                    'city'=>$guardian['city'],
                                    'lga'=>$guardian['lga'],
                            );

            $guardian_id = $this->Student_model->add_new_guardian($guardian_fields);
            $student_guardian_fields = array(
                                            'student_id'=>$guardian['student_id'],
                                            'guardian_id'=>$guardian_id,
                                            'relation'=>$guardian['relation_with_student'],
                                            'emergency_contact'=>isset($guardian['emergency_contact'])?$guardian['emergency_contact']:0,
                                            'is_authorized'=>isset($guardian['is_authorized'])?$guardian['is_authorized']:0,
                                        );
            $result = $this->Student_model->save_student_guardian($student_guardian_fields);
            if ($result) {
                $data['student_id'] = $guardian['student_id'];
                redirect('students/student_guardian_list/'.$data['student_id']);
            } else {
                redirect('students/student_guardian_list/'.$data['student_id']);
            }

        }

        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

	public function update_student($student_id) {
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules('surname', 'surname', 'required|xss_clean');
		$this->form_validation->set_rules('first_name', 'first name', 'required|xss_clean');
		$this->form_validation->set_rules('admission_no', 'admission number', 'required|xss_clean');
		$this->form_validation->set_rules('admission_date', 'admission date', 'required|xss_clean');
		$this->form_validation->set_rules('batch_no', 'batch number', 'required|xss_clean');
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
			unset($student_data['guardian_length']);
			$result = $this->Student_model->update_student($student_data, $student_id);
			if ($result) {
                $record['students'] = $this->Student_model->get_all_students();
                $json['student_html'] = $this->load->view('parts/student_listing', $record, true);
                $json['success'] = true;
                $json['message'] = "Student successfully updated.";
			} else {
                $json['error'] = true;
                $json['message'] = "Seems to an error in update student record.";
			}
		}
        if($this->input->is_ajax_request()) {
          set_content_type($json);
        }
	}

	public function delete_user($student_id) {
		$result = $this->Student_model->delete_student($student_id);
		if ($result) {
      $record['students'] = $this->Student_model->get_all_students();
      $json['student_html'] = $this->load->view('parts/student_listing', $record, true);
      $json['success'] = true;
      $json['message'] = "Student successfully deleted.";
		} else {
      $json['success'] = true;
      $json['message'] = "Seems to an error in delete student record.";
		}
    if($this->input->is_ajax_request()) {
      set_content_type($json);
    }
	}



    public function guardian_profile(){
        $this->load->view('parts/header');
        $this->load->view('parts/topbar');
        $this->load->view('parts/sidebar');
        $this->load->view('student/guardian_profile');
        $this->load->view('parts/footer');
    }



    public function student_profile($id){
        $record['student'] = $this->Student_model->get_student_by_id($id);
        $this->load->view('parts/header');
        $this->load->view('parts/topbar');
        $this->load->view('parts/sidebar');
        $this->load->view('student/student_profile',$record);
        $this->load->view('parts/footer');
    }

    public function student_filters(){
	    $filters = $this->input->post();
        $data['students'] = $this->Student_model->get_students_by_filters($filters);
        $data['filters'] = $filters;
        $data['batches'] = $this->Student_model->get_all_batches();
       // print_r($data['batches']);
        $json['student_html'] = $this->load->view('parts/student_listing', $data, true);
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

}
