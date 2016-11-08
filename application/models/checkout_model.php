<?php

class Checkout_model extends CI_Model {

	function insert_customer($data)
	{
		$this->db->insert('customer', $data);

		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;		
	}
	function insert_order($data)
	{
		$this->db->insert('orders', $data);
		
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;
	}	
	
	function insert_order_detail($data)
	{
		$this->db->insert('orderdetails', $data);
	}	
}