<?php

class Product_model extends CI_Model {
	
	function add_product($data)
	{
		$insert = $this->db->insert('products', $data);
		return $insert;
	}
	function get_search_products_rows() // for Search Page with pagination
	{
		$this->db->or_like('name', $this->input->post('search'));
		$this->db->or_like('description', $this->input->post('search'));
		$this->db->or_like('price', $this->input->post('search'));	
		$this->db->or_like('option_name', $this->input->post('search'));
		$this->db->or_like('option_values', $this->input->post('search'));			
		$results = $this->db->get('products')->num_rows();				
		return $results;
	}	
	function get_search_products() // for Search Page with pagination
	{
		$this->db->or_like('name', $this->input->post('search'));
		$this->db->or_like('description', $this->input->post('search'));
		$this->db->or_like('price', $this->input->post('search'));
		$this->db->or_like('option_name', $this->input->post('search'));
		$this->db->or_like('option_values', $this->input->post('search'));			
		$this->db->order_by("product_id", "desc");
		$results = $this->db->get('products',9,$this->uri->segment(3))->result();		
		foreach ($results as &$result) {			
			if ($result->option_values) {
				$result->option_values = explode(',',$result->option_values);
			}			
		}		
		return $results;
	}	

	function get_products_all() // for Products Page with pagination
	{
		$this->db->order_by("product_id", "desc");
		$results = $this->db->get('products',9,$this->uri->segment(3))->result();		
		foreach ($results as &$result) {			
			if ($result->option_values) {
				$result->option_values = explode(',',$result->option_values);
			}			
		}		
		return $results;
	}
	
	function get_products() // For Home Page
	{
		$this->db->order_by("product_id", "desc");
		$results = $this->db->get('products',6)->result();		
		foreach ($results as &$result) {			
			if ($result->option_values) {
				$result->option_values = explode(',',$result->option_values);
			}			
		}		
		return $results;		
		
		//$query = $this->db->get('products', 6);
		//return $query->result();
	}
	
	function get_details() // View a single product
	{
		$this->db->where('product_id', $this->uri->segment(3));	
		$results = $this->db->get('products')->result();		
		foreach ($results as &$result) {			
			if ($result->option_values) {
				$result->option_values = explode(',',$result->option_values);
			}			
		}		
		return $results;		
	}	
	
/*Starting Code For Product Management*/
/*Starting Code For Product Management*/

	function get_products_for_admin() // For Admin Page
	{
		$this->db->order_by("product_id", "desc");
		$results = $this->db->get('products',10,$this->uri->segment(3))->result();				
		return $results;		
	}
	
	function edit_product()
	{	
		$this->db->where('category_id', $this->uri->segment(3));	
		$results = $this->db->get('category')->result();				
		return $results;
	}
	
	function get_category_name($id)
	{	
		$this->db->select('category_name');
		$this->db->where('category_id', $id);	
		$results = $this->db->get('category')->result();				
		return $results;
	}	
	
	function get_product_to_edit() 
	{
		$this->db->where('product_id', $this->uri->segment(3));	
		$results = $this->db->get('products')->result();			
		return $results;		
	}	
	
	function update_product($data)
	{		
		$this->db->where('product_id', $this->uri->segment(3));
		$this->db->update('products', $data);
	}	
	function delete_product()
	{
		$this->db->where('product_id', $this->uri->segment(3));
		$this->db->delete('products');
	}
	function get_product_after_deleted() // all category with pagination
	{	
     	$this->db->order_by("product_id", "desc");
		$results = $this->db->get('products', $this->uri->segment(3))->result();				
		return $results;
	}	
	
}