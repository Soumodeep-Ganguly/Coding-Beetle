<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topic extends CI_Model {

	function newTopic($data)
    {
    	$this->db->insert('topics',$data);
        return $this->db->insert_id();
	}

	function topicUser($id){
		$q = $this->db->get_where('topics', array('topic_id' => $id));
	    $result = $q->result_array();
	    $id = $result[0]['user_id'];
	    return $id;
	}

	function allTopics($id, $limit, $offset){
		$q = $this->db->limit($limit, $offset)->order_by('created_on', 'DESC')->get_where('topics', array('user_id' => $id));
		$result = $q->result_array();
		return $result;
	}

	function num_rows($id){
		$q = $this->db->get_where('topics', array('user_id'=>$id));
		return $q->num_rows();
	}

	function getTopics($subject){
		$q = $this->db->get_where('topics', array('subject' => $subject));
		return $q->result_array();
	}

	function getTop(){
		$this->db->select('*');
		$this->db->from('topics');
		$this->db->limit(20);
		$q = $this->db->order_by('created_on', 'DESC')->get();
		return $q->result_array();
	}

	function getSingleTopics($id,$subject,$topic){
		$q = $this->db->get_where('topics', array('subject' => $subject,'topic'=>$topic,'topic_id'=>$id));
		return $q->result_array();
	}

	function verifyTopic($id)
    {
        $result = $this->db->get_where('topics', array('topic_id' => $id));

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

    function searchResult($search){
    	$this->db->select('*');
	    $this->db->from('topics');
	    $this->db->like('subject', $search);
	    $this->db->or_like('topic', $search);
	    $this->db->or_like('description', $search);
	    $query = $this->db->get();

	    return $query->result_array();
    }

    function updateTopic($data, $id){
    	$this->db->trans_start();
		$this->db->where('topic_id', $id);
		$this->db->update('topics', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    return false;
		}else{
			return true;
		}
    }

	function getTopic($id){
		$q = $this->db->get_where('topics', array('topic_id'=>$id));
		$result = $q->result_array();
		return $result[0];
	}

	function delete_row($id){
	    $this->db->where('topic_id', $id);
	    $this->db->delete('topics');
	}

}