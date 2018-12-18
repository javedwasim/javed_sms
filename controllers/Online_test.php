<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Online_test extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
            $this->load->model('General_model');
            $this->load->model('Test_model');
            $this->load->model('Batches_model');
            $this->load->model('Fee_model');
            $this->load->helper('content-type');
            $this -> load -> library('form_validation');
		}

        public function manage_subjects(){
            $data['subjects'] = $this->Test_model->get_subjects();
            $data['classes'] = $this->Test_model->get_classes();
            $json['subjects_html'] = $this->load->view('online/subjects', $data, true);
            if($this->input->is_ajax_request()) {
              set_content_type($json);
            }
        }

        public function edit_exam_subjects(){
            $filter = $this->input->post();
            $data['subject'] = $this->Test_model->get_course_subjects($filter);
            $data['classes'] = $this->Test_model->get_classes();
            $data['class_id'] = $filter['course_id'];
            $data['subject_id'] = $filter['subject_id'];

            $json['result_html'] = $this->load->view('online/edit_exam_subj', $data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function add_exam_subjects(){
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('course_id', 'Class Name', 'required|xss_clean');
            $this->form_validation->set_rules('subject_name', 'Subject Name', 'required|xss_clean');
            $data = $this->input->post();

            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {

                $result = $this->Test_model->add_exam_subjects($data);
                if ($result) {
                    $json['success'] = true;
                    $json['message'] = "Subject successfully added.";
                    $data['subjects'] = $this->Test_model->get_subjects();
                    $data['classes'] = $this->Test_model->get_classes();
                    $json['subjects_html'] = $this->load->view('online/subjects', $data, true);
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error.";
                }
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function save_exam_subjects() {
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('course_id', 'Class Name', 'required|xss_clean');
            $this->form_validation->set_rules('subject_name', 'Subject Name', 'required|xss_clean');

            $data = $this->input->post();
            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {
                $result = $this->Test_model->save_exam_subjects($data);
                if ($result) {
                    $json['success'] = true;
                    $json['message'] = "Subject save successfully!.";
                    $data['subjects'] = $this->Test_model->get_subjects();
                    $data['classes'] = $this->Test_model->get_classes();
                    $json['subjects_html'] = $this->load->view('online/subjects', $data, true);
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seem to be an error.";
                    $data['subjects'] = $this->Test_model->get_subjects();
                    $data['classes'] = $this->Test_model->get_classes();
                    $json['subjects_html'] = $this->load->view('online/subjects', $data, true);
                }
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function delete_subject($id) {
            $result = $this->Test_model->delete_subject($id);
            if ($result) {
                $json['success'] = true;
                $json['message'] = "Subject successfully deleted.";

                $data['subjects'] = $this->Test_model->get_subjects();
                $data['classes'] = $this->Test_model->get_classes();
                $json['subjects_html'] = $this->load->view('online/subjects', $data, true);
            } else {
                $json['error'] = true;
                $json['message'] = "Seems to an error.";
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function manage_exam(){
            //$data['subjects'] = $this->Test_model->get_subjects();
            $data['subjects'] = $this->Test_model->get_subject_detail();
            $data['examinations'] = $this->Test_model->get_examination();
            $data['batches'] = $this->Batches_model->get_all_batches();
            //print_r($data['examinations']); die();
            $json['result_html'] = $this->load->view('online/exam', $data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function get_course_subjects($id){
            $subjects = $this->Test_model->get_subjects_by_course($id);
            $options = '';
            foreach ($subjects as $subject){
                $name = $subject['subject_name'];
                $id = $subject['id'];
                $options.="<option value='$id'>$name</option>";
            }

           echo $options;
        }

        public function add_exam(){
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('exam_name', 'Exam Name', 'required|xss_clean');
            $this->form_validation->set_rules('exam_date', 'Exam Date', 'required|xss_clean');
            $this->form_validation->set_rules('start_time', 'Start Time', 'required|xss_clean');
            $this->form_validation->set_rules('no_of_question', 'No of question', 'required|xss_clean');
            $this->form_validation->set_rules('marks_per_question', 'Marks per question', 'required|xss_clean');
            $this->form_validation->set_rules('duration', 'Exam duration', 'required|xss_clean');

            $data = $this->input->post();
            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {
                if(isset($data['exam_id'])){
                    $result = $this->Test_model->update_exam($data);
                    $json['message'] = "Exam successfully updated.";
                }else{
                    $result = $this->Test_model->add_exam($data);
                    $json['message'] = "Exam successfully added.";
                }
                if ($result) {
                    $json['success'] = true;
                    $data['subjects'] = $this->Test_model->get_subject_detail();
                    $data['examinations'] = $this->Test_model->get_examination();
                    $json['result_html'] = $this->load->view('online/exam', $data, true);
                } else {
                    $json['error'] = true;
                    $json['message'] = "Seems to an error.";
                }
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function edit_exam(){
            $filter = $this->input->post();
            $data['exam'] = $this->Test_model->get_exams($filter);
            $data['subjects'] = $this->Test_model->get_subject_detail();
            $data['classes'] = $this->Test_model->get_classes();
            $data['class_id'] = $filter['course_id'];
            $data['subject_id'] = $filter['subject_id'];
            $json['result_html'] = $this->load->view('online/edit_exam', $data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function delete_exam($id) {
            $result = $this->Test_model->delete_exam($id);
            if ($result) {
                $json['success'] = true;
                $json['message'] = "Exam successfully deleted.";

                $data['subjects'] = $this->Test_model->get_subjects();
                $data['classes'] = $this->Test_model->get_classes();
                $data['examinations'] = $this->Test_model->get_examination();
                $json['result_html'] = $this->load->view('online/exam', $data, true);
            } else {
                $json['error'] = true;
                $json['message'] = "Seems to an error.";
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function manage_que_ans(){
            $data['examinations'] = $this->Test_model->get_examination();
            $data['questions'] = $this->Test_model->get_exam_questions();
            $json['result_html'] = $this->load->view('online/exam_question', $data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function add_question(){
            $this->load->library('form_validation');
            $this->load->helper('security');
            $this->form_validation->set_rules('exam_id', 'Exam Name', 'required|xss_clean');
            $this->form_validation->set_rules('question', 'Exam Question', 'required|xss_clean');
            $this->form_validation->set_rules('answer_option[]', 'Answer Option', 'required|xss_clean');
            $this->form_validation->set_rules('correct_ans', 'Correct Answer', 'required|xss_clean');

            $data = $this->input->post();
            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            } else {
                if(isset($data['question_id'])){
                    $result = $this->Test_model->update_exam_question($data);
                    $json['message'] = "Question successfully updated.";
                }else{
                    $result = $this->Test_model->add_exam_question($data);
                    $json['message'] = "Question successfully added.";
                }
                if ($result) {
                    $json['success'] = true;
                    $data['examinations'] = $this->Test_model->get_examination();
                    $data['questions'] = $this->Test_model->get_exam_questions();
                    $json['result_html'] = $this->load->view('online/exam_question', $data, true);
                } else {
                    $json['error'] = true;
                    $json['message'] = "Question limit exceeded.";
                }
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function edit_exam_question($id){
            $data['examinations'] = $this->Test_model->get_examination();
            $data['question'] = $this->Test_model->get_exam_question($id);
            $json['result_html'] = $this->load->view('online/edit_exam_question', $data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function delete_exam_question($id) {
            $result = $this->Test_model->delete_exam_question($id);
            if ($result) {
                $json['success'] = true;
                $json['message'] = "Question successfully deleted.";

                $data['examinations'] = $this->Test_model->get_examination();
                $data['questions'] = $this->Test_model->get_exam_questions();
                $json['result_html'] = $this->load->view('online/exam_question', $data, true);
            } else {
                $json['error'] = true;
                $json['message'] = "Seems to an error.";
            }
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function student_exam(){
            $data['examinations'] = $this->Test_model->get_examination();
            $json['result_html'] = $this->load->view('online/student_exam', $data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function get_exam_questions(){
            $exam_id = $this->input->post('exam_id');
            $data['questions'] = $this->Test_model->get_student_exam($exam_id);
            $data['student'] = $this->Test_model->get_logged_student();
            $json['result_html'] = $this->load->view('online/online_exam_questions', $data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function save_exam(){
            $data = $this->input->post();
            $exam_id = $data['exam_id'];
            $this->load->library('form_validation');
            $this->load->helper('security');
            $questions = $this->Test_model->get_student_exam($exam_id);
            $count = 1;
            foreach ($questions as $question){
                $this->form_validation->set_rules($question['id'], 'Question '.$count, 'required|xss_clean');
                $count++;
            }
            if ($this->form_validation->run() == FALSE) {
                $json['error'] = true;
                $json['message'] = validation_errors();
            }else{

                $result = $this->Test_model->get_student_test($data);
                if($result){
                    $this->Test_model->save_student_exam($data);
                    $json['success'] = true;
                    $json['message'] = 'Test save successfully.';
                }else{
                    $json['error'] = true;
                    $json['message'] = 'Test has already been taken.';
                }
            }


            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }


        public function exam_result(){
            $user_data = $this->session->userdata('userdata');
            if($user_data['name']!='admin'){
                $student = $this->Test_model->get_logged_student();
            }else{
                $student = array();
            }
            $data['students'] = $this->Test_model->get_all_students();
            $data['batches'] = $this->Batches_model->get_all_batches();
            $data['examinations'] = $this->Test_model->get_examination();
            $data['student_data'] = $student;
            $json['success'] = true;
            $json['result_html'] = $this->load->view('online/exam_result',$data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function student_exam_result(){
            $data = $this->input->post();
            $exam_id = $data['exam_id'];
            if(isset($data['student_id'])){
                $student_id = $data['student_id'];
            }else{
                $result = $this->Test_model->get_logged_student();
                $student_id = $result['student_id'];
            }
            $data_result = array();
            if(isset($data['batch_no']) && !empty($data['batch_no'])){

               $batch_no =  $data['batch_no'];
               $students = $this->Test_model->get_batch_students($batch_no);

               foreach($students as $student){
                   $std_result = $this->get_student_result($student['student_id'],$exam_id);
                   if(!empty($std_result)){
                       $data_result[] = $std_result;
                   }
               }

                if(!empty($data_result)){
                    $json['success'] = true;
                    $data['std_results']=$data_result;
                    $json['result_html'] = $this->load->view('online/student_exam_result',$data, true);
                }else{
                    $json['error'] = true;
                    $json['message'] = 'Result not found.';
                }

            }else{
                $std_result = $this->get_student_result($student_id,$exam_id);
                if(!empty($std_result)){
                    $json['success'] = true;
                    $json['result_html'] = $this->load->view('online/student_exam_result',$std_result, true);
                }else{
                    $json['error'] = true;
                    $json['message'] = 'Result not found.';
                }
            }

            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

        public function get_student_result($student_id,$exam_id){
            $exam_result = $this->Test_model->get_student_result($student_id,$exam_id);
            if($exam_result){
                $json['success'] = true;
                $result_array = array();
                foreach ($exam_result as $result){
                    if($result['student_option']==$result['correct_answer_id']){
                        array_push($result_array,$result['correct_answer_id']);
                    }
                }
                $data['total_question']  = $exam_result[0]['total_questions'];
                $data['student_id']      = $student_id;
                $data['exam_name']       = $exam_result[0]['exam_name'];
                $data['correct_answers'] = count($result_array);
                $data['student_name']    = $exam_result[0]['first_name'].' '.$exam_result[0]['last_name'];
                return $data;
                //$json['result_html'] = $this->load->view('online/student_exam_result',$data, true);
            }else{
                return array();
            }

        }

        public function stripe_payment(){
            $data['batch_id'] = '';
            $data['students'] = $this->Test_model->get_all_students();
            $data['examinations'] = $this->Test_model->get_examination();
            $data['batches'] = $this->Batches_model->get_all_batches();
            $data['payments'] = $this->Fee_model->get_payments();
            $data['fee_types'] = $this->Fee_model->get_fees();

            $json['success'] = true;
            $json['result_html'] = $this->load->view('online/payment_form',$data, true);
            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }
        }

        public function payment_success()
        {
            $this->load->view('online/payment_success');
        }

        public function check()
        {
            //check whether stripe token is not empty
            if(!empty($_POST['stripeToken']))
            {
                $data = $this->input->post();
                //get token, card and user info from the form
                $token  = $data['stripeToken'];
                $email = $data['email'];
                //include Stripe PHP library
                require_once APPPATH."third_party/stripe/init.php";
                //set api key
                $stripe = array(
                    "secret_key"      => "sk_test_NU8gMdBYyZj96ilvbdwix5ir",
                    "publishable_key" => "pk_test_GJTsu9uDvyFCkc2GFAvubaI6"
                );

                \Stripe\Stripe::setApiKey($stripe['secret_key']);
                //add customer to stripe
                $customer = \Stripe\Customer::create(array(
                    'email' => $email,
                    'source'  => $token
                ));
                //item information
                $itemName = "Student Fee";
                $itemNumber = "PS123456";
                $itemPrice = $data['amount_paid']*100;
                $currency = "usd";
                $orderID = "SKA92712382139";

                //charge a credit or a debit card
                $charge = \Stripe\Charge::create(array(
                    'customer' => $customer->id,
                    'amount'   => $itemPrice,
                    'currency' => $currency,
                    'description' => $itemNumber,
                    'metadata' => array(
                        'item_id' => $itemNumber
                    )
                ));

                //retrieve charge details
                $chargeJson = $charge->jsonSerialize();
                //check whether the charge is successful
                if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1)
                {
                    $payment_id =$this->Test_model->create_payment($chargeJson,$data);
                    $json['success'] = true;
                    $json['message'] = 'Seem to be an error!';
                    $this->session->set_flashdata('error', array('insertID' => "Payment Successful # ".$payment_id['order_id'],'class' => 'success'));
                    redirect('/online_test/payment_success');
                    exit();
                }
                else
                {
                    $json['error'] = true;
                    $json['message'] = 'Seem to be an error!';
                }
            }

            if($this->input->is_ajax_request()) {
                set_content_type($json);
            }

        }

}

?>