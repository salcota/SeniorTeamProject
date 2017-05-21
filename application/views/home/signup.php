<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	
<div class = "container">

    <!-- For UI consistency with other files that use session for greeting logged-in users contained in p tag -->
    <p></p>

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

	        // Inserts user icon next to user input.
		echo '<span class="input-group-addon addon-iconwidth" id="envelope-addon"><i class="fa fa-user" aria-hidden="true"><span class="required"> &nbsp;&nbsp;*</span></i></span>';
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
		echo '<span class="input-group-addon addon-iconwidth" id="envelope-addon"><i class="fa fa-envelope" aria-hidden="true"><span class="required"> &nbsp;*</span></i></span>';
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
		echo form_label('<span class="small text-muted">May only be alphanumeric and at least 4 characters long</span>', 'password');
                echo "<div class='input-group'>";

		// Inserts lock icon next to the password input.
        	echo '<span class="input-group-addon addon-iconwidth" id="lock-addon"><i class="fa fa-lock" aria-hidden="true"><span class="required"> &nbsp;&nbsp;*</span></i></span>';
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
        	echo '<span class="input-group-addon addon-iconwidth" id="lock-addon"><i class="fa fa-lock" aria-hidden="true"><span class="required"> &nbsp;&nbsp;*</span></i></span>';
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
	
    <!--CAPTCHA Verification-->
    <div class="row justify-content-center">

	<div class="form-group col-sm-5">
	    <?php
               echo form_label('<span class="small text-muted">Enter the word shown in the image</span>', 'captcha');
		echo "<div class='input-group'>";
          
                echo '<span class="input-group-addon addon-iconwidth" id=i"lock-addon"><button class="btn-success" style="border-radius: 6px"><i class="fa fa-refresh" style="color: #FFF; position: relative; left: -1px" aria-hidden="true"></i></button></span>';
 
		echo '<img style="border: solid 1px #BBB" src="' . base_url() . 'Images/captcha">';
        	$data = array(
					'class'		=> 'form-control',
					'name'          => 'captcha',
					'id'            => 'captcha',
					'maxlength'     => '10'
			);

		echo form_input($data);
		echo "</div>";
	    ?>
	</div>
    </div>

    <br />

    <!-- Major -->
    <div class="row justify-content-center" style="margin-top: -20px">
        <div class="form-group col-sm-5">
            <?php
		echo form_label('<span class="small text-muted">Optional</span>', 'major');
                echo "<div class='input-group'>";

                echo '<span class="input-group-addon addon-iconwidth" id="lock-addon"><i class="fa fa-graduation-cap" aria-hidden="true"> &nbsp;&nbsp;&nbsp;</i></span>';

                foreach ($sfsu_majors as $major) {
                    $options[$major->major_id] = $major->major_name;
                }
                echo form_dropdown('major', $options, '1');
	 	echo '</div>';
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
		echo "I agree with the <a href='"?><?php echo base_url() . "About/view/terms'>Terms & Services</a><span class='required'> *</span>";
	    ?>
	</div>
    </div>

    <div class="row justify-content-center">
	<div class="col-sm-5" style="text-align: center">
	    <?php
		$data = array(
		    'class' 	=> 'btn btn-success',
		    'name' 	=> 'submit',
		    'style'	=> 'cursor: pointer; width: 150px',
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
