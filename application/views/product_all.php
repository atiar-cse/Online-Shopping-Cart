<?php $this->load->view('header');?>   

	<?php $this->load->view('left');?>    
   
   <div class="center_content">
   		<div class="center_title_bar">All Products</div>
   		<?php if(isset($products)) : foreach($products as $product) : ?> 
              <div class="prod_box">
                  <div class="top_prod_box"></div>
                  <div class="center_prod_box">            
                       <div class="product_title"><a href="<?php echo base_url();?>product/view/<?php echo $product->product_id; ?>"><?php echo $product->name; ?> </a></div>
                       <div class="product_img"><a href="<?php echo base_url();?>product/view/<?php echo $product->product_id; ?>"><img src="<?php echo base_url();?>uploads/thumbs/<?php echo $product->picture; ?>" alt="" title="" border="0" /></a></div>
                       <div class="prod_price"><span class="reduce"><?php echo $product->price; ?> BDT</span> <span class="price"><?php echo $product->price; ?> BDT</span> 
                       <div class="option">
                       <?php $attributes = array('class' => '', 'id' => ''); echo form_open('cart/add',$attributes); ?>
					   <?php if ($product->option_name): ?>
					   <?php echo $product->option_name; echo " "; ?>
					   <?php echo form_dropdown($product->option_name,$product->option_values,NULL,'id="option1"'); ?>
				       <?php endif; ?></div></div>  <!--end  prod_price -->                  
                  </div>
                  <div class="bottom_prod_box"></div>                   
                             
                  <div id="" class="prod_details_tab">
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
                  <a href="#" title="header=[Gifts] body=[&nbsp;] fade=[on]"><img src="<?php echo base_url();?>css/images/favorites.gif" alt="" title="" border="0" class="left_bt" /></a> <?php */?>          
                  <a href="<?php echo base_url();?>product/view/<?php echo $product->product_id; ?>" class="prod_details"  title="header=[Details] body=[&nbsp;] fade=[on]">details</a>            
                  </div>                     
              </div>                    
                                    
        <?php endforeach; ?>         
        <?php else : ?>	
        	<h2>No Information for Products.</h2>
        <?php endif; ?>  
           <div id="pag">
                
                <?php echo $this->pagination->create_links(); ?>   
           </div>
   
   </div><!-- end of center content -->
   
	<?php $this->load->view('right');?>  
   
            
   </div><!-- end of main content -->
   

   
<?php $this->load->view('footer');?>       
  