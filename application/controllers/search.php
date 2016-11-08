<?php

class Search extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
	function index()
	{
		
			  $this->load->model('product_model');
			  $data = array();	
			  $data['title']='Search - OSC';
			  $data['navigation']='Search';	
			  
					$this->load->library('pagination'); // Starting Pagination Code			  
					$config['base_url'] = 'http://atiar.me/osc/search/index';
					$config['total_rows'] = $this->product_model->get_search_products_rows();
					$config['per_page'] = 3;
					$config['num_links'] = 5;
					
					$config['first_link'] = '<< First';
					$config['last_link'] = 'Last >>';
					
					$config['next_link'] = '&gt;';
					$config['prev_link'] = '&lt;';
					
					$this->pagination->initialize($config);
					
					$data['search_query'] = $this->input->post('search');
					$data['total_matched'] = $this->product_model->get_search_products_rows();
					$data['products'] = $this->product_model->get_search_products();			
	  
				  $this->load->view('search', $data);				
	
	}


}