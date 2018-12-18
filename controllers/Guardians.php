<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guardians extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->model('Dashboard_model');
        $this->load->helper('content-type');

    }

    public function index(){

        $record['guardians'] = $this->Student_model->get_all_guardians();
        $fields = $this->guardian_fields();
        $record['guardian_fields'] = $fields;
        $record['countries'] = $this->Student_model->get_all_countries();
        $record['states'] = $this->Student_model->get_all_states();
        $record['students'] = $this->Student_model->get_all_students();

        $this->load->view('parts/header');
        $this->load->view('parts/topbar');
        $this->load->view('parts/sidebar');
        $this->load->view('student/guardian_listing', $record);
        $this->load->view('parts/footer');

    }

    public function guardians()
    {
        $record['guardians'] = $this->Student_model->get_all_guardians();
        $guardian_fields = $this->Student_model->get_form_fields(4);
        $fields = array();
        foreach ($guardian_fields as $field) {
            $fields[$field['field_name']] = $field['add_view'];
        }
        $record['guardian_fields'] = $fields;
        $record['countries'] = $this->Student_model->get_all_countries();
        $record['states'] = $this->Student_model->get_all_states();
        $record['students'] = $this->Student_model->get_all_students();
        $json['guardian_html'] = $this->load->view('student/guardian_listing', $record, true);
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function add_new_guardian() {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('surname', 'surname', 'required|xss_clean');
        $this->form_validation->set_rules('first_name', 'first name', 'required|xss_clean');
        $this->form_validation->set_rules('student_id', 'Student Name', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'is_unique[login.email]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            $this->session->set_flashdata('error', validation_errors());
            redirect('guardians/');
            exit();
        } else {
            $guardian = $this->input->post();

            $loggedin_user = $this->session->userdata('userdata');
            $guardian_fields = array('surname' => $guardian['surname'],
                'first_name' => isset($guardian['first_name'])?$guardian['first_name']:'',
                'middle_name' => isset($guardian['middle_name'])?$guardian['middle_name']:'',
                //'photo' => isset($guardian['photo'])?$guardian['photo']:'',
                'title' => isset($guardian['title'])?$guardian['title']:'',
                'email' => isset($guardian['email'])?$guardian['email']:'',
                'gender' => isset($guardian['gender'])?$guardian['gender']:'',
                'phone' => isset($guardian['phone'])?$guardian['phone']:'',
                'mobile_phone' => isset($guardian['mobile_phone'])?$guardian['mobile_phone']:'',
                'address_line' => isset($guardian['address_line'])?$guardian['address_line']:'',
                'country' => isset($guardian['country'])?$guardian['country']:'',
                'state' => isset($guardian['state'])?$guardian['state']:'',
                'city' => isset($guardian['city'])?$guardian['city']:'',
                'lga' => isset($guardian['lga'])?$guardian['lga']:'',
                'status' => 1,
                'created_by' => $loggedin_user['login_id'],
            );
            if (!empty($_FILES['photo']['name'])) {
                $upload_path = 'assets/uploads/guardian_images';
                $feile_name = strtolower(str_replace(' ', '-', $this->input->post('surname') . '-' . $this->input->post('first_name'))) . '-' . uniqid();
                $config = array(
                    'upload_path' => $upload_path,
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'overwrite' => TRUE,
                    'file_name' => $feile_name
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
                    $guardian_fields['photo'] = $imageDetailArray['file_name'];
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error in image upload.";
                }
            }


            $guardian_id = $this->Student_model->add_new_guardian($guardian_fields);

            $student_guardian_fields = array(
                'student_id' => $guardian['student_id'],
                'guardian_id' => $guardian_id,
                'relation' => $guardian['relation_with_student'],
                'emergency_contact' => isset($guardian['emergency_contact']) ? $guardian['emergency_contact'] : 0,
                'is_authorized' => isset($guardian['is_authorized']) ? $guardian['is_authorized'] : 0,
            );
            $result = $this->Student_model->save_student_guardian($student_guardian_fields);

            if ($result) {
                $json['success'] = true;
                $json['message'] = "Guardian successfully added.";
            } else {
                $json['error'] = true;
                $json['message'] = "Seems to an error.";
            }

            redirect('guardians/');
            exit();

        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function guardian_filters(){
        $filters = $this->input->post();
        $data['guardians'] = $this->Student_model->get_guardian_by_filters($filters);
        $data['filters'] = $filters;
        $json['guardian_html'] = $this->load->view('student/guardian_listing', $data, true);
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function guardian_profile($id)
    {
        $data['guardian'] = $this->Student_model->get_guardian_by_id($id);
        $data['countries'] = $this->Student_model->get_all_countries();
        $data['states'] = $this->Student_model->get_all_states();
        $data['origins'] = $this->Student_model->get_all_origins();
        $data['wards'] = $this->Student_model->get_guardian_wards($id);
        $fields = $this->guardian_fields();
        $data['guardian_fields'] = $fields;
        $json['guardian_html'] = $this->load->view('student/guardian_profile', $data, true);
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function change_pwd(){
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('current_pwd', 'current password', 'required|min_length[8]|xss_clean');
        $this->form_validation->set_rules('new_pwd', 'new password', 'required|min_length[8]|xss_clean');
        $this->form_validation->set_rules('c_pwd', 'confirm password', 'required|min_length[8]|matches[new_pwd]');

        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            $json['message'] = validation_errors();
        }else{
            $guardian = $this->input->post();
            $user_email = $this->input->post('email');
            $result = $this->Dashboard_model->get_user_by_email($user_email);
            if($result) {
                if (password_verify ( $this->input->post('current_pwd') , $result['password'] )) {
                    $result = $this->Student_model->change_guardian_pwd($guardian);
                    if($result){
                        $json['success'] = true;
                        $json['message'] = "Password change successfully!";
                    }else{
                        $json['error'] = true;
                        $json['message'] = "Seems to be an error.";
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

    public function delete_user($id) {
        $result = $this->Student_model->delete_guardian($id);
        if ($result) {
            $json['success'] = true;
            $json['message'] = "Guardian successfully deleted.";

        } else {
            $json['error'] = true;
            $json['message'] = "Seems to an error in delete guardian record.";
        }

        $record['guardians'] = $this->Student_model->get_all_guardians();
        $guardian_fields = $this->Student_model->get_form_fields(4);
        $fields = array();
        foreach ($guardian_fields as $field) {
            $fields[$field['field_name']] = $field['add_view'];
        }
        $record['guardian_fields'] = $fields;
        $record['countries'] = $this->Student_model->get_all_countries();
        $record['states'] = $this->Student_model->get_all_states();
        $record['students'] = $this->Student_model->get_all_students();
        $json['guardian_html'] = $this->load->view('student/guardian_listing', $record, true);
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function update_guardian($id) {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('surname', 'surname', 'required|xss_clean');
        $this->form_validation->set_rules('first_name', 'first name', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            echo $json['message'] = validation_errors();
        } else {
            $guardian_data = $this->input->post();
            $update_guardian_data = array(
                                            'title'=>$guardian_data['title'],
                                            'surname'=>$guardian_data['surname'],
                                            'first_name'=>$guardian_data['first_name'],
                                            'middle_name'=>$guardian_data['middle_name'],
                                            'last_name'=>$guardian_data['last_name'],
                                            'phone'=>$guardian_data['phone'],
                                            'mobile_phone'=>$guardian_data['mobile_phone'],
                                            'email'=>$guardian_data['email'],
                                            'gender'=>$guardian_data['gender'],
                                            'country'=>$guardian_data['country'],
                                            'state'=>$guardian_data['state'],
                                            'city'=>$guardian_data['city'],
                                            'address_line'=>$guardian_data['address_line'],
                                            'lga'=>$guardian_data['lga'],
                                            'status'=>$guardian_data['status'],
                                    );

            //echo "<pre>"; print_r($update_guardian_data); die();
            if (!empty($_FILES['photo']['name'])) {
                $upload_path = 'assets/uploads/guardian_images';
                $feile_name = strtolower(str_replace(' ', '-', $this->input->post('surname') . '-' . $this->input->post('first_name'))) . '-' . uniqid();
                $config = array(
                    'upload_path' => $upload_path,
                    'allowed_types' => "gif|jpg|png|jpeg",
                    'overwrite' => TRUE,
                    'file_name' => $feile_name
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
                    $update_guardian_data['photo'] = $imageDetailArray['file_name'];
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error in image upload.";
                }
            }
            $result = $this->Student_model->update_guardian($update_guardian_data, $id);
            $relation = $this->Student_model->update_student_guardian($guardian_data['relation']);

            if ($result || $relation ) {
                $this->session->set_flashdata('success', 'Guardian successfully updated.');
                redirect('guardians/');
            } else {
                $this->session->set_flashdata('error', 'Seems to an error in update student record.');
                redirect('guardians/');
            }
        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function student_guardian_profile()
    {
        $guardian = $this->Student_model->student_guardian_profile();
        $id = $guardian['guardian_id'];
        $data['guardian'] = $guardian;
        $data['countries'] = $this->Student_model->get_all_countries();
        $data['states'] = $this->Student_model->get_all_states();
        $data['origins'] = $this->Student_model->get_all_origins();
        $data['wards'] = $this->Student_model->get_guardian_wards($id);
        $data['guardian_id'] = $id;
        $json['result_html'] = $this->load->view('student/guardian_profile', $data, true);
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function guardian_fields(){
        $guardian_fields = $this->Student_model->get_form_fields(4);
        $fields = array();
        foreach ($guardian_fields as $field) {
            $fields[$field['field_name']] = $field['add_view'];
        }

        return $fields;
    }

    public function validate_email(){
        $email = $this->input->post('email');
        $result = $this->Student_model->validate_guardian_email($email);
        if($result) {
            $json['success'] = true;
            $json['message'] = "Email already been taken.";
        } else {
            $json['error'] = true;
            $json['message'] = "Seem to be an error.";
        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

}