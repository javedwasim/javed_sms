<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class Attendance extends MY_Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function register(){
	    	$json['register_html'] = $this->load->view('attendance/register', '', true);
	    	if($this->input->is_ajax_request()) {
		      set_content_type($json);
		    }
    	}

    	public function reports(){
	    	$json['reports_html'] = $this->load->view('attendance/reports', '', true);
	    	if($this->input->is_ajax_request()) {
		      set_content_type($json);
		    }
    	}

    	public function student_report_page(){
    		$json['reports_html'] = $this->load->view('attendance/report_page','',true);
    		if($this->input->is_ajax_request()){
    			set_content_type($json);
    		}
    	}


	}


?>