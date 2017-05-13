<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo form_open_multipart('uploadprofile/save');?>

<div class="container">

    <!-- For UI consistency wehere a p tag exists to greet user if logged in -->
    <p></p>


   <!-- Flashdata -->


   <?php if ($this->session->flashdata('profile_errors')) { ?>
    <div class="alert alert-danger"> <?= $this->session->flashdata('profile_errors') ?> </div>
   <?php } ?>

  <?php if ($this->session->flashdata('picture_errors')) { ?>
    <div class="alert alert-danger"> <?= $this->session->flashdata('picture_errors') ?> </div>
   <?php } ?>



    <!-- Subtitle Header -->
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">Your Profile</h1>
                <hr class= "my-4">
		<p class="lead">Update your profile with a picture, new major,  and description of your self,  or change your password frequently for better security.</p>
            </div>
        </div>
    </div>

    <br /><br /><br />

    <!-- Profile Information - Image, Major, Password, and Biography -->  
    <div class="row justify-content-center"> 

	<!-- Image Holder of Profile Picture -->
         <div class="col-lg-5" style="margin-bottom: 10px">
            <div class="card" style="margin: 0 auto 10 auto; padding: 5 5 0 5">
		<p class="small" style="padding-left: 10px; text-align: center">
                    <img class="card-img-top card-style"  src="<?php echo $pic ?>" alt="Card image cap">
		    <br /><br />
                    <span class="card-title">Edit your profile picture</span>
		</p>
	    </div>
         </div> 

	<!--  Username -->
	<div class="col-lg-5">
            <div class="form-group input-group">
                <?php
                    echo '<span class="input-group-addon span-for-profile">Username</span>';
                    // 
                    $data = array(
                        'class' 	=> 'form-control',
                        'name' 		=> 'photo',
                        'type' 		=> 'text',
                        'size' 		=> '100',
			'readonly' 	=> 'true',
			'placeholder' 	=> $username
                    );
                   
                    echo form_input($data);
                ?>
            </div>

	    <!--  Email -->
            <div class="form-group input-group">
                <?php
                    echo '<span class="input-group-addon span-for-profile">Email</span>';
                    // 
                    $data = array(
                        'class' 	=> 'form-control',
                        'name' 		=> 'photo',
                        'type' 		=> 'text',
                        'size' 		=> '100',
			'readonly'	=>'true',
			'placeholder' 	=> $email
                    );
                   
                    echo form_input($data);
                ?>
            </div>

	    <!-- Profile Picture -->
            <div class="form-group input-group">
                <?php
                    echo '<span class="input-group-addon span-for-profile">Profile Picture</span>';
                    // 
                    $data = array(
                        'class' 	=> 'form-control',
                        'name' 		=> 'userfile',
                        'type' 		=> 'file',
                        'size' 		=> '100',
                    );
            	    $value ="";
                    echo form_upload($data, $value);
                ?>
            </div>

	    <!-- Major -->
            <div class="form-group input-group">
                <?php
		     echo '<span class="input-group-addon span-for-profile">Majors</span>';

                     foreach ($majors as $major) {
                        $options[$major->major_id] = $major->major_name;
                     }
                     echo form_dropdown('major', $options, $usermajor);
                ?>
            </div>

	    <!--New Password Input-->
            <div class="form-group input-group">
                <?php
                    // Inserts lock icon next to the password input
                    echo '<span class="input-group-addon span-for-profile">New Password</span>';
                    $data =array(
	                'class' 	=> 'form-control',
	                'name' 		=> 'password',
	                'type' 		=> 'password',
	                'placeholder' 	=> 'Password'
	            );
	            echo form_password($data);
	        ?>
	    </div>

	    <!--Password Confirmation Input-->
	    <div class="form-group input-group">
	        <?php
	            // Inserts lock icon next to the password input
	            echo '<span class="input-group-addon span-for-profile">Confirm</span>';
	            $data =array(
	                'class' 	=> 'form-control',
	                'name' 		=> 'passconf',
	                'type' 		=> 'password',
	                'placeholder' 	=> 'Confirm Password'
	            );
	            echo form_password($data);
	        ?>
	    </div>

        </div>
    </div>

    <!-- Biography -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="form-group">
                <?php
                    echo '<span>Biography</span>';
                    //
                    $data = array(
                        'class' 	=> 'form-control',
                        'name' 		=> 'description',
                        'type' 		=> 'textarea',
                        'maxlength' 	=> '300',
                        'style' 	=> 'resize: none; height: 100px',
			'placeholder' 	=> $biography
                    );
                    $value = "";
                    echo form_textarea($data, $value);
                ?>
            </div>
        </div>
    </div>

    <!-- Reset - Submit -->
    <div class="row justify-content-center">
        <div class="col-lg-10" style="text-align: right">
            <?php
                $data = array(
                    'style' 		=> 'width: 100px',
                    'class' 		=> 'btn btn-success',
                    'name' 		=> 'reset',
                    'value' 		=> 'Reset',
                    'style' 		=> 'cursor: pointer; width: 100px'
                );
                echo form_reset($data);
            ?>
            &emsp;
            <?php
                $data = array(
                    'style' 		=> 'width: 100px',
                    'class' 		=> 'btn btn-success',
                    'name' 		=> 'submit',
                    'value' 		=> 'Save',
                    'style' 		=> 'cursor: pointer; width: 100px'
                );
                echo form_submit($data);
            ?>
        </div>
    </div>

    <?php form_close(); ?>

    <br /><br /><br />

</div>
