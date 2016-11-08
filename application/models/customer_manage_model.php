<?php

class Customer_manage_model extends CI_Model {
	
	function get_customer_orders($id)
	{
		$this->db->where('customer_id', $id);
		$results = $this->db->get('orders')->num_rows();				
		return $results;
	}	
	
	function delete_customer()
	{
		$this->db->where('customer_id', $this->uri->segment(3));
		$this->db->delete('customer');
	}
	
	function get_customers() // all customers with pagination
	{		
		$results = $this->db->get('customer',10,$this->uri->segment(3))->result();				
		return $results;
	}
	function get_customer_after_deleted() // all category with pagination
	{		
		$results = $this->db->get('customer', $this->uri->segment(3))->result();				
		return $results;
	}			
	
}