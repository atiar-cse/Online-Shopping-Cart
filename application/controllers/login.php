<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		  $data['title']= 'Log In - OSC';
		  $data['navigation']= 'Login';			  
		  $this->load->view('login_form', $data);
	}
	
	function validate_credentials()
	{		
		$this->load->model('customer_model');
		$query = $this->customer_model->validate();
		
		if($query) // if the user's credentials validated...
		{
			
			$result=$this->customer_model->fullName(); // fullName & Setting Session
			if($result)
				{
					$data=array();
					$data['customer_id']=$result->customer_id;
					$data['first_name']=$result->first_name;
					$data['last_name']=$result->last_name;					
					$data['email_address']=$result->email_address;
					$data['is_logged_in']=true;
					$this->session->set_userdata($data);
					redirect('');	
				}			
		}
		else // incorrect username or password
		{
			//$this->index();
		    $data['title']= 'Log In - OSC';
		    $data['navigation']= 'Login';			
			$this->load->view('login_form_invalid');
		}
	}	
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('osc');
	}	
}