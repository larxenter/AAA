<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}
	
	public function login()
	{
		$this->load->view('members');
	}
	
	public function signup()
	{
		$this->load->view('signup');
	}

	public function members()
	{
		$this->load->view('members');
	}
	public function log_out(){
			$this->session->sess_destroy();
			$this->load->view('login');
		}

	public function login_validation()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_validate_credentials');
		$this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

		if($this->form_validation->run())
		{
			$data = array(
				'email' => $this->input->post('email'),
				'is_logged_in' => 1
				);
			$this->session->set_userdata($data);
			redirect('main/members');
		} else {
			$this->load->view('login');
		}
	}

	public function signup_validation()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
		
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

		$this->form_validation->set_message('is_unique', "That email address already exists.");

		if ($this->form_validation->run())
		{

			$key = md5(uniqid());

			$this->load->library('email', array('mailtype'=>'html'));
			$this->load->model('model_users');
			if ($this->model_users->add_user($key)){
				echo "added database.";
			} else echo "problem adding to database.";


		} else {
			$this->load->view('signup');
		}
	}

	public function validate_credentials(){
		$this->load->model('model_users');

		if ($this->model_users->can_log_in()){
			return true;
		} else{
			$this->form_validation->set_message('validate_credentials', 'Incorrect username/password.');
			return false;
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('main/login');
	}

	public function register_user($key){
		$this->load->model('Model_users');

		if ($this->Model_users->is_key_valid($key))
		{
			if($newemail = $this->Model_users->add_user($key))
			{
				$data = Array(
						'email' => $newemail,
						'is_logged_in' => 1
				);

				$this->session->set_userdata($data);
				redirect('main/members');
			} 
			else 
			{
				echo "failed to add user, please try again.";
			}
		} 
		else 
		{
			echo "invalid";
		}
	}


}

?>