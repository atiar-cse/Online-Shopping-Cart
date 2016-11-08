<?php

class Customer_model extends CI_Model {

	function validate()
	{
		$this->db->where('email_address', $this->input->post('email_address'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('customer');
		
		if($query->num_rows == 1)
		{
			return true;
		}
		
	}
	
	function fullName() // fullName 
	{
		$this->db->select('*');
        $this->db->from('customer');
		$this->db->where('email_address', $this->input->post('email_address'));
        $query_result=$this->db->get();
        return $query_result->row();
	}
	
	function emailAddressCheck()
	{
		$this->db->select('*');
        $this->db->from('customer');
		$this->db->where('email_address', $this->input->post('email_address'));
        $query_result=$this->db->get();
        return $query_result->row();		
	}
	
	function create_customer()
	{
		
		$new_customer_insert_data = array(
			'email_address' => $this->input->post('email_address'),							  
			'password' => md5($this->input->post('password')),										  
									  
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'company' => $this->input->post('company'),
			'address' => $this->input->post('address'),			
			'city' => $this->input->post('city'),
			'country' => $this->input->post('country'),			
			'zip' => $this->input->post('zip'),
			'telephone' => $this->input->post('telephone'),			
					
		);
		
		$insert = $this->db->insert('customer', $new_customer_insert_data);
		return $insert;
	}
	
	function get_profile()
	{
		$this->db->select('*');
        $this->db->from('customer');
		$this->db->where('customer_id', $this->session->userdata('customer_id'));	
		$query = $this->db->get();
		return $query->result();
	}	
	
	function update_profile($data) 
	{
		$this->db->where('customer_id', $this->session->userdata('customer_id'));
		$this->db->update('customer', $data);		
	}	
	
	function update_password($data) 
	{
		$this->db->where('customer_id', $this->session->userdata('customer_id'));
		$this->db->update('customer', $data);		
	}
	
	function update_email($data) 
	{
		$this->db->where('customer_id', $this->session->userdata('customer_id'));
		$this->db->update('customer', $data);		
	}	
	
	function get_old_pass() // Old Password 
	{
		$this->db->select('*');
        $this->db->from('customer');
		$this->db->where('customer_id', $this->session->userdata('customer_id'));
        $query_result=$this->db->get();
        return $query_result->row();
	}	
}