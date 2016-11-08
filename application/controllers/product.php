<?php

class Product extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->all();
	}

	function all()
	{
		$this->load->model('product_model');
		$data = array();	
		$data['title']='Products - OSC';
		$data['navigation']='Products';		
		
			  $this->load->library('pagination'); // Starting Pagination Code			  
			  $config['base_url'] = 'http://atiar.me/osc/product/all';
			  $config['total_rows'] = $this->db->get('products')->num_rows();
			  $config['per_page'] = 3;
			  $config['num_links'] = 5;
			  
			  $config['first_link'] = '<< First';
			  $config['last_link'] = 'Last >>';
			  
			  $config['next_link'] = '&gt;';
			  $config['prev_link'] = '&lt;';
			  
			  $this->pagination->initialize($config);
			  
			  $data['products'] = $this->product_model->get_products_all();			

			$this->load->view('product_all', $data);		
	}
	
	function view()
	{
		$this->load->model('product_model');
		$data = array();	
		if($query = $this->product_model->get_details())
		{
			$data['products'] = $query;
		 	foreach($data['products'] as $product)			
			$data['title']= $product->name.' - OSC';
			$data['navigation']= "Product >> ".$product->name;			
			$this->load->view('product_view', $data);
		}			  
		else 
		   {
		   		$data['title']='Online Shopping Cart';
				$data['msg']='No Information for the product - DB failed.';
				$data['navigation']= "Product";		
				$this->load->view('product_view', $data);				
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
			  
			  $this->form_validation->set_rules('name', '', 'trim|required');		
			  $this->form_validation->set_rules('elm1', '', 'trim|required'); //description
			  $this->form_validation->set_rules('price', '', 'trim|required');		
			  $this->form_validation->set_rules('discount', '', 'trim');
			  $this->form_validation->set_rules('option_name', '', 'trim');
			  $this->form_validation->set_rules('option_values', '', 'trim');
			  
			  if($this->form_validation->run() == FALSE)
			  {
				  $data['title']='Add Product';
				  $this->load->view('add_product',$data);
			  }			  
			  else
			     {
					  $config['upload_path'] = './uploads/';
					  $config['allowed_types'] = 'gif|jpg|png';
					  $config['max_size']	= '3500';
					  $config['max_width']  = '9000';
					  $config['max_height']  = '6000';
			  
					  $this->load->library('upload', $config);					  
			  
					  if ( ! $this->upload->do_upload())
					  {
						  $data['msg'] = $this->upload->display_errors(); // If UPLOADING failed
						  $data['title']='Add Product';					
						  $this->load->view('add_product',$data);			  
					  }
					  else
					  {
						  $image_data = $this->upload->data();
						  
						  $config = array(
							  'source_image' => $image_data['full_path'],
							  'new_image' => './uploads/thumbs',
							  'maintain_ration' => true,
							  'width' => 150,
							  'height' => 100
						  );						  
						  $this->load->library('image_lib', $config);
						  $this->image_lib->resize();
						  
						  $data = array(
							  'name' => $this->input->post('name'),				  						  
							  'description' => $this->input->post('elm1'), // description
							  'category_id' => $this->input->post('category_id'),		
							  'price' => $this->input->post('price'),	
							  'available' => $this->input->post('available'),				  						  
							  'discount' => $this->input->post('discount'),
							  'discount_available' => $this->input->post('discount_available'),		
							  'option_name' => $this->input->post('option_name'),
							  'option_values' => $this->input->post('option_values'),
							  'picture' => $image_data['file_name'],			
						  );	
						  
						  $this->load->model('product_model');			
						  if($query = $this->product_model->add_product($data))
						  {			  
							  $data['title']='Add Product';
							  $data['msg']='Product Successfully added!';					
							  $this->load->view('add_product',$data);
						  }
						  else
						  {
							  $data['title']='Add Product';
							  $data['msg']='Error Occured!';					
							  $this->load->view('add_product',$data);		
						  }	
			  
					  }					 					 
				 }
			  
			  
		  }
	}
	

/*Starting Code For Product Management*/
/*Starting Code For Product Management*/

	function products() // all products for admin
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
			$data['title']='All Products';

			  $this->load->library('pagination'); // Starting Pagination Code			  
			  $config['base_url'] = 'http://atiar.me/osc/product/products';
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
				$this->load->view('all_products', $data);
			}			  
			else 
			   {
					$data['title']='All Products';
					$data['msg']='Nothing.';
					$this->load->view('all_products', $data);				
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
			$this->load->model('product_model');
			$data = array();	
			$data['title']='Edit Product';			
			
			if($query = $this->product_model->get_product_to_edit()) // To Edit Product
			{
				$data['product'] = $query;
				$this->load->view('edit_product', $data);
			}			  
			else 
			   {
					$data['title']='Edit Product';
					$data['msg']='Nothing.';
					$this->load->view('edit_product', $data);				
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
			  
			  $this->form_validation->set_rules('name', '', 'trim|required');		
			  $this->form_validation->set_rules('elm1', '', 'trim|required'); //description
			  $this->form_validation->set_rules('price', '', 'trim|required');		
			  $this->form_validation->set_rules('discount', '', 'trim');
			  $this->form_validation->set_rules('option_name', '', 'trim');
			  $this->form_validation->set_rules('option_values', '', 'trim');
			  
			  if($this->form_validation->run() == FALSE)
			  {
				  $data['title']='Edit Product';
				  $this->load->view('edit_product',$data);
			  }			  
			  else // else #1
			     {
							$data = array(
								'name' => $this->input->post('name'),				  						  
								'description' => $this->input->post('elm1'), // description
								'category_id' => $this->input->post('category_id'),		
								'price' => $this->input->post('price'),	
								'available' => $this->input->post('available'),				  						  
								'discount' => $this->input->post('discount'),
								'discount_available' => $this->input->post('discount_available'),		
								'option_name' => $this->input->post('option_name'),
								'option_values' => $this->input->post('option_values'),		
							);	
							
							$this->load->model('product_model');			
							if($query = $this->product_model->update_product($data))
							{			  
								$data['title']='Edit Product';
								$data['msg']='Product Successfully updated!';					
								$this->load->view('edit_product',$data);
							}
							else
							{
								$data['title']='Edit Product';
								$data['msg']='Error Occured!';					
								$this->load->view('edit_product',$data);		
							}	
					
				 } // end else #1
			  
			  
		  }
	}
	
	function delete() // delete product
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
			
			$this->product_model->delete_product();
			
			$data = array();	
			$data['title']='Products';
			$data['msg']='Successfully deleted.';
			
			  $this->load->library('pagination'); // Starting Pagination Code			  
			  $config['base_url'] = 'http://atiar.me/osc/product/delete';
			  $config['total_rows'] = $this->db->get('products')->num_rows();
			  $config['per_page'] = 10;
			  $config['num_links'] = 5;
			  
			  $config['first_link'] = '<< First';
			  $config['last_link'] = 'Last >>';
			  
			  $config['next_link'] = '&gt;';
			  $config['prev_link'] = '&lt;';
			  
			  $this->pagination->initialize($config);			
			
			if($query = $this->product_model->get_product_after_deleted())
			{
				$data['products'] = $query;
				$this->load->view('all_products', $data);
			}			  
			else 
			   {
					$data['title']='Products';
					$data['msg']='No Information.';
					$this->load->view('all_products', $data);				
			   }			
		}
	}	



}
?>