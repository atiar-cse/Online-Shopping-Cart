<?php

class Admin_Controller extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('auth');
		//$this->auth->is_logged_in(uri_string());
		$this->load->view('login_form');
		//load the base language file
		//$this->lang->load('admin_common');
	}
}