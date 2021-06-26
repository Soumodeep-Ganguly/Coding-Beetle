<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
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

	public function index(){
		if ($this->input->post('register')) {
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_verifyEmail');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[15]');
			$this->form_validation->set_rules('confirm-password', 'Confirm Password', 'required|min_length[6]|max_length[15]|matches[password]');

			$this->form_validation->set_message('verifyEmail', '%s id already exists');

			if($this->form_validation->run())
			{
				$data['username']=$this->input->post('username');
				$data['email']=$this->input->post('email');
				$data['password']=password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				$data['user_type'] = '0';
				$user=$this->am->createAdmin($data);
				if($user>0){
				    redirect('login',$result);
				}
				else{
					$array = array(
						'title' => 'Registration'
					);
					$this->load->view('registration',$array);
				}
			}
			else
			{
				$array = array(
					'error'   => true,
					'username_error' => form_error('username'),
					'email_error' => form_error('email'),
					'password_error' => form_error('password'),
					'confirm_error' => form_error('confirm-password'),
					'title' => 'Registration'
				);
				$this->load->view('registration',$array);
			}
		}else{
			$array = array(
						'title' => 'Registration'
					);
			$this->load->view('registration',$array);
		}
	}

	public function register()
	{
		if ($this->input->post('register')) {
			$this->form_validation->set_rules('username', 'Username', 'required|alpha');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_verifyEmail');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[15]');
			$this->form_validation->set_rules('confirm-password', 'Confirm Password', 'required|min_length[6]|max_length[15]|matches[password]');
			$this->form_validation->set_rules('security', 'Security Code', 'required|callback_secure');

			$this->form_validation->set_message('verifyEmail', '%s id already exists');
			$this->form_validation->set_message('secure', 'Security code does not match.');

			if($this->form_validation->run())
			{
				$data['username']=$this->input->post('username');
				$data['email']=$this->input->post('email');
				$data['password']=password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				$data['user_type'] = '1';
				$user=$this->am->createAdmin($data);
				if($user>0){
				    redirect('login',$result);
				}
				else{
					$array = array(
						'title' => 'Admin Registration'
					);
					$this->load->view('admin/registration',$array);
				}
			}
			else
			{
				$array = array(
					'error'   => true,
					'username_error' => form_error('username'),
					'email_error' => form_error('email'),
					'password_error' => form_error('password'),
					'confirm_error' => form_error('confirm-password'),
					'security_error' => form_error('security'),
					'title' => 'Admin Registration'
				);
				$this->load->view('admin/registration',$array);
			}
		}else{
			$array = array(
						'title' => 'Admin Registration'
					);
			$this->load->view('admin/registration',$array);
		}
	}

	public function verifyEmail($email)
	{
	    $variable = $this->am->verifyEmail($email);
	    if($variable == true)
	    {
	      return false;
	    }
	    else
	    {
	      return true;
	    }
	}

	public function secure($code)
	{
		if ($code == 'CODEX143') {
			return true;
		}else{
			return false;
		}
	}

}