<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Model extends CI_Model {

    function getAdmin($email)
    {
	    $q = $this->db->get_where('admin', array('email' => $email));
	    return $q->result_array();
    }

    function getUserId($email){
    	$q = $this->db->get_where('admin', array('email' => $email));
	    $result = $q->result_array();
	    $id = $result[0]['admin_id'];
	    return $id;
    }

    function getUserType($email){
    	$q = $this->db->get_where('admin', array('email' => $email));
	    $result = $q->result_array();
	    $type = $result[0]['user_type'];
	    return $type;
    }

    function verifyEmail($email)
	{
	    $result = $this->db->get_where('admin', array('email' => $email));

	    $rowCount = $result->num_rows();
	    if($rowCount == 1)
	    {
	      return true; 
	    }
	    else
	    {
	      return false;
	    }
	}

    function createAdmin($data)
    {
    	$this->db->insert('admin',$data);
        return $this->db->insert_id();
	}

}