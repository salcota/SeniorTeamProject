<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container lightText">

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
            <div class="jumbotron" style="color: #EEE; background: url(<?php echo base_url() . 'public/images/san_francisco.png'?>)">
                <h1 class="display-4">Welcome to the Staff!</h1>
	    	<hr class="my-4 hr-for-jumbotron">
	    	<h5>CSC 648/848 - Software Engineering Class at SFSU</h5>
	    	<hr class="my-4 hr-for-jumbotron">
	    	<p class="lead" style="text-align: left">
	            Spring 2017
		    <br />
		    Section 1
		    <br />
		    Team 4
	        </p>
            </div>
        </div>
    </div>

    <br /><br /><br />

    <!-- Members' pictures and mini biography -->
    <div>
	<div class="row justify-content-center">
            <div class="col-sm-4 about_us">
	        <div class="about_frame">
	            <img src="<?php echo base_url() . "public/images/aboutIhsan.png"?>" alt="Ihsan Taha"/>
	        </div>
	        <br />
                <h5>Ihsan</h5>
	        <p>CEO of SFSU Congre-Gator's Market, a passionate programmer with a background in UI design, web development, and game development.</p>
            </div>

	    <div class="col-sm-4 about_us">
	        <div class="about_frame">
                    <img src="<?php echo base_url() . "public/images/aboutPrateek.png"?>" alt="Prateek Gupta"/>
	        </div>
                <br />
                <h5>Prateek</h5>
            	<p>CTO of SFSU Congre-Gator's Market, Master's Student Computer Science, Andorid Developer, Web App developer, Tech enthusiast</p>
            </div>

            <div class="col-sm-4 about_us">
                <div class="about_frame">
            	<img src="<?php echo base_url() . "public/images/aboutDarel.jpg"?>" alt="a pic at Mission Peak"/>
	    </div>
            <br />
            <h5>Darel</h5>
            <p>Darel is a senior at San Francisco State University, completing his bachelor's degree in Computer Science.</p>
    	</div>
    </div>

    <br />

    <div class="row justify-content-center">
        <div class="col-sm-4 about_us">
            <div class="about_frame">
                <img src="<?php echo base_url() . "public/images/aboutScota.jpg"?>" alt="Shane Cota"/>
	    </div>
	    <br />
            <h5>Shane</h5>
            <p>Shane is a senior at San Francisco State University with an interest in network security, completing his bachelor's degree in Computer Science.</p>    
	</div>

        <div class="col-sm-4 about_us">
            <div class="about_frame">
                <img src="<?php echo base_url() . "public/images/aboutKevin.jpg"?>" alt="Kevin Chu"/>	
	    </div>
	    <br />
            <h5>Kevin</h5>
            <p>Kevin is an experienced GitHub user and back-end developer.</p>
	</div>

	<div class="col-sm-4 about_us">
            <div class="about_frame">
                <img src="<?php echo base_url() . "public/images/aboutMtom.png"?>" src="Mark Tompong"/>
	    </div>
            <br />
            <h5>Mark</h5>
            <p>Mark is a senior in Computer Science and front-end developer of SFSU Congre-Gator's Market.</p>
            </div>
        </div>

        <br /><br /><br />

    </div>

</div>
