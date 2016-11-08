<?php $this->load->view('header'); ?>


        	

<div id="container">

	<?php $this->load->view('customer_left_nav'); ?>

    <div id="acc-container">
			<?php if(isset($profile)) : foreach($profile as $row) : ?>  
    	<div class="border-bottom acc-dash">      	
        	<h3>Account Update</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>          
        </div>
    	<div class="border-bottom cus-name2">
        	<?php echo validation_errors('<p class="error">'); ?>
			<?php
            $attributes = array('class' => 'email', 'id' => 'myform2');
            echo form_open('customer/update',$attributes);
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
            	Address<em>*</em> : <?php $data = array(
					'name' => 'address',				
					'autocomplete' => 'off',
					'value' => $row->address,
					'placeholder' => '',
					'required' => 'required',
					); echo form_input($data); ?>
            </div> 
        	<div class="update-form">
            	Company : <?php $data = array(
					'name' => 'company',				
					'autocomplete' => 'off',
					'value' => $row->company,
					'placeholder' => '',
					'required' => 'required',
					);  echo form_input($data); ?>
            </div>             
        	<div class="update-form">
            	City<em>*</em> : <?php $data = array(
					'name' => 'city',				
					'autocomplete' => 'off',
					'value' => $row->city,
					'placeholder' => '',
					'required' => 'required',
					);   echo form_input($data); ?>
            </div>
        	<div class="update-form">
            	Country<em>*</em> : <?php $options = array(
							  'USA'  => 'USA',
							  'UK'    => 'UK',
							  'Bangladesh'   => 'Bangladesh',
							  'Canada' => 'Canada',
							);
							$js = 'id="country2"';
							echo form_dropdown('country2', $options, $row->country,$js); ?>
            </div> 
        	<div class="update-form">
            	Zip Code<em>*</em> : <?php $data = array(
					'name' => 'zip',				
					'autocomplete' => 'off',
					'value' => $row->zip,
					'placeholder' => '',
					'required' => 'required',
					);  echo form_input($data); ?>
            </div> 
        	<div class="update-form">
            	Telephone<em>*</em> : <?php $data = array(
					'name' => 'telephone',				
					'autocomplete' => 'off',
					'value' => $row->telephone,
					'placeholder' => '',
					'required' => 'required',
					);  echo form_input($data); ?>
            </div>  
        	<div class="update-form">
            	<?php echo form_submit('submit', 'Update Acccount'); ?>
            </div>                                                                            
        </div> 
                <?php endforeach; ?>         
            <?php else : ?>	
                <h2>No Information.</h2>
            <?php endif; ?>                
    </div> <!--End #aa-container -->
</div>
                 
                  
    


<?php $this->load->view('footer'); ?>

