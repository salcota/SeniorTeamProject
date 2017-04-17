<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	
<div class = "container">

    <!-- Notifies user that he or she is logged in if condition is true -->
    <p>
        <?php
            if($this->session->flashdata('login_success')):
            echo "<div class='alert alert-success' role='alert'>" . $this->session->flashdata('login_success') . "</div>"; 

            // If login success and signup.php is the previous page, redirects user to home page after two seconds.
            echo "<script>setTimeout(function() {returnToHome();}, 2000); function returnToHome() {window.location.href = ('"?> <?php echo base_url() . "Home/view/home');}</script>";
           endif;
        ?>
    </p>

    <!-- Subtitle Header -->
    <div class="row justify-content-center">
        <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">Sign Up!</h1>
                <hr class="my-4">
		<p class="lead">You must be a student of San Francisco State University and use an SFSU email to register.</p>
            </div>
        </div>
    </div>

    <br /><br /><br />

    <!--Inserts values of form input data in $attributes to use elsewhere -->
    <?php $attributes = array('id'=>'login_form', 'class'=>'form_horizontal'); ?>

    <div class="row justify-content-center text-danger">
        <div class="col-sm-5">
            <?php
                // Loads and unload errors if any are present after you insert form iput data such as length requirements which can be found in the Users.php controller.
                if($this->session->flashdata('errors')):
                echo "<div class='alert alert-danger' role='alert'><strong>" . $this->session->flashdata('errors') . "</strong></div>";
                endif;
            ?>
	</div>
    </div>

    <!-- Creates the login form with email and password input and a submit button-->
    <?php  echo form_open('Signup/login', $attributes);?>

    <!-- Username Input -->
    <div class="row justify-content-center">

	<div class="form-group col-sm-5">
	    <?php
		echo form_label('<span class="small text-muted">May only be alphanumeric and at least 8 characters long</span>', 'sfsu_username');
                echo "<div class='input-group'>";

	        // Inserts user icon next to email input.
		echo '<span class="input-group-addon" id="envelope-addon" style="width: 40px"><i class="fa fa-user" aria-hidden="true"></i></span>';
		$data = array(
		    'class' 		=> 'form-control',
		    'name' 		=> 'username',
		    'placeholder' 	=> 'Enter your username'
		);
	        echo form_input($data);
		echo "</div>";
	    ?>
	</div>
    </div>

    <!-- SFSU Email Input -->
    <div class="row justify-content-center">

        <div class="form-group col-sm-5">
	    <?php
		echo form_label('<span class="small text-muted">Must end with @mail.sfsu.edu</span>', 'sfsu_email');
		echo "<div class='input-group'>";

		// Inserts email icon next to email input.
		echo '<span class="input-group-addon" id="envelope-addon" style="width: 40px"><i class="fa fa-envelope" aria-hidden="true"></i></span>';
		$data = array(
		    'class' 		=> 'form-control',
		    'name' 		=> 'sfsu_email',
		    'placeholder' 	=> 'Enter your  email'
	    	);
		echo form_input($data);
		echo "</div>";
	    ?>
	</div>
    </div>

    <!--Password Input-->
    <div class="row justify-content-center">
	<div class="form-group col-sm-5">
	    <?php
		echo form_label('<span class="small text-muted">Must be at least 4 characters long</span>', 'sfsu_username');
                echo "<div class='input-group'>";

		// Inserts lock icon next to the password input.
        	echo '<span class="input-group-addon" id="lock-addon" style="width: 40px"><i class="fa fa-lock" aria-hidden="true"></i></span>';
        	$data =array(
               	    'class' 		=> 'form-control',
                    'name' 		=> 'password',
		    'type' 		=> 'password',
                    'placeholder' 	=> 'Password'
        	);
        	echo form_password($data);
		echo "</div>";
	    ?>
	</div>
    </div>

    <!--Password Confirmation Input-->
    <div class="row justify-content-center">
	<div class="form-group input-group col-sm-5">
	    <?php
		// Inserts lock icon next to the password input.
        	echo '<span class="input-group-addon" id="lock-addon" style="width: 40px"><i class="fa fa-lock" aria-hidden="true"></i></span>';
        	$data =array(
              	    'class' 		=> 'form-control',
                    'name' 		=> 'passconf',
		    'type' 		=> 'password',
                    'placeholder' 	=> 'Confirm Password'
        	);
        	echo form_password($data);
	    ?>
	</div>
    </div> 

    <br />

    <!--Terms Agreement & Submit Button-->
    <div class="row justify-content-center" style="margin-top: -20px">
        <div class="col-sm-5 form-group terms-link">
	    <?php
		$data = array(
	           'name'     	=> 'terms_agreement',
        	   'id'       	=> 'terms_agreement',
        	   'value'    	=> 'Agree',
        	   'checked' 	=>  FALSE
		);
		echo form_checkbox($data);
		echo " I have read and agree to the <a href='"?><?php echo base_url() . "About/view/terms'>Terms & Services</a>";
	    ?>
	</div>
    </div>

    <div class="row justify-content-center">
	<div class="col-sm-5" style="text-align: center">
	    <?php
		$data = array(
		    'style' 	=> 'width: 150px',
		    'class' 	=> 'btn btn-success',
		    'name' 	=> 'submit',
		    'value' 	=> 'Submit',
	        );
		echo "<br />";
		echo form_submit($data);
	    	echo form_close();	
	    ?>
	</div>

    </div>

    <br /><br /><br />

</div>
