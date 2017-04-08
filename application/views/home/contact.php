<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 
          <div class="container">
              
              <div class = "row justify-content-center pagetitle">
                  <div class ="col-sm-6 subtitle" id="subheader">CONTACT</div>
              

	      	  <div class = "col-sm-6" style="text-align: right; padding-top: 10px; padding-left: -5px">

		      <?php
                           $registered = true;

		           if ($registered)
			    {
		                $this->load->view('reguser/reguser_navbar'); 
		      	    }
		      ?>
			
	          </div>

              </div>
              
		<br />

              <div class="jumbotron" style="background-color:#FFF">
		<center>
             	<h1 class="display-4">Have any concerns? Contact Us!</h1>

		<hr class= "my-4">

		<p class="lead"> Whether it's for technical issues, suggestions, or general feedback, please don't hesitate to reach out to our staff.</p>
		</center>
              </div>
                          
              
              <div class="row justify-content-center">
                  <div class="col-sm-12">
                      <h5>Phone:&emsp;&emsp;(415)-265-3692</h5>
		      <h5>Email:&emsp;&emsp;&nbsp;&nbsp;<span style="color: #369">ihsan@mail.sfsu.edu</span></h5>
		      <h5>Location:&emsp;SFSU Congre-Gators Market, San Francisco, CA</h5>
                  </div>


              </div>
              
	      <br />
		
          </div>

	  <?php $this->load->view('common/jquery_tether_bootstrap'); ?>
         
  </body>

</html>
