<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container" style="margin-top: 100px">

    <!-- Subtitle Header -->
    <div class="row">
        <div class="col">
            <div class="jumbotron" style="background-color:#FFF; margin-top: 25px; text-align: center">
                <h1 class="display-4">Kunal</h1>
		<hr class="my-4" />
	    </div>
        </div>
    </div>

    <br/><br /><br />

    <!-- User Information -->
    <div class="row justify-content-center">

        <!-- Image Holder of Profile Picture -->
        <div class="col-sm-4" style="margin-bottom: 25px">
            <div class="card" style="height: 205px">
                <img class="card-img-top" src="..." alt="Profile Picture">
            </div>
        </div>

        <!-- Displays the table containing information on the current user -->
        <div class="col-md-6">
            <?php echo
                "<table>" .
                "<tr> <th>Username:</th>    	<td>Kunal</td> </tr>" .
                "<tr> <th>Major:</th>        	<td>Computer Science</td> </tr>" .
                "<tr> <th>Date:</th>    	<td>April 15, 2017</td> </tr>" .
                "</table>"
            ?>
        </div>

    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <span style="font-weight: bold">Biography</span>
            <div class="description_box">
                I am a computer science senior looking to sell some furniture before I move out of campus in a few months.
            </div>
        </div>
    </div>

    <br/><br/><br/>

</div>
