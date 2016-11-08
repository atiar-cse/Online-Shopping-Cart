<?php

class Orders extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	function index()
	{
		$data['title']= 'Category';
		//$data['navigation']= 'Cart';
		$this->load->view('add_category',$data, array('error' => ' ' ));
	}	
	
	function all() // all category for admin
	{
		$is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		{
			$data['title']='Log In';
			$this->load->view('admin_login',$data);		 
		} 
		else
		{
		
			$this->load->model('orders_model');
			$data = array();	
			$data['title']='Orders';

			  $this->load->library('pagination'); // Starting Pagination Code			  
			  $config['base_url'] = 'http://atiar.me/osc/orders/all';
			  $config['total_rows'] = $this->db->get('orders')->num_rows();
			  $config['per_page'] = 10;
			  $config['num_links'] = 5;
			  
			  $config['first_link'] = '<< First';
			  $config['last_link'] = 'Last >>';
			  
			  $config['next_link'] = '&gt;';
			  $config['prev_link'] = '&lt;';
			  
			  $this->pagination->initialize($config);
			  
			if($query = $this->orders_model->get_orders())
			{
				$data['orders'] = $query;
				$this->load->view('orders', $data);
			}			  
			else 
			   {
					$data['title']='Orders';
					$data['msg']='Nothing!';
					$this->load->view('orders', $data);				
			   }			
		}
	}		
	
	function delete() // all category for admin
	{
		$is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		{
			$data['title']='Log In';
			$this->load->view('admin_login',$data);		 
		} 
		else
		{	
			$this->load->model('orders_model');
			
			$this->orders_model->delete_order();
			
			$data = array();	
			$data['title']='Orders';
			$data['msg']='Successfully deleted.';
			
			  $this->load->library('pagination'); // Starting Pagination Code			  
			  $config['base_url'] = 'http://atiar.me/osc/orders/all';
			  $config['total_rows'] = $this->db->get('orders')->num_rows();
			  $config['per_page'] = 10;
			  $config['num_links'] = 5;
			  
			  $config['first_link'] = '<< First';
			  $config['last_link'] = 'Last >>';
			  
			  $config['next_link'] = '&gt;';
			  $config['prev_link'] = '&lt;';
			  
			  $this->pagination->initialize($config);			
			
			if($query = $this->orders_model->get_orders_after_deleted())
			{
				$data['orders'] = $query;
				$this->load->view('orders', $data);
			}			  
			else 
			   {
					$data['title']='Orders';
					$data['msg']='Nothing!';
					$this->load->view('orders', $data);				
			   }			
		}
	}	

	function pending() // all category for admin
	{
		$is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		{
			$data['title']='Log In';
			$this->load->view('admin_login',$data);		 
		} 
		else
		{
		
			$this->load->model('orders_model');
			$data = array();	
			$data['title']='Pending Orders';

			  $this->load->library('pagination'); // Starting Pagination Code			  
			  $config['base_url'] = 'http://atiar.me/osc/orders/all';
			  $config['total_rows'] = $this->orders_model->get_orders_pending_num();
			  $config['per_page'] = 10;
			  $config['num_links'] = 5;
			  
			  $config['first_link'] = '<< First';
			  $config['last_link'] = 'Last >>';
			  
			  $config['next_link'] = '&gt;';
			  $config['prev_link'] = '&lt;';
			  
			  $this->pagination->initialize($config);
			  
			if($query = $this->orders_model->get_orders_pending())
			{
				$data['orders'] = $query;
				$this->load->view('orders_pending', $data);
			}			  
			else 
			   {
					$data['title']='Pending Orders';
					$data['msg']='Nothing!';
					$this->load->view('orders_pending', $data);				
			   }			
		}
	}	

	function delivered() // all category for admin
	{
		$is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		{
			$data['title']='Log In';
			$this->load->view('admin_login',$data);		 
		} 
		else
		{
		
			$this->load->model('orders_model');
			$data = array();	
			$data['title']='Delivered Orders';

			  $this->load->library('pagination'); // Starting Pagination Code			  
			  $config['base_url'] = 'http://atiar.me/osc/orders/all';
			  $config['total_rows'] = $this->orders_model->get_orders_delivered_num();
			  $config['per_page'] = 10;
			  $config['num_links'] = 5;
			  
			  $config['first_link'] = '<< First';
			  $config['last_link'] = 'Last >>';
			  
			  $config['next_link'] = '&gt;';
			  $config['prev_link'] = '&lt;';
			  
			  $this->pagination->initialize($config);
			  
			if($query = $this->orders_model->get_orders_delivered())
			{
				$data['orders'] = $query;
				$this->load->view('orders', $data);
			}			  
			else 
			   {
					$data['title']='Delivered Orders';
					$data['msg']='Nothing!';
					$this->load->view('orders', $data);				
			   }			
		}
	}	
	
	function details() // all category for admin
	{
		$is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		{
			$data['title']='Log In';
			$this->load->view('admin_login',$data);		 
		} 
		else
		{
		
			$this->load->model('orders_model');
			$data = array();	
			$data['title']='Order Details';
			  
			if($query = $this->orders_model->get_orders_details())
			{
				$data['orders'] = $query;
				$this->load->view('orders_details', $data);
			}			  
			else 
			   {
					$data['title']='Order Details';
					$data['msg']='Nothing!';
					$this->load->view('orders_details', $data);				
			   }			
		}
	}	
	
	function todeliver() // all category for admin
	{
		$is_admin_logged_in = $this->session->userdata('is_admin_logged_in');
		if(!isset($is_admin_logged_in) || $is_admin_logged_in != true)
		{
			$data['title']='Log In';
			$this->load->view('admin_login',$data);		 
		} 
		else
		{
		
			$this->load->model('orders_model');
			$data = array();	
			$data['title']='Order Details';
			
			$this->orders_model->get_delivered();
			$data['msg']='Successfully updated!';
			
			$customer_email = $this->orders_model->get_customer_email();
			
				   // Sending New Password in Email
					$this->load->library('email');
					$this->email->clear();
					
					$config['mailtype'] = 'html';
					$config['newline'] = "\r\n";
					$config['crlf'] = "\r\n";
					$config['protocol'] = 'sendmail';
					$this->email->initialize($config);
					
					$to = $this->orders_model->get_customer_email();		
					
					$this->email->from('support@osc.com', 'Online Shopping Cart');
					$this->email->to($to);
					$this->email->subject('Order Delivery Notification');
					
					$message = "<h3>Thank you, your order has been delivered!! </h3><br> \r\n";
					$this->email->message($message);					
					
					//$this->email->set_newline("\r\n");

					//$path = $this->config->item('server_root');
					//$file = $path . '/ci_day3/attachments/yourInfo.txt';
					//$this->email->attach($file);
					$this->email->send();			
			
			if($query = $this->orders_model->get_orders_details())
			{
				$data['orders'] = $query;
				$this->load->view('orders_details', $data);
			}			  
			else 
			   {
					$data['title']='Order Details';
					$data['msg']='Nothing!';
					$this->load->view('orders_details', $data);				
			   }			
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
			  
			  $this->form_validation->set_rules('category_name', '', 'trim|required');		
			  
			  if($this->form_validation->run() == FALSE)
			  {
				  $data['title']='Edit Category';
				  $this->load->view('edit_category',$data);
			  }			  
			  else
			     {
					  $this->load->model('category_model');	
					  if($query = $this->category_model->is_category_exists()) //333
					  {
						  $data['title']='Edit Category';
						  $data['msg']='The category name already exists!';
						  $this->load->view('edit_category',$data);
					  }			  
					  else // else #3
						 { 
							  $data = array(
								  'category_name' => $this->input->post('category_name'),  						  
								  'description' => $this->input->post('category_description'),			
							  );						 
							  
							  $this->load->model('category_model');	
					
							  $this->category_model->update_category($data);
							 			  
								  $data['title']='Update Category';
								  $data['msg']='Category successfully updated!';
								  
								  if($query = $this->category_model->get_edited_category())
								  {
									  $data['category'] = $query;
									  //$this->load->view('edit_category', $data);
								  }								  
								  
								  $this->load->view('edit_category',$data);
							 
								  
															 
						 } // End else #3					 
			  					 					 
				 }			  
			  
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
			$this->load->model('category_model');
			$data = array();	
			$data['title']='Category';			
			
			if($query = $this->category_model->edit_category())
			{
				$data['category'] = $query;
				$this->load->view('edit_category', $data);
			}			  
			else 
			   {
					$data['title']='Category';
					$data['msg']='Nothing!';
					$this->load->view('edit_category', $data);				
			   }					
		}		
	}		
}

