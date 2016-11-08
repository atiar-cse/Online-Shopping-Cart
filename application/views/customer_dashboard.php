<?php $this->load->view('header'); ?>


        	

<div id="container">

	<?php $this->load->view('customer_left_nav'); ?>

    <div id="acc-container">
			<?php if(isset($profile)) : foreach($profile as $row) : ?>  
    	<div class="border-bottom acc-dash">      	
        	<h3>My Dashboard</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>
            <p class="hello">Hello, <?php echo $row->first_name; ?>	 <?php echo $row->last_name; ?>	</p>
            <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below ti view or edit information.</p>
            <p class="overview">Account Overview</p>
        </div>
    	<div class="border-bottom cus-name">
        	<p><b>ID:</b> <?php echo $row->email_address; ?>	</p>
            <p><b>Account #:</b> <?php echo $row->customer_id; ?>	</p>
            <p><b>Telephone:</b> <?php echo $row->telephone; ?>	</p>
            <p><b>Address:</b> <?php echo $row->address; ?></p>  
            <p><b>City:</b> <?php echo $row->city; ?></p> 
            <p><b>Country:</b> <?php echo $row->country; ?></p>           
        </div> 
                <?php endforeach; ?>         
            <?php else : ?>	
                <h2>No Information.</h2>
            <?php endif; ?>  
            
            
    	<div class="border-bottom cus-name">
<!--        	<p class="overview" style="font-size:18px;">Recent Orders</p>
			<p style="padding-left:20px;">There are no recent orders under this account.</p> --> 
            
            	<?php 
				
				
					//$this->load->model('orders_model');
					//$query = $this->orders_model->get_customer_orders_nummm();				
					//echo $query;
				?>
<!--        	<p class="overview" style="font-size:18px;">Newsletters</p>
			<p style="padding-left:20px;">You are currently not subscribed to any newsletter.</p> -->                     
        </div>                           
    </div> <!--End #aa-container -->
</div>
                 
                  
    


<?php $this->load->view('footer'); ?>

