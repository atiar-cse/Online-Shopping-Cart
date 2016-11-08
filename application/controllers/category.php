<?php

class Category extends CI_Controller {

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
	function cat()
	{
		$this->load->model('category_model');	
		
			  $this->load->library('pagination'); // Starting Pagination Code			  
			  $config['base_url'] = 'http://atiar.me/osc/category/cat';
			  $config['total_rows'] = $this->category_model->get_products_num_by_category();
			  $config['per_page'] = 6;
			  $config['num_links'] = 5;
			  
			  $config['first_link'] = '<< First';
			  $config['last_link'] = 'Last >>';
			  
			  $config['next_link'] = '&gt;';
			  $config['prev_link'] = '&lt;';
			  
			  $this->pagination->initialize($config);
			  
			  if($query = $this->category_model->get_products_by_category())
			  {
				  $data['products'] = $query;
				  $data['title']= 'Category';
				  $data['navigation']= 'Category';
				  $this->load->view('view_category',$data);
			  }			  
			  else 
			   {
					$data['title']= 'Category';
					$data['navigation']= 'Category';
					//$data['msg']='No Information - DB failed.';
					$this->load->view('view_category', $data);				
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
			$this->load->model('category_model');
			
			$this->category_model->delete_category();
			
			$data = array();	
			$data['title']='Category';
			$data['msg']='Successfully deleted.';
			
			  $this->load->library('pagination'); // Starting Pagination Code			  
			  $config['base_url'] = 'http://atiar.me/osc/category/categories';
			  $config['total_rows'] = $this->db->get('category')->num_rows();
			  $config['per_page'] = 10;
			  $config['num_links'] = 5;
			  
			  $config['first_link'] = '<< First';
			  $config['last_link'] = 'Last >>';
			  
			  $config['next_link'] = '&gt;';
			  $config['prev_link'] = '&lt;';
			  
			  $this->pagination->initialize($config);			
			
			if($query = $this->category_model->get_category_after_deleted())
			{
				$data['category'] = $query;
				$this->load->view('all_category', $data);
			}			  
			else 
			   {
					$data['title']='Category';
					$data['msg']='No Information - DB failed.';
					$this->load->view('all_category', $data);				
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
					$data['msg']='No Information - DB failed.';
					$this->load->view('edit_category', $data);				
			   }					
		}		
	}	
	
	function categories() // all category for admin
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

			  $this->load->library('pagination'); // Starting Pagination Code			  
			  $config['base_url'] = 'http://atiar.me/osc/category/categories';
			  $config['total_rows'] = $this->db->get('category')->num_rows();
			  $config['per_page'] = 10;
			  $config['num_links'] = 5;
			  
			  $config['first_link'] = '<< First';
			  $config['last_link'] = 'Last >>';
			  
			  $config['next_link'] = '&gt;';
			  $config['prev_link'] = '&lt;';
			  
			  $this->pagination->initialize($config);
			  
			if($query = $this->category_model->get_category())
			{
				$data['category'] = $query;
				$this->load->view('all_category', $data);
			}			  
			else 
			   {
					$data['title']='Category';
					$data['msg']='No Information - DB failed.';
					$this->load->view('all_category', $data);				
			   }			
		}
	}	
	
	function add()
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
				  $data['title']='Add Category';
				  $this->load->view('add_category',$data);
			  }			  
			  else
			     {
					  $this->load->model('category_model');	
					  if($query = $this->category_model->is_category_exists()) //333
					  {
						  $data['title']='Add Category';
						  $data['msg']='The category name already exists!';
						  $this->load->view('add_category',$data);
					  }			  
					  else // else #3
						 {  
							  $data = array(
								  'category_name' => $this->input->post('category_name'),  						  
								  'description' => $this->input->post('category_description'),			
							  );	
							  
							  $this->load->model('category_model');			
							  if($query = $this->category_model->add_category($data)) //3333
							  {			  
								  $data['title']='Add Category';
								  $data['msg']='Category Successfully added!';					
								  $this->load->view('add_category',$data);
							  }
							  else
							  {
								  $data['title']='Add Category';
								  $data['msg']='Error Occured!';					
								  $this->load->view('add_category',$data);		
							  }									  
															 
						 } // End else #3					 
			  					 					 
				 }			  
			  
		  }
	}	
}

