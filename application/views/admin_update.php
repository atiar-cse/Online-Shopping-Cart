<?php $this->load->view('admin_header'); ?>


        	

<div id="container">

	<?php $this->load->view('admin_left_nav'); ?>

    <div id="acc-container">
    	<div class="border-bottom acc-dash">      	
        	<!--<h3>Dashboard! </h3> -->  <?php if(isset($msg)) { echo '<p class="error">'; echo $msg; echo '</p>';} ?>
            
        </div>
    	<div class="border-bottom cus-name2">
			<?php if(isset($profile)) : foreach($profile as $row) : ?>  
    	<div class="border-bottom acc-dash">      	
        	<h3>Profile Update</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>          
        </div>
    	<div class="cus-name2">
        	<?php echo validation_errors('<p class="error">'); ?>
			<?php
            $attributes = array('class' => 'email', 'id' => 'myform2');
            echo form_open('admin/update',$attributes);
			?>
        	<div class="update-form">
            	First Name<em>*</em> : <?php $data = array(
					'name' => 'first_name',				
					'autocomplete' => 'off',
					'value' => $row->first_name,
					'placeholder' => '',
					'required' => 'required',
					); echo form_input($data); ?>
            </div>
        	<div class="update-form">
            	Last Name<em>*</em> : <?php $data = array(
					'name' => 'last_name',				
					'autocomplete' => 'off',
					'value' => $row->last_name,
					'placeholder' => '',
					'required' => 'required',
					); echo form_input($data); ?>
            </div> 
        	<div class="update-form">
            	Role<em>*</em> : <?php $options = array(
							  'Administrator'  => 'Administrator',
							);
							$js = 'id="role2"';
							echo form_dropdown('role2', $options, $row->role,$js); ?>
            </div>  
        	<div class="update-form">
            	<?php echo form_submit('submit', 'Update Profile'); ?>
            </div>                                                                            
        </div> 
                <?php endforeach; ?>         
            <?php else : ?>	
                <h2>No Information.</h2>
            <?php endif; ?> 
        </div>               
    </div> <!--End #aa-container -->
</div>
                 
                  
    


<?php //$this->load->view('admin_footer'); ?>

