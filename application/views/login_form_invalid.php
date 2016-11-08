<?php $this->load->view('header'); ?>


          <?php 		
          $is_logged_in = $this->session->userdata('is_logged_in');
                  if(!isset($is_logged_in) || $is_logged_in != true)
                  {
					echo '<div id="container">';
					echo '<div id="login_form"><h1>Please Login !</h1>';
					
					echo form_label('<p class="invalid">Invalid login or password.</p>');
					
					echo form_open('login/validate_credentials');
					echo form_label('Email Address<em>*</em>');	
					  $email = array(
					  'name' => 'email_address',
					  'type' => 'email',
					  'id' => '',
					  'value' => '',
					  'autocomplete' => 'off',
					  'class' => '',
					  'placeholder' => 'Your Email',
					  'required' => 'required',
					  );					
					echo form_input($email);
					
					echo form_label('Password<em>*</em>');
					  $data = array(
					  'name' => 'password',
					  'id' => '',
					  'value' => '',
					  'autocomplete' => 'off',
					  'class' => '',
					  'placeholder' => 'Your Password',
					  'required' => 'required',
					  );					
					echo form_password($data);
					echo form_submit('submit', 'Login');
					echo anchor('signup', 'Create Account');
					echo form_close();
					echo '</div>'; 
					echo '</div>'; 
                  } 
                  else
                  {
					  echo '<div id="container">';
					  echo '<div id="login_form">';
                      echo '<h2>';echo 'You are  '; echo $this->session->userdata('first_name'); echo ' '; echo $this->session->userdata('last_name'); echo '!<br/>';echo 'Please '; echo anchor('login/logout', 'logout');echo '</h2>';
					  echo '</div>';
					  echo '</div>';
                  }
                  
          ?> 


<?php $this->load->view('footer'); ?>

