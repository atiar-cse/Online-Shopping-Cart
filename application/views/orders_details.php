<?php $this->load->view('admin_header'); ?>


        	

<div id="container">

	<?php $this->load->view('admin_left_nav'); ?>
    
    <div id="acc-container">
    	<div class="border-bottom acc-dash">      	
        	<h3><?php echo $title;?></h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>
        </div>
    	<div class="border-bottom cus-name2">
     
				 <?php if(isset($msg)) { echo '<p class="error">'; echo $msg; echo '</p>';} ?>
                 
         	<div id="admin-category"> 

			  <?php if(isset($orders)) : foreach($orders as $row) : ?> 
              		
                    Order Number : # <?php echo $row->order_id;  ?> <br /> 
                    Status : <strong><em><?php echo $row->status;  ?></em></strong>
              
              
				  <?php 
                  	$details = $this->orders_model->get_product_order_details($row->order_id); // orderdetails table
                  	foreach ($details as $item):
						$product_name = $this->orders_model->get_product_name($item->product_id);
						foreach ($product_name as $name):
							echo "<p><strong>Product Number : </strong>","#", $item->product_id;
							echo "<br/><strong>Product Name : </strong>", $name->name;
							echo "<br/><strong>Option : </strong>", $item->option_name," : ", $item->option_values;
							echo "<br/><strong>Quantity : </strong>", $item->quantity;
							echo "<br/><strong>Total : </strong>", $item->total, " BTD";							
							
							echo "<p><br/>";
						endforeach;						
					endforeach;
                  ?>
                  
                  
                	<?php echo "<strong>Grand Total = </strong>", $row->orderamount, " BTD <br />"; ?>
                    
                    <br /><br/> <h3> Shipping Address : </h3>
                    
                    <?php 
					echo "<br/><br/><br/><p><strong>Name : </strong>", $row->ordership_first_name," ",$row->ordership_last_name ;
                    echo "<br/><strong>Email Address : </strong>", $row->ordership_email_address;
                    echo "<br/><strong>Company : </strong>", $row->ordership_company;
                    echo "<br/><strong>Address : </strong>", $row->ordership_address;
                    echo "<br/><strong>City : </strong>", $row->ordership_city;	
					echo "<br/><strong>Country : </strong>", $row->ordership_country;
					echo "<br/><strong>Zip Code : </strong>", $row->ordership_zip;
					echo "<br/><strong>Mobile : </strong>", $row->ordership_telephone;
					echo "<br/><br/><strong>Payment Method : </strong>", $row->paymentmethod;
					echo "<br/><strong>bKash Number : </strong>", $row->bkashno;
					echo "<br/><strong>bKash trxID : </strong>", $row->bkashtrxid;
					echo "<br/><strong>Bank A/C Name : </strong>", $row->bankaccholder;
					echo "<br/><strong>Bank A/C Number : #</strong>", $row->bankaccnumber;					
                    
                    echo "<p>";   
					?>
                    
                    <div id="delivered" >
                    	<?php
							$status = $row->status;
						if($status == 'pending') {
						echo anchor('orders/todeliver/'.$row->order_id, 'Click here to change the order status - DELIVERED.', array('onClick' => "return confirm('Are you sure you want to deliver this product order?')")); 
						}
						?>
                        
                    </div>
                    
              <?php endforeach; ?>
              <?php else : ?>	
                  <h2>No Information for the orders.</h2>
              <?php endif; ?>                                  
                               
            </div> <!--End .admin-category -->                                                              
        </div> 
        
       
                      
    </div> <!--End #aa-container -->   
    
    
</div>
                 
                  
    


<?php //$this->load->view('admin_footer'); ?>

