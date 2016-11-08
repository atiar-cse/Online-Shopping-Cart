<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title><?php echo $title;?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/iecss.css" />
<![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>js/boxOver.js"></script>
<style type="text/css">
#bank {
	display:none;
}
#bkash {
	display:none;
}
</style>

<script type="text/javascript">
function hideArea() {
     var bank = document.getElementById('bank');
	 var bkash = document.getElementById('bkash');	 
     var thelist = document.getElementsByName('rad');	 
	 
	 for(var i = 0; i < thelist.length; i++) {
          if(thelist[i].checked) {
               if(thelist[i].value == "bank") {
                    bank.style.display = "inline";
                    bkash.style.display = "none";					
               }
               if(thelist[i].value == "bkash") {
                    bkash.style.display = "inline";
                    bank.style.display = "none";					
               }
               break;
          }
     }
} 
</script>



<script type="text/javascript">

function validate_form ( )
{
	valid = true;
	
        if ( ( document.check99.rad[0].checked == false ) && ( document.check99.rad[1].checked == false ) )
        {
                alert ( "Please choose a payment method." );
                valid = false;
        }	

        return valid;
}

</script>
</head>
<body>

<div id="main_container">
	<div class="top_bar">
         <div class="user-login">
          <?php 		
          $is_logged_in = $this->session->userdata('is_logged_in');
                  if(!isset($is_logged_in) || $is_logged_in != true)
                  {
                      echo 'Welcome Guest! '; echo anchor('/login', 'Login');		
                      //$this->load->view('login_form');
                  } 
                  else
                  {
                      echo 'Welcome '; echo $this->session->userdata('first_name'); echo ' '; echo $this->session->userdata('last_name'); echo '! '; echo anchor('login/logout', 'Logout');
                  }
                  
          ?>           
          </div>    
    
    
    
    	<div class="top_search">
        	<div class="search_text">Advanced Search</div>
            <?php
            $attributes = array('class' => 'email', 'id' => 'myform2');
            echo form_open_multipart('search/index',$attributes);
			?>
            <input type="text" class="search_input" name="search" value="" placeholder="search by name or price... etc" />
            <input type="image" src="<?php echo base_url();?>css/images/search.gif" class="search_bt"/>
            <?php echo form_close(); ?>
            
        </div> <!--End top_search-->
        
        <div class="languages">            
  <?php /*?>      	<div class="lang_text">Languages:</div>
            <a href="#" class="lang"><img src="<?php echo base_url();?>css/images/us.gif" alt="" title="" border="0" /></a>
            <a href="#" class="lang"><img src="<?php echo base_url();?>css/images/bd.gif" alt="" title="" border="0" /></a>   <?php */?>    
        </div> <!--End Language-->
    
    </div> <!--End Top Bar-->
	<div id="header">
        
        <div id="logo">
            <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>css/images/logo.png" alt="" title="" border="0" width="310" height="95" /></a> 
	    </div> <!--End logo-->
        
        <div class="oferte_content">
        	 <div class="top_divider"><img src="<?php echo base_url();?>css/images/header_divider.png" alt="" title="" width="1" height="164" />				             </div>
        	<div class="oferta">
            
           		<div class="oferta_content">
                	<img src="<?php echo base_url();?>css/images/laptop.png" width="94" height="92" border="0" class="oferta_img" />
                	
                    <div class="oferta_details"> 
                            <div class="oferta_title">Samsung Notebooks</div>
                            <div class="oferta_text">
                            Samsung Notebooks are among the world's lightest and most powerful mobile computers. Our Notebooks are an excellent choice for people who don't want to sacrifice processing speed or design for mobility and productivity on the go.
                            </div>
                            <a href="<?php echo base_url();?>product/view/13" class="details">details</a>
                    </div>
                </div>
                <div class="oferta_pagination">
                
<!--                     <span class="current">1</span>
                     <a href="#">2</a>
                     <a href="#">3</a>
                     <a href="#">4</a>
                     <a href="#">5</a>   -->
                             
                </div>        

            </div>
            <div class="top_divider"><img src="<?php echo base_url();?>css/images/header_divider.png" alt="" title="" width="1" height="164" /></div>
        	
        </div> <!-- end of oferte_content-->
        

    </div> <!--End header-->
    
   <div id="main_content"> 
   
            <div id="menu_tab">
            <div class="left_menu_corner"></div>
                    <ul class="menu">
                         <li><a href="<?php echo base_url();?>" class="nav1">  Home </a></li>
                         <li class="divider"></li>
                         <li><a href="<?php echo base_url();?>product/all" class="nav2">Products</a></li>
                         <!--<li class="divider"></li> -->
                         <!--<li><a href="#" class="nav3">Specials</a></li> -->
                         <li class="divider"></li>
                         <li><a href="<?php echo base_url();?>index.php/customer/profile" class="nav4">My account</a></li>
                         <li class="divider"></li>
                         <li><a href="<?php echo base_url();?>index.php/signup" class="nav4">Sign Up</a></li>
                         <li class="divider"></li>                         
                         <li><a href="<?php echo base_url();?>cart" class="nav5">Shipping </a></li>
                         <li class="divider"></li>
                         <li><a href="<?php echo base_url();?>contact" class="nav6">Contact Us</a></li>
                         <li class="divider"></li>
                         <li class="currencies">Currencies
                         <select>
                         <option>BDT</option>
                         <!--<option>Euro</option>
                         <option>US Dollar</option> -->
                         </select>
                         </li>
                    </ul>

             <div class="right_menu_corner"></div>
            </div><!-- end of menu tab -->
            
    <div class="crumb_navigation">
    Navigation: <span class="current"><?php if($title == "Online Shopping Cart")echo "Home"; else echo"Home >> "; ?>
  					<?php if(isset($navigation)) echo $navigation; ?>
                </span>
    
    </div>        
    
