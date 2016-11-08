<?php $this->load->view('header'); ?>

<div id="container">
<div id="login_form">
<h1>Create an Account!</h1>

<?php echo form_label('<p class="invalid">There is already an account with this email address. If you are sure that it is your email address, click <a href="#">here</a> to get your password and access your account.</p>'); ?>

<?php echo validation_errors('<p class="error">'); ?>
<fieldset>
<legend>Login Info</legend>
<?php
$attributes = array('class' => 'email', 'id' => 'myform');
echo form_open('signup/create_customer',$attributes);

echo form_label('Email Address<em>*</em>');
  $data = array(
  'name' => 'email_address',
  'id' => '',
  'value' => '',
  'autocomplete' => 'off',
  'class' => '',
  'placeholder' => 'Email',
  'required' => 'required',
  );
echo form_input($data);

echo form_label('Password<em>*</em>');
  $data = array(
  'name' => 'password',
  'autocomplete' => 'off',
  'placeholder' => 'Password',
  'required' => 'required',
  'style' => 'width: 280px;box-shadow: none !important;border: 1px solid #000 !important;background:#CCC !important;',						      						    
  );
echo form_password($data);
echo form_label('Confirm Password<em>*</em>');
  $data = array(
  'name' => 'password_confirm',
  'autocomplete' => 'off',
  'placeholder' => 'Confirm Password',
  'required' => 'required',
  'style' => 'width: 280px;box-shadow: none !important;border: 1px solid #000 !important;background:#CCC !important;',						      						      
  );
echo form_password($data);
?>
</fieldset>

<fieldset>
<legend>Billing / Shipping Info </legend>
<?php
echo form_label('First Name<em>*</em>');
  $data = array(
  'name' => 'first_name',
  'autocomplete' => 'off',
  'placeholder' => 'First Name',
  'required' => 'required',
  );
echo form_input($data);

echo form_label('Last Name<em>*</em>');
  $data = array(
  'name' => 'last_name',
  'autocomplete' => 'off',
  'placeholder' => 'Last Name',
  'required' => 'required',
  );
echo form_input($data);

echo form_label('Company');
  $data = array(
  'name' => 'company',
  'autocomplete' => 'off',
  'placeholder' => 'Company',
  'required' => 'required',
  );
echo form_input($data);

echo form_label('Address<em>*</em>');
  $data = array(
  'name' => 'address',
  'autocomplete' => 'off',
  'placeholder' => 'Address',
  'required' => 'required',
  );
echo form_input($data);

echo form_label('City<em>*</em>');
  $data = array(
  'name' => 'city',
  'autocomplete' => 'off',
  'placeholder' => 'City',
  'required' => 'required',
  );
echo form_input($data);

echo form_label('Country<em>*</em>');
$options = array(
                  'USA'  => 'USA',
                  'UK'    => 'UK',
                  'Bangladesh'   => 'Bangladesh',
                  'Canada' => 'Canada',
                );
$js = 'id="country"';
echo form_dropdown('country', $options, 'Bangladesh',$js);

echo form_label('Zip Code<em>*</em>');
  $data = array(
  'name' => 'zip',
  'autocomplete' => 'off',
  'placeholder' => 'Zip Code',
  'required' => 'required',
  );
echo form_input($data);

echo form_label('Telephone<em>*</em>');
  $data = array(
  'name' => 'telephone',
  'autocomplete' => 'off',
  'placeholder' => 'Telephone',
  'required' => 'required',
  );
echo form_input($data);


echo form_submit('submit', 'Create Acccount');
?>
</fieldset>

</div>
</div> <!--End #container -->
<?php $this->load->view('footer'); ?>




  


