<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	function details() // Details Customer Order
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$data['title'] = 'Login';
			$data['navigation'] = 'Login';			  
			$this->load->view('login_form', $data);			 
		} 
		else
		{
		
			$this->load->model('orders_model');
			$data = array();	
			$data['title']='Order Details';
			  
			if($query = $this->orders_model->get_customer_orders_details())
			{
				$data['orders'] = $query;
				$this->load->view('customer_orders_details', $data);
			}			  
			else 
			   {
					$data['title']='Order Details';
					$data['msg']='Nothing!';
					$this->load->view('customer_orders_details', $data);				
			   }			
		}
	}		

	function orders() // all category for admin
	{
          $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
			  $data['title'] = 'Login';
			  $data['navigation'] = 'Login';			  
			  $this->load->view('login_form', $data);			 
		  } 
		else
		{
		
			$this->load->model('orders_model');
			$data = array();	
			$data['title']='My Orders';

			  $this->load->library('pagination'); // Starting Pagination Code			  
			  $config['base_url'] = 'http://atiar.me/osc/customer/orders';
			  $config['total_rows'] = $this->orders_model->get_customer_orders_num();
			  $config['per_page'] = 10;
			  $config['num_links'] = 5;
			  
			  $config['first_link'] = '<< First';
			  $config['last_link'] = 'Last >>';
			  
			  $config['next_link'] = '&gt;';
			  $config['prev_link'] = '&lt;';
			  
			  $this->pagination->initialize($config);
			  
			if($query = $this->orders_model->get_customer_orders())
			{
				$data['orders'] = $query;
				$this->load->view('customer_orders', $data);
			}			  
			else 
			   {
					$data['title']='My Orders';
					$data['msg']='Nothing!';
					$this->load->view('customer_orders', $data);				
			   }			
		}
	}	

	public function profile()
	{
		//$this->load->view('signup_form');
          $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
			  $data['title'] = 'Login';
			  $data['navigation'] = 'Login';			  
			  $this->load->view('login_form', $data);			 
		  } 
		  else
		  {
			  $this->overview();	
		  }		
	}
	
	function overview()
	{
          $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
			  $data['title'] = 'Login';
			  $data['navigation'] = 'Login';			  
			  $this->load->view('login_form', $data);			 
		  } 
		  else
		  {
			  $this->load->model('customer_model');
			  $data = array();		
			  if($query = $this->customer_model->get_profile())
			  {
				  $data['profile'] = $query;
			  }
			  
			  $data['title'] = 'Profile';
			  $data['navigation'] = 'My Account';
			  $this->load->view('customer_dashboard', $data);	
		  }				
	}
	
	function edit()
	{
          $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
			  $data['title'] = 'Login';
			  $data['navigation'] = 'Login';			  
			  $this->load->view('login_form');			 
		  } 
		  else
		  {
			  $this->load_edit();	
		  }				
	}

	function load_edit()
	{
          $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
			  $data['title'] = 'Login';
			  $data['navigation'] = 'Login';			  
			  $this->load->view('login_form');			 
		  } 
		  else
		  {
			  $this->load->model('customer_model');
			  $data = array();		
			  if($query = $this->customer_model->get_profile())
			  {
				  $data['profile'] = $query;
			  }
			  
			  $data['title'] = 'Profile Setting';
			  $data['navigation'] = 'Profile Setting';			  
			  $this->load->view('customer_update', $data);
		  }			
	}
	
	function update()
	{
          $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
			  $data['title'] = 'Login';
			  $data['navigation'] = 'Login';			  
			  $this->load->view('login_form', $data);			 
		  } 
		  else
		  {
			  $this->load->library('form_validation');			  
			  $this->form_validation->set_rules('first_name', '', 'trim|required');
			  $this->form_validation->set_rules('last_name', '', 'trim|required');
			  $this->form_validation->set_rules('company', '', 'trim');		
			  $this->form_validation->set_rules('address', '', 'trim|required');		
			  $this->form_validation->set_rules('city', '', 'trim|required');			
			  $this->form_validation->set_rules('country2', '', 'trim');			
			  $this->form_validation->set_rules('zip', '', 'trim|required');			
			  $this->form_validation->set_rules('telephone', '', 'trim|required');		
			  
			  if($this->form_validation->run() == FALSE)
			  {
				  $this->load_edit();
			  }
			  
			  else
				{	
					  $data = array(		  
						  'first_name' => $this->input->post('first_name'),
						  'last_name' => $this->input->post('last_name'),
						  'company' => $this->input->post('company'),
						  'address' => $this->input->post('address'),			
						  'city' => $this->input->post('city'),
						  'country' => $this->input->post('country2'),			
						  'zip' => $this->input->post('zip'),
						  'telephone' => $this->input->post('telephone'),			
								  
					  );
					  $this->load->model('customer_model');
					  $this->customer_model->update_profile($data);
					  $this->session->set_userdata($data);	
					  $this->load_edit();
				}
		  }			
	}
	
	function password()
	{
          $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
			  $data['title'] = 'Login';
			  $data['navigation'] = 'Login';			  
			  $this->load->view('login_form', $data);			 
		  } 
		  else
		  {
			  $data['title'] = 'Change Password';
			  $data['navigation'] = 'Change Password';			  
			 $this->load->view('customer_password', $data);
		  }			
	}	
	
	function update_password()
	{
          $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
			  $data['title'] = 'Login';
			  $data['navigation'] = 'Login';			  
			  $this->load->view('login_form', $data);			 
		  } 
		  else
		  {
			  $this->load->library('form_validation');
			  $this->form_validation->set_rules('old_password', '', 'trim|required|min_length[4]|max_length[32]');	
			  $this->form_validation->set_rules('password', '', 'trim|required|min_length[4]|max_length[32]');
			  $this->form_validation->set_rules('password_confirm', '', 'trim|required|matches[password]');	
			  
			  if($this->form_validation->run() == FALSE)
			  {
				   $this->password();
			  }			  
			  else
			  {		
				   $this->load->model('customer_model');
				   $result=$this->customer_model->get_old_pass(); // Getting Old Password
				   if($result)
						{
							$oldpass = $result->password;
							if($oldpass == md5($this->input->post('old_password')))
							{
							   $data = array(		  
									'password' => md5($this->input->post('password'))						  
								);							  
							   $this->load->model('customer_model');
							   $this->customer_model->update_password($data);
							   // Sending New Password in Email
								$this->load->library('email');
								$this->email->clear();
								
								$config['mailtype'] = 'html';
								$config['newline'] = "\r\n";
								$config['crlf'] = "\r\n";
								$config['protocol'] = 'sendmail';
								$this->email->initialize($config);
								
								$to = $this->session->userdata('email_address');
								$pass = $this->input->post('password');
								$name = $this->session->userdata('first_name');
								
								
								$this->email->from('support@osc.com', 'Online Shopping Cart');
								$this->email->to($to);
								$this->email->subject('Password Changed');
								
								$message = "<h3>Thank you, $name !! </h3><br> \r\n";
								$message .= "Here is your New login details. <br> <br> \r\n";
								$message .= "Email: $to <br> \r\n";
								$message .= "Password: $pass \r\n <br> <br>Thanks,";
								$this->email->message($message);					
								
								//$this->email->set_newline("\r\n");
			
								//$path = $this->config->item('server_root');
								//$file = $path . '/ci_day3/attachments/yourInfo.txt';
								//$this->email->attach($file);
								$this->email->send();
								
								
							  $data['title'] = 'Change Password';
							  $data['navigation'] = 'Change Password';	
							   $this->load->view('customer_password_thanks', $data);   
							}
							else 
							{
								$this->password();
							}
						}				   
			  }
		  }			
	}	
	
	function email()
	{
          $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
			  $data['title'] = 'Login';
			  $data['navigation'] = 'Login';			  
			  $this->load->view('login_form', $data);			 
		  } 
		  else
		  {
			  $data['title'] = 'Change Email';
			  $data['navigation'] = 'Change Email';				  
			 $this->load->view('customer_email', $data);
		  }			
	}	
	
	function update_email()
	{
          $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
			  $data['title'] = 'Change Email';
			  $data['navigation'] = 'Change Email';				  
			  $this->load->view('login_form',$data);			 
		  } 
		  else
		  {
			  $this->load->library('form_validation');
			  
		      $this->form_validation->set_rules('password', '', 'trim|required|min_length[4]|max_length[32]');
			  $this->form_validation->set_rules('email_address', '', 'trim|required|valid_email');
			  $this->form_validation->set_rules('email_address_confirm', '', 'trim|required|matches[email_address]');			
			  
			  if($this->form_validation->run() == FALSE)
			  {
				   $this->email();
			  }			  
			  else
			  {
				  $this->load->model('customer_model');
				  $result=$this->customer_model->get_old_pass(); // Getting Old Password
				  if($result)
					  {
						  $oldpass = $result->password;
						  $oldEmail = $result->email_address;
						  if($oldpass == md5($this->input->post('password')))
							{
								if($oldEmail == ($this->input->post('email_address')))
								{
									$data['title'] = 'Change Email';
									$data['navigation'] = 'Change Email';									
									$this->load->view('customer_emailexist',$data);									
								}
								else 
								{
									$data = array(		  
										'email_address' => $this->input->post('email_address')							  
									);								  
								    $this->load->model('customer_model');
								    $this->customer_model->update_email($data); // The new email address updated
								   // Sending New Password in Email
									$this->load->library('email');
									$this->email->clear();
									
									$config['mailtype'] = 'html';
									$config['newline'] = "\r\n";
									$config['crlf'] = "\r\n";
									$config['protocol'] = 'sendmail';
									$this->email->initialize($config);
									
									$newEmail = $this->input->post('email_address');
									$to = $this->session->userdata('email_address');
									$name = $this->session->userdata('first_name');
									
									
									$this->email->from('support@osc.com', 'Online Shopping Cart');
									$this->email->to($to);
									$this->email->cc($newEmail); 
									$this->email->subject('Email Changed');
									
									$message = "<h3>Thank you, $name !! </h3><br> \r\n";
									$message .= "Here is your New login details. <br> <br> \r\n";
									$message .= "Old Email: $to <br> \r\n";
									$message .= "New Email: $newEmail \r\n <br> <br>Thanks,";
									$this->email->message($message);					
									
									//$this->email->set_newline("\r\n");
				
									//$path = $this->config->item('server_root');
									//$file = $path . '/ci_day3/attachments/yourInfo.txt';
									//$this->email->attach($file);
									$this->email->send();
									
									$data=array();
									$data['email_address']=$newEmail;
									$this->session->set_userdata($data);
									
									$data['title'] = 'Change Email';
									$data['navigation'] = 'Change Email';									
				  
								    $this->load->view('customer_email_thanks', $data);									
									
								}
							}
						   else	
						   {
							  $data['title'] = 'Password';
							  $data['navigation'] = 'Password';							   
							 $this->load->view('customer_wrongpass',$data);  
						   }
					  }
			  }
		  }			
	}		
}