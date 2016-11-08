<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Osc extends CI_Controller {

	public function index()
	{
		$this->load->model('product_model');
		$data = array();	
		$data['title']='Online Shopping Cart';
		if($query = $this->product_model->get_products())
		{
			$data['products'] = $query;
			$this->load->view('index', $data);
		}			  
		else 
		   {
		   		$data['title']='Online Shopping Cart';
				$data['msg']='No Information - DB failed.';
				$this->load->view('index', $data);				
		   }
	}
}

