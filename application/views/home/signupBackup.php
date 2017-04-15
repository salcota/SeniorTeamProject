<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class = "container" style="margin-top: 100px">

    <!-- Subtitle Header -->
    <div class="row">
        <div class="col">
            <div class="jumbotron" style="background-color:#FFF; margin-top: 25px; text-align: center">
                <h1 class="display-4">Sign Up</h1>
	        <hr calss="my-4">
	        <p class="lead">
		    Please enter a San Francisco State University email and a password containing at least eight characters.
	        </p>
            </div>
        </div>
    </div>

    <br /><br /><br />

    <!--Inserts values of form input data in $attributes to use elsewhere (double check with Prateek)-->
    <?php $attributes = array('id'=>'login_form', 'class'=>'form_horizontal'); ?>



    <div class="row justify-content-center text-danger">
        <div class="col-sm-5">
	    <?php
		// Loads and unloads errors if any are present after you insert form iput data such as length requirements which can be found in the Users.php controller
		if($this->session->flashdata('errors')):
		echo "<div class='alert alert-danger' role='alert'><strong>" . $this->session->flashdata('errors') . "</strong></div>";
		endif;
	    ?>

	    <?php	
		if($this->session->flashdata('login_failed')):
    		echo "<div class='alert alert-danger' role='alert'><strong>" . $this->session->flashdata('login_failed') . "</strong></div>";
    		endif; 
	    ?>
        </div>
    </div>

    <!-- Creates the login form with email and password input and a submit button-->
    <?php 
        //changed to 'Signup/login' from 'Users/login'
        echo form_open('Signup/login', $attributes);
    ?>

    <div class="row justify-content-center">
        <div class="form-group input-group col-sm-5">
            <?php
	        // Inserts email icon next to email input
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

    <br /><br />

    <!--Submit Button-->
    <div class="row justify-content-center" style="margin-top: -20px">
        <div class="form-group col-sm-5" style="text-align: center">
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

    <!-- Don't need a signup link on signup page -->
    <!--Signup Button-->
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <!--<button type="submit" class="btn btn-success" style="width: 100px">Sign Up</button>-->
        </div>
    </div>

    <br /><br /><br />

</div>
