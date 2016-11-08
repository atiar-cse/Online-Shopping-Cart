<?php $this->load->view('admin_header'); ?>


        	

<div id="container">

	<?php $this->load->view('admin_left_nav'); ?>
    
    <div id="acc-container">
    	<div class="border-bottom acc-dash">      	
        	<h3>Add New Category !</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>
        </div>
    	<div class="border-bottom cus-name2">
        	 <?php if(isset($msg)) { echo '<p class="error">'; echo $msg; echo '</p>';} ?>
             
        	<?php echo validation_errors('<p class="error">'); ?>
			<?php
            $attributes = array('class' => 'email', 'id' => 'myform2');
            echo form_open_multipart('category/add',$attributes);
			?>
        	<div class="update-form">
            	Category Name<em>*</em> : <?php $data = array(
					'name' => 'category_name',
					'autocomplete' => 'off',
					'value' => '',
					'placeholder' => 'Category Name*',
					'required' => 'required',
					); echo form_input($data); ?>
            </div> 
        	<div class="update-form">
            	 Description<em></em> : <?php $data = array(
					'name' => 'category_description',
					'autocomplete' => 'off',
					'value' => '',
					'placeholder' => 'Optional',
					); echo form_input($data); ?>
            </div>                         
 
                    
                                              
        	<div class="update-form">
            	<?php echo form_submit('submit', 'Add Category'); ?>
            </div>                                                                            
        </div>               
    </div> <!--End #aa-container -->
</div>
                 
                  
    


<?php //$this->load->view('admin_footer'); ?>

