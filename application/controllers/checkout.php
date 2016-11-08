<?php

class Checkout extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
	function index()
	{
          $is_logged_in = $this->session->userdata('is_logged_in');
		  if(!isset($is_logged_in) || $is_logged_in != true)
		  {
			  $data['title']= 'Checkout - OSC';
			  $data['navigation']= 'Checkout';		
			  $this->load->view('checkout',$data, array('error' => ' ' ));			 
		  } 
		  else
		  {
			  $this->load->model('customer_model');
			  $data = array();		
			  if($query = $this->customer_model->get_profile())
			  {
				  $data['profile'] = $query;
			  }			  
			  
			  $data['title']= 'Checkout - OSC';
			  $data['navigation']= 'Checkout - You are already logged in!!';		
			  $this->load->view('checkout_logged',$data, array('error' => ' ' ));	
		  }			
	}	

	function save_order()
	{
		$tt = $this->input->post('rad');
		
		if($tt == "bank" )
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
			$this->form_validation->set_rules('country', '', 'trim|required');			
			$this->form_validation->set_rules('zip', '', 'trim|required');			
			$this->form_validation->set_rules('telephone', '', 'trim|required');
			
			$this->form_validation->set_rules('bank_first_name', '', 'trim|required');			
			$this->form_validation->set_rules('back_acc_num', '', 'trim|required');			
			$this->form_validation->set_rules('bank_name', '', 'trim|required');			
			
			if($this->form_validation->run() == FALSE)
			{
				$data['title']= 'Checkout - OSC';
				$data['navigation']= 'Checkout';		
				$this->load->view('checkout',$data, array('error' => ' ' ));
			}
			else  // Start else #1
			{
				$this->load->model('customer_model');	
				$result=$this->customer_model->emailAddressCheck();
				if($result)
				{
					$data['title']= 'Checkout - OSC';
					$data['navigation']= 'Checkout';
					$data['msg']= 'The email you entered already exists! If you are sure that is your email, Please login with the email. Thanks!';					
					$this->load->view('checkout',$data, array('error' => ' ' ));
				}// End if emailcheck
				else // Start else #2
				{
					$this->load->model('checkout_model');	
					$customer = array(
						'email_address' => $this->input->post('email_address'),							  
						'password' => md5($this->input->post('password')),										  
												  
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'company' => $this->input->post('company'),
						'address' => $this->input->post('address'),			
						'city' => $this->input->post('city'),
						'country' => $this->input->post('country'),			
						'zip' => $this->input->post('zip'),
						'telephone' => $this->input->post('telephone'),
					);
					
					$cust_id = $this->checkout_model->insert_customer($customer);
					
					$data=array(); // Start code for setting session for the customer
					$data['customer_id']= $cust_id;
					$data['first_name']= $this->input->post('first_name');
					$data['last_name']= $this->input->post('last_name');					
					$data['email_address']= $this->input->post('email_address');
					$data['is_logged_in']=true;
					$this->session->set_userdata($data);	// End code for setting session for the customer					
					
					$order = array(
						'customer_id' => $cust_id,
						'orderamount' => $this->input->post('orderamount'),						
						'ordership_email_address' => $this->input->post('email_address'),										  
												  
						'ordership_first_name' => $this->input->post('first_name'),
						'ordership_last_name' => $this->input->post('last_name'),
						'ordership_company' => $this->input->post('company'),
						'ordership_address' => $this->input->post('address'),			
						'ordership_city' => $this->input->post('city'),
						'ordership_country' => $this->input->post('country'),			
						'ordership_zip' => $this->input->post('zip'),
						'ordership_telephone' => $this->input->post('telephone'),							   
						'orderdate' => date('Y-m-d'),
						
						'paymentmethod' => $this->input->post('bank_name'),			
						'bankaccholder' => $this->input->post('bank_first_name'),
						'bankaccnumber' => $this->input->post('back_acc_num'),
						'status' => 'pending',
					);	
					
					$ord_id = $this->checkout_model->insert_order($order); // in orders table				
					
					if ($cart = $this->cart->contents()):
						foreach ($cart as $item):
							$order_detail = array(
								'order_id' 		=> $ord_id,
								'product_id' 	=> $item['id'],
								'quantity' 		=> $item['qty'],
								'price' 		=> $item['price'],
								'total' 		=> $item['subtotal'],							
							);	
							if ($this->cart->has_options($item['rowid'])) 
							{
								foreach ($this->cart->product_options($item['rowid']) as $option => $value) 
								{
									$order_detail['option_name']= $option;
									$order_detail['option_values']= $value;																
								}
										
							 }
	
							$cust_id = $this->checkout_model->insert_order_detail($order_detail);
							
						endforeach;
					endif;
					
					$this->load->library('email'); // Start code for sending email
					$this->email->clear();
					
					$config['mailtype'] = 'html';
					$config['newline'] = "\r\n";
					$config['crlf'] = "\r\n";
					$config['protocol'] = 'sendmail';
					$this->email->initialize($config);
					
					$to = $this->input->post('email_address');
					$name = $this->input->post('first_name');
					$adminEmail = 'atiar.cse@gmail.com';
					
					$pmethod = $this->input->post('bank_name');
					$bname = $this->input->post('bank_first_name');
					$bnum = $this->input->post('back_acc_num');
					
						$firstname = $this->input->post('first_name');
						$lastname = $this->input->post('last_name');
						$company = $this->input->post('company');
						$address = $this->input->post('address');			
						$city = $this->input->post('city');
						$country = $this->input->post('country');			
						$zip = $this->input->post('zip');
						$telephone = $this->input->post('telephone');					
					
					$this->email->from('support@osc.com', 'Online Shopping Cart');
					$this->email->to($to);
					$this->email->bcc($adminEmail); 
					$this->email->subject('New Order - OSC');
					
					$message = '<h3>Thank you, ' . $name . '!! </h3><br>' . "\r\n";
					
					$message .= 'Here is your New Order details. <br> <br>' . "\r\n";
					
					if ($cart = $this->cart->contents()):
						foreach ($cart as $item):
							$message .= '<ul> ';
							$message .= '<li> <strong>Prdoduct Name : </strong>' . $item['name'] . '</li>';
							$message .= '<li> <strong>Prdoduct Price : </strong>' . $item['price'] . '</li>';
							$message .= '<li> <strong>Quantity : </strong>' . $item['qty'] . '</li>';							
							if ($this->cart->has_options($item['rowid'])) 
							{
								foreach ($this->cart->product_options($item['rowid']) as $option => $value) 
								{
									$message .= '<li> <strong>Prdoduct Option - </strong>' . $option . ':' . $value . '</li>';															
								}
										
							 }
							 
							$message .= '<li> <strong>Sub Total : </strong>' . $item['subtotal'] . '</li>';	
							$message .= '</ul> ';
							
						endforeach;
						
							$message .= '<strong>Payment Method : ' . $pmethod . '</strong>, ';	
							$message .= '<br/><strong>Your Name : ' . $bname . '</strong>, ';	
							$message .= '<br/><strong>A/C Number : ' . $bnum . '</strong>';	
							
							$message .= '<h3>Grand Total : ' . number_format(40+$this->cart->total(),2) . ' BDT with shipping charge.</h3>';							
					endif;
							$message .= '<br/><h4>Shipping Address : </h4>';	
							$message .= '<strong>Your Name : </strong>' . $firstname . ' ' . $lastname . '<br/>';	
							$message .= '<strong>Company : </strong>' . $company . '<br/>';	
							$message .= '<strong>Address : </strong>' . $address . '<br/>';	
							$message .= '<strong>City : </strong>' . $city . '<br/>';	
							$message .= '<strong>Country : </strong>' . $country . '<br/>';	
							$message .= '<strong>Zip Code : </strong>' . $zip . '<br/>';
							$message .= '<strong>Telephone : </strong>' . $telephone . '<br/>';							
							
							$message .= '<br/><strong>Thanks - OSC!! </strong>';					
					
					$this->email->message($message);					
					
					//$this->email->set_newline("\r\n");

					//$path = $this->config->item('server_root');
					//$file = $path . '/ci_day3/attachments/yourInfo.txt';
					//$this->email->attach($file);
					$this->email->send();	// End code code for sending email
					
					$this->cart->destroy();
					
					$data['title']= 'Checkout - OSC';
					$data['navigation']= 'Checkout placed';
					$data['msg']= 'Order successfuly placed!!';				
					$this->load->view('checkout',$data, array('error' => ' ' ));					
				} // End else #2
			} // End else #1
		} // End if bank
		
		if($tt == "bkash" )
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
			$this->form_validation->set_rules('country', '', 'trim|required');			
			$this->form_validation->set_rules('zip', '', 'trim|required');			
			$this->form_validation->set_rules('telephone', '', 'trim|required');
			
			$this->form_validation->set_rules('bkashNumber', '', 'trim|required');			
			$this->form_validation->set_rules('trxid', '', 'trim|required');						
			
			if($this->form_validation->run() == FALSE)
			{
				$data['title']= 'Checkout - OSC';
				$data['navigation']= 'Checkout';		
				$this->load->view('checkout',$data, array('error' => ' ' ));
			}
			else  // Start else #1
			{
				$this->load->model('customer_model');	
				$result=$this->customer_model->emailAddressCheck();
				if($result)
				{
					$data['title']= 'Checkout - OSC';
					$data['navigation']= 'Checkout';
					$data['msg']= 'The email you entered already exists! If you are sure that is your email, Please login with the email. Thanks!';					
					$this->load->view('checkout',$data, array('error' => ' ' ));
				}// End if emailcheck
				else // Start else #2
				{
					$this->load->model('checkout_model');	
					$customer = array(
						'email_address' => $this->input->post('email_address'),							  
						'password' => md5($this->input->post('password')),										  
												  
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'company' => $this->input->post('company'),
						'address' => $this->input->post('address'),			
						'city' => $this->input->post('city'),
						'country' => $this->input->post('country'),			
						'zip' => $this->input->post('zip'),
						'telephone' => $this->input->post('telephone'),
					);
					
					$cust_id = $this->checkout_model->insert_customer($customer);
					
					$data=array(); // Start code for setting session for the customer
					$data['customer_id']= $cust_id;
					$data['first_name']= $this->input->post('first_name');
					$data['last_name']= $this->input->post('last_name');					
					$data['email_address']= $this->input->post('email_address');
					$data['is_logged_in']=true;
					$this->session->set_userdata($data);	// End code for setting session for the customer					
					
					$order = array(
						'customer_id' => $cust_id,
						'orderamount' => $this->input->post('orderamount'),						
						'ordership_email_address' => $this->input->post('email_address'),										  
												  
						'ordership_first_name' => $this->input->post('first_name'),
						'ordership_last_name' => $this->input->post('last_name'),
						'ordership_company' => $this->input->post('company'),
						'ordership_address' => $this->input->post('address'),			
						'ordership_city' => $this->input->post('city'),
						'ordership_country' => $this->input->post('country'),			
						'ordership_zip' => $this->input->post('zip'),
						'ordership_telephone' => $this->input->post('telephone'),							   
						'orderdate' => date('Y-m-d'),
						
						'paymentmethod' => 'bKash',			
						'bkashno' => $this->input->post('bkashNumber'),
						'bkashtrxid' => $this->input->post('trxid'),
						'status' => 'pending',
					);	
					
					$ord_id = $this->checkout_model->insert_order($order); // in orders table				
					
					if ($cart = $this->cart->contents()):
						foreach ($cart as $item):
							$order_detail = array(
								'order_id' 		=> $ord_id,
								'product_id' 	=> $item['id'],
								'quantity' 		=> $item['qty'],
								'price' 		=> $item['price'],
								'total' 		=> $item['subtotal'],							
							);	
							if ($this->cart->has_options($item['rowid'])) 
							{
								foreach ($this->cart->product_options($item['rowid']) as $option => $value) 
								{
									$order_detail['option_name']= $option;
									$order_detail['option_values']= $value;																
								}
										
							 }
	
							$cust_id = $this->checkout_model->insert_order_detail($order_detail);
							
						endforeach;
					endif;
					
					$this->load->library('email'); // Start code for sending email
					$this->email->clear();
					
					$config['mailtype'] = 'html';
					$config['newline'] = "\r\n";
					$config['crlf'] = "\r\n";
					$config['protocol'] = 'sendmail';
					$this->email->initialize($config);
					
					$to = $this->input->post('email_address');
					$name = $this->input->post('first_name');
					$adminEmail = 'atiar.cse@gmail.com';
					
					$pmethod = 'bKash';
					$bname = $this->input->post('bkashNumber');
					$bnum = $this->input->post('trxid');	
					
						$firstname = $this->input->post('first_name');
						$lastname = $this->input->post('last_name');
						$company = $this->input->post('company');
						$address = $this->input->post('address');			
						$city = $this->input->post('city');
						$country = $this->input->post('country');			
						$zip = $this->input->post('zip');
						$telephone = $this->input->post('telephone');					
					
					$this->email->from('support@osc.com', 'Online Shopping Cart');
					$this->email->to($to);
					$this->email->bcc($adminEmail); 
					$this->email->subject('New Order - OSC');
					
					$message = '<h3>Thank you, ' . $name . '!! </h3><br>' . "\r\n";
					
					$message .= 'Here is your New Order details. <br> <br>' . "\r\n";
					
					if ($cart = $this->cart->contents()):
						foreach ($cart as $item):
							$message .= '<ul> ';
							$message .= '<li> <strong>Prdoduct Name : </strong>' . $item['name'] . '</li>';
							$message .= '<li> <strong>Prdoduct Price : </strong>' . $item['price'] . '</li>';
							$message .= '<li> <strong>Quantity : </strong>' . $item['qty'] . '</li>';							
							if ($this->cart->has_options($item['rowid'])) 
							{
								foreach ($this->cart->product_options($item['rowid']) as $option => $value) 
								{
									$message .= '<li> <strong>Prdoduct Option - </strong>' . $option . ':' . $value . '</li>';															
								}
										
							 }
							 
							$message .= '<li> <strong>Sub Total : </strong>' . $item['subtotal'] . '</li>';	
							$message .= '</ul> ';
							
						endforeach;
						
							$message .= '<strong>Payment Method : ' . $pmethod . '</strong>, ';	
							$message .= '<br/><strong>bKash Number : ' . $bname . '</strong>, ';	
							$message .= '<br/><strong>TrxID : ' . $bnum . '</strong>';	
							
							$message .= '<h3>Grand Total : ' . number_format(40+$this->cart->total(),2) . ' BDT with shipping charge.</h3>';							
					endif;
							$message .= '<br/><h4>Shipping Address : </h4>';	
							$message .= '<strong>Your Name : </strong>' . $firstname . ' ' . $lastname . '<br/>';	
							$message .= '<strong>Company : </strong>' . $company . '<br/>';	
							$message .= '<strong>Address : </strong>' . $address . '<br/>';	
							$message .= '<strong>City : </strong>' . $city . '<br/>';	
							$message .= '<strong>Country : </strong>' . $country . '<br/>';	
							$message .= '<strong>Zip Code : </strong>' . $zip . '<br/>';
							$message .= '<strong>Telephone : </strong>' . $telephone . '<br/>';
							
							$message .= '<br/><strong>Thanks - OSC!! </strong>';					
					
					$this->email->message($message);					
					
					//$this->email->set_newline("\r\n");

					//$path = $this->config->item('server_root');
					//$file = $path . '/ci_day3/attachments/yourInfo.txt';
					//$this->email->attach($file);
					$this->email->send();	// End code code for sending email
					
					$this->cart->destroy();
					
					$data['title']= 'Checkout - OSC';
					$data['navigation']= 'Checkout placed';
					$data['msg']= 'Order successfuly placed!!';				
					$this->load->view('checkout',$data, array('error' => ' ' ));					
				} // End else #2
			} // End else #1					
		} // End if bKash	
/*		else 
		{
			  $data['title']= 'Checkout - OSC';
			  $data['navigation']= 'Checkout';
			  $data['msg']= 'Please select a payment method!';				
			  $this->load->view('checkout',$data, array('error' => ' ' ));			
		}*/	
	}	
	
	function save_order_logged()
	{
		$tt = $this->input->post('rad');
		
		if($tt == "bank" )
		{
			$this->load->library('form_validation');
			
			// field name, error message, validation rules
			//$this->form_validation->set_rules('email_address', '', 'trim|required|valid_email');		
			//$this->form_validation->set_rules('password', '', 'trim|required|min_length[4]|max_length[32]');
			//$this->form_validation->set_rules('password_confirm', '', 'trim|required|matches[password]');		
			
			$this->form_validation->set_rules('first_name', '', 'trim|required');
			$this->form_validation->set_rules('last_name', '', 'trim|required');
			$this->form_validation->set_rules('company', '', 'trim');		
			$this->form_validation->set_rules('address', '', 'trim|required');		
			$this->form_validation->set_rules('city', '', 'trim|required');			
			$this->form_validation->set_rules('country', '', 'trim|required');			
			$this->form_validation->set_rules('zip', '', 'trim|required');			
			$this->form_validation->set_rules('telephone', '', 'trim|required');
			
			$this->form_validation->set_rules('bank_first_name', '', 'trim|required');			
			$this->form_validation->set_rules('back_acc_num', '', 'trim|required');			
			$this->form_validation->set_rules('bank_name', '', 'trim|required');			
			
			if($this->form_validation->run() == FALSE)
			{
			  $this->load->model('customer_model');
			  $data = array();		
			  if($query = $this->customer_model->get_profile())
			  {
				  $data['profile'] = $query;
			  }					
				
				$data['title']= 'Checkout - OSC';
				$data['navigation']= 'Checkout';		
				$this->load->view('checkout_logged',$data, array('error' => ' ' ));
			}
			else  // Start else #1
			{
		
					$this->load->model('checkout_model');	
					
					
					$order = array(
						'customer_id' => $this->session->userdata('customer_id'),
						'orderamount' => $this->input->post('orderamount'),						
						'ordership_email_address' => $this->session->userdata('email_address'),										  
												  
						'ordership_first_name' => $this->input->post('first_name'),
						'ordership_last_name' => $this->input->post('last_name'),
						'ordership_company' => $this->input->post('company'),
						'ordership_address' => $this->input->post('address'),			
						'ordership_city' => $this->input->post('city'),
						'ordership_country' => $this->input->post('country'),			
						'ordership_zip' => $this->input->post('zip'),
						'ordership_telephone' => $this->input->post('telephone'),							   
						'orderdate' => date('Y-m-d'),
						
						'paymentmethod' => $this->input->post('bank_name'),			
						'bankaccholder' => $this->input->post('bank_first_name'),
						'bankaccnumber' => $this->input->post('back_acc_num'),
						'status' => 'pending',
					);	
					
					$ord_id = $this->checkout_model->insert_order($order); // in orders table				
					
					if ($cart = $this->cart->contents()):
						foreach ($cart as $item):
							$order_detail = array(
								'order_id' 		=> $ord_id,
								'product_id' 	=> $item['id'],
								'quantity' 		=> $item['qty'],
								'price' 		=> $item['price'],
								'total' 		=> $item['subtotal'],							
							);	
							if ($this->cart->has_options($item['rowid'])) 
							{
								foreach ($this->cart->product_options($item['rowid']) as $option => $value) 
								{
									$order_detail['option_name']= $option;
									$order_detail['option_values']= $value;																
								}
										
							 }
	
							$cust_id = $this->checkout_model->insert_order_detail($order_detail);
							
						endforeach;
					endif;
					
					$this->load->library('email'); // Start code for sending email
					$this->email->clear();
					
					$config['mailtype'] = 'html';
					$config['newline'] = "\r\n";
					$config['crlf'] = "\r\n";
					$config['protocol'] = 'sendmail';
					$this->email->initialize($config);
					
					$to = $this->session->userdata('email_address');
					$name = $this->input->post('first_name');
					$adminEmail = 'atiar.cse@gmail.com';
					
					$pmethod = $this->input->post('bank_name');
					$bname = $this->input->post('bank_first_name');
					$bnum = $this->input->post('back_acc_num');	
					
						$firstname = $this->input->post('first_name');
						$lastname = $this->input->post('last_name');
						$company = $this->input->post('company');
						$address = $this->input->post('address');			
						$city = $this->input->post('city');
						$country = $this->input->post('country');			
						$zip = $this->input->post('zip');
						$telephone = $this->input->post('telephone');					
					
					$this->email->from('support@osc.com', 'Online Shopping Cart');
					$this->email->to($to);
					$this->email->bcc($adminEmail); 
					$this->email->subject('New Order - OSC');
					
					$message = '<h3>Thank you, ' . $name . '!! </h3><br>' . "\r\n";
					
					$message .= 'Here is your New Order details. <br> <br>' . "\r\n";
					
					if ($cart = $this->cart->contents()):
						foreach ($cart as $item):
							$message .= '<ul> ';
							$message .= '<li> <strong>Prdoduct Name : </strong>' . $item['name'] . '</li>';
							$message .= '<li> <strong>Prdoduct Price : </strong>' . $item['price'] . '</li>';
							$message .= '<li> <strong>Quantity : </strong>' . $item['qty'] . '</li>';							
							if ($this->cart->has_options($item['rowid'])) 
							{
								foreach ($this->cart->product_options($item['rowid']) as $option => $value) 
								{
									$message .= '<li> <strong>Prdoduct Option - </strong>' . $option . ':' . $value . '</li>';															
								}
										
							 }
							 
							$message .= '<li> <strong>Sub Total : </strong>' . $item['subtotal'] . '</li>';	
							$message .= '</ul> ';
							
						endforeach;
						
							$message .= '<strong>Payment Method : ' . $pmethod . '</strong>, ';	
							$message .= '<br/><strong>Your Name : ' . $bname . '</strong>, ';	
							$message .= '<br/><strong>A/C Number : ' . $bnum . '</strong>';	
							
							$message .= '<h3>Grand Total : ' . number_format(40+$this->cart->total(),2) . ' BDT with shipping charge.</h3>';							
					endif;
							$message .= '<br/><h4>Shipping Address : </h4>';	
							$message .= '<strong>Your Name : </strong>' . $firstname . ' ' . $lastname . '<br/>';	
							$message .= '<strong>Company : </strong>' . $company . '<br/>';	
							$message .= '<strong>Address : </strong>' . $address . '<br/>';	
							$message .= '<strong>City : </strong>' . $city . '<br/>';	
							$message .= '<strong>Country : </strong>' . $country . '<br/>';	
							$message .= '<strong>Zip Code : </strong>' . $zip . '<br/>';
							$message .= '<strong>Telephone : </strong>' . $telephone . '<br/>';
							
							$message .= '<br/><strong>Thanks - OSC!! </strong>';					
					
					$this->email->message($message);					
					
					//$this->email->set_newline("\r\n");

					//$path = $this->config->item('server_root');
					//$file = $path . '/ci_day3/attachments/yourInfo.txt';
					//$this->email->attach($file);
					$this->email->send();	// End code code for sending email
					
					$this->cart->destroy();
					
					$data['title']= 'Checkout - OSC';
					$data['navigation']= 'Checkout placed';
					$data['msg']= 'Order successfuly placed!!';				
					$this->load->view('checkout_logged',$data, array('error' => ' ' ));					

			} // End else #1
		} // End if bank
		
		if($tt == "bkash" )
		{
			$this->load->library('form_validation');
			
			// field name, error message, validation rules
			//$this->form_validation->set_rules('email_address', '', 'trim|required|valid_email');		
			//$this->form_validation->set_rules('password', '', 'trim|required|min_length[4]|max_length[32]');
			//$this->form_validation->set_rules('password_confirm', '', 'trim|required|matches[password]');		
			
			$this->form_validation->set_rules('first_name', '', 'trim|required');
			$this->form_validation->set_rules('last_name', '', 'trim|required');
			$this->form_validation->set_rules('company', '', 'trim');		
			$this->form_validation->set_rules('address', '', 'trim|required');		
			$this->form_validation->set_rules('city', '', 'trim|required');			
			$this->form_validation->set_rules('country', '', 'trim|required');			
			$this->form_validation->set_rules('zip', '', 'trim|required');			
			$this->form_validation->set_rules('telephone', '', 'trim|required');
			
			$this->form_validation->set_rules('bkashNumber', '', 'trim|required');			
			$this->form_validation->set_rules('trxid', '', 'trim|required');						
			
			if($this->form_validation->run() == FALSE)
			{
			  $this->load->model('customer_model');
			  $data = array();		
			  if($query = $this->customer_model->get_profile())
			  {
				  $data['profile'] = $query;
			  }					
				
				$data['title']= 'Checkout - OSC';
				$data['navigation']= 'Checkout';		
				$this->load->view('checkout_logged',$data, array('error' => ' ' ));
			}
			else  // Start else #1
			{
					$this->load->model('checkout_model');						
					
					$order = array(
						'customer_id' => $this->session->userdata('customer_id'),
						'orderamount' => $this->input->post('orderamount'),						
						'ordership_email_address' => $this->session->userdata('email_address'),										  
												  
						'ordership_first_name' => $this->input->post('first_name'),
						'ordership_last_name' => $this->input->post('last_name'),
						'ordership_company' => $this->input->post('company'),
						'ordership_address' => $this->input->post('address'),			
						'ordership_city' => $this->input->post('city'),
						'ordership_country' => $this->input->post('country'),			
						'ordership_zip' => $this->input->post('zip'),
						'ordership_telephone' => $this->input->post('telephone'),							   
						'orderdate' => date('Y-m-d'),
						
						'paymentmethod' => 'bKash',			
						'bkashno' => $this->input->post('bkashNumber'),
						'bkashtrxid' => $this->input->post('trxid'),
						'status' => 'pending',
					);
					
					$ord_id = $this->checkout_model->insert_order($order); // in orders table				
					
					if ($cart = $this->cart->contents()):
						foreach ($cart as $item):
							$order_detail = array(
								'order_id' 		=> $ord_id,
								'product_id' 	=> $item['id'],
								'quantity' 		=> $item['qty'],
								'price' 		=> $item['price'],
								'total' 		=> $item['subtotal'],							
							);	
							if ($this->cart->has_options($item['rowid'])) 
							{
								foreach ($this->cart->product_options($item['rowid']) as $option => $value) 
								{
									$order_detail['option_name']= $option;
									$order_detail['option_values']= $value;																
								}
										
							 }
	
							$cust_id = $this->checkout_model->insert_order_detail($order_detail);
							
						endforeach;
					endif;
					
					$this->load->library('email'); // Start code for sending email
					$this->email->clear();
					
					$config['mailtype'] = 'html';
					$config['newline'] = "\r\n";
					$config['crlf'] = "\r\n";
					$config['protocol'] = 'sendmail';
					$this->email->initialize($config);
					
					$to = $this->session->userdata('email_address');
					$name = $this->input->post('first_name');

					$adminEmail = 'atiar.cse@gmail.com';
					
					$pmethod = 'bKash';
					$bname = $this->input->post('bkashNumber');
					$bnum = $this->input->post('trxid');	
					
						$firstname = $this->input->post('first_name');
						$lastname = $this->input->post('last_name');
						$company = $this->input->post('company');
						$address = $this->input->post('address');			
						$city = $this->input->post('city');
						$country = $this->input->post('country');			
						$zip = $this->input->post('zip');
						$telephone = $this->input->post('telephone');					
					
					$this->email->from('support@osc.com', 'Online Shopping Cart');
					$this->email->to($to);
					$this->email->bcc($adminEmail); 
					$this->email->subject('New Order - OSC');
					
					$message = '<h3>Thank you, ' . $name . '!! </h3><br>' . "\r\n";
					
					$message .= 'Here is your New Order details. <br> <br>' . "\r\n";
					
					if ($cart = $this->cart->contents()):
						foreach ($cart as $item):
							$message .= '<ul> ';
							$message .= '<li> <strong>Prdoduct Name : </strong>' . $item['name'] . '</li>';
							$message .= '<li> <strong>Prdoduct Price : </strong>' . $item['price'] . '</li>';
							$message .= '<li> <strong>Quantity : </strong>' . $item['qty'] . '</li>';							
							if ($this->cart->has_options($item['rowid'])) 
							{
								foreach ($this->cart->product_options($item['rowid']) as $option => $value) 
								{
									$message .= '<li> <strong>Prdoduct Option - </strong>' . $option . ':' . $value . '</li>';															
								}
										
							 }
							 
							$message .= '<li> <strong>Sub Total : </strong>' . $item['subtotal'] . '</li>';	
							$message .= '</ul> ';
							
						endforeach;
						
							$message .= '<strong>Payment Method : ' . $pmethod . '</strong>, ';	
							$message .= '<br/><strong>bKash Number : ' . $bname . '</strong>, ';	
							$message .= '<br/><strong>TrxID : ' . $bnum . '</strong>';	
							
							$message .= '<h3>Grand Total : ' . number_format(40+$this->cart->total(),2) . ' BDT with shipping charge.</h3>';							
					endif;
							$message .= '<br/><h4>Shipping Address : </h4>';	
							$message .= '<strong>Your Name : </strong>' . $firstname . ' ' . $lastname . '<br/>';	
							$message .= '<strong>Company : </strong>' . $company . '<br/>';	
							$message .= '<strong>Address : </strong>' . $address . '<br/>';	
							$message .= '<strong>City : </strong>' . $city . '<br/>';	
							$message .= '<strong>Country : </strong>' . $country . '<br/>';	
							$message .= '<strong>Zip Code : </strong>' . $zip . '<br/>';
							$message .= '<strong>Telephone : </strong>' . $telephone . '<br/>';
							
							$message .= '<br/><strong>Thanks - OSC!! </strong>';					
					
					$this->email->message($message);					
					
					//$this->email->set_newline("\r\n");

					//$path = $this->config->item('server_root');
					//$file = $path . '/ci_day3/attachments/yourInfo.txt';
					//$this->email->attach($file);
					$this->email->send();	// End code code for sending email
					
					$this->cart->destroy();
					
					$data['title']= 'Checkout - OSC';
					$data['navigation']= 'Checkout done!';
					$data['msg']= 'Order successfuly placed!!';				
					$this->load->view('checkout_logged',$data, array('error' => ' ' ));					

			} // End else #1					
		} // End if bKash	
/*		else 
		{
			  $this->load->model('customer_model');
			  $data = array();		
			  if($query = $this->customer_model->get_profile())
			  {
				  $data['profile'] = $query;
			  }				
			  $data['title']= 'Checkout - OSC';
			  $data['navigation']= 'Checkout';
			  $data['msg']= 'Please select a payment method!';				
			  $this->load->view('checkout_logged',$data, array('error' => ' ' ));			
		}
*/	}		

}