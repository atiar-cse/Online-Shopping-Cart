<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title><?php echo $title;?> - OSC</title>

<!-- TinyMCE -->
<script type="text/javascript" src="<?php echo base_url();?>tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "<?php echo base_url();?>tinymce/examples/css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "<?php echo base_url();?>tinymce/examples/lists/template_list.js",
		external_link_list_url : "<?php echo base_url();?>tinymce/examples/lists/link_list.js",
		external_image_list_url : "<?php echo base_url();?>tinymce/examples/lists/image_list.js",
		media_external_list_url : "<?php echo base_url();?>tinymce/examples/lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		formats : {
			alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
			aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
			alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
			alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
			bold : {inline : 'span', 'classes' : 'bold'},
			italic : {inline : 'span', 'classes' : 'italic'},
			underline : {inline : 'span', 'classes' : 'underline', exact : true},
			strikethrough : {inline : 'del'}
		},

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/iecss.css" />
<![endif]-->
<script type="text/javascript" src="<?php echo base_url();?>js/boxOver.js"></script>
</head>
<body>

<div id="main_container">
	
    
	<div id="admin_header">
        
        <div id="logo">
            <a href="<?php echo base_url();?>index.php/admin"><img src="<?php echo base_url();?>css/images/logo.png" alt="" title="" border="0" width="310" height="95" /></a> 
	    </div> <!--End logo-->
 
         <div class="admin-login">
          <?php 		
				echo 'Welcome, '; echo $this->session->userdata('admin_first_name'); echo ' '; echo $this->session->userdata('admin_last_name'); echo '! '; echo anchor('admin/logout', 'Logout');                  
          ?>           
          </div>  
          <div class="admin_menu">
            <ul class="">
              <li> <a href="<?php echo base_url();?>index.php/admin/profile/">View Profile</a> </li>
              <li> <a href="<?php echo base_url();?>index.php/admin/edit/">Profile Setting</a> </li>
              <li> <a href="<?php echo base_url();?>index.php/admin/password/">Change Password</a> </li> 
              <li> <a href="<?php echo base_url();?>index.php/admin/email/">Change Email</a> </li> 
              <li> <a href="<?php echo base_url();?>index.php/admin/add/">Add Administrator</a> </li>               
            </ul>      
          </div>

    </div> <!--End header-->
    
       
    
