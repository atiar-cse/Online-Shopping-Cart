<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title><?php echo $title;?> - OSC</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/iecss.css" />
<![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>js/boxOver.js"></script>
</head>
<body>

<div id="main_container">
	<div id="login_form_admin">
    	<!--<h1>Please Login !</h1> -->
        <em><b>Warning</b> - 
    	 The page you tried to access requires you to be logged in.</em>
		<?php if(isset($msg)) { echo '<br/>'; echo '<br/>'; echo '<p class="error">'; echo $msg; echo '</p>';} ?>

        	<?php 
                echo form_open('admin/validate_credentials');
                echo form_label('');	
                  $email = array(
                  'name' => 'email_address',
                  'type' => 'email',
                  'id' => '',
                  'value' => '',
                  'autocomplete' => 'off',
                  'class' => '',
                  'placeholder' => 'Email Address',
                  'required' => 'required',
                  );					
                echo form_input($email);
                
                echo form_label('');
                  $data = array(
                  'name' => 'password',
                  'id' => '',
                  'value' => '',
                  'autocomplete' => 'off',
                  'class' => '',
                  'placeholder' => 'Password',
                  'required' => 'required',
                  );					
                echo form_password($data);
				echo form_hidden('redirect', current_url());
                echo form_submit('submit', 'Login');
                echo form_close();  
			?>
            
        <div id="admin_logo">
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>css/images/logo.png" alt="" title="" border="0" width="310" height="95" /></a> 
	    </div> <!--End logo-->              
</div>
               
</div>                 
    


<?php //$this->load->view('admin_footer'); ?>

