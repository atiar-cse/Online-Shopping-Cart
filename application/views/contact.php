<?php $this->load->view('header');?>  

	<?php $this->load->view('left');?>    
   
   <div class="center_content">
   		<div class="center_title_bar">Contact Us <span style="float:right; padding-right:35px;"> +8801728-705638 &nbsp; or &nbsp; +8801723-213668</span></div>
    
    	<div class="prod_box_big">
        	<div class="top_prod_box_big"></div>
            <div class="center_prod_box_big">            
                 
              	<div id="contact_us_form" class="">
                
                 <?php if(isset($msg)) { echo '<p class="error">'; echo $msg; echo '</p>';} ?>
                
                           <?php $attributes = array('class' => 'email', 'id' => '');
                              echo form_open_multipart('contact/send',$attributes);
                              ?>
                           
                    <div class="form_row">
                       <?php    
                          $data = array(
                          'name' => 'first_name',
                          'autocomplete' => 'off',
                          'placeholder' => 'First Name*',
                          'required' => 'required',
                          );
                        echo form_input($data);
					   ?>	
                    </div>  

                    <div class="form_row">
                       <?php    
                          $data = array(
                          'name' => 'last_name',
                          'autocomplete' => 'off',
                          'placeholder' => 'Last Name*',
                          'required' => 'required',
                          );
                        echo form_input($data);
					   ?>	
                    </div>


                    <div class="form_row">
                       <?php    
                          $data = array(
                          'name' => 'email_ad',
                          'autocomplete' => 'off',
                          'placeholder' => 'Email Address*',
                          'required' => 'required',
                          );
                        echo form_input($data);
					   ?>	
                    </div>
                    
                    <div class="form_row">
                       <?php    
                          $data = array(
                          'name' => 'phone',
                          'autocomplete' => 'off',
                          'placeholder' => 'Phone',

                          );
                        echo form_input($data);
					   ?>	
                    </div>


                    <div class="form_row">
                       <?php    
                          $data = array(
                          'name' => 'message',
                          'autocomplete' => 'off',
                          'placeholder' => 'Type Your Message',
                          'required' => 'required',
                          );
                        echo form_textarea($data);
					   ?>	
                    </div>

                    
                    <div class="form_row">
					  <?php   $data = array(
                            'name' => 'action',
                            'value' => 'Send',
                            'id' => 'contact_us',  				
                            ); echo form_submit($data);
					  
					  	echo form_close();
                      ?>
                    </div>      
                    
                </div> <!--End #contact_us_form -->
                
                <div class="office">
                	<strong>Head Office</strong> <br /> <br />
                    106, Nur Hossain Hall <br />
                    HSTU, Dinajpur-5200 <br />
                    Bangladesh <br /><br />
                    
                    <iframe width="250" height="250" frameborder="1px" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Hajee+Mohammad+Danesh+Science+and+Technology+University&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=45.8712,67.763672&amp;t=m&amp;ie=UTF8&amp;hq=Hajee+Mohammad+Danesh+Science+and+Technology+University&amp;ll=25.696583,88.65187&amp;spn=0.025638,0.033088&amp;z=14&amp;iwloc=A&amp;cid=3318184855586074530&amp;output=embed"></iframe> 
                    
                </div>
                
                                     
            </div>
            <div class="bottom_prod_box_big"></div>                                
        </div>
       

   
   </div><!-- end of center content -->
   
	<?php $this->load->view('right');?>  
   
            
   </div><!-- end of main content -->
   
<?php $this->load->view('footer');?>        
  