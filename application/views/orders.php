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
                           
                        
                    <table>
                    <caption> </caption>
                    <thead>
                        <tr>
                            <th>Email Address</th>
                            <th>Status</th>
                     
                            <th> Delete</th>
                            <th> Details</th>
                        </tr>
                    </thead> 

                    <?php if(isset($orders)) : foreach($orders as $row) : ?> 
                    
                        <tr>
                            <td> <?php echo $row->ordership_email_address; ?> </td>
                            <td>
                               <?php echo $row->status; ?>
                            </td>
                           
                            <td> <?php echo anchor('orders/delete/'.$row->order_id, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')")); ?>
    </td>
    						<td> <?php echo anchor('orders/details/'.$row->order_id, 'Details'); ?> </td>
                        </tr>
                    <?php endforeach; ?>
                    </table>   

                    <?php else : ?>	
                        <h2>No Information for the orders.</h2>
                    <?php endif; ?>                                  
                               
            </div> <!--End .admin-category -->                                                              
        </div> 
        
        
           <div id="pag">
                
                <?php echo $this->pagination->create_links(); ?>   
           </div>        
                      
    </div> <!--End #aa-container -->   
    
    
</div>
                 
                  
    


<?php //$this->load->view('admin_footer'); ?>

