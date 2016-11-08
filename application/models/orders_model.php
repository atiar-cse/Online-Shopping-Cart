<?php

class Orders_model extends CI_Model {
	
	function get_customer_orders_num() // 
	{	
		$this->db->where('customer_id', $this->session->userdata('customer_id'));	
		$results = $this->db->get('orders')->num_rows();				
		return $results;
	}

	function get_customer_orders_nummm() // 
	{	
		$this->db->where('status', 'pending');	
		$results = $this->db->get('orders')->num_rows();				
		return $results;
	}
	
	function get_customer_orders() //
	{	
		$this->db->where('customer_id', $this->session->userdata('customer_id'));	
		$results = $this->db->get('orders',10,$this->uri->segment(3))->result();				
		return $results;
	}	
	
	
	
	
	
	function get_orders() // all category with pagination
	{		
		$results = $this->db->get('orders',10,$this->uri->segment(3))->result();				
		return $results;
	}
	
	function delete_order()
	{
		$this->db->where('order_id', $this->uri->segment(3));
		$this->db->delete('orders');
	}	
	
	function get_orders_after_deleted() // all category with pagination
	{		
		$results = $this->db->get('orders', $this->uri->segment(3))->result();				
		return $results;
	}
	
	function get_orders_pending_num() // 
	{	
		$this->db->where('status', 'pending');	
		$results = $this->db->get('orders')->num_rows();				
		return $results;
	}	
	
	function get_orders_pending() //
	{	
		$this->db->where('status', 'pending');		
		$results = $this->db->get('orders',10,$this->uri->segment(3))->result();				
		return $results;
	}	
	
	function get_orders_delivered_num() // 
	{	
		$this->db->where('status', 'delivered');	
		$results = $this->db->get('orders')->num_rows();				
		return $results;
	}	
	
	function get_orders_delivered() //
	{	
		$this->db->where('status', 'delivered');		
		$results = $this->db->get('orders',10,$this->uri->segment(3))->result();				
		return $results;
	}	
	
	function get_orders_details() //
	{	
		$this->db->where('order_id', $this->uri->segment(3));		
		$results = $this->db->get('orders')->result();	
		return $results;
	}

	function get_customer_orders_details() //
	{	
		$this->db->where('order_id', $this->uri->segment(3));
		$this->db->where('customer_id', $this->session->userdata('customer_id'));		
		$results = $this->db->get('orders')->result();	
		return $results;
	}	
	
	function get_product_order_details($id)
	{
		$this->db->where('order_id', $id);
		$results = $this->db->get('orderdetails')->result();	
		return $results;
	}	
	
	function get_product_name($id)
	{
		$this->db->select('name');
		$this->db->where('product_id', $id);
		$results = $this->db->get('products')->result();	
		return $results;
	}	
	
	function get_delivered()
	{
		$data = array(
				  'status' => 'delivered', 			
				);
		$this->db->where('order_id', $this->uri->segment(3));
		$this->db->update('orders', $data);
	}	
	
	function get_customer_email()
	{
		$this->db->select('ordership_email_address');
		$this->db->where('order_id', $this->uri->segment(3));
		$results = $this->db->get('orders')->result();	
		return $results;
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
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