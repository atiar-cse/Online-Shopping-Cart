<?php $this->load->view('admin_header'); ?>


        	

<div id="container">

	<?php $this->load->view('admin_left_nav'); ?>
    
    <div id="acc-container">
    	<div class="border-bottom acc-dash">      	
        	<h3>Manage Customers</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>
        </div>
    	<div class="border-bottom cus-name2">
     
				 <?php if(isset($msg)) { echo '<p class="error">'; echo $msg; echo '</p>';} ?>
                 
         	<div id="admin-category"> 
                           
                        
                    <table>
                    <caption> </caption>
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Email Address</th>
                            <th>Orders</th>
                     
                            <th> Delete</th>
                        </tr>
                    </thead> 

                    <?php if(isset($customer)) : foreach($customer as $row) : ?> 
                    
                        <tr>
                            <td> <?php echo $row->first_name; ?> <?php echo $row->last_name; ?> </td>
                            <td>
                               <?php echo $row->email_address; ?>
                            </td>
                            <td style="padding-left:20px;">
                               <?php echo $this->customer_manage_model->get_customer_orders($row->customer_id); //showing number of orders for the customer ?>
                            </td>                            
                          
                            <td> <?php echo anchor('customer_manage/delete/'.$row->customer_id, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')")); ?>
    </td>
                        </tr>
                    <?php endforeach; ?>
                    </table>   

                    <?php else : ?>	
                        <h2>No Information for Category.</h2>
                    <?php endif; ?>                                  
                               
            </div> <!--End .admin-category -->                                                              
        </div> 
        
        
           <div id="pag">
                
                <?php echo $this->pagination->create_links(); ?>   
           </div>        
                      
    </div> <!--End #aa-container -->
</div>
                 
                  
    


<?php //$this->load->view('admin_footer'); ?>

