<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class = "row justify-content-center pagetitle">
    <div class="col-sm-12 subtitle" id="subheader">LOGIN</div>
</div>

<br /><br /><br />

<?php $attributes = array('id'=>'login_form', 'class'=>'form_horizontal'); ?>

<div class="row justify-content-center text-danger">
<div class="col-sm-5">

	<?php
		if($this->session->flashdata('errors')):

		echo $this->session->flashdata('errors');

		endif;
	?>
</div>
</div>

<?php echo form_open('Users/login', $attributes);?>

<div class="row justify-content-center">
<div class="form-group input-group col-sm-5">

<?php
	echo '<span class="input-group-addon" id="envelope-addon" style="width: 40px"><i class="fa fa-envelope" aria-hidden="true"></i></span>';

	$data = array(
		'class' => 'form-control',
		'name' => 'email',
		'placeholder' => 'Enter your  email'
	);

	echo form_input($data);
?>

</div>
</div>

<div class="row justify-content-center">
<div class="form-group input-group col-sm-5">

<?php
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



<div class="row justify-content-center" style="margin-top: -10px">
	<small class="form-text text-muted">Forgot password?</small>
</div>

<br />

<div class="row justify-content-center" style="margin-top: -20px">
<div class="form-group col-sm-5 align-self-start">
	
<?php
	$data = array(
		'style' => 'width: 100px',
		'class' => 'btn btn-success',
		'name' => 'submit',
		'value' => 'Login'
	);

	echo form_submit($data);
	echo form_close();	
?>

</div>
</div>

<br /><br />

<div class="row justify-content-center">
	<div class="col-sm-5">
		<h5>Not a member? Sign up!</h5>
	</div>
</div>

<div class="row justify-content-center">
<div class="col-sm-5">
<button type="submit" class="btn btn-success" style="width: 100px">Sign Up</button>
</div>
</div>

<br /><br /><br />
