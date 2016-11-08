<?php

class Contact extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
	function index()
	{
		$data['title']= 'Contact Us';
		$data['navigation']= 'Contact Us';		
		$this->load->view('contact',$data, array('error' => ' ' ));
	}	
	
	function send()
	{
		   // Sending New Password in Email
			$this->load->library('email');
			$this->email->clear();
			
			$config['mailtype'] = 'html';
			$config['newline'] = "\r\n";
			$config['crlf'] = "\r\n";
			$config['protocol'] = 'sendmail';
			$this->email->initialize($config);
			
			$to = 'atiar.cse@gmail.com';
			$name = $this->input->post('first_name');
			$lname = $this->input->post('last_name');
			$email = $this->input->post('email_ad');
			$phone = $this->input->post('phone');
			$message = $this->input->post('message');
			
			
			$this->email->from($email);
			$this->email->to($to);
			$this->email->subject('Contact Us Form - OSC');
			
			$message = "<h3>Name : $name $lname!! </h3><br> \r\n";
			$message .= "Email: $email <br> \r\n";
			$message .= "Phone: $phone <br> \r\n";
			$message .= "Message: $message <br> \r\n";			
			$this->email->message($message);					
			
			//$this->email->set_newline("\r\n");

			//$path = $this->config->item('server_root');
			//$file = $path . '/ci_day3/attachments/yourInfo.txt';
			//$this->email->attach($file);
			$this->email->send();		
		
		$data['title']= 'Contact Us';
		$data['msg']= 'Your email was sent successfully!';		
		$data['navigation']= 'Contact Us';		
		$this->load->view('contact',$data, array('error' => ' ' ));
	}		


}