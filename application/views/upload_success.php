<html>
<head>
<title>Upload Form</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>

<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>

<h3>The data!</h3>
<ul>
<?php echo $upload_data['file_name'];?> <br/>
<?php echo $upload_data['file_type'];?><br/>
<?php echo $upload_data['file_path'];?><br/>
<?php echo $upload_data['full_path'];?><br/>
<?php echo $upload_data['is_image'];?><br/>
<?php echo $upload_data['image_width'];?>
</ul>
The img is <br/>
<img src="<?php echo $upload_data['full_path'];?>" width="<?php echo $upload_data['image_width'];?>" height="<?php echo $upload_data['image_height'];?>" /> 

<p><?php echo anchor('upload', 'Upload Another File!'); ?></p>

</body>
</html>