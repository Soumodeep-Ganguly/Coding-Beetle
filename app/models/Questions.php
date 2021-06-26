<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questions extends CI_Model {

	function newQuestion($data){
		$this->db->insert('questions',$data);
        return $this->db->insert_id();
	}

	function total_rows(){
		$q = $this->db->get('questions');
	    return $q->num_rows();
	}

	function user_question_row($id){
		$q = $this->db->get_where('questions',array('user_id'=>$id));
	    return $q->num_rows();
	}

	function getQuestions($limit, $offset)
    {
	    $q = $this->db->limit($limit, $offset)->get('questions');
	    return $q->result_array();
    }

    function getUserQuestions($id,$limit, $offset)
    {
	    $q = $this->db->limit($limit, $offset)->get_where('questions',array('user_id'=>$id));
	    return $q->result_array();
    }

    function questionUser($id){
		$q = $this->db->get_where('questions', array('question_id' => $id));
	    $result = $q->result_array();
	    $id = $result[0]['user_id'];
	    return $id;
	}

    function getQuestion($id)
    {
	    $q = $this->db->get_where('questions',array('question_id'=>$id));
	    $result = $q->result_array();
	    return $result[0];
    }

    function getTopQuestions(){
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->limit(20);
		$q = $this->db->order_by('created_on', 'DESC')->get();
		return $q->result_array();
	}

	function searchQuestions($search){
    	$this->db->select('*');
	    $this->db->from('questions');
	    $this->db->like('question', $search);
	    $this->db->or_like('tags', $search);
	    // $this->db->or_like('description', $search);
	    $query = $this->db->get();

	    return $query->result_array();
    }

    function delete_row($id){
	    $this->db->where('question_id', $id);
	    $this->db->delete('questions');
	}
}