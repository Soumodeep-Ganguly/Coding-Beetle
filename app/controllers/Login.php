<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
        parent::__construct();
        if($this->session->userdata('email')){
        	if ($this->am->getUserType($this->session->userdata('email')) == '1') {
        		redirect('admin');
        	}else{
        		redirect('/');
        	}
        }
    }

	public function index()
	{
		if ($this->input->post('login')) {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_verifyEmail');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[15]');

			$this->form_validation->set_message('verifyEmail', 'Email id does not exists.');

			if($this->form_validation->run())
			{
				$email = $this->input->post('email');  
		        $password = $this->input->post('password');  
		        $result = $this->am->getAdmin($email);
		        $hashed_password = $result[0]['password'];
		        if (password_verify($password, $hashed_password))   
		        {  
		        	if ($result[0]['user_type'] == '1') {
		        		// declaring session  
			            $this->session->set_userdata(array('email'=>$email));
			            redirect('/admin'); 	
		        	}else{
		        		$this->session->set_userdata(array('email'=>$email));
		        		redirect('/');
		        	}
		        }  
		        else
		        {  
		        	$array = array(
						'title' => 'Admin Login'
					);
		        	$this->session->set_flashdata('invalid', 'Invalid Password');
		            $this->load->view('admin/login',$array);  
		        }  
			}
			else
			{
				$array = array(
					'error'   => true,
					'email_error' => form_error('email'),
					'password_error' => form_error('password'),
					'title' => 'Admin Login'
				);
				$this->load->view('admin/login',$array);
			}
		}else{
			$array = array(
				'title' => 'Admin Login'
			);
			$this->load->view('admin/login',$array);
		}	
	}

	public function verifyEmail($email)
	{
	    $variable = $this->am->verifyEmail($email);
	    if($variable == true)
	    {
	      return true;
	    }
	    else
	    {
	      return false;
	    }
	}

}