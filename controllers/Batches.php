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
        $data['batch_id']=$id;;
        $data['screen'] = 'batch_students';
        $this->load->view('batches/demographics', $data);
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

    public function guardian_profile($id){
        $data['guardian'] = $this->Student_model->get_guardian_by_id($id);
        $data['countries'] = $this->Student_model->get_all_countries();
        $data['states'] = $this->Student_model->get_all_states();
        $data['origins'] = $this->Student_model->get_all_origins();
        $data['wards'] = $this->Student_model->get_guardian_wards($id);
        //print_r($data['guardian']); die();
        $this->load->view('parts/header');
        $this->load->view('parts/topbar');
        $this->load->view('parts/sidebar');
        $this->load->view('student/guardian_profile',$data);
        $this->load->view('parts/footer');
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
            $guardian = $this->input->post();
            $user_email = $this->input->post('email');
            $result = $this->Dashboard_model->get_user_by_email($user_email);
            if($result) {
                if (password_verify ( $this->input->post('current_pwd') , $result['password'] )) {
                    $result = $this->Student_model->change_pwd($guardian);
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

    public function assign_employees(){
        $data = $this->input->post();
        $employees = $data['employee'];
        $role = $data['role'];
        $assign_data = array();
        for($i=0;$i<count($employees);$i++){
            $assign_data[$employees[$i]] = $role[$i];
        }
       echo "<pre>"; print_r($assign_data); die();
    }

    public function delete_user($id) {
        $result = $this->Student_model->delete_guardian($id);
        if ($result) {
            $json['success'] = true;
            $json['message'] = "Guardian successfully deleted.";
            $record['guardians'] = $this->Student_model->get_all_guardians();
            $json['guardian_html'] = $this->load->view('student/guardian_listing', $record, true);

        } else {
            $json['error'] = true;
            $json['message'] = "Seems to an error in delete guardian record.";
        }
        if($this->input->is_ajax_request()) {
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
                                    );

            //echo "<pre>"; print_r($update_guardian_data); die();
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
            $result = $this->Student_model->update_guardian($update_guardian_data, $id);
            $relation = $this->Student_model->update_student_guardian($guardian_data['relation']);
            if ($result || $relation ) {
                $this->session->set_flashdata('success', 'Employee successfully updated.');
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

}