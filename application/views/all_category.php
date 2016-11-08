<?php $this->load->view('admin_header'); ?>


        	

<div id="container">

	<?php $this->load->view('admin_left_nav'); ?>
    
    <div id="acc-container">
    	<div class="border-bottom acc-dash">      	
        	<h3>Categories</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>
        </div>
    	<div class="border-bottom cus-name2">
     
				 <?php if(isset($msg)) { echo '<p class="error">'; echo $msg; echo '</p>';} ?>
                 
         	<div id="admin-category"> 
                           
                        
                    <table>
                    <caption> </caption>
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Edit</th>
                            <th> Delete</th>
                        </tr>
                    </thead> 

                    <?php if(isset($category)) : foreach($category as $row) : ?> 
                    
                        <tr>
                            <td> <?php echo $row->category_name; ?> </td>
                            <td>
                               <?php echo $row->description; ?>
                            </td>
                            <td> <a href="<?php echo base_url();?>category/edit/<?php echo $row->category_id	; ?>">Edit</a> </td>
                            <td> <?php echo anchor('category/delete/'.$row->category_id, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')")); ?>
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

