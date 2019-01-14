<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
Class Subject_model extends CI_Model {

    public function get_subjects_detail(){

        $elective = "SELECT sd.*, s.name as subject_name,count(ae.emp_id) as emp_count,
                        batches.arm,batches.session,classes.code AS c_name
                        FROM subjects_detail sd  
                        LEFT JOIN subjects s on s.id = sd.subject_id
                        LEFT JOIN (
                            select id as emp_id,subject_detail_id FROM subject_assign_employee 
                            GROUP by id
                        )ae on ae.subject_detail_id = sd.id
                        LEFT JOIN batches ON batches.id = sd. batch_id
	                    LEFT JOIN classes ON classes.id = batches. course_id
                        WHERE elective_group_id>0
                        GROUP By sd.id";

        $core = "SELECT sd.*, s.name as subject_name,count(ae.emp_id) as emp_count,
                        batches.arm,batches.session,classes.code AS c_name
                        FROM subjects_detail sd  
                        LEFT JOIN subjects s on s.id = sd.subject_id
                        LEFT JOIN (
                            select id as emp_id,subject_detail_id FROM subject_assign_employee 
                            GROUP by id
                        )ae on ae.subject_detail_id = sd.id
                        LEFT JOIN batches ON batches.id = sd. batch_id
	                    LEFT JOIN classes ON classes.id = batches. course_id
                        WHERE elective_group_id=0
                        GROUP By sd.id";

        $elective_subjects =  $this->db->query($elective);
        $core_subjects = $this->db->query($core);
        if($elective_subjects) {
            $subjects=array();
            $subjects['elective_subjects']=$elective_subjects->result_array();
            $subjects['core_subjects']=$core_subjects->result_array();
            return $subjects;
        } else {
            return array();
        }

    }

    public function get_batch_subject($batch_no){
        $where = "";
        if($batch_no!=0){
            $where .= "AND batch_id = $batch_no";
        }

        $elective = "SELECT sd.*, s.name as subject_name,count(ae.emp_id) as emp_count,
                        batches.arm,batches.session,classes.code AS c_name
                        FROM subjects_detail sd  
                        LEFT JOIN subjects s on s.id = sd.subject_id
                        LEFT JOIN (
                            select id as emp_id,subject_detail_id FROM subject_assign_employee 
                            GROUP by id
                        )ae on ae.subject_detail_id = sd.id
                        LEFT JOIN batches ON batches.id = sd. batch_id
	                    LEFT JOIN classes ON classes.id = batches. course_id
                        WHERE elective_group_id>0 $where
                        GROUP By sd.id";

        $core = "SELECT sd.*, s.name as subject_name,count(ae.emp_id) as emp_count,
                        batches.arm,batches.session,classes.code AS c_name
                        FROM subjects_detail sd  
                        LEFT JOIN subjects s on s.id = sd.subject_id
                        LEFT JOIN (
                            select id as emp_id,subject_detail_id FROM subject_assign_employee 
                            GROUP by id
                        )ae on ae.subject_detail_id = sd.id
                        LEFT JOIN batches ON batches.id = sd. batch_id
	                    LEFT JOIN classes ON classes.id = batches. course_id
                        WHERE elective_group_id=0 $where
                        GROUP By sd.id";

        $elective_subjects =  $this->db->query($elective);
        $core_subjects = $this->db->query($core);
        if($elective_subjects) {
            $subjects=array();
            $subjects['elective_subjects']=$elective_subjects->result_array();
            $subjects['core_subjects']=$core_subjects->result_array();
            return $subjects;
        } else {
            return array();
        }

    }

    public function get_all_subjects() {
        $result = $this->db->select('*')
                    ->from('subjects')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function get_batch_subjects($batch_no) {
        $result = $this->db->select('*')
                    ->from('subjects')
                    ->where('subjects')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function get_all_batches(){

        $query = "SELECT b.*, c.code,Count(students.student_id) as student_count 
                    FROM batches b 
                    LEFT JOIN classes c ON c.id=b.course_id 
                    LEFT JOIN (
                        select student_id,batch_no FROM students GROUP by student_id
                    )students on students.batch_no = b.id
                    GROUP By b.id
                    ORDER BY b.session ASC";
        $result = $query = $this->db->query($query);
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }


    public function get_all_sessions() {
        $result = $this->db->select('*')
                    ->from('acadamic_sessions')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function get_all_employees() {
        $result = $this->db->select('*')
                    ->from('employees')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function get_all_classes() {
        $result = $this->db->select('*')
                    ->from('classes')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function get_elective_group(){
        $result = $this->db->select('*')
                    ->from('elective_groups')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_subject_by_id($id) {
        $result = $this->db->select('*')
                    ->from('subjects_detail')
                    ->where('id',$id)
                    ->limit(1)
                    ->get();
        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    public function update_subject($data, $id) {
        $this->db->where('id', $id)->update('subjects_detail', $data);
        return $this->db->affected_rows();
    }

    public function save_subject($data) {
        $this->db->insert('subjects_detail', $data);
        return $this->db->insert_id();
    }

    public function save_elective_subject($data) {
        $this->db->insert('elective_groups', $data);
        return $this->db->insert_id();
    }

    public function delete_subject($id) {
        $this->db->where('id', $id)->delete('subjects_detail');
        return $this->db->affected_rows();
    }


	public function assign_new_employee($data){
        $result = $this->db->select('id')->from('subject_assign_employee')
                    ->where('subject_detail_id',$data['subject_detail_id'])->limit(1)->get();
        if($result){
            $this->db->where('subject_detail_id',$data['subject_detail_id'])->delete('subject_assign_employee');
        }
        $employees = $data['employee'];
        $role = $data['role'];
        for($i=0;$i<count($employees);$i++){
            $this->db->insert('subject_assign_employee',
            array(
                    'employee_id'=>$employees[$i],
                    'role_id'=>$role[$i],
                    'subject_detail_id'=>$data['subject_detail_id'])
            );
        }
        return $this->db->insert_id();
    }

    public function get_assigned_employees($id){
        $this->db->select('ae.*');
        $this->db->from('subject_assign_employee ae');
        $this->db->join('employees e', 'e.employee_id=ae.employee_id', 'left');
        $this->db->join('roles r', 'r.id=ae.role_id', 'left');
        $this->db->where('ae.subject_detail_id',$id);
        $result = $this->db->get();
        //print_r($this->db->last_query()); die();
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function get_assessment_categories() {
        $result = $this->db->select('*')
                    ->from('assessment_categories')
                    ->get();
        if ($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }

    public function save_subject_assessments($data){
        $this->db->insert('subject_assessments', $data);
        return $this->db->insert_id();
    }

    public function get_subject_assessments($id){
        $query = "SELECT sa.*, ac.name as cate_name, ases.name as session_name,sd.batch_id,batches.session
                    ,sbj.name as sbj_name
                    FROM subject_assessments sa
                    LEFT JOIN assessment_categories ac ON ac.id=sa.assessment_category_id 
                    LEFT JOIN acadamic_sessions ases ON sa.due_date >=ases.first_term_start
                    AND sa.due_date BETWEEN ases.first_term_start AND ases.first_term_end
                    LEFT JOIN subjects_detail sd on sd.id = sa.subject_detail_id
                    LEFT JOIN batches on batches.id = sd.batch_id and batches.session = ases.name
                    LEFT JOIN subjects sbj on sbj.id=sd.subject_id
                    WHERE subject_detail_id = $id 
                    GROUP BY sa.id";
        $result = $query = $this->db->query($query);
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_subject_assessments_by_id($id){
        $result = $this->db->select('sa.*')
                    ->from('subject_assessments sa')
                    ->where('id',$id)
                    ->limit(1)
                    ->get();
        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    public function update_publish_grade($data) {
        $id = $data['subject_detail_id'];
        $result = $this->db->select('publish_score,include_final_grade')->from('subject_assessments')->where('id',$id)->limit(1)->get();
        $row = $result->row_array();
        $update_data = array();
        if($data['data_update']=='publish'){
          $row['publish_score']==1? $update_data['publish_score']=0:$update_data['publish_score']=1;
          $this->db->where('id', $id)->update('subject_assessments', $update_data);
        }elseif($data['data_update']=='grade'){
            $row['include_final_grade']==1? $update_data['include_final_grade']=0:$update_data['include_final_grade']=1;
            $this->db->where('id', $id)->update('subject_assessments', $update_data);
        }
        return $this->db->affected_rows();
    }

    public function update_subject_assessments($data,$id){
        $this->db->where('id', $id)->update('subject_assessments', $data);
        return $this->db->affected_rows();
    }

    public function delete_subject_assessment($id) {
        $this->db->where('id', $id)->delete('subject_assessments');
        //delete assessment score
        $this->db->where('asses_id', $id)->delete('student_score_sheet');
        return true;
    }

    public function get_score_sheet($id){
        $query = "SELECT s.student_id, batches.id as bacth_id,acs.id as session_id,
                    batches.session,sd.id as subj_detail_id,s.first_name,s.last_name,s.surname,
                    GROUP_CONCAT(sas.abbreviation ORDER BY sas.id ASC) as score_term,
                    GROUP_CONCAT(sas.points ORDER BY sas.id ASC) as score_points,
                    GROUP_CONCAT(sas.id ORDER BY sas.id ASC) AS asses_id,
                    SUBSTRING_INDEX(sc.obtain_score,',', 1) AS first_value,
                    SUBSTRING_INDEX(SUBSTRING_INDEX(sc.obtain_score,',', 2),',','-1') as second_value,
                    SUBSTRING_INDEX(SUBSTRING_INDEX(sc.obtain_score,',', 3),',','-1') as third_value,
                    sc.term_id,sc.obtain_score
                    FROM students s
                    LEFT JOIN batches on batches.id  = s.batch_no
                    LEFT JOIN acadamic_sessions acs on acs.id=s.batch_no
                    LEFT JOIN subjects_detail sd on sd.batch_id=batches.id
                    
                    LEFT JOIN(
                         SELECT sa.*,batches.session as sess 
                         FROM subject_assessments sa
                         LEFT JOIN acadamic_sessions ases ON sa.due_date >=ases.first_term_start
                         AND sa.due_date BETWEEN ases.first_term_start AND ases.first_term_end
                         LEFT JOIN subjects_detail sd on sd.id = sa.subject_detail_id
                         LEFT JOIN batches on batches.id = sd.batch_id and batches.session = ases.name
                         WHERE sd.id = $id AND batches.session IS NOT NULL
                         GROUP BY sa.id 
                         ORDER BY sa.abbreviation DESC                        
                    )sas on sas.subject_detail_id=sd.id   
                                      
                    LEFT JOIN(
                        SELECT ss.*,GROUP_CONCAT(ss.score ORDER BY ss.id ASC) as obtain_score
                        FROM student_score_sheet ss
                        WHERE ss.subject_detail_id = $id AND (term_id = 1)
                        GROUP BY ss.student_id
                    )sc on sc.student_id = s.student_id
                    WHERE (sd.id=$id)
                    GROUP BY s.student_id";
        $result = $query = $this->db->query($query);
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function saveStudentScore($data){
        $points = $data['points'];
        $score = $data['score'];
        $assessment_id = $data['asses_id'];
        //insert score
        unset($data['points']);
        $assments = $this->db->select('*')->from('subject_assessments')
                    ->where('subject_detail_id',$data['subject_detail_id'])
                    ->get();
        $assments = $assments->result_array();
        $query = $this->db->select('*')->from('student_score_sheet')
                    ->where('student_id',$data['student_id'])
                    ->where('subject_detail_id',$data['subject_detail_id'])
                    ->where('assessment_term',$data['assessment_term'])
                    ->where('batch_id',$data['batch_id'])
                    ->where('term_id',$data['term_id'])
                    ->limit(1)
                    ->get();

         if($query->num_rows() == 0){
           foreach ($assments as $assment){
               if($assment['id'] == "$assessment_id"){
                   $data['score'] = $score;
                   $data['asses_id'] = $assessment_id;
                   $data['assessment_term'] = $assment['abbreviation'];
                   $data['term_id'] = $assment['term_id'];
                   $this->db->insert('student_score_sheet', $data);
               }else{
                   $data['score'] = 0;
                   $data['asses_id'] = $assment['id'];
                   $data['assessment_term'] = $assment['abbreviation'];
                   $data['term_id'] = $assment['term_id'];
                   $this->db->insert('student_score_sheet', $data);
               }
           }
           return $this->db->insert_id();
       }else{
           $result = $query->row_array();
           $this->db->where('id', $result['id'])->update('student_score_sheet', $data);
           return $this->db->affected_rows();
       }

//        $data['points'] = $points;
//        if($query->num_rows()>0){
//            //update score
//            unset($data['points']);
//            $result = $query->row_array();
//            $this->db->where('id', $result['id'])->update('student_score_sheet', $data);
//            return $this->db->affected_rows();
//        }else{
//            $this->db->insert('student_score_sheet', $data);
//            return $this->db->insert_id();
//        }


    }

    public function get_term_score_sheet($id,$term_id){
        if($term_id == 1){
            $due_date = " AND sa.due_date BETWEEN ases.first_term_start AND ases.first_term_end ";
        }elseif($term_id == 2){
            $due_date = " AND sa.due_date BETWEEN ases.second_term_start AND ases.second_term_end  ";
        }else{
            $due_date = " AND sa.due_date BETWEEN ases.third_term_start AND ases.third_term_end  ";
        }
        $query = "SELECT s.student_id, batches.id as bacth_id,acs.id as session_id,
                    batches.session,sd.id as subj_detail_id,s.first_name,s.last_name,s.surname,
                    GROUP_CONCAT(sas.abbreviation ORDER BY sas.id ASC) as score_term,
                    GROUP_CONCAT(sas.points ORDER BY sas.id ASC) as score_points,
                    GROUP_CONCAT(sas.id ORDER BY sas.id ASC) AS asses_id,
                    SUBSTRING_INDEX(sc.obtain_score,',', 1) AS first_value,
                    SUBSTRING_INDEX(SUBSTRING_INDEX(sc.obtain_score,',', 2),',','-1') as second_value,
                    SUBSTRING_INDEX(SUBSTRING_INDEX(sc.obtain_score,',', 3),',','-1') as third_value,
                    sc.term_id,sc.obtain_score
                    FROM students s
                    LEFT JOIN batches on batches.id  = s.batch_no
                    LEFT JOIN acadamic_sessions acs on acs.id=s.batch_no
                    LEFT JOIN subjects_detail sd on sd.batch_id=batches.id
                    
                    LEFT JOIN(
                         SELECT sa.*,batches.session as sess 
                         FROM subject_assessments sa
                         LEFT JOIN acadamic_sessions ases ON sa.due_date >=ases.first_term_start
                         $due_date
                         LEFT JOIN subjects_detail sd on sd.id = sa.subject_detail_id
                         LEFT JOIN batches on batches.id = sd.batch_id and batches.session = ases.name
                         WHERE sd.id = $id AND batches.session IS NOT NULL
                         GROUP BY sa.id 
                         ORDER BY sa.abbreviation DESC                        
                    )sas on sas.subject_detail_id=sd.id                                         
                    LEFT JOIN(
                        SELECT ss.*,GROUP_CONCAT(ss.score ORDER BY ss.id ASC) as obtain_score
                        FROM student_score_sheet ss
                        WHERE ss.subject_detail_id = $id AND (term_id = $term_id)
                        GROUP BY ss.student_id
                    )sc on sc.student_id = s.student_id
                    WHERE (sd.id=$id)
                    GROUP BY s.student_id";
        $result = $query = $this->db->query($query);
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_student_assessments($id,$filter){

        if(isset($filter) && !empty($filter['subject'])){
            $subject = $filter['subject'];
        }else{
            $subject = 0;
        }
        if(isset($filter) && !empty($filter['session'])){
            $session = $filter['session'];
        }else{
            $session = 0;
        }

        if(isset($filter) && !empty($filter['term'])){
            $term  = $filter['term'];
        }else{
            $term = 0;
        }

        $query = "SELECT sa.id,sa.points,sa.assessment_name,sa.due_date,ac.name AS cate_name, 
                    sd.batch_id,sbj.name,score.score,score.student_id,score.id,
                    score.asses_id,students.surname,sbj.id AS subject_id,batches.session,score.term_id
                    FROM subject_assessments sa
                    LEFT JOIN assessment_categories ac ON ac.id=sa.assessment_category_id
                    LEFT JOIN subjects_detail sd ON sd.id = sa.subject_detail_id
                    LEFT JOIN subjects sbj ON sbj.id=sd.subject_id
                    LEFT JOIN student_score_sheet score ON score.subject_detail_id = sa.subject_detail_id 
                    AND sa.id = score.asses_id
                    LEFT JOIN students ON students.student_id = score.student_id 
                    LEFT JOIN batches ON batches.id = students.batch_no
                    WHERE score.student_id IS NOT NULL AND score.student_id IN ($id)
                    AND($subject=0 OR sbj.id = $subject)
                    AND($session=0 OR batches.session = '$session')
                    AND($term=0 OR score.term_id = $term)
                    GROUP BY score.id
                    ORDER BY score.id ASC";
        $result = $query = $this->db->query($query);
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function get_student_subject_assessments($id,$filter){

        if(isset($filter) && !empty($filter['session'])){
            $session = $filter['session'];
        }else{
            $session = 0;
        }

        if(isset($filter) && !empty($filter['term'])){
            $term  = $filter['term'];
        }else{
            $term = 0;
        }

        $query = "SELECT sbj.id,sbj.name,GROUP_CONCAT(score.term_id) AS subject_term,
                    GROUP_CONCAT(CONCAT(score.assessment_name,'/',score.due_date,'/',score.score,'/',
                    score.points,'/',score.surname))  AS subject_score,GROUP_CONCAT(score.session) AS b_session
                    FROM subjects sbj
                    LEFT JOIN (
                        SELECT sa.id,sa.points,sa.assessment_name,sa.due_date,score.term_id,
                            sd.batch_id,score.score,score.student_id,score.id AS score_id,
                            score.asses_id,sd.subject_id,students.surname,batches.session
                        FROM subject_assessments sa 
                        LEFT JOIN subjects_detail sd ON sd.id = sa.subject_detail_id
                        LEFT JOIN student_score_sheet score ON score.subject_detail_id = sa.subject_detail_id AND sa.id = score.asses_id
                        LEFT JOIN students ON students.student_id = score.student_id 	
                        LEFT JOIN batches ON batches.id = students.batch_no 
                        WHERE 1 
                        AND ($session=0 OR batches.session = '$session')
                        AND ($term=0 OR score.term_id = $term)
                    )score ON score.subject_id = sbj.id
                    WHERE student_id IN ($id)
                    GROUP BY sbj.id";
        $result = $query = $this->db->query($query);
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }


}