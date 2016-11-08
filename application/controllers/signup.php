<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function index()
	{
          $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
			   $data['title']= 'Sign Up - OSC';
			   $data['navigation']= 'Sign Up';
			  $this->load->view('signup_form', $data);			 
		  } 
		  else
		  {
			  $data['title']= 'Log In';
			  $data['navigation']= 'Login';			  
		   	  $this->load->view('login_form', $data);
		  }
	}
	
	function create_customer()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('email_address', '', 'trim|required|valid_email');		
		$this->form_validation->set_rules('password', '', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password_confirm', '', 'trim|required|matches[password]');		
		
		$this->form_validation->set_rules('first_name', '', 'trim|required');
		$this->form_validation->set_rules('last_name', '', 'trim|required');
		$this->form_validation->set_rules('company', '', 'trim');		
		$this->form_validation->set_rules('address', '', 'trim|required');		
		$this->form_validation->set_rules('city', '', 'trim|required');			
		$this->form_validation->set_rules('country', '', 'trim');			
		$this->form_validation->set_rules('zip', '', 'trim|required');			
		$this->form_validation->set_rules('telephone', '', 'trim|required');		
		
		if($this->form_validation->run() == FALSE)
		{
			   $data['title']= 'Sign Up - OSC';
			   $data['navigation']= 'Sign Up';
			  $this->load->view('signup_form', $data);
		}
		
		else
		{			
			
			$this->load->model('customer_model');	
			$result=$this->customer_model->emailAddressCheck(); //cehecking duplicate email address
			if($result)
			{
			   $data['title']= 'Sign Up - OSC';
			   $data['navigation']= 'Sign Up';				
				$this->load->view('signup_form_invalid', $data);
			}
			else 
			{
				$this->load->model('customer_model');			
				if($query = $this->customer_model->create_customer())
				{
					$this->load->library('email');
					$this->email->clear();
					
					$config['mailtype'] = 'html';
					$config['newline'] = "\r\n";
					$config['crlf'] = "\r\n";
					$config['protocol'] = 'sendmail';
					$this->email->initialize($config);
					
					$to = $this->input->post('email_address');
					$pass = $this->input->post('password');
					$name = $this->input->post('first_name');
					
					
					$this->email->from('support@osc.com', 'Online Shopping Cart');
					$this->email->to($to);
					$this->email->subject('Welcome to OSC');
					
					$message = "<h3>Thank you, $name !! </h3><br> \r\n";
					$message .= "Here is your login details. <br> <br> \r\n";
					$message .= "Email: $to <br> \r\n";
					$message .= "Password: $pass \r\n <br> <br>Thanks,";
					$this->email->message($message);					
					
					//$this->email->set_newline("\r\n");

					//$path = $this->config->item('server_root');
					//$file = $path . '/ci_day3/attachments/yourInfo.txt';
					//$this->email->attach($file);
					$this->email->send();
					
			   		$data['title']= 'Sign Up Succes - OSC';
			   		$data['navigation']= 'Sign Up';						
					$this->load->view('signup_success', $data);
				}
				else
				{
			   $data['title']= 'Sign Up - OSC';
			   $data['navigation']= 'Sign Up';
			  $this->load->view('signup_form', $data);			
				}				
			}
			
		}
		
	}		
	
}