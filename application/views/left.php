   <div class="left_content">
    <div class="title_box">Categories</div>
    

    
        <ul class="left_menu">
        
    		<?php $results = $this->db->get('category',15)->result(); ?>
             
           		<?php if(isset($results)) : foreach($results as $row) : ?> 
                 
				 	<li class="odd"> <a href="<?php echo base_url();?>category/cat/<?php echo $row->category_id; ?>"> <?php echo $row->category_name; ?> </a> </li>
				 
				 		<?php endforeach; ?>         
				<?php else : ?>	
                    <h2>No Information for Products.</h2>
                <?php endif; ?>          
        </ul> 
        
        
     <div class="title_box">Special Products</div>  
     <div class="border_box">
         <div class="product_title"><a href="<?php echo base_url();?>product/view/10">Motorola 156 MX-VL</a></div>
         <div class="product_img"><a href="<?php echo base_url();?>product/view/10"><img src="<?php echo base_url();?>css/images/laptop.png" alt="" title="" border="0" /></a></div>
         <div class="prod_price"><span class="reduce">30,500 BDT</span> <span class="price">30,500 BDT</span></div>
     </div>  
     
     
<!--     <div class="title_box">Newsletter</div>  
     <div class="border_box_news">
		<input type="text" name="newsletter" class="newsletter_input" value="your email"/>
        <a href="#" class="join">join</a>
     </div>  --> 
     
     <?php /*?><div class="banner_adds">
     
     <a href="#"><img src="<?php echo base_url();?>css/images/bann2.jpg" alt="" title="" border="0" /></a>
     </div>  <?php */?>  
        
    
   </div><!-- end of left content -->