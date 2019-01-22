<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
Class General_model extends CI_Model {

    public function get_classes(){
        $result = $this->db->select('*')
            ->from('classes')
            ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function add_new_class($data) {
        $this->db->insert('classes', $data);
        return $this->db->insert_id();
    }

    public function delete_class($id) {
        $this->db->where('id', $id)->delete('classes');
        return $this->db->affected_rows();
    }

    public function update_class($student_data, $student_id) {
        $this->db->where('id', $student_id)->update('classes', $student_data);
        return $this->db->affected_rows();
    }


    public function get_all_students() {
        $this->db->select('s.*,b.arm,b.session,c.code');
        $this->db->from('students s');
        $this->db->join('batches b', 'b.id=s.batch_no', 'left');
        $this->db->join('classes c', 'c.id=b.course_id', 'left');
        $this->db->order_by('s.student_id','desc');
        $result = $this->db->get();
		//$result = $this->db->select('*')->from('students')->get();
		if($result) {
			return $result->result_array();
		} else {
			return array();
		}
	}

	public function add_form_fields($data) {
		$this->db->insert('profile_fields', $data);
		return $this->db->insert_id();
	}

	public function get_form_fields($id) {
		$result = $this->db->select('*')
                    ->from('profile_group_detail')
                    ->where('profile_setting_id',$id)
                    ->get();
		if ($result) {
			return $result->result_array();
		} else {
			return array();
		}
		
	}

	public function update_form_fields($data, $where) {
		$this->db->where('profile_field_type', $where)
		->update('profile_fields', $data);
		return $this->db->affected_rows();
	}

    public function update_student_form_fields($data) {
	    $update_data = array();

        $student_fields = $this->get_form_fields(1);
        foreach ($data as $key=>$value){
            $update_data[] = $key;
        }

	    foreach ($student_fields as $field){
            if(array_search($field['field_name'],$update_data)){

                $this->db->where('field_name', $field['field_name'])->where('profile_setting_id', 1)->update('profile_group_detail', array('add_view'=>1));
            }else{
                $this->db->where('field_name', $field['field_name'])->where('profile_setting_id', 1)->update('profile_group_detail', array('add_view'=>0));
            }
        }
        return $this->db->affected_rows();
    }

    public function update_guardian_form_fields($data) {
        $update_data = array();
        $guardian_fields = $this->get_form_fields(2);
        foreach ($data as $key=>$value){
            $update_data[] = $key;
        }
        //print_r($update_data); die();
        foreach ($guardian_fields as $field){
            if(array_search($field['field_name'],$update_data)){

                $this->db->where('field_name', $field['field_name'])->where('profile_setting_id', 2)->update('profile_group_detail', array('add_view'=>1));
            }else{
                $this->db->where('field_name', $field['field_name'])->where('profile_setting_id', 2)->update('profile_group_detail', array('add_view'=>0));
            }
        }
        return $this->db->affected_rows();
    }

	public function get_all_countries() {
		$result = $this->db->select('*')
						->from('countries_list')
						->get();
		if ($result) {
			return $result->result_array();
		} else {
			return array();
		}
		
	}

	public function add_new_student($student_data) {
		$this->db->insert('students', $student_data);
		return $this->db->insert_id();
	}

	public function get_student_by_id($student_id) {
		$result = $this->db->select('*')
						->from('students')
						->where('student_id', $student_id)
						->limit(1)
						->get();
		if ($result) {
			return $result->row_array();
		} else {
			return array();
		}
	}

	public function update_student($student_data, $student_id) {
		$this->db->where('student_id', $student_id)->update('students', $student_data);
		return $this->db->affected_rows();
	}

	public function delete_student($student_id) {
		$this->db->where('student_id', $student_id)->delete('students');
		return $this->db->affected_rows();
	}

	public function add_new_guardian($guardian_data) {
		$this->db->insert('guardians', $guardian_data);
		return $this->db->insert_id();
	}

	public function get_all_guardians() {
		$result = $this->db->select('*')
						->from('guardians')
						->get();
		if ($result) {
			return $result->result_array();
		} else {
			return array();
		}
	}

	public function  get_students_by_filters($filters){
	    $where = " 1 ";
	    if(isset($filters['search-employee']) && (!empty($filters['search-employee'])) ){
	       $name = $filters['search-employee'];
           $where =  "(surname LIKE '%$name%' or first_name LIKE '%$name%' or last_name LIKE '%$name%')";
        }
        if(isset($filters['admit_date']) && (!empty($filters['admit_date'])) ){
            $admit_date = $filters['admit_date'];
            $where .=  " AND (admission_date = '' OR admission_date = '$admit_date')";
        }

        if(isset($filters['batch_no']) && (!empty($filters['batch_no'])) ){
            $batch_no = $filters['batch_no'];
            $where .=  " AND (batch_no = '' OR batch_no = '$batch_no')";
        }

        if(isset($filters['dob']) && (!empty($filters['dob'])) ){
            $dob = $filters['dob'];
            $where .=  " AND (date_of_birth = '' OR date_of_birth = '$dob')";
        }

        if(isset($filters['gender']) && (!empty($filters['gender'])) ){
            $gender = $filters['gender'];
            $where .=  " AND (gender = '' OR gender = '$gender')";
        }

        $sql = "SELECT students.*,batches.arm,batches.session,classes.code FROM students 
                left join batches on batches.id = students.batch_no
                left join classes on classes.id = batches.course_id
                where $where";
        $result = $query = $this->db->query($sql);
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function get_all_batches(){
        $this->db->select('b.*,c.code');
        $this->db->from('batches b');
        $this->db->join('classes c', 'c.id=b.course_id', 'left');
        $this->db->order_by('b.session','asc');
        $result = $this->db->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function add_student_category($data) {
        $this->db->insert('student_categories', $data);
        return $this->db->insert_id();
    }

    public function update_category($data, $id) {
        $this->db->where('id', $id)
            ->update('student_categories', array('category'=>$data));
        return $this->db->affected_rows();
    }

    public function get_all_student_categories(){
        $result = $this->db->select('*')
                    ->from('student_categories')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function delete_student_category($id) {
        $this->db->where('id', $id)->delete('student_categories');
        return $this->db->affected_rows();
    }

    public function add_new_subject($data) {
        $this->db->insert('subjects', $data);
        return $this->db->insert_id();
    }

    public function get_all_subjects() {
        $sql = "SELECT s.*,sd.subject_count FROM subjects s 
                LEFT JOIN(
                    SELECT sd.subject_id,count(id) as subject_count FROM subjects_detail sd 
                    GROUP BY sd.subject_id
                )sd ON sd.subject_id = s.id";
        $result = $query = $this->db->query($sql);
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function update_subject($data, $id) {
        $this->db->where('id', $id)->update('subjects', $data);
        return $this->db->affected_rows();
    }

    public function delete_subject($id) {
        $this->db->where('id', $id)->delete('subjects');
        return $this->db->affected_rows();
    }

    public function save_institution($data) {
        $result = $this->db->select('id')->from('institutions')->where('id',1)->limit(1)->get();

        if ($result->num_rows()>0) {
            $this->db->where('id', 1)->update('institutions', $data);
            return 1;
        } else {
            $this->db->insert('institutions', $data);
            return $this->db->insert_id();
        }
    }

    public function add_new_session($data) {

        $insert_data = array(
            'name'=>$data['name'],
            'first_term_start'=>date('Y-m-d',strtotime($data['first_term_start'])),
            'first_term_end'=>date('Y-m-d',strtotime($data['first_term_end'])),
            'second_term_start'=>date('Y-m-d',strtotime($data['second_term_start'])),
            'second_term_end'=>date('Y-m-d',strtotime($data['second_term_end'])),
            'third_term_start'=>date('Y-m-d',strtotime($data['third_term_start'])),
            'third_term_end'=>date('Y-m-d',strtotime($data['third_term_end'])),
        );

        $this->db->insert('acadamic_sessions', $insert_data);
        return $this->db->insert_id();
    }

    public function get_all_sessions(){
        $result = $this->db->select('*')
                    ->from('acadamic_sessions')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function update_session($data, $id) {
        $this->db->where('id', $id)->update('acadamic_sessions', $data);
        return $this->db->affected_rows();
    }

    public function delete_session($id) {
        $this->db->where('id', $id)->delete('acadamic_sessions');
        return $this->db->affected_rows();
    }

    public function get_institution_detail(){
        $result = $this->db->select('*')
                    ->from('institutions')
                    ->get();
        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    public function get_institution(){
        $result = $this->db->select('*')
                    ->from('institutions')
                    ->limit(1)
                    ->get();
        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    public function get_all_domains(){
        $affective = $this->db->select('*')
                    ->from('domain_goup')
                    ->where('learning_domain','affective')
                    ->get();

        $psychomotor = $this->db->select('*')
                    ->from('domain_goup')
                    ->where('learning_domain','psychomotor')
                    ->get();

        $result = array();
        if ($psychomotor || $affective) {
            $result['affective'] =  $affective->result_array();
            $result['pychomotor'] =  $psychomotor->result_array();
            return $result;
        } else {
            return array();
        }

    }

    public function update_class_set_domain($data){
        $batches = $this->get_batches_course_session($data['course_id'],$data['session']);
        //delete last batch learning domain.
        $learning_domain_ids = array();
        foreach ($batches as $batch){
            $this->db->where('course_id',$batch['course_id'])
                    ->where('session',$batch['session'])
                    ->delete('class_set_learning_domain');

        }
        //insert new entries
        foreach ($batches as $batch){
            if($data['affective_domain']){
                $this->db->insert('class_set_learning_domain',
                    array(
                        'batch_id'=>$batch['id'],
                        'domain_group_id'=>$data['affective_domain'],
                        'course_id'=>$batch['course_id'],
                        'session'=>$batch['session']
                    ));
                $effective_domain_id = $this->db->insert_id();
                $learning_domain_ids['affective_domain_id'] = $effective_domain_id;
            }
            if($data['phychomotor_domain']){
                $this->db->insert('class_set_learning_domain',
                    array(
                        'batch_id'=>$batch['id'],
                        'domain_group_id'=>$data['phychomotor_domain'],
                        'course_id'=>$batch['course_id'],
                        'session'=>$batch['session']
                    ));
                $phychomotor_domain_id = $this->db->insert_id();
                $learning_domain_ids['phychomotor_domain_id'] = $phychomotor_domain_id;
            }
        }
        return $learning_domain_ids;
    }

    public function get_class_set_domain($course_id,$session){
        $result = $this->db->select('cd.domain_group_id')
                    ->from('class_set_learning_domain cd')
                    ->join('domain_goup dg','dg.id = cd.domain_group_id')
                    ->where('course_id',$course_id)
                    ->where('session',$session)
                    ->group_by('domain_group_id')
                    ->get();
        //$this->db->last_query();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_class_set(){
        $query = "SELECT b.*, c.code,student_count,bas.employee_id,c.name as class_name
                    FROM batches b 
                    LEFT JOIN classes c ON c.id=b.course_id 
                    LEFT JOIN (
                        select student_id,batch_no,Count(students.student_id) as student_count
                        FROM students 
                        GROUP by batch_no
                    )students on students.batch_no = b.id
                    LEFT JOIN batch_assign_employee bas on bas.batch_id = b.id
                    where 1
                    GROUP BY b.id
                    ORDER BY b.session ASC";
        $result = $query = $this->db->query($query);
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_batches_course_session($course_id,$session){

        $query = "SELECT b.*, c.code,student_count,bas.employee_id
                    FROM batches b 
                    LEFT JOIN classes c ON c.id=b.course_id 
                    LEFT JOIN (
                        select student_id,batch_no,Count(students.student_id) as student_count,
                        students.last_name,students.first_name
                        FROM students 
                        GROUP by batch_no
                    )students on students.batch_no = b.id
                    LEFT JOIN batch_assign_employee bas on bas.batch_id = b.id
                    WHERE course_id = $course_id AND session =  '$session'            
                    GROUP By b.id
                    ORDER BY b.session ASC";
        $result = $query = $this->db->query($query);
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_lga_origin(){
        $result = $this->db->select('cities.*,states.name as state_name')
            ->from('cities')
            ->join('states','states.id=cities.state_id','left')
            ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function get_states(){
        $result = $this->db->select('*')
            ->from('states')
            ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function add_state_origin($data) {
        unset($data['city_id']);
        $this->db->insert('cities', $data);
        return $this->db->insert_id();
    }

    public function get_origin_by_id($id){
        $result = $this->db->select('cities.*,states.name as state_name')
            ->from('cities')
            ->join('states','states.id=cities.state_id','left')
            ->where('cities.id',$id)
            ->limit(1)
            ->get();
        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }

    }

    public function update_state_origin($data) {
        $id = $data['city_id'];
        $this->db->where('id', $id)->update('cities', array('name'=>$data['name'],'state_id'=>$data['state_id']));
        return $this->db->affected_rows();
    }

    public function delete_origin($id) {
        $this->db->where('id', $id)->delete('cities');
        return $this->db->affected_rows();
    }

}