<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guardians extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->helper('content-type');

    }
    public function guardians()
    {
        $record['guardians'] = $this->Student_model->get_all_guardians();
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
        if ($this->form_validation->run() == FALSE) {
            $json['error'] = true;
            $json['message'] = validation_errors();
        } else {
            $guardian_data = $this->input->post();
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
                    $guardian_data['photo'] = $imageDetailArray['file_name'];
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error in image uploading.";
                }
            }
            $result = $this->Student_model->add_new_guardian($guardian_data);
            if ($result) {
                $json['success'] = true;
                $json['message'] = "Guardian successfully added.";
                $record['guardians'] = $this->Student_model->get_all_guardians();
                $json['guardian_html'] = $this->load->view('parts/guardian_list', $record, true);
            } else {
                $json['error'] = true;
                $json['message'] = "Seems to an error. Please try again.";
            }
        }
        if($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

}