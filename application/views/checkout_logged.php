<?php $this->load->view('header');?>  

	<?php $this->load->view('left');?>    
   
   <div class="center_content">
   		<?php if(isset($msg)) { echo '<p class="cartError">'; echo $msg; echo '</p>';} ?>
      
             <?php if ($cart = $this->cart->contents()): ?>
             
				<?php if(isset($profile)) : foreach($profile as $row) : ?>              
                
                <div id="checkout">
                
                	<h3 class="checkout_title">ONE PAGE CHECKOUT 2</h3>
                    <p class="checkout_p">Fill in the fields below to complete your purchase!</p>
                    <!--<p class="checkout_p">Already registered? <a href="#">Click here to login</a></p> -->
                    
                    <div class="check_left">
                        <p style=" padding-bottom:15px; text-align:center;"><strong class="checkout_title">NAME & ADDRESS</strong></p>
                        
                         
                        
                        <?php echo validation_errors('<p class="error">'); ?>
                        <fieldset>
                        <legend>Your Email : </legend>
                        <?php
                        	$attributes = array('onSubmit' => 'return validate_form();','class' => 'email','name' => 'check99', 'id' => 'myform');
                       		echo form_open('checkout/save_order_logged',$attributes);
                        ?>

                        <p> <?php echo $row->email_address; ?> </p>
                        </fieldset>
                        
                        <fieldset>
                        <legend>Billing / Shipping Info </legend>
                        <span class="chk-logged">First Name : </span>
                        <?php
    
                          $data = array(
                          'name' => 'first_name',
                          'autocomplete' => 'off',
                          'placeholder' => 'First Name*',
                          'value' => $row->first_name,						  
                          'required' => 'required',
                          );
                        echo form_input($data);
                        ?>
                        <span class="chk-logged">Last Name : </span>
                        <?php 
                   
                          $data = array(
                          'name' => 'last_name',
                          'autocomplete' => 'off',
                          'placeholder' => 'Last Name*',
                          'value' => $row->last_name,						  
                          'required' => 'required',
                          );
                        echo form_input($data);
                        ?>
                        <span class="chk-logged">Company : </span>
                        <?php 
                        
                          $data = array(
                          'name' => 'company',
                          'autocomplete' => 'off',
                          'placeholder' => 'Company',
                          'value' => $row->company,						  
                          'required' => 'required',
                          );
                        echo form_input($data);
                        ?>
                        <span class="chk-logged">Address* : </span>
                        <?php 
                        
                          $data = array(
                          'name' => 'address',
                          'autocomplete' => 'off',
                          'placeholder' => 'Address*',
                          'value' => $row->address,						  
                          'required' => 'required',
                          );
                        echo form_input($data);
                        ?>
                        <span class="chk-logged">City* : </span>
                        <?php 
                          $data = array(
                          'name' => 'city',
                          'autocomplete' => 'off',
                          'placeholder' => 'City*',
                          'value' => $row->city,						  
                          'required' => 'required',
                          );
                        echo form_input($data);
                        ?>
                      <span class="chk-logged">Country* : </span>
                      <?php 
                        $options = array(
                                          'USA'  => 'USA',
                                          'UK'    => 'UK',
                                          'Bangladesh'   => 'Bangladesh',
                                          'Canada' => 'Canada',
                                        );
                        $js = 'id="country_checkout"';
                        echo form_dropdown('country', $options, $row->country,$js);
                        ?>
                       <span class="chk-logged">Zip Code* : </span>
                       <?php 
                          $data = array(
                          'name' => 'zip',
                          'autocomplete' => 'off',
                          'placeholder' => 'Zip Code*',
                          'value' => $row->zip,						  
                          'required' => 'required',
                          );
                        echo form_input($data);
                        ?>
                		<span class="chk-logged">Telephone* : </span>
                        <?php 
                          $data = array(
                          'name' => 'telephone',
                          'autocomplete' => 'off',
                          'placeholder' => 'Telephone*',
                          'value' => $row->telephone,						  
                          'required' => 'required',
                          );
                        echo form_input($data);
                        
                        
                        //echo form_submit('submit', 'Create Acccount');
                        ?>
                        </fieldset>
					</div><!-- End .check_left -->
                    <div class="check_right">
                    	<p style="text-align:center;"><strong class="checkout_title">PAYMENT METHOD</strong></p>
                        
                        <p style="padding-left:40px; font-size:13px;"> <br /> <strong>TOTAL</strong> (with shipping) <strong>:</strong> <?php echo number_format(40+$this->cart->total(),2); ?> BDT </p> <br />
                        	<input type="hidden" name="orderamount" value="<?php echo number_format(40+$this->cart->total(),2); ?>" />
                        <p>
                        
                        <input type="radio" onclick="hideArea()" name="rad" value="bank" />
                        
                        <span style="font-size:15px;">Bank Payment</span> </p>
                        
                        	<div id="bank">
                        
                        	    <p style="padding-left:40px; font-size:13px;"> Please confirm the money through one of the following bank accounts:  <br /> <br />

                                  <strong>Account Holder:</strong>	Atiar Rahman <br />
                                  <strong>Account Number:</strong>	0802019 <br />
                                  <strong>Bank Name:</strong>	BRAC Bank Limited <br /> 
                                  
                                  ---------------------------------------------------<br /> 
                                  
                                  <strong>Account Holder:</strong>	Mehedi Hasan <br />
                                  <strong>Account Number:</strong>	0802024 <br />
                                  <strong>Bank Name:</strong>	DBBL <br /> <br />
                                  <?php
        
									$data = array(
									'name' => 'bank_first_name',
									'autocomplete' => 'off',
									'placeholder' => 'Your A/C Name*',
									);
								  echo form_input($data); 
								  ?>
                                  
                                  <?php
        
									$data = array(
									'name' => 'back_acc_num',
									'autocomplete' => 'off',
									'placeholder' => 'Your A/C Number*',
									);
								  echo form_input($data); 
								  ?>  
                                  
                                  <?php
        
									$data = array(
									'name' => 'bank_name',
									'autocomplete' => 'off',
									'placeholder' => 'Bank Name*',
									);
								  echo form_input($data); 
								  ?>                                                                   
                               </p>
                               
							</div> <!--End #bank -->  
                        
                        <p>
                        
                        <input type="radio" onclick="hideArea()" name="rad" value="bkash" />
                        
                        <span style="font-size:15px;">bKash</span> </p>
                        	<div id="bkash">
                                  <p style="padding-left:40px; font-size:13px;"> Please confirm the money through one of the following bKash accounts:  <br /> <br />
  
                                    <strong>Account Holder:</strong>	Atiar Rahman <br />
                                    <strong>bKash Number:</strong>	01728-705638 <br />
                                    
                                    ---------------------------------------------------<br /> 
                                    
                                    <strong>Account Holder:</strong>	Mehedi Hasan <br />
                                    <strong>bKash Number:</strong>	01723-213668 <br /> <br />
                                    
                                    <?php
          
                                      $data = array(
                                      'name' => 'bkashNumber',
                                      'autocomplete' => 'off',
                                      'placeholder' => 'Your bKash Number*',
                                      );
                                    echo form_input($data); 
                                    ?>
                                    
                                    <?php
          
                                      $data = array(
                                      'name' => 'trxid',
                                      'autocomplete' => 'off',
                                      'placeholder' => 'TrxID*',
                                      );
                                    echo form_input($data); 
                                    ?>                                    
                                 </p>
                               </div> <!--End #bkash -->
                               <p>
                               	  <?php   $data = array(
  						  				'name' => 'action',
						  				'value' => '',
  						  				'id' => 'placeorder',  				
  						  				); echo form_submit($data); 
								  ?>
                        
                        	</p>                        
                    </div> <!--End .check_right -->
	
                </div>  <!--End #Checkout -->
                
                <?php endforeach; ?> 
                <?php endif; ?>  
               
                <?php endif; ?>    <!--Cart contents  -->            
               <?php if (!$this->cart->contents()){ echo '<h3 class="cart_title3">Your cart is Empty!</h3>'; } ?>

   </div><!-- end of center content -->
   
	<?php $this->load->view('right');?>  
   
            
   </div><!-- end of main content -->
   
<?php $this->load->view('footer');?>        
  