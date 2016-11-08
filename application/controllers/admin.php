<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
          $is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		  if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		  {
		   	  $data['title']='Log In';
			  $this->load->view('admin_login',$data);		 
		  } 
		  else
		  {
					$this->load->model('product_model');
					$data = array();	
					$data['title']='Dashboard';
		
					  $this->load->library('pagination'); // Starting Pagination Code			  
					  $config['base_url'] = 'http://atiar.me/osc/admin/index';
					  $config['total_rows'] = $this->db->get('products')->num_rows();
					  $config['per_page'] = 10;
					  $config['num_links'] = 5;
					  
					  $config['first_link'] = '<< First';
					  $config['last_link'] = 'Last >>';
					  
					  $config['next_link'] = '&gt;';
					  $config['prev_link'] = '&lt;';
					  
					  $this->pagination->initialize($config);
					  
					if($query = $this->product_model->get_products_for_admin())
					{
						$data['products'] = $query;
						$this->load->view('admin_dashboard', $data);
					}			  
					else 
					   {
							$data['title']='Dashboard';
							$data['msg']='Nothing.';
							$this->load->view('admin_dashboard', $data);				
					   }			  
			  
			  
			  			  
		  }
	}	
	
	public function profile()
	{
          $is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		  if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		  {
		   	  $data['title']='Log In';
			  $this->load->view('admin_login',$data);		 
		  } 
		  else
		  {
			  $this->overview();	
		  }		
	}
	
	function overview()
	{
          $is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		  if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		  {
		   	  $data['title']='Log In';
			  $this->load->view('admin_login',$data);		 
		  } 
		  else
		  {
			  $this->load->model('admin_model');
			  $data = array();	
  		   	  $data['title']='Profile';
			  if($query = $this->admin_model->get_profile())
			  {
				  $data['profile'] = $query;
			  }			  
			  $this->load->view('admin_profile', $data);	
		  }				
	}	
	
	function validate_credentials()	// OK
	{		
		$this->load->model('admin_model');
		$query = $this->admin_model->validate();
		
		if($query) // if the user's credentials validated...
		{

			$result=$this->admin_model->fullName(); // fullName & Setting Session
			if($result)
				{
					$data=array();
					$data['admin_id']=$result->admin_id;
					$data['admin_first_name']=$result->first_name;
					$data['admin_last_name']=$result->last_name;					
					$data['admin_email_address']=$result->admin_email;
					$data['is_admin_logged_in']=true;
					$this->session->set_userdata($data);
					
					redirect('admin');
					//$this->index();
				}			
		}
		else // incorrect username or password
		{
			$data['title']='Log In';
			$data['msg']='Invalid Email or Password.';
			$this->load->view('admin_login',$data);
		}
	}		

	public function add()
	{
          $is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		  if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		  {
		   	  $data['title']='Log In';
			  $this->load->view('admin_login',$data);		 
		  } 
		  else
		  { ////
			  $this->load->library('form_validation');
			  
			  // field name, msg message, validation rules
			  $this->form_validation->set_rules('admin_email', '', 'trim|required|valid_email');		
			  $this->form_validation->set_rules('password', '', 'trim|required|min_length[4]|max_length[32]');
			  $this->form_validation->set_rules('password_confirm', '', 'trim|required|matches[password]');		
			  
			  $this->form_validation->set_rules('first_name', '', 'trim|required');
			  $this->form_validation->set_rules('last_name', '', 'trim|required');
			  $this->form_validation->set_rules('role', '', 'trim');		
			  
			  if($this->form_validation->run() == FALSE)
			  {
				  $data['title']='Add Admin';
				  $this->load->view('admin_add',$data);
			  }
			  
			  else
			  {			
				  
				  $this->load->model('admin_model');	
				  $result=$this->admin_model->adminEmailAddressCheck(); //cehecking duplicate email address
				  if($result)
				  {
					  $data['title']='Add Admin';
					  $data['msg']='The Email already exists';
					  $this->load->view('admin_add',$data);
				  }
				  else 
				  {
					  $this->load->model('admin_model');			
					  if($query = $this->admin_model->add_admin())
					  {
						  $this->load->library('email');
						  $this->email->clear();
						  
						  $config['mailtype'] = 'html';
						  $config['newline'] = "\r\n";
						  $config['crlf'] = "\r\n";
						  $config['protocol'] = 'sendmail';
						  $this->email->initialize($config);
						  
						  $to = $this->input->post('admin_email');
						  $pass = $this->input->post('password');
						  $name = $this->input->post('first_name');
						  $role = $this->input->post('role');
						  
						  
						  $this->email->from('support@osc.com', 'Online Shopping Cart');
						  $this->email->to($to);
						  $this->email->subject('OSC added you as a administrator');
						  
						  $message = "<h3>Thank you, $name !! </h3><br> \r\n";
						  $message .= "Here is your login details. <br> <br> \r\n";
						  $message .= "Email: $to <br> \r\n";
						  $message .= "Role: $role <br> \r\n";
						  $message .= "Password: $pass \r\n <br> <br>Thanks,";
						  $this->email->message($message);					
						  
						  $this->email->set_newline("\r\n");
	  
						  //$path = $this->config->item('server_root');
						  //$file = $path . '/ci_day3/attachments/yourInfo.txt';
						  //$this->email->attach($file);
						  $this->email->send();
						  
						  $data['title']='Add Admin';
						  $data['msg']='Successfully added!';					
						  $this->load->view('admin_add',$data);
					  }
					  else
					  {
						  $data['title']='Add Admin';
						  $data['msg']='Error Occured!';					
						  $this->load->view('admin_add',$data);		
					  }				
				  }
				  
			  }////			  
		  }
	}
	
	function edit()
	{
          $is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		  if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		  {
		   	  $data['title']='Log In';
			  $this->load->view('admin_login',$data);		 
		  }
		  else
		  {
			  $this->load_edit();	
		  }				
	}

	function load_edit()
	{
          $is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		  if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		  {
		   	  $data['title']='Log In';
			  $this->load->view('admin_login',$data);		 
		  }
		  else
		  {
			  $this->load->model('admin_model');
			  $data = array();	
			  $data['title']='Profile Edit';
			  if($query = $this->admin_model->get_profile())
			  {
				  $data['profile'] = $query;
			  }
			  
			  $this->load->view('admin_update', $data);
		  }			
	}
	
	function update()
	{
          $is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		  if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		  {
		   	  $data['title']='Log In';
			  $this->load->view('admin_login',$data);		 
		  }
		  else
		  {			  
			  $this->load->library('form_validation');
			  $this->form_validation->set_rules('first_name', '', 'trim|required');
			  $this->form_validation->set_rules('last_name', '', 'trim|required');
			  $this->form_validation->set_rules('role2', '', 'trim');		
			  
			  if($this->form_validation->run() == FALSE)
			  {
				  $this->load_edit();
			  }			  
			  else
				  {	  
						$data = array(		  
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name'),
							'role' => $this->input->post('role2'),						  
						);
						$this->load->model('admin_model');
						$this->admin_model->update_profile($data);
						$data = array(		  
							'admin_first_name' => $this->input->post('first_name'),
							'admin_last_name' => $this->input->post('last_name'),						  
						);			  
						$this->session->set_userdata($data);	
						
						$this->load->model('admin_model'); // Getting information after updated
						$data = array();	
						$data['title']='Profile Edit';
						$data['msg']='Successfully Updated!';			  
						if($query = $this->admin_model->get_profile())
						{
							$data['profile'] = $query;
						}			  
						$this->load->view('admin_update', $data);	
				  }
			
		  }			
	}	
	
	function password()
	{
          $is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		  if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		  {
		   	  $data['title']='Log In';
			  $this->load->view('admin_login',$data);		 
		  }
		  else
		  {
     	   	 $data['title']='Change Password';
			 $this->load->view('admin_password',$data);
		  }			///
	}	
	
	function update_password()
	{
          $is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		  if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		  {
		   	  $data['title']='Log In';
			  $this->load->view('admin_login',$data);		 
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
				   $this->load->model('admin_model');
				   $result=$this->admin_model->get_old_pass(); // Getting Old Password
				   if($result)
						{
							$oldpass = $result->password;
							if($oldpass == md5($this->input->post('old_password')))
							{
							   $data = array(		  
									'password' => md5($this->input->post('password'))						  
								);							  
							   $this->load->model('admin_model');
							   $this->admin_model->update_password($data);
							   // Sending New Password in the Admin Email
								$this->load->library('email');
								$this->email->clear();
								
								$config['mailtype'] = 'html';
								$config['newline'] = "\r\n";
								$config['crlf'] = "\r\n";
								$config['protocol'] = 'sendmail';
								$this->email->initialize($config);
								
								$to = $this->session->userdata('admin_email_address');
								$pass = $this->input->post('password');
								$name = $this->session->userdata('admin_first_name');
								
								
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
								
								$data['msg']='Password Changed Successfully!';
							    $data['title']='Change Password';
							    $this->load->view('admin_password',$data);  
							}
							else 
							{
								$data['msg']='Current password did not match.';
							    $data['title']='Change Password';
							    $this->load->view('admin_password',$data);
							}
						}				   
			  }
		  }			
	}		
	
	function email()
	{
          $is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		  if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		  {
		   	  $data['title']='Log In';
			  $this->load->view('admin_login',$data);		 
		  }
		  else
		  {
		   	 $data['title']='Change Email'; 
			 $this->load->view('admin_email',$data);
		  }			
	}	
	
	function update_email()
	{
          $is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		  if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		  {
		   	  $data['title']='Log In';
			  $this->load->view('admin_login',$data);		 
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
				  $this->load->model('admin_model');
				  $result=$this->admin_model->get_old_pass(); // Getting Old Password
				  if($result)
					  {
						  $oldpass = $result->password;
						  $oldEmail = $result->admin_email;
						  if($oldpass == md5($this->input->post('password')))
							{
								if($oldEmail == ($this->input->post('email_address')))
								{
									$data['msg']='You entered the email that already exists!';
									$data['title']='Change Email';
									$this->load->view('admin_email',$data);									
								}
								else 
								{
									$data = array(		  
										'admin_email' => $this->input->post('email_address')							  
									);								  
								    $this->load->model('admin_model');
								    $this->admin_model->update_email($data); // The new email address updated
								   // Sending New Password in Email
									$this->load->library('email');
									$this->email->clear();
									
									$config['mailtype'] = 'html';
									$config['newline'] = "\r\n";
									$config['crlf'] = "\r\n";
									$config['protocol'] = 'sendmail';
									$this->email->initialize($config);
									
									$newEmail = $this->input->post('email_address');
									$to = $this->session->userdata('admin_email_address');
									$name = $this->session->userdata('admin_first_name');
									
									
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
									$data['admin_email_address']=$newEmail;
									$this->session->set_userdata($data);									
				  
									$data['msg']='Your Email address has been chagned successfully!';
									$data['title']='Change Email';
									$this->load->view('admin_email',$data); 								
									
								}
							}
						   else	
						   {
								$data['msg']='Current password did not match.';
							    $data['title']='Change Email';
							    $this->load->view('admin_email',$data); 
						   }
					  }
			  }
		  }			
	}




	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}

}
