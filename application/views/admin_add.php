<?php $this->load->view('admin_header'); ?>


        	

<div id="container">

	<?php $this->load->view('admin_left_nav'); ?>

    <div id="acc-container">
    	<div class="border-bottom acc-dash">      	
        	<h3>Add a Administrator!</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>
        </div>
    	<div class="border-bottom cus-name2">
        	 <?php if(isset($msg)) { echo '<p class="error">'; echo $msg; echo '</p>';} ?>
             
        	<?php echo validation_errors('<p class="error">'); ?>
			<?php
            $attributes = array('class' => 'email', 'id' => 'myform2');
            echo form_open('admin/add',$attributes);
			?>
        	<div class="update-form">
            	Email<em>*</em> : <?php $data = array(
					'name' => 'admin_email',				
					'autocomplete' => 'off',
					'value' => '',
					'placeholder' => '',
					'required' => 'required',
					); echo form_input($data); ?>
            </div> 
        	<div class="update-form">
            	Password<em>*</em> : <?php $data = array(
					'name' => 'password',				
					'autocomplete' => 'off',
					'value' => '',
					'placeholder' => '',
					'required' => 'required',
					);  echo form_password($data); ?>
            </div>             
        	<div class="update-form">
            	Password Confirm<em>*</em> : <?php $data = array(
					'name' => 'password_confirm',				
					'autocomplete' => 'off',
					'value' => '',
					'placeholder' => '',
					'required' => 'required',
					);   echo form_password($data); ?>
            </div>            
        	<div class="update-form">
            	First Name<em>*</em> : <?php $data = array(
					'name' => 'first_name',				
					'autocomplete' => 'off',
					'value' => '',
					'placeholder' => '',
					'required' => 'required',
					); echo form_input($data); ?>
            </div>
        	<div class="update-form">
            	Last Name<em>*</em> : <?php $data = array(
					'name' => 'last_name',				
					'autocomplete' => 'off',
					'value' => '',
					'placeholder' => '',
					'required' => 'required',
					); echo form_input($data); ?>
            </div> 
        	<div class="update-form">
            	Role<em>*</em> : <?php $options = array(
							  'Administrator'  => 'Administrator',
							);
							$js = 'id="role"';
							echo form_dropdown('role', $options, 'Administrator',$js); ?>
            </div> 
        	<div class="update-form">
            	<?php echo form_submit('submit', 'Add Administrator'); ?>
            </div>                                                                            
        </div>               
    </div> <!--End #aa-container -->
</div>
                 
                  
    


<?php //$this->load->view('admin_footer'); ?>

