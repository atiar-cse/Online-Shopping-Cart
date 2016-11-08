<?php $this->load->view('admin_header'); ?>


        	

<div id="container">

	<?php $this->load->view('admin_left_nav'); ?>
    
    <div id="acc-container">
    	<div class="border-bottom acc-dash">      	
        	<h3>Edit Product</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4> 
        </div>
    	<div class="border-bottom cus-name2">
        	 			<?php if(isset($msg)) { echo '<p class="error">'; echo $msg; echo '</p>';} ?>
               
             <?php if(isset($product)) : foreach($product as $row) : ?>                 
                               
			<?php echo validation_errors('<p class="error">'); ?>
			<?php
            $attributes = array('class' => 'email', 'id' => 'myform2');
            echo form_open_multipart('product/update',$attributes);
			?>
        	<div class="update-form">
            	Product Name<em>*</em> : <?php $data = array(
					'name' => 'name',
					'autocomplete' => 'off',
					'value' => $row->name,
					'placeholder' => '',
					'required' => 'required',
					); echo form_input($data); ?>
            </div> 
        	<div class="update-form">
            	Description<em>*</em> : <br /> <br /> 
                <textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%">
                	<?php echo $row->description; ?>
                </textarea>
            </div>             
        	<div class="update-form">
            	<br />  Price<em>*</em> : <?php $data = array(
					'name' => 'price',				
					'autocomplete' => 'off',
					'value' => $row->price,
					'placeholder' => '',
					'required' => 'required',
					);   echo form_input($data); ?>
            </div>      
            
              
        	<div class="update-form">
            	 Category <em>*</em>
				<select id="role" name="category_id">                
					<?php 
						$results = $this->product_model->get_category_name($row->category_id);          
						 foreach($results as $item)  
						 	{
								echo '<option ' . 'value=' . $item->category_id . '>' . $item->category_name . '</option>';
							}	
					?>   
                    
					<?php 
						$results = $this->db->get('category')->result();              
						 foreach($results as $item)  
						 	{
								echo '<option ' . 'value=' . $item->category_id . '>' . $item->category_name . '</option>';
							}	
					?>     	                               
                </select>
            </div>               
                          
        	<div class="update-form">
            	Available<em>*</em> : <?php $options = array(
							  'yes'  => 'Yes',
							  'no'  => 'No',
							);
							$js = 'id="role"';
							echo form_dropdown('available', $options,  $row->available,$js); ?>
            </div> 
        	<div class="update-form">
            	Discount<em>*</em> : <?php $options = array(
							  'yes'  => 'Yes',
							  'no'  => 'No',
							);
							$js = 'id="role"';
							echo form_dropdown('discount_available', $options, $row->discount_available,$js); ?>
            </div>   
        	<div class="update-form">
            	Discount Amount<em></em> : <?php $data = array(
					'name' => 'discount',				
					'autocomplete' => 'off',
					'value' => $row->discount,					
					);   echo form_input($data); ?>
            </div>  
        	<div class="update-form">
            	Option Name<em></em> : <?php $data = array(
					'name' => 'option_name',				
					'autocomplete' => 'off',
					'value' => $row->option_name,
					'placeholder' => 'additional',
					);   echo form_input($data); ?>
            </div>      
        	<div class="update-form">
            	Option Values<em></em> : <?php $data = array(
					'name' => 'option_values',				
					'autocomplete' => 'off',
					'value' => $row->option_values,
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
					);   echo form_input($data); ?>  
            </div>                                                 
        	<div class="update-form">
            	<input type="hidden" name="hidden-img" value="<?php echo $row->picture; ?>" />
            	<?php echo form_submit('submit', 'Update Product'); ?>
                <?php echo form_close(); ?>
            </div>    
            
        	<div id="img-edit" class="update-form">
            	
			<br /><br /><br />	<img src="<?php echo base_url();?>uploads/<?php echo $row->picture; ?>" max-width="300px" max-height="250px" alt="" title="" border="0" /> 
            </div>                                              

                    <?php endforeach; ?>
 

                    <?php else : ?>	
                        <h2>No Information for the product to edit.</h2>
                    <?php endif; ?>              
             
             
             
             
                                                                          
        </div>            
    </div> <!--End #aa-container -->
</div>
                 
                  
    


<?php //$this->load->view('admin_footer'); ?>

