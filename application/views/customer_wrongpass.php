<?php $this->load->view('header'); ?>


        	

<div id="container">

	<?php $this->load->view('customer_left_nav'); ?>
    
    <div id="acc-container"> 
    	<div class="border-bottom acc-dash">      	
        	<h3>Account Update >> Change Email</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>          
        </div>
    	<div class="border-bottom cus-name2">
        	<?php echo validation_errors('<p class="error">'); ?>
			<?php
            $attributes = array('class' => 'email', 'id' => 'myform2');
            echo form_open('customer/update_email',$attributes);
			?>
        	<div class="update-form">
					<p class="invalid">You entered wrong password!!</p>
            </div>            
        	<div class="update-form">
            	New Email<em>*</em> : <?php   $data = array(
					'name' => 'email_address',
					'type' => 'email',					
					'autocomplete' => 'off',
					'placeholder' => 'Email',
					'required' => 'required',
					); echo form_input($data); ?>
            </div>
        	<div class="update-form">
            	Confirm Email<em>*</em> : <?php $data = array(
					'name' => 'email_address_confirm',
					'type' => 'email',
					'autocomplete' => 'off',
					'placeholder' => 'Confirm Email',
					'required' => 'required',
					);echo form_input($data); ?>
            </div>  
        	<div class="update-form">
            	Password<em>*</em> : <?php $data = array(
					'name' => 'password',
					'autocomplete' => 'off',
					'placeholder' => 'Current Password',
					'required' => 'required',
					);echo form_password($data); ?>
            </div>              
        	<div class="update-form">
            	<?php echo form_submit('submit', 'Change Email'); ?>
            </div>                                                                                   
        </div>              
    </div> <!--End #aa-container -->
</div>
                 
                  
    


<?php $this->load->view('footer'); ?>

