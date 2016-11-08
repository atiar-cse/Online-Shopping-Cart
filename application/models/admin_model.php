<?php

class Admin_model extends CI_Model {

	function validate()
	{
		$this->db->where('admin_email', $this->input->post('email_address'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('admin');
		
		if($query->num_rows == 1)
		{
			return true;
		}
		
	}
	
	function fullName() // fullName 
	{
		$this->db->select('*');
        $this->db->from('admin');
		$this->db->where('admin_email', $this->input->post('email_address'));
        $query_result=$this->db->get();
        return $query_result->row();
	}	
	
	function adminEmailAddressCheck()
	{
		$this->db->select('*');
        $this->db->from('admin');
		$this->db->where('admin_email', $this->input->post('admin_email'));
        $query_result=$this->db->get();
        return $query_result->row();		
	}
	
	function get_profile()
	{
		$this->db->select('*');
        $this->db->from('admin');
		$this->db->where('admin_id', $this->session->userdata('admin_id'));	
		$query = $this->db->get();
		return $query->result();
	}	
	
	function update_profile($data) 
	{
		$this->db->where('admin_id', $this->session->userdata('admin_id'));
		$this->db->update('admin', $data);		
	}	
	
	function add_admin()
	{
		$this->load->helper('date');
		$format = 'DATE_RFC822';
		$time = time();
		$tt = standard_date($format, $time); // GMT time
		$data = array(
			'admin_email' => $this->input->post('admin_email'),							  
			'password' => md5($this->input->post('password')),										  
									  
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'admin_registered' => $tt,			
			'role' => $this->input->post('role'),		
					
		);
		
		$insert = $this->db->insert('admin', $data);
		return $insert;
	}	
	
	function get_old_pass() // Old Password 
	{
		$this->db->select('*');
        $this->db->from('admin');
		$this->db->where('admin_id', $this->session->userdata('admin_id'));
        $query_result=$this->db->get();
        return $query_result->row();
	}	
	
	function update_password($data) 
	{
		$this->db->where('admin_id', $this->session->userdata('admin_id'));
		$this->db->update('admin', $data);		
	}	
	
	function update_email($data) 
	{
		$this->db->where('admin_id', $this->session->userdata('admin_id'));
		$this->db->update('admin', $data);		
	}	
	
}