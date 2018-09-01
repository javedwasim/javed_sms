<?php

class Sms_Model extends CI_Model
{

    public function add_sms($data,$recipients)
    {
        $result = $this->db->select('*')->from('selected_recipients')->limit(1)->get();
        //print_r($recipients); die();
        if($result->num_rows()>0){

            $this->db->insert("sms", $data);
            $sms_id =  $this->db->insert_id();

            if (in_array("selected_students_guardians", $recipients)){
                $result = $this->db->select('*')
                            ->from('student_guardians')
                            ->join('guardians','guardians.guardian_id = student_guardians.guardian_id')
                            ->group_by('student_guardians.guardian_id')
                            ->get();
                $student_guardians = $result->result_array();
                foreach ($student_guardians as $guardian){
                    //send sms on selected user mobile
                    $this->db->insert("sms_recipients", array('recipient_id'=>$guardian['guardian_id'],'recipient_group'=>'student_guardians','sms_id'=>$sms_id));
                }
            }
            if (in_array("selected_guardians", $recipients)){
                $result = $this->db->select('*')->from('selected_recipients')->where('recipient_group','selected_guardians')->get();
                $selected_guardians = $result->result_array();
                foreach ($selected_guardians as $guardian){
                    //send sms on selected user mobile
                    $this->db->insert("sms_recipients", array('recipient_id'=>$guardian['user_id'],'recipient_group'=>'selected_guardians','sms_id'=>$sms_id));
                }
            }
            if (in_array("selected_students", $recipients)){
                $result = $this->db->select('*')->from('selected_recipients')->where('recipient_group','selected_students')->get();
                $selected_students = $result->result_array();
                foreach ($selected_students as $student){
                    //send sms on selected user mobile
                    $this->db->insert("sms_recipients", array('recipient_id'=>$student['user_id'],'recipient_group'=>'selected_students','sms_id'=>$sms_id));
                }
            }

            if (in_array("selected_employees", $recipients)){
                $result = $this->db->select('*')->from('selected_recipients')->where('recipient_group','selected_employees')->get();
                $selected_employees = $result->result_array();
                foreach ($selected_employees as $employee){
                    //send sms on selected user mobile
                    $this->db->insert("sms_recipients", array('recipient_id'=>$employee['user_id'],'recipient_group'=>'selected_employees','sms_id'=>$sms_id));
                }
            }
            return $sms_id;

        }else{
            return false;
        }

    }

    public function get_sms_detail($id){
        $query = "SELECT sms.*, sr.recipients 
                    FROM `sms` 
                    LEFT JOIN (
                        SELECT count(id) as recipients, sms_id
                        From sms_recipients
                        GROUP BY sms_recipients.sms_id
                    )sr ON sr.sms_id = sms.id
                    WHERE sms.id = $id limit 1";
        $result = $query = $this->db->query($query);
        if($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }

    public function get_event($id)
    {
        return $this->db->where("ID", $id)->get("calendar_events");
    }

    public function update_event($id, $data)
    {
        $this->db->where("ID", $id)->update("calendar_events", $data);
        return $this->db->affected_rows();
    }

    public function delete_event($id)
    {
        $this->db->where('id', $id)->delete('calendar_events');
        $this->db->where('event_id', $id)->delete('events_groups');
        return $this->db->affected_rows();
    }
    
    public function save_event($data)
    {
        $this->db->insert('calendar_events', $data);
        return $this->db->insert_id();
    }
    
    public function save_event_group($data,$event_id)
    {
        if(isset($data['class_group'])){
            $class_groups = $data['class_group'];
            foreach ($class_groups as $group){
                $this->db->insert('events_groups', array('event_id'=>$event_id,'event_groups'=>$group));
            }
        }
        
        if(isset($data['student_category'])){
            $groups = $data['student_category'];
            foreach ($groups as $group){
                $this->db->insert('events_groups', array('event_id'=>$event_id,'event_groups'=>$group));
            }
        }
        
        if(isset($data['employee_category'])){
            $groups = $data['employee_category'];
            foreach ($groups as $group){
                $this->db->insert('events_groups', array('event_id'=>$event_id,'event_groups'=>$group));
            }
        }
        
        if(isset($data['employee_department'])){
            $groups = $data['employee_department'];
            foreach ($groups as $group){
                $this->db->insert('events_groups', array('event_id'=>$event_id,'event_groups'=>$group));
            }
        }
        
        if(isset($data['employee_position'])){
            $groups = $data['employee_position'];
            foreach ($groups as $group){
                $this->db->insert('events_groups', array('event_id'=>$event_id,'event_groups'=>$group));
            }
        }
        
        return $this->db->insert_id();
    }
    
    public function get_sms_list()
    {
        $query = "SELECT sms.*, sr.recipients 
                    FROM `sms` 
                    LEFT JOIN (
                        SELECT count(id) as recipients, sms_id
                        From sms_recipients
                        GROUP BY sms_recipients.sms_id
                    )sr ON sr.sms_id = sms.id
                    WHERE 1";
        $result = $query = $this->db->query($query);
        if($result) {
            return $result->result_array();
        } else {
            return array();
        }
    }
    
    public function get_eventby_id($id)
    {
        $result = $this->db->select('*')
                    ->from('calendar_events')
                    ->where('id',$id)
                    ->limit(1)
                    ->get();
        
        if ($result) {
            return $result->row_array();
        } else {
            return array();
        }
    }

}

?>