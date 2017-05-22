<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
 
<div class="container">

    <!-- Notifies user that he or she is logged in if condition is true -->
    <p style="text-align: center">
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
            	<h1 class="display-4">Have any concerns? Contact Us!</h1>
	    	<hr class= "my-4">
	    	<p class="lead"> Whether it's for technical issues, suggestions, or general feedback, please don't hesitate to reach out to our staff.</p>
            </div>
	</div>
    </div>

    <br /><br /><br />

    <!-- Contact Information -->                                        
    <div class="row justify-content-center lightText">
        <div class="col-sm-12">
            <h5>Phone:&emsp;&emsp;(415)-265-3692</h5>
	    <h5>Email:&emsp;&emsp;&nbsp;&nbsp;<span style="color: #369">ihsan@mail.sfsu.edu</span></h5>
	    <h5>Location:&emsp;SFSU Congre-Gators Market, San Francisco, CA</h5>
        </div>
    </div>
              
    <br /><br /><br />
		
</div>
