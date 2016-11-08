<?php $this->load->view('admin_header'); ?>


        	

<div id="container">

	<?php $this->load->view('admin_left_nav'); ?>

    <div id="acc-container">
			<?php if(isset($profile)) : foreach($profile as $row) : ?>  
    	<div class="border-bottom acc-dash">      	
        	<h3>Account Dashboard</h3>
            <h4>For Assistance, Contact Us : <a href="#">Click Here</a></h4>
            <p class="hello">Hello, <?php echo $row->first_name; ?>	 <?php echo $row->last_name; ?>	</p>
            <p>From your Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below ti view or edit information.</p>
            <p class="overview">Account Overview</p>
        </div>
    	<div class="border-bottom cus-name">
        	<p><b>Email:</b> <?php echo $row->admin_email; ?>	</p>
            <p><b>First Name:</b> <?php echo $row->first_name; ?>	</p>
            <p><b>Last Name:</b> <?php echo $row->last_name; ?>	</p>
            <p><b>Role:</b> <?php echo $row->role; ?></p>              
            <p><b>Since:</b> <?php echo $row->admin_registered; ?></p>            
        </div> 
                <?php endforeach; ?>         
            <?php else : ?>	
                <h2>No Information.</h2>
            <?php endif; ?>                
    </div> <!--End #aa-container -->
</div>
                 
                  
    


<?php //$this->load->view('admin_footer'); ?>

