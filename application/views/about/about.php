<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">

    <div class = "row justify-content-center pagetitle">
	<div class ="col-sm-6 subtitle" id="subheader">ABOUT US...</div>


        <div class = "col-sm-6" style="text-align: right; padding-top: 10px; padding-left: -5px">

            <?php
                $registered = false;

            	if ($registered)
                {
                    $this->load->view('reguser/reguser_navbar');
                }
            ?>

        </div>

    </div>

    <br />

    <div class="row justify-content-center">

	<div class="col">
        <div class="jumbotron" style="background-image: url(<?php echo base_url() . 'public/images/Unknown.jpeg'?>">
              
            <h1 class="display-4" style="text-align: center">Welcome to the Staff!</h1>

	    <hr class="my-4">

	    <h5 style="text-align: center">CSC 648/848 - Software Engineering Class at SFSU</h5>

	    <hr class="my-4">

	    <p class="lead">
	        Spring 2017
		<br />
		Section 1
		<br />
		Team 4
	    </p>
  
       </div>
       </div>

    </div>

    <div class="row justify-content-center">

        <div class="col-sm-4 about_us">
	      <img src="http://www.ihsansdomain.com/IhsanTaha_ProfilePic.png" alt="Ihsan Taha"/>
	      <br />
              <h5>Ihsan</h5>
	      <p style="text-align: justify">I am a passionate programmer with a background in UI design and web development, but always open to learning new skills and adapting to new environments.</p>
        </div>

        <div class="col-sm-4 about_us">
              <img src="https://scontent.fsnc1-5.fna.fbcdn.net/v/t31.0-8/15369961_1339774136074974_8835888128227889161_o.jpg?oh=8bc8dd4ff06a96bae490810799859836&amp;oe=59042FB6" alt="Prateek Gupta"/>
              <br />
              <h5>Prateek</h5>
              <p style="text-align: justify">Master's Student Computer Science, Andorid Developer, Web App developer, Tech enthusiast</p>
        </div>

        <div class="col-sm-4 about_us">
              <img src="<?php echo base_url() . "public/images/aboutDarel.jpg"?>" alt="a pic at Mission Peak"/>
              <br />
              <h5>Darel</h5>
              <p style="text-align: justify">Darel is a senior at San Francisco State University, completing his bachelor's degree in Computer Science.</p>
        </div>

    </div>

</div>

</body>
</html>


