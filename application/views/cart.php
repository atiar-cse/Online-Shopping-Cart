<?php $this->load->view('header');?>  

	<?php $this->load->view('left');?>    
   
   <div class="center_content">
      
             <?php if ($cart = $this->cart->contents()): ?>
                <div id="cart">
                    <table>
                    <caption><h3 class="cart_title2">Shopping Cart</h3></caption>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Option</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th style="text-align:center;">Amount</th>
                            <th></th>
                        </tr>
                    </thead> 
                    <?php echo form_open('cart/update_cart'); ?>
                    <?php $i = 1; ?>
                    <?php foreach ($cart as $item):
                    	echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
                        echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
                        echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
                        echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
                        echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);  ?>
                        <tr class="cart_tr">
                            <td><?php echo $i++; ?>. <?php echo $item['name']; ?></td>
                            <td>
                                <?php if ($this->cart->has_options($item['rowid'])) {
                                    foreach ($this->cart->product_options($item['rowid']) as $option => $value) {
                                        echo $option . ": <em>" . $value . "</em>";
                                    }
                                    
                                } ?>
                            </td>
                            <td>BDT <?php echo number_format($item['price'],2); ?> </td>
                            <td> <?php $data = array(
  						  				'name' => 'cart['. $item['id'] .'][qty]',
						  				'value' => $item['qty'],
  						  				'id' => 'cart_qty',  				
  						  				); 
										echo form_input($data); //echo $item['qty']; ?>
                            </td>
                            <td class="sbtl">BDT <?php echo number_format($item['subtotal'],2) ?> </td>
                            <td class="remove">
                                <?php  echo anchor('cart/remove/'.$item['rowid'], 'X', array('onClick' => "return confirm('Are you sure you want to remove?')")); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="total">
                        <td colspan="4"><strong>Order Total :</strong></td>
                        <td class="sbtl">BDT <?php echo number_format($this->cart->total(),2); ?></td>
                    </tr>
                    </table> 
                    <div class="cart_check">
                    	 <div class="cart_remove">
						 	<?php echo anchor('cart/destroy/', '<strong>Remove All</strong>', array('onClick' => "return confirm('Are you sure you want to remove all?')")); ?>
                         </div>
                         <div class="cart_remove">
						 	<?php   $data = array(
  						  				'name' => 'action',
						  				'value' => 'Update Cart',
  						  				'id' => 'addtocartupd',  				
  						  				); echo form_submit($data); ?>
                            <?php echo form_close(); ?>
                         </div>
                         <div class="cart_remove">
						 	<?php echo anchor('checkout/','<strong>Go to Checkout</strong>'); ?>
                         </div>
                    	
                    </div>                  		
                    </div> 
                   <div class="cart_charge">
                      <strong style="color:#EB340A;">Shipping charge BDT 40 will be added.</strong>
                    </div>                  
               
                <?php endif; ?>  
               
               <?php if (!$this->cart->contents()){ echo '<h3 class="cart_title3">Your cart is Empty!</h3>'; } ?> 
                 <!-- <h4>Your Shopping Cart is Empty </h4>   -->               
                
    
   </div><!-- end of center content -->
   
	<?php $this->load->view('right');?>  
   
            
   </div><!-- end of main content -->
   
<?php $this->load->view('footer');?>        
  