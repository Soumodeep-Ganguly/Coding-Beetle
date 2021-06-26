<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends CI_Model {

    function getISub($name)
    {

	    $q = $this->db->get_where('subjects', array('subject_name' => $name));

	    return $q->num_rows();
    }

    function getSubjects(){
    	$query = $this->db->get('subjects');
    	$result = $query->result();
    	return $result;
    }

    function newSubject($data)
    {
    	$q = $this->db->get_where('subjects', $data);
		if($q->num_rows() == 0){
			$this->db->insert('subjects',$data);
			return true;
		}
	}

}