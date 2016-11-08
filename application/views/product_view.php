<?php $this->load->view('header');?>  

	<?php $this->load->view('left');?>    
   
   <div class="center_content">
   	   <?php if(isset($products)) : foreach($products as $product) : ?>
   		<div class="center_title_bar">Product Details</div>
 
              <div class="prod_boxv">
                  <!--<div class="top_prod_boxv"></div> -->
                  <div class="center_prod_boxv">            
                       <div class="product_title"><?php echo $product->name; ?> </div>
                       <div class="product_imgv"><a href="<?php echo base_url();?>uploads/<?php echo $product->picture; ?>"><img src="<?php echo base_url();?>uploads/<?php echo $product->picture; ?>" max-width="500px" max-height="350px" alt="" title="" border="0" /></a></div>
                       
                       <?php $attributes = array('class' => '', 'id' => ''); echo form_open('cart/add',$attributes); ?>
                       
                       <div class="prod_price">
                       
                       		 <?php if ($product->option_name): ?>
					   		 <?php echo $product->option_name; echo " "; ?>
					   		 <?php echo form_dropdown($product->option_name,$product->option_values,NULL,'id="option1"'); ?>
                             &nbsp;&nbsp; &nbsp;&nbsp; 
				       		 <?php endif; ?>
                       
                       		<b>Price: </b><span class="reduce"><?php echo $product->price; ?> $</span> <span class="price"><?php echo $product->price; ?> $</span>&nbsp;&nbsp; <input style="background:none; border:none; color:#0FA0DD; box-shadow:none;" type="submit" value="Buy Now!"  />
    
                       </div>                        
                  </div>
                  <!--<div class="bottom_prod_boxv"></div> -->  
                  
				  <div class="prod_des">            
                    
                       <?php echo $product->description; ?>
                                               
                  </div>                  
                             
                  <div class="prod_details_tab_des">
                  <?php echo form_hidden('id', $product->product_id); ?>
                  <?php	echo form_hidden('redirect', current_url()); ?>
				  <?php   $data = array(
  						  'name' => 'action',
						  'value' => 'Add to Cart',
  						  'id' => 'addtocart',  				
  						  ); echo form_submit($data); ?>
				  <?php echo form_close(); ?>
                  
                  <?php /*?><a href="#" title="header=[Add to cart] body=[&nbsp;] fade=[on]"><img src="<?php echo base_url();?>css/images/cart.gif" alt="" title="" border="0" class="left_bt" /></a>
                  <a href="#" title="header=[Specials] body=[&nbsp;] fade=[on]"><img src="<?php echo base_url();?>css/images/favs.gif" alt="" title="" border="0" class="left_bt" /></a>
                  <a href="#" title="header=[Gifts] body=[&nbsp;] fade=[on]"><img src="<?php echo base_url();?>css/images/favorites.gif" alt="" title="" border="0" class="left_bt" /></a>           
                  <a href="details.html" title="header=[Add to cart] body=[&nbsp;] fade=[on]" class="prod_details2"><b>Buy Now!</b></a> <?php */?>           
                  </div>                     
              </div>                    
                                    
        <?php endforeach; ?>         
        <?php else : ?>	
        	<h2>No Information for the Products.</h2>
        <?php endif; ?>  
     
   </div><!-- end of center content -->
   
	<?php $this->load->view('right');?>  
   
            
   </div><!-- end of main content -->
   
<?php $this->load->view('footer');?>        
  