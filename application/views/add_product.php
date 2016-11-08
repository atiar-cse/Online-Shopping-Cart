<?php $this->load->view('admin_header'); ?>


        	

<div id="container">

	<?php $this->load->view('admin_left_nav'); ?>
    
    <div id="acc-container">
    	<div class="border-bottom acc-dash">      	
        	<h3>Add New Product !</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>
        </div>
    	<div class="border-bottom cus-name2">
        	 <?php if(isset($msg)) { echo '<p class="error">'; echo $msg; echo '</p>';} ?>
             
        	<?php echo validation_errors('<p class="error">'); ?>
			<?php
            $attributes = array('class' => 'email', 'id' => 'myform2');
            echo form_open_multipart('product/add',$attributes);
			?>
        	<div class="update-form">
            	Product Name<em>*</em> : <?php $data = array(
					'name' => 'name',
					'autocomplete' => 'off',
					'value' => '',
					'placeholder' => '',
					'required' => 'required',
					); echo form_input($data); ?>
            </div> 
        	<div class="update-form">
            	Description<em>*</em> : <br /> <br /> 
                <textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%">
                	
                </textarea>
            </div>             
        	<div class="update-form">
            	<br />  Price<em>*</em> : <?php $data = array(
					'name' => 'price',				
					'autocomplete' => 'off',
					'value' => '',
					'placeholder' => '',
					'required' => 'required',
					);   echo form_input($data); ?>
            </div>      
<?php /*?>        	<div class="update-form">
            	Category<em>*</em> : <?php $options = array(
							  'EEE'  => 'EEE',
							  'CSE'  => 'CSE',
							);
							$js = 'id="role"';
							echo form_dropdown('category_id', $options, 'CSE',$js); ?>
            </div><?php */?>  
            
              
        	<div class="update-form">
            	 Category <em>*</em>
				<select id="role" name="category_id">
                	
					<?php $results = $this->db->get('category')->result(); ?>             
						<?php if(isset($results)) : foreach($results as $row) : ?>                     
                    	<option value="<?php echo $row->category_id; ?>"><?php echo $row->category_name; ?></option>
                     
                            <?php endforeach; ?>         
                    <?php else : ?>	
                        <option value="Uncategory">No Category</option>
                    <?php endif; ?>
                    
					<?php $results = $this->db->get('category')->result(); ?>             
						<?php if(!$results) : ?>            
							<option value="Uncategory">No Category</option>
                    	<?php endif; ?>                    
                    
                    
                </select>
            </div>               
                          
        	<div class="update-form">
            	Available<em>*</em> : <?php $options = array(
							  'yes'  => 'Yes',
							  'no'  => 'No',
							);
							$js = 'id="role"';
							echo form_dropdown('available', $options, 'yes',$js); ?>
            </div> 
        	<div class="update-form">
            	Discount<em>*</em> : <?php $options = array(
							  'yes'  => 'Yes',
							  'no'  => 'No',
							);
							$js = 'id="role"';
							echo form_dropdown('discount_available', $options, 'no',$js); ?>
            </div>   
        	<div class="update-form">
            	Discount Amount<em></em> : <?php $data = array(
					'name' => 'discount',				
					'autocomplete' => 'off',
					'value' => '',
					'placeholder' => 'Default is zero.',
					);   echo form_input($data); ?>
            </div>  
        	<div class="update-form">
            	Option Name<em></em> : <?php $data = array(
					'name' => 'option_name',				
					'autocomplete' => 'off',
					'value' => '',
					'placeholder' => 'additional',
					);   echo form_input($data); ?>
            </div>      
        	<div class="update-form">
            	Option Values<em></em> : <?php $data = array(
					'name' => 'option_values',				
					'autocomplete' => 'off',
					'value' => '',
					'placeholder' => 'Separate by Comma',
					);   echo form_input($data); ?>
            </div>                      
        	<div class="update-form">
            	Product Image<em>*</em> : <?php $data = array(
					'name' => 'userfile',
					'type' => 'file',
					'autocomplete' => 'off',
					'value' => '',
					'placeholder' => '',
					'required' => 'required',
					);   echo form_input($data); ?>
            </div>                                                 
        	<div class="update-form">
            	<?php echo form_submit('submit', 'Add Product'); ?>
            </div>                                                                            
        </div>               
    </div> <!--End #aa-container -->
</div>
                 
                  
    


<?php //$this->load->view('admin_footer'); ?>

