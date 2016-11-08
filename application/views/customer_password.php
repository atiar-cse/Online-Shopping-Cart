<?php $this->load->view('header'); ?>


        	

<div id="container">

	<?php $this->load->view('customer_left_nav'); ?>

    <div id="acc-container"> 
    	<div class="border-bottom acc-dash">      	
        	<h3>Account Update >> Change Password</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>          
        </div>
    	<div class="border-bottom cus-name2">
        	<?php echo validation_errors('<p class="error">'); ?>
			<?php
            $attributes = array('class' => 'email', 'id' => 'myform2');
            echo form_open('customer/update_password',$attributes);
			?>
        	<div class="update-form">
            	Old Password<em>*</em> : <?php $data = array(
					'name' => 'old_password',				
					'autocomplete' => 'off',
					'placeholder' => 'Your Old Password',
					'required' => 'required',
					);echo form_password($data); ?>
            </div>            
        	<div class="update-form">
            	New Password<em>*</em> : <?php $data = array(
					'name' => 'password',				
					'autocomplete' => 'off',
					'placeholder' => 'Your New Password',
					'required' => 'required',
					);echo form_password($data); ?>
            </div>
        	<div class="update-form">
            	Confirm Password<em>*</em> : <?php $data = array(
					'name' => 'password_confirm',				
					'autocomplete' => 'off',
					'placeholder' => 'Confirm Password',
					'required' => 'required',
					); echo form_password($data); ?>
            </div>   
        	<div class="update-form">
            	<?php echo form_submit('submit', 'Change Password'); ?>
            </div>                                                                                   
        </div>              
    </div> <!--End #aa-container -->
</div>
                 
                  
    


<?php $this->load->view('footer'); ?>

