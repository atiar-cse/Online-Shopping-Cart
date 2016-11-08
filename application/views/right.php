   <div class="right_content">
   		<div class="shopping_cart">
        	<div class="cart_title"><a style="color: #847676; text-decoration:none; font-size: 12px; font-weight: bold; padding: 8px 0 0;" href="<?php echo base_url();?>cart">Shopping cart</a></div>
            
            <div class="cart_details">
            	<?php if ($cart = $this->cart->contents()): ?>
                    	<?php $i = 0; ?>
                    	<?php foreach ($cart as $item): ?>
                         <?php $i++; ?>
                    	<?php endforeach; ?>
							
                
                   		<?php echo $i++; ?> items <br />
                  		<span class="border_cart"></span>
                  		Total: <span class="price">BDT <?php echo number_format($this->cart->total(),2); ?> </span>                 <?php endif; ?>  
                        
                  <?php if (!$this->cart->contents()){ echo '0 items <br /> <span class="border_cart"></span> 	Total: <span class="price">$0.00</span>'; } ?>

            </div>  <!--End cart_details -->
            
            <div class="cart_icon"><a href="<?php echo base_url();?>cart" title="header=[Checkout] body=[&nbsp;] fade=[on]"><img src="<?php echo base_url();?>css/images/shoppingcart.png" alt="" title="" width="48" height="48" border="0" /></a></div>
        
        </div>
   
   
     <div class="title_box">What's new</div>  
     <div class="border_box">
         <div class="product_title"><a href="<?php echo base_url();?>product/view/11">Motorola 156 MX-VL - Notebook</a></div>
         <div class="product_img"><a href="<?php echo base_url();?>product/view/11"><img src="<?php echo base_url();?>css/images/p2.gif" alt="" title="" border="0" /></a></div>
         <div class="prod_price"><span class="reduce">34500 BDT</span> <span class="price">34500 BDT</span></div>
     </div>  
     
     
     
    <?php /*?><div class="title_box">Manufacturers</div>
    
        <ul class="left_menu">
        <li class="odd"><a href="#">Sony</a></li>
        <li class="even"><a href="#">Samsung</a></li>
         <li class="odd"><a href="#">Daewoo</a></li>
        <li class="even"><a href="#">LG</a></li>
         <li class="odd"><a href="#">Fujitsu Siemens</a></li>
         <li class="even"><a href="#">Motorola</a></li>
        <li class="odd"><a href="#">Phillips</a></li>
        <li class="even"><a href="#">Beko</a></li>
        </ul>  <?php */?>    
     
    <?php /*?> <div class="banner_adds">
     
     <a href="#"><img src="<?php echo base_url();?>css/images/bann1.jpg" alt="" title="" border="0" /></a>
     </div> <?php */?>       
     
   </div><!-- end of right content --> 