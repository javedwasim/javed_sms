<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model');
        $this->load->model('Student_model');
        $this->load->model('Batches_model');
        $this->load->model('Fee_model');
        $this->load->helper('cookie');
    }

    public function index() {

        $this->load->model('General_model');
        $institution = $this->General_model->get_institution();
        $this->session->set_userdata('institution_detail', $institution);

        if (!$this->session->userdata('is_logged_in')) {
            $this->load->view('login');
        } else {
            $user_data = $this->session->userdata('userdata');
            //print_r($user_data); die();
            $user_name = $user_data['name'];
            $query = $this->db->select('*')->from('students')->where('username',$user_name)->limit(1)->get();
            $gquery = $this->db->select('*')->from('guardians')->where('username',$user_name)->limit(1)->get();
            $equery = $this->db->select('*')->from('employees')->where('username',$user_name)->limit(1)->get();
            $e_result = $equery->row_array();
            $g_result = $gquery->row_array();
            $role_q = $this->db->select('*')->from('employee_categories')->where('id',$e_result['category'])->limit(1)->get();
            $role = $role_q->row_array();
            if($query->num_rows()>0){
                $result = $query->row_array();
                $student_id = $result['student_id'];
                $data = $this->Student_model->get_student_by_id($student_id);
                $record['guardians'] = $this->Student_model->get_student_guardian($student_id);
                $record['student'] = $data;
                $record['student_id'] = $student_id;
                $record['screen'] = 'student_profile';
                $this->session->set_userdata('profile_student_id', $student_id);
                $record['photo'] = "assets/uploads/student_images/".$result['photo'];
                $json['student_html'] = $this->load->view('student/index', $record);
            }elseif(isset($role) && ($role['role_id'] == 6)){
                $filter = $this->input->post();
                $data['batch_id'] = '';
                $data['batches'] = $this->Batches_model->get_all_batches();
                $data['payments'] = $this->Fee_model->get_all_fee($filter);
                $data['fee_types'] = $this->Fee_model->get_fees();
                $data['fee_status'] = $this->Fee_model->get_fee_status();
                $data['filter'] = $filter;
                if(isset($e_result['employee_id'])){
                    $this->session->set_userdata('profile_employee_id', $e_result['employee_id']);
                }

                $data['photo'] = "assets/uploads/employee_images/".$e_result['photo'];
                $json['result_html'] = $this->load->view('fee/index', $data);

            }
            elseif($gquery->num_rows()>0){
                $result = $gquery->row_array();
                $guardian_id = $result['guardian_id'];
                $data['guardian'] = $this->Student_model->get_guardian_by_id($guardian_id);
                $data['countries'] = $this->Student_model->get_all_countries();
                $data['states'] = $this->Student_model->get_all_states();
                $data['origins'] = $this->Student_model->get_all_origins();
                $data['wards'] = $this->Student_model->get_guardian_wards($guardian_id);
                $data['screen'] = 'guardian_profile';
                $this->session->set_userdata('profile_employee_id', $g_result['guardian_id']);
                $record['photo'] = "assets/uploads/student_images/".$result['photo'];
                $this->load->view('student/index', $data);
            }elseif($equery->num_rows()>0){
                $record['batches'] = $this->Batches_model->get_all_batches();
                $record['sessions'] = $this->Batches_model->get_all_sessions();
                $record['classes'] = $this->Batches_model->get_all_classes();
                $record['rights'] = $this->session->userdata('other_rights');
                $record['userdata'] = $this->session->userdata('userdata');
                $this->session->set_userdata('profile_employee_id', $e_result['employee_id']);
                $record['photo'] = "assets/uploads/employee_images/".$e_result['photo'];
                $json['batch_html'] = $this->load->view('batches/index', $record);
            }else{
                $data['students'] = $this->Student_model->get_all_students();
                $data['photo'] = '';
                $this->load->view('student/index', $data);
            }

        }
    }

    public function dashboard() {
        $this->load->view('parts/header');
        $this->load->view('parts/topbar');
        $this->load->view('parts/sidebar');
        $this->load->view('dashboard/dashboard');
        $this->load->view('parts/footer');
    }

    public function login() {
        //$hashToStoreInDb = password_hash('admin', PASSWORD_BCRYPT); print_r($hashToStoreInDb); die();
        $coookie = $this->input->cookie('username',TRUE);
        $password = $this->input->cookie('password',TRUE);
        if (!$this->session->userdata('is_logged_in')) {
            if ($this->input->post()) {
                $user_email = $this->input->post('email');
                $result = $this->Dashboard_model->get_user_by_email($user_email);
                if ($result) {
                    if (password_verify($this->input->post('password'), $result['password'])) {
                        if($this->input->post('remember-me')=='on'){
                            $user_cookie  = array(
                                'name'  => 'username',
                                'value'  => $this->input->post('email'),
                                'expire' => '86500',
                            );
                            set_cookie($user_cookie);
                            $password_cookie  = array(
                                'name'  => 'password',
                                'value'  => $this->input->post('password'),
                                'expire' => '86500',
                            );
                            set_cookie($user_cookie);
                            set_cookie($password_cookie);

                        }else{
                            delete_cookie("password");
                            delete_cookie("username");

                        }
                        $this->session->set_userdata('userdata', $result);
                        $this->session->set_userdata('is_logged_in', '1');
                        $other_rights = $this->Dashboard_model->get_other_rights_detail();
                        $this->session->set_userdata('other_rights', $other_rights);
                        redirect('dashboard');
                        
                    } else {
                        $this->session->set_flashdata('error', "Wrong username or password.");
                        redirect('/');
                    }
                } else {
                    $this->session->set_flashdata('error', "Wrong username or password.");
                    redirect('/');
                }
            } else {
                //$this->session->set_flashdata('error', "Wrong user name or password.");
                $this->load->view('login');
            }
        }
    }

    public function get_menus() {
        $this->load->model('model_menu');
        $menus_array = $this->model_menu->fetch_menu();
        $this->load->helper('menu');
        $data['menu_result'] = print_menu(0, $menus_array);
        $data['user_data'] = $this->session->userdata('userdata');
        $this->load->view('parts/menu', $data);
    }

    public function get_menus_search($menu) {
        $this->load->model('model_menu');
        if($menu!='all'){
            $menus_array = $this->model_menu->fetch_menu_search($menu);
            $parent_menu = array();
            $setting_menu = array();
            foreach ($menus_array as $menu){
                if($menu->parent_id!=25){
                    $parent_menu[] = $menu->menu_id;
                }else{
                    $parent_menu[] = $menu->menu_id;
                    $setting_menu[] = $menu->parent_id;
                }

            }
            $menu_list = ltrim(implode(',', $parent_menu),',');
            $menu_list = rtrim($menu_list,',');
            $menus_array = $this->model_menu->fetch_menu_by_id($menu_list,$setting_menu);
        }else{
            $menus_array = $this->model_menu->fetch_menu();
        }
        $this->load->helper('menu');
        $data['menu_result'] = print_menu(0, $menus_array);
        $data['user_data'] = $this->session->userdata('userdata');
        $json['sidebar_html'] = $this->load->view('parts/menu', $data,true);
        if ($this->input->is_ajax_request()) {
            set_content_type($json);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/');
    }

    public function error_page(){
        $this->output->set_status_header('404');
        $data['screen'] = 'error';
        $this->load->view('student/index',$data);
    }

}
