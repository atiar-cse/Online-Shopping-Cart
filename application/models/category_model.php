<?php

class Category_model extends CI_Model {
	
	function get_category_name()
	{	
		$this->db->where('category_id', $this->uri->segment(3));	
		$results = $this->db->get('category')->result();				
		return $results;
	}	
	
	function get_products_num_by_category()
	{
		$this->db->select('*');
        $this->db->from('products');
		$this->db->where('category_id', $this->uri->segment(3));
        $query_result=$this->db->get();
        return $query_result->num_rows();		
	}	
	function get_products_by_category()
	{
		$this->db->where('category_id', $this->uri->segment(3));	
		$results = $this->db->get('products',6)->result();		
		foreach ($results as &$result) {			
			if ($result->option_values) {
				$result->option_values = explode(',',$result->option_values);
			}			
		}		
		return $results;		
	}	
	
	function delete_category()
	{
		$this->db->where('category_id', $this->uri->segment(3));
		$this->db->delete('category');
	}	
	function get_edited_category()
	{	
		$this->db->where('category_id', $this->input->post('hidden_id'));	
		$results = $this->db->get('category')->result();				
		return $results;
	}		
	
	function update_category($data)
	{
		
		$this->db->where('category_id', $this->input->post('hidden_id'));
		$this->db->update('category', $data);
	}	
	
	function edit_category()
	{	
		$this->db->where('category_id', $this->uri->segment(3));	
		$results = $this->db->get('category')->result();				
		return $results;
	}	
	
	function get_category() // all category with pagination
	{		
		$results = $this->db->get('category',10,$this->uri->segment(3))->result();				
		return $results;
	}
	function get_category_after_deleted() // all category with pagination
	{		
		$results = $this->db->get('category', $this->uri->segment(3))->result();				
		return $results;
	}		
	
	function is_category_exists()
	{
		$this->db->select('*');
        $this->db->from('category');
		$this->db->where('category_name', $this->input->post('category_name'));
        $query_result=$this->db->get();
        return $query_result->row();		
	}	
	
	function add_category($data)
	{
		$insert = $this->db->insert('category', $data);
		return $insert;
	}		
	
}