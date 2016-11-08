<?php $this->load->view('admin_header'); ?>


        	

<div id="container">

	<?php $this->load->view('admin_left_nav'); ?>

    <div id="acc-container"> 
    	<div class="border-bottom acc-dash">      	
        	<?php if(isset($msg)) { echo '<p class="error">'; echo $msg; echo '</p>';} ?>         
        </div>    
    	<div class="border-bottom acc-dash">      	
        	<h3>Change Password</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>          
        </div>
    	<div class="border-bottom cus-name2">
        	<?php echo validation_errors('<p class="error">'); ?>
			<?php
            $attributes = array('class' => 'email', 'id' => 'myform2');
            echo form_open('admin/update_password',$attributes);
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
					'placeholder' => 'Confirm New Password',
					'required' => 'required',
					); echo form_password($data); ?>
            </div>   
        	<div class="update-form">
            	<?php echo form_submit('submit', 'Change Password'); ?>
            </div>                                                                                   
        </div>              
    </div> <!--End #aa-container -->
</div>
                 
                  
    


<?php //$this->load->view('admin_footer'); ?>

