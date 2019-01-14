<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
Class Reportcard_model extends CI_Model {

    public function save_report_card_group($data){

        $this->db->insert('report_card_group', $data);
        return $this->db->insert_id();
    }


	public function get_report_card_group() {
        $student = $this->logged_user_info();
        if($student){
            $this->db->select('rc.*,c.name as class_name,c.code, b.session,b.arm');
            $this->db->from('report_card_group rc');
            $this->db->join('batches b', 'b.id=rc.course_set_id', 'left');
            $this->db->join('classes c', 'c.id=b.course_id', 'left');
            $this->db->where('course_set_id',$student['batch_no']);
            $result = $this->db->get();
        }else{
            $this->db->select('rc.*,c.name as class_name,c.code, b.session,b.arm');
            $this->db->from('report_card_group rc');
            $this->db->join('batches b', 'b.id=rc.course_set_id', 'left');
            $this->db->join('classes c', 'c.id=b.course_id', 'left');
            $result = $this->db->get();
        }
        //echo $this->db->last_query();
		if($result) {
			return $result->result_array();
		} else {
			return array();
		}
	}

	public function get_report_card_group_bY_id($id){
        $this->db->select('rc.*,c.name as class_name');
        $this->db->from('report_card_group rc');
        $this->db->join('batches b', 'b.id=rc.course_set_id', 'left');
        $this->db->join('classes c', 'c.id=b.course_id', 'left');
        $this->db->where('rc.id',$id);
        $this->db->limit(1);
        $result = $this->db->get();
        if($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    public function update_report_card_group($data) {
	    $id = $data['report_id'];
	    unset($data['report_id']);
	    if(isset($data['published'])){
            $data['published'] = 1;
        }else{
            $data['published'] = 0;
        }
        if(isset($data['status'])){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }
        $this->db->where('id', $id)->update('report_card_group', $data);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    public function delete_report_card_group($id) {
        $this->db->where('id', $id)->delete('report_card_group');
        return $this->db->affected_rows();
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

    public function get_class_set_student($class_set_id){
        //get course and session of batch
        $result = $this->db->select('batches.*,c.name as class_name')->from('batches')
                    ->join('classes c','c.id=batches.course_id','left')
                    ->where('batches.id',$class_set_id)
                    ->limit(1)
                    ->get();
        $batch_info = $result->row_array();
        //get all batches of course and session
        $result = $this->db->select('id')
                    ->from('batches')
                    ->where('session',$batch_info['session'])
                    ->where('course_id',$batch_info['course_id'])
                    ->get();
        $batches = $result->result_array();
        $batch_id = array();
        foreach ($batches as $batch){
            $batch_id[] =   $batch['id'];
        }

        //get class set students
        $batch_ids = implode(',', $batch_id);
        $result = $this->db->select('*')
                    ->from('students')
                    ->where("batch_no IN ($batch_ids)")
                    ->group_by('student_id')
                    ->group_by('batch_no')
                    ->get();
        $result_array = array();
        if($result) {
            $result_array['students'] = $result->result_array();
            $result_array['batch'] = $batch_info;
            return $result_array;
        } else {
            return array();
        }

    }

    public function get_batch_subjects($student_id,$term_id){
        $result = $this->db->select('batch_no')->from('students')->where('student_id',$student_id)->limit(1)->get();
        $student =$result->row_array();
        $batch_id = $student['batch_no'];

        $query = "SELECT sd.id as sd_id, sd.subject_id,s.name as sbj_name,stu.student_id,assessment_term, st_score,
                    surname,first_name,sd.batch_id,sae.subject_teacher
                    FROM subjects_detail sd
                    LEFT JOIN (
                        SELECT st.*,ss.subject_detail_id,
                        GROUP_CONCAT(assessment_term ORDER BY ss.subject_detail_id) as assessment_term,
                        GROUP_CONCAT(score ORDER BY ss.subject_detail_id) as st_score,ss.term_id                        
                        FROM students st
                        LEFT JOIN student_score_sheet ss on ss.student_id = st.student_id and st.batch_no = ss.batch_id   
                        WHERE ss.student_id = $student_id AND ss.term_id = $term_id
                        GROUP BY ss.subject_detail_id
                    )stu on stu.subject_detail_id = sd.id  
                    LEFT JOIN subjects s on s.id = sd.subject_id                    
                    LEFT JOIN (
                        SELECT sae.subject_detail_id,GROUP_CONCAT(DISTINCT(e.employee_id)) AS subject_teacher_id,
                        GROUP_CONCAT(DISTINCT(CONCAT(e.surname,' ',e.first_name))) AS subject_teacher
                        FROM subject_assign_employee sae
                        LEFT JOIN employees e ON e.employee_id = sae.employee_id  
                        GROUP BY sae.subject_detail_id
                    )sae ON sae.subject_detail_id=sd.id                    
                    WHERE batch_id = $batch_id
                    GROUP BY sd.id
                    ORDER BY sbj_name";
        $result = $query = $this->db->query($query);
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

<<<<<<< HEAD
    public function get_report_summary($student_id,$term_id){
        //find student batch
        $result = $this->db->select('batch_no')->from('students')->where('student_id',$student_id)->limit(1)->get();
        $student =$result->row_array();
        $batch_id = $student['batch_no'];
        //find student position in class.
        $query = "SELECT ss.*, 
                    SUM(case when sas.points >0 then sas.points else 0 end) as total_marks,
                    SUM(case when ss.score >0 then ss.score else 0 end) as obtain_marks,
                    concat(round(( SUM(case when ss.score >0 then ss.score else 0 end)/SUM(case when sas.points >0 then sas.points else 0 end) * 100 ),2),'%') AS percentage
                    FROM student_score_sheet ss
                    LEFT JOIN subjects_detail sd on sd.id = ss.subject_detail_id
                    LEFT JOIN subject_assessments sas on sas.subject_detail_id = sd.id 
                    and ss.assessment_term = sas.abbreviation
                    WHERE ss.batch_id = $batch_id and ss.term_id = $term_id
                    group by ss.student_id  
                    ORDER BY percentage DESC";

        $records = $query = $this->db->query($query);
        $record_array = array();
        foreach ($records->result_array() as $record){
            $record_array[] = $record['student_id'];
        }
        $postion = array_search($student_id,$record_array);
        $postion = $postion+1;
        //find student percentage

        $query = "SELECT ss.*, 
                    SUM(case when sas.points >0 then sas.points else 0 end) as total_marks,
                    SUM(case when ss.score >0 then ss.score else 0 end) as obtain_marks,
                    concat(round(( SUM(case when ss.score >0 then ss.score else 0 end)/SUM(case when sas.points >0 then sas.points else 0 end) * 100 ),2),'%') AS percentage
                    FROM student_score_sheet ss
                    LEFT JOIN subjects_detail sd on sd.id = ss.subject_detail_id
                    LEFT JOIN subject_assessments sas on sas.subject_detail_id = sd.id 
                    and ss.assessment_term = sas.abbreviation
                    WHERE ss.batch_id = $batch_id and ss.term_id = $term_id and ss.student_id = $student_id
                    group by ss.student_id  
                    ORDER BY percentage DESC";

        $records = $query = $this->db->query($query);
        $percentage = $records->row_array();
        $percentage = $percentage['percentage'];

        if($percentage>=90){
            $grade = "A";
        }elseif(($percentage>=80)&&($percentage<=89)){
            $grade = "B";
        }elseif(($percentage>=70)&&($percentage<=79)){
            $grade = "C";
        }elseif(($percentage>=60)&&($percentage<=69)){
            $grade = "D";
        }elseif(($percentage>=0)&&($percentage<=59)){
            $grade = "D";
        }

        if ($result) {
            return array('percentage'=>$percentage,'position'=>$postion,'roll_no'=>$student_id,'grade'=>$grade);
        } else {
            return array();
        }
    }

=======
>>>>>>> 5a94356c82c190f32621ca477f3e6d39d612397d
    public function get_bahaviour_score_sheet($id,$term_id) {
        $this->db->select('sg.*');
        $this->db->from('student_grades sg');
        $this->db->where('student_id',$id);
        $this->db->where('term_id',$term_id);
        $this->db->limit(1);
        $result = $this->db->get();
        if($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    public function logged_user_info(){
        $user = $this->session->userdata('userdata');
        $result = $this->db->select('*')->from('students')->where('username',$user['name'])->limit(1)->get();
        return $result->row_array();
    }

    public function save_report_comment($data){
        $this->db->select('rc.*');
        $this->db->from('student_report_comments rc');
        $this->db->where('student_id',$data['student_id']);
        $this->db->where('term_id',$data['term_id']);
        $this->db->where('batch_id',$data['batch_id']);
        $this->db->where('commented_by',$data['commented_by']);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows()>0){
            $this->db->where('student_id', $data['student_id'])
                ->where('term_id', $data['term_id'])
                ->where('batch_id', $data['batch_id'])
                ->where('commented_by',$data['commented_by'])
                ->update('student_report_comments', $data);
            return $this->db->affected_rows();
        }else{
            $this->db->insert('student_report_comments', $data);
            return $this->db->insert_id();
        }

    }

    public function get_report_comment($student,$term_id){
        $this->db->select('rc.*');
        $this->db->from('student_report_comments rc');
        $this->db->where('student_id',$student['student_id']);
        $this->db->where('batch_id',$student['batch_no']);
        $this->db->where('term_id',$term_id);
        $this->db->where('commented_by','principal');
        $this->db->limit(1);
        $principal = $this->db->get();

        $this->db->select('rc.*');
        $this->db->from('student_report_comments rc');
        $this->db->where('student_id',$student['student_id']);
        $this->db->where('batch_id',$student['batch_no']);
        $this->db->where('term_id',$term_id);
        $this->db->where('commented_by','teacher');
        $this->db->limit(1);
        $teacher = $this->db->get();

        if($principal || $teacher) {
            $data['principal'] = $principal->row_array();
            $data['teacher']   = $teacher->row_array();
            return $data;
        } else {
            return array();
        }
    }

    public function get_class_teacher($student){
        $batch = $student['batch_no'];
        $query = "SELECT bas.*,GROUP_CONCAT(e.employee_id) as emp_id,
                    GROUP_CONCAT(DISTINCT(e.employee_id)) as emp_id,
                    GROUP_CONCAT(DISTINCT(CONCAT(e.surname,' ',e.first_name))) AS employees
                    FROM batch_assign_employee bas 
                    LEFT JOIN employees e ON e.employee_id = bas.employee_id
                    WHERE bas.batch_id=$batch
                    GROUP BY batch_id";
        $result = $query = $this->db->query($query);
        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }


    public function get_guardian_student($class_set_id,$user_name){
        $query = $this->db->select('*')
                    ->from('guardians')
                    ->where("username",$user_name)
                    ->limit(1)
                    ->get();
        $guardisan = $query->row_array();
        $guardian_id = $guardisan['guardian_id'];
        //get course and session of batch
        $result = $this->db->select('batches.*,c.name as class_name')->from('batches')
            ->join('classes c','c.id=batches.course_id','left')
            ->where('batches.id',$class_set_id)
            ->limit(1)
            ->get();
        $batch_info = $result->row_array();
        //get class set students
        $result = $this->db->select('s.*,g.guardian_id')
                ->from('students s')
                ->join('student_guardians g','g.student_id=s.student_id','left')
                ->where('g.guardian_id',$guardian_id)
                ->get();
        $result_array = array();
        if($result) {
            $result_array['students'] = $result->result_array();
            $result_array['batch'] = $batch_info;
            return $result_array;
        } else {
            return array();
        }

    }

}