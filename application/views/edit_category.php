<?php $this->load->view('admin_header'); ?>


        	

<div id="container">

	<?php $this->load->view('admin_left_nav'); ?>
    
    <div id="acc-container">
    	<div class="border-bottom acc-dash">      	
        	<h3>Edit Category</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>
        </div>
    	<div class="border-bottom cus-name2">
        	 <?php if(isset($msg)) { echo '<p class="error">'; echo $msg; echo '</p>';} ?>
             
             
             
                    <?php if(isset($category)) : foreach($category as $row) : ?>                 
                               
							  <?php echo validation_errors('<p class="error">'); ?>
                              <?php
                              $attributes = array('class' => 'email', 'id' => 'myform2');
                              echo form_open_multipart('category/update',$attributes);
                              ?>
                              <input type="hidden" name="hidden_id" value="<?php echo $row->category_id; ?>" />
                              <div class="update-form">
                                  Category Name<em>*</em> : <?php $data = array(
                                      'name' => 'category_name',
                                      'autocomplete' => 'off',
                                      'value' => $row->category_name,
                                      'placeholder' => 'Category Name*',
                                      'required' => 'required',
                                      ); echo form_input($data); ?>
                              </div> 
                              <div class="update-form">
                                   Description<em></em> : <?php $data = array(
                                      'name' => 'category_description',
                                      'autocomplete' => 'off',
                                      'value' => $row->description,
                                      'placeholder' => 'Optional',
                                      ); echo form_input($data); ?>
                              </div>                         
                   
                                      
                                                                
                              <div class="update-form">
                                  <?php echo form_submit('submit', 'Update Category'); ?>
                              </div>                                 

                    <?php endforeach; ?>
 

                    <?php else : ?>	
                        <h2>No Information for Category.</h2>
                    <?php endif; ?>              
             
             
             
             
                                                                          
        </div>               
    </div> <!--End #aa-container -->
</div>
                 
                  
    


<?php //$this->load->view('admin_footer'); ?>

