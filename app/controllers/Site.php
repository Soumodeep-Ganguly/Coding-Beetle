<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    // home page view
	public function index()
	{
        $top = $this->topic->getTop();
        $questions = $this->ques->getTopQuestions();
        $array = array(
            'title' => 'Coding Beetle',
            'top' => $top,
            'questions' => $questions
        );
		$this->load->view('index',$array);
	}

    // show all the programming languages
	public function programming()
	{
		$subjects = $this->sub->getSubjects();
		$array = array(
            'title' => 'Programming',
            'programs' => $subjects
        );
		$this->load->view('programming',$array);
	}

    // show all the topics under a particular programming language
	public function program_detail($subject){
		$topics = $this->topic->getTopics($subject);
        $array = array(
            'title' => $subject,
            'subjects' => $topics
        );
        $this->load->view('programming',$array);
	}

    // show a single topic on one page
	public function program_topic($id,$subject,$topic)
    { 
        $topic = str_replace('-', ' ', $topic);
        $topics = $this->topic->getSingleTopics($id,$subject,$topic);
        $array = array(
            'title' => $subject,
            'topics' => $topics
        );
        $this->load->view('programming',$array);
    }

    // showing the search result
    public function search(){
        if($this->input->get('search') !== FALSE){
            $title = 'Search - '.$this->input->get('search_input');
            $searched = $this->topic->searchResult($this->input->get('search_input'));
            $array = array(
                    'title' => $title,
                    'searched' => $searched
                );
            $this->load->view('search',$array);
        }else{
            $this->session->set_flashdata('error', "Search for Something!");
            redirect('programming');
        }
    }

    // ask question in this particular section
    public function ask_question(){
        if(!$this->session->userdata('email')){
            redirect('login');
        }else{
            if ($this->input->post('save')) {
                $this->form_validation->set_rules('tags', 'Tags', 'required');
                $this->form_validation->set_rules('question', 'Question', 'required');
                if($this->form_validation->run())
                {  
                    $data['tags']=$this->input->post('tags');
                    $data['question']=$this->input->post('question');
                    $data['user_id']=$this->am->getUserId($this->session->userdata('email'));
                    $user=$this->ques->newQuestion($data);
                    if($user>0){
                        $this->session->set_flashdata('success', 'Your Question is Added');
                        redirect('/#question_tab');
                    }
                    else{ 
                        $array = array(
                            'title' => 'Ask Question'
                        );
                        $this->load->view('ask_question',$array);
                    }
                }else{
                    $array = array(
                        'error'   => true,
                        'tags_error' => form_error('tags'),
                        'question_error' => form_error('question'),
                        'title' => 'Ask Question'
                    );
                    $this->load->view('ask_question',$array);
                }
            }else{
                $array = array(
                    'title' => 'Ask Question'
                );
                $this->load->view('ask_question',$array);
            }
        }
    }

    // show all the questions
    public function questions(){
        $config = [
            'base_url' => base_url('questions'),
            'per_page' => 20,
            'total_rows' => $this->ques->total_rows()
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

        $questions = $this->ques->getQuestions($config['per_page'], $this->uri->segment(2));
        $array = array(
            'title' => 'Questions',
            'questions' => $questions
        );
        $this->load->view('questions',$array);
    }

    // show single question and answers related to it
    public function show_questions($id){
        $question = $this->ques->getQuestion($id);
        $answers = $this->ans->getAnswers($id);
        $array = array(
            'title' => 'Questions',
            'question' => $question,
            'answers' => $answers
        );
        $this->load->view('questions',$array);
    }

    // answer to a particular question which is allowed only if the user has logged in
    public function answer(){
        if(!$this->session->userdata('email')){
            redirect('login');
        }else{
            if ($this->input->post('save')) {
                $this->form_validation->set_rules('answer', 'Answer', 'required');
                $this->form_validation->set_rules('question', 'Question', 'required');
                if($this->form_validation->run())
                {  
                    $data['answer']=$this->input->post('answer');
                    $data['question_id']=$this->input->post('question');
                    $data['user_id']=$this->am->getUserId($this->session->userdata('email'));
                    $user=$this->ans->newAnswer($data);
                    if($user>0){
                        $this->session->set_flashdata('success', 'Your Answer is Added');
                        $url = 'questions/view/'.$this->input->post('question');
                        redirect($url);
                    }
                    else{ 
                        $this->session->set_flashdata('error', 'Unable to Save Your Answer');
                        $url = 'questions/view/'.$this->input->post('question');
                        redirect($url);
                    }
                }else{
                    $this->session->set_flashdata('error', 'Invalid Input');
                    redirect('questions');
                }
            }else{
                $this->session->set_flashdata('error', 'Unexpected Error occured');
                redirect('questions');
            }
        }
    }

    // show only the questions asked by current user
    public function my_questions(){
        if(!$this->session->userdata('email')){
            redirect('login');
        }else{
            $id = $this->am->getUserId($this->session->userdata('email'));
            if ($this->ques->user_question_row($id) > 0) {
                $config = [
                    'base_url' => base_url('my-questions'),
                    'per_page' => 20,
                    'total_rows' => $this->ques->user_question_row($id)
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

                $questions = $this->ques->getUserQuestions($id,$config['per_page'], $this->uri->segment(2));
                $array = array(
                    'title' => 'Questions',
                    'questions' => $questions
                );
                $this->load->view('questions',$array);
            }else{
                $this->session->set_flashdata('error', 'No Records Found');
                redirect('/#topics_tab');
            }            
        }
    }

    // show questions where the current user have answered
    public function my_answers(){
        if(!$this->session->userdata('email')){
            redirect('login');
        }else{
            $id = $this->am->getUserId($this->session->userdata('email'));
            if ($this->ans->user_answer_row($id) > 0) {
                $config = [
                    'base_url' => base_url('my-answers'),
                    'per_page' => 5,
                    'total_rows' => $this->ans->user_answer_row($id)
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

                $answers = $this->ans->getUserAnswers($id,$config['per_page'], $this->uri->segment(2));
                $array = array(
                    'title' => 'Questions',
                    'my_answers' => $answers
                );
                $this->load->view('questions',$array);
            }else{
                $this->session->set_flashdata('error', 'No Records Found');
                redirect('/#topics_tab');
            }            
        }
    }

    // delete a question and all the answers under it, if the question was asked by current user
    public function delete_question($id){
        if ($this->am->getUserId($this->session->userdata('email')) == $this->ques->questionUser($id)){
            $this->ques->delete_row($id);
            $this->ans->delete_question($id);
            $this->session->set_flashdata('success', 'Question Successfully Deleted');
            redirect('/');
        }else{
            $this->session->set_flashdata('error', 'Only Admin of this post can Delete this post');
            redirect('/');
        }
    }

    // delete an answer if the answer was asked by current user
    public function delete_answer($id){
        if ($this->am->getUserId($this->session->userdata('email')) == $this->ans->answerUser($id)){
            $this->ans->delete_row($id);
            $url = '/questions/view/'.$id;
            $this->session->set_flashdata('success', 'Answer Successfully Deleted');
            redirect($url);
        }else{
            $this->session->set_flashdata('error', 'Only Admin of this post can Delete this post');
            redirect('/');
        }
    }

	public function about()
	{
		$this->load->view('about');
	}

    public function logout()  
    {  
        //removing session  
        $this->session->unset_userdata('email');  
        redirect("/");  
    }  
}
