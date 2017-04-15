
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class = "container">
              <div class = "row justify-content-center pagetitle">
                  <div class="col-12 subtitle" id="subheader">SIGNUP</div>
              </div>




<br /><br /><br />


<!--Insert values of form input data in $attributes to use elsewhere (double check with Prateek)-->
<?php $attributes = array('id'=>'login_form', 'class'=>'form_horizontal'); ?>



<div class="row justify-content-center text-danger">
<div class="col-sm-5">

	<?php
		// Load and unload errors if any are present after you insert form iput data such as length requirements which can be found in the Users.php controller (double check online)
		if($this->session->flashdata('errors')):
		echo $this->session->flashdata('errors');
		endif;
	?>
</div>
</div>


<p class="bg-danger" style="text-align: center">

<?php if($this->session->flashdata('login_failed')): ?>

<?php echo $this->session->flashdata('login_failed'); ?>

<?php endif; ?>

</p>

<!-- Creates the login form with email and password input and a submit button-->
<?php //changed to 'Signup/login' from 'Users/login'
echo form_open('Signup/login', $attributes);?>

<!-- username input -->
<div class="row justify-content-center">
<div class="form-group input-group col-sm-5">

<?php

	// Inserts email icon next to email input
	echo '<span class="input-group-addon" id="envelope-addon" style="width: 40px"><i class="fa fa-envelope" aria-hidden="true"></i></span>';
	$data = array(
		'class' => 'form-control',
		'name' => 'username',
		'placeholder' => 'Enter your username'
	);
	echo form_input($data);
?>

</div>
</div>

<!-- sfsu_email input -->
<div class="row justify-content-center">
<div class="form-group input-group col-sm-5">

<?php
	// Inserts email icon next to email input
	echo '<span class="input-group-addon" id="envelope-addon" style="width: 40px"><i class="fa fa-envelope" aria-hidden="true"></i></span>';
	$data = array(
		'class' => 'form-control',
		'name' => 'sfsu_email',
		'placeholder' => 'Enter your  email'
	);
	echo form_input($data);
?>

</div>
</div>



<!--Password Input-->
<div class="row justify-content-center">
<div class="form-group input-group col-sm-5">

<?php
	// Inserts lock icon next to the password input
        echo '<span class="input-group-addon" id="lock-addon" style="width: 40px"><i class="fa fa-lock" aria-hidden="true"></i></span>';
        $data =array(
                'class' => 'form-control',
                'name' => 'password',
		'type' => 'password',
                'placeholder' => 'Password'
        );
        echo form_password($data);
?>

</div>
</div>

<!--Password Confirmation Input-->
<div class="row justify-content-center">
<div class="form-group input-group col-sm-5">

<?php
	// Inserts lock icon next to the password input
        echo '<span class="input-group-addon" id="lock-addon" style="width: 40px"><i class="fa fa-lock" aria-hidden="true"></i></span>';
        $data =array(
                'class' => 'form-control',
                'name' => 'passconf',
		'type' => 'password',
                'placeholder' => 'Confirm Password'
        );
        echo form_password($data);
?>

</div>
</div>

<!-- don't need forgot pw link on signup page -->  
<div class="row justify-content-center" style="margin-top: -10px">
	<small class="form-text text-muted">Forgot password?</small>
</div> 

<br />



<!--Submit Button-->
<div class="row justify-content-center" style="margin-top: -20px">
<div class="form-group col-sm-5 align-self-start">
	
<?php
	$data = array(
		'style' => 'width: 100px',
		'class' => 'btn btn-success',
		'name' => 'submit',
		'value' => 'Signup'
	);
	echo form_submit($data);
	echo form_close();	
?>

</div>
</div>
<!--
<div class="row justify-content-center">
	<div class="col-sm-5">
		<h5>Not a member? Sign up!</h5>
	</div>
</div>
-->

<!-- don't need a signup link on signup page -->
<!--Signup Button-->
<div class="row justify-content-center">
<div class="col-sm-5">
<!--<button type="submit" class="btn btn-success" style="width: 100px">Sign Up</button>
-->

</div>
</div>

<br /><br /><br />

</div>
