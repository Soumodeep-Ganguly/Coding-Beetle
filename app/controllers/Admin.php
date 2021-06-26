<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
        parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }else if($this->am->getUserType($this->session->userdata('email')) == '0'){
            redirect('/');
        }
    }

	public function index()
	{ 
        $subjects = $this->sub->getSubjects();
        $array = array(
            'title' => 'Admin Home',
            'subjects' => $subjects
        );
		$this->load->view('admin/index',$array);
	}

    public function add_data()
    { 
        if ($this->input->post('save')) {
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('topic', 'Topic', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            if($this->form_validation->run())
            {  
                $data['subject']=$this->input->post('subject');
                $data['topic']=$this->input->post('topic');
                $data['description']=$this->input->post('description');
                $data['user_id']=$this->am->getUserId($this->session->userdata('email'));
                $user=$this->topic->newTopic($data);
                if($user>0){
                    $this->session->set_flashdata('success', 'Topic Successfully Added');
                    redirect('admin');
                }
                else{
                    $results = $this->sub->getSubjects(); 
                    $array = array(
                        'title' => 'Add Data',
                        'results' => $results
                    );
                    $this->load->view('admin/add_data',$array);
                }
            }else{
                $results = $this->sub->getSubjects(); 
                $array = array(
                    'error'   => true,
                    'subject_error' => form_error('subject'),
                    'topic_error' => form_error('topic'),
                    'description_error' => form_error('description'),
                    'title' => 'Add Data',
                    'results' => $results
                );
                $this->load->view('admin/add_data',$array);
            }
        }else{
            $results = $this->sub->getSubjects(); 
            $array = array(
                'title' => 'Add Data',
                'results' => $results
            );
            $this->load->view('admin/add_data',$array);
        }
    }

    public function add_subject(){ 
        $subject = $this->input->post('subject');
        $data = array(
            'subject_name' => $subject
        );
        if($this->sub->newSubject($data)){
            echo "success";
        }else{
            echo "Subject already present";
        }
    }

    public function my_data()
    { 
        $id = $this->am->getUserId($this->session->userdata('email'));

        $config = [
            'base_url' => base_url('admin/my'),
            'per_page' => 2,
            'total_rows' => $this->topic->num_rows($id)
        ];

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $topics = $this->topic->allTopics($id, $config['per_page'], $this->uri->segment(3));
        $array = array(
            'title' => 'My Content',
            'topics' => $topics
        );
        $this->load->view('admin/my-content',$array);
    }

    public function view_subject($subject)
    { 
        $subject = str_replace('-', ' ',$subject);
        $topics = $this->topic->getTopics($subject);
        $array = array(
            'title' => $subject,
            'subjects' => $topics
        );
        $this->load->view('admin/view_data',$array);
    }

    public function view_topic($id,$subject,$topic)
    { 
        $topic = str_replace('-', ' ', $topic);
        $subject = str_replace('-', ' ',$subject);
        $topics = $this->topic->getSingleTopics($id,$subject,$topic);
        $array = array(
            'title' => $subject,
            'topics' => $topics
        );
        $this->load->view('admin/view_data',$array);
    }

    public function delete_topic($id){
        if ($this->am->getUserId($this->session->userdata('email')) == $this->topic->topicUser($id)){
            $this->topic->delete_row($id);
            $this->session->set_flashdata('success', 'Topic Successfully Deleted');
            redirect('admin');
        }else{
            $this->session->set_flashdata('error', 'Only Admin of this post can Delete this post');
            redirect('admin');
        }
    }

    public function edit(){
        $this->session->set_flashdata('error', 'That destination is not available');
        redirect('admin');
    }

    public function view(){
        $this->session->set_flashdata('error', 'That destination is not available');
        redirect('admin');
    }

    public function edit_topic($id){
        if ($this->am->getUserId($this->session->userdata('email')) == $this->topic->topicUser($id)){
            if($this->topic->verifyTopic($id)){
                if ($this->input->post('save')) {
                    $data['subject']=$this->input->post('subject');
                    $data['topic']=$this->input->post('topic');
                    $data['description']=$this->input->post('description');

                    if ($this->topic->updateTopic($data,$id)) {
                        $this->session->set_flashdata('success', 'Successfully saved.');
                        $status = 'admin/edit/'.$id;
                        redirect($status);
                    }else{
                        $this->session->set_flashdata('error', 'Unable to Save changes.');
                        $status = 'admin/edit/'.$id;
                        redirect($status);
                    }
                }else{
                    $subjects = $this->sub->getSubjects(); 
                    $topic = $this->topic->getTopic($id);
                    $name = $topic['topic'];
                    $array = array(
                        'title' => $name,
                        'topic' => $topic,
                        'subjects' => $subjects
                    );
                    $this->load->view('admin/edit',$array);
                }
            }else{
                $this->session->set_flashdata('error', "Topic Doesn't Exist");
                redirect('admin');
            }    
        }else{
            $this->session->set_flashdata('error', 'Only Admin of this post can Edit this post');
            redirect('admin');
        }
    }

    public function search(){
        if($this->input->get('search') !== FALSE){
            $title = 'Search - '.$this->input->get('search_input');
            $searched = $this->topic->searchResult($this->input->get('search_input'));
            $searchQues = $this->ques->searchQuestions($this->input->get('search_input'));
            $array = array(
                    'title' => $title,
                    'searched' => $searched
                );
            $this->load->view('admin/search',$array);
        }else{
            $this->session->set_flashdata('error', "Search for Something!");
            redirect('admin');
        }
    }

	public function logout()  
    {  
        //removing session  
        $this->session->unset_userdata('email');  
        redirect("login");  
    }  
}
