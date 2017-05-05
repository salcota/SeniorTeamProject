<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">

    <!-- Notifies user that he or she is logged in if condition is true -->
    <p>
        <?php
            if($this->session->flashdata('login_success')):
            echo "<div class='alert alert-success' role='alert'>" . $this->session->flashdata('login_success') . "</div>";
            endif;
        ?>
    </p>

    <!-- Subtitle Header -->
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1 class="display-4"><?php echo $name;?></h1>
		<hr class="my-4" />
	    </div>
        </div>
    </div>

    <br/><br /><br />

    <!-- User Information -->
    <div class="row justify-content-center">

        <!-- Image Holder of Profile Picture -->
	<div class="col-md-5" style="margin-bottom: 10px">
            <div class="card" style="margin: 0 auto 10 auto; padding: 5 5 0 5">
                <p class="small" style="padding-left: 10px; padding-top: 13px; text-align: center">
                	<img class="card-img-top card-style" src="<?php echo $pic;?>" alt="Profile Picture">
		</p>
            </div>
        </div>

        <!-- Displays the table containing information on the current user -->
        <div class="col-md-5">
            <?php 
			// Get String of user's major.
			$userMajorName = "";
			foreach($majors as $major)
			{
				if ($major->major_id == $usermajor)
				{
					$userMajorName = $major->major_name;
					break;
				}
			}
			
			echo <<<END
                <table>
                <tr><th>Username:</th>    	<td>$username</td> </tr>
                <tr> <th>Major:</th>        	<td>$userMajorName</td> </tr>
                <tr> <th>Date:</th>    	<td>$registrationDate</td> </tr>
                </table>
END;
            ?>
        </div>

    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <span style="font-weight: bold">Biography</span>
            <div class="description_box">
                <?php
					echo $biography;
				?>
            </div>
        </div>
    </div>

    <br/><br/><br/>

</div>
