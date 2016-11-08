<?php $this->load->view('admin_header'); ?>


        	

<div id="container">

	<?php $this->load->view('admin_left_nav'); ?>
    
    <div id="acc-container">
    	<div class="border-bottom acc-dash">      	
        	<h3>Products</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>
        </div>
    	<div class="border-bottom cus-name2">
     
				 <?php if(isset($msg)) { echo '<p class="error">'; echo $msg; echo '</p>';} ?>
                 
         	<div id="admin-category"> 
                           
                        
                    <table>
                    <caption> </caption>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Delete</th>
                            <th> Edit</th>
                            <th> View</th>
                        </tr>
                    </thead> 

                    <?php if(isset($products)) : foreach($products as $row) : ?> 
                    
                        <tr>
                            <td> <?php echo $row->name; ?> </td>
                            <td>
                               BDT <?php echo $row->price; ?>
                            </td>
                            <td> <?php echo anchor('product/delete/'.$row->product_id, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')")); ?>
                             </td>
                            <td>  <a href="<?php echo base_url();?>product/edit/<?php echo $row->product_id	; ?>">Edit</a>
    						</td>
    						<td> <a target="_blank" href="<?php echo base_url();?>product/view/<?php echo $row->product_id	; ?>">View</a> </td>
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

