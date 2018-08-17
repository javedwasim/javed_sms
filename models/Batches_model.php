<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
Class Batches_model extends CI_Model {

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

    public function get_batch_by_id($id) {
        $result = $this->db->select('*')
                    ->from('batches')
                    ->where('id',$id)
                    ->limit(1)
                    ->get();
        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    public function update_batch($data, $id) {
        $this->db->where('id', $id)->update('batches', $data);
        return $this->db->affected_rows();
    }

    public function delete_batch($id) {
        $this->db->where('id', $id)->delete('batches');
        return $this->db->affected_rows();
    }

    public function get_demographics($id){
        $this->db->select('d.*,s.*,b.*,c.code');
        $this->db->from('students s');
        $this->db->join('demographics d', 's.student_id=d.student_id', 'left');
        $this->db->join('batches b', 'b.id=d.batch_id', 'left');
        $this->db->join('classes c', 'c.id=b.course_id', 'left');
        $this->db->order_by('s.student_id','desc');
        $this->db->where('s.status',1);
        $this->db->where('b.id',$id);
        $result = $this->db->get();
        //print_r($this->db->last_query()); die();
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }

    public function transfer_student_batch($data) {
        $batch_no = $data['batch_no'];
        $last_day_in_batch = $data['last_day_in_batch'];
        $reason_to_leave_batch = $data['reason_to_leave_batch'];
        $str = $data['ids'];
        $sids = explode(",",$str);
        if(isset($data['transfer_type']) &&($data['transfer_type']=='inter_batch')){
            foreach ($sids as $id){
                $this->db->where('student_id', $id)->update('students',
                    array(
                        'batch_no'=>$batch_no,
                        'last_day_in_batch'=>$last_day_in_batch,
                        'reason_to_leave_batch'=>$reason_to_leave_batch
                    ));
            }
        }else{
            foreach ($sids as $id){
                $this->db->where('student_id', $id)->update('students',
                    array(
                        'last_day_in_batch'=>$last_day_in_batch,
                        'reason_to_leave_batch'=>$reason_to_leave_batch,
                        'status'=>2
                    ));

            }
        }


        return $this->db->affected_rows();
    }


	public function get_all_students() {
        $this->db->select('s.*,b.arm,b.session,c.code');
        $this->db->from('students s');
        $this->db->join('batches b', 'b.id=s.batch_no', 'left');
        $this->db->join('classes c', 'c.id=b.course_id', 'left');
        $this->db->order_by('s.student_id','desc');
        $this->db->where('s.status',1);
        $result = $this->db->get();
		//$result = $this->db->select('*')->from('students')->get();
		if($result) {
			return $result->result_array();
		} else {
			return array();
		}
	}

	public function assign_new_employee($data){
        $batch = $this->db->select('id')->from('batch_assign_employee')
                    ->where('batch_id',$data['batch_id'])->limit(1)->get();
        if($batch){
            $this->db->where('batch_id',$data['batch_id'])->delete('batch_assign_employee');
        }
        $employees = $data['employee'];
        $role = $data['role'];
        for($i=0;$i<count($employees);$i++){
            $this->db->insert('batch_assign_employee',
            array(
                    'employee_id'=>$employees[$i],
                    'role_id'=>$role[$i],
                    'batch_id'=>$data['batch_id'])
            );
        }
        return $this->db->insert_id();
    }

    public function get_assigned_employees($id){

        $this->db->select('ae.*,e.first_name,e.middle_name,r.name as role_name,e.photo,e.gender');
        $this->db->from('batch_assign_employee ae');
        $this->db->join('employees e', 'e.employee_id=ae.employee_id', 'left');
        $this->db->join('roles r', 'r.id=ae.role_id', 'left');
        $this->db->order_by('e.first_name','desc');
        $this->db->where('ae.batch_id',$id);
        $result = $this->db->get();

        if($result) {
            return $result->result_array();
        } else {
            return array();
        }

    }
}