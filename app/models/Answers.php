<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Answers extends CI_Model {

	function newAnswer($data){
		$this->db->insert('answers',$data);
        return $this->db->insert_id();
	}

	function getAnswers($id)
    {
	    $q = $this->db->get_where('answers',array('question_id'=>$id));
	    return $q->result_array();
    }

    function user_answer_row($id){
		$q = $this->db->get_where('answers',array('user_id'=>$id));
	    return $q->num_rows();
	}

    function getUserAnswers($id,$limit, $offset)
    {
	    $q = $this->db->limit($limit, $offset)->get_where('answers',array('user_id'=>$id));
	    return $q->result_array();
    }

    function answerUser($id){
		$q = $this->db->get_where('answers', array('answer_id' => $id));
	    $result = $q->result_array();
	    $id = $result[0]['user_id'];
	    return $id;
	}

    function delete_row($id){
	    $this->db->where('answer_id', $id);
	    $this->db->delete('answers');
	}

	function delete_question($id){
	    $this->db->where('question_id', $id);
	    $this->db->delete('answers');
	}

}