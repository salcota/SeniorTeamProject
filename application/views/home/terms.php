<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 
          <div class="container">
              
              <div class = "row justify-content-center pagetitle">
                  <div class="col-6 subtitle" id="subheader">TERMS & SERVICES</div>

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
              <br /><br /><br />
              
              <div class="row-sm-12" style="text-align: justify">
		
             	<h5>1- Compliance & Liability:</h5>
		<p>All registered users understand they must comply with the SFSU Congre-Gators Market rules. Any issues raised that conflict with the agreement of our terms will be the sole responsibility of that user, and the company will not be held liable to any damages caused.</p>
		<h5>2- Misconduct:</h5>
		<p>The user shall agree not to post any offensive material such as inappropriate graphics or profane language on the item-listings page, profile page, and in any general message.
		<br><br />
		The user shall also agree to remain true to the decisions made to buy or sell a product once an agreement is made with another user. If for any reason a meet up for a business transaction is interrupted, the affected user must contact and inform the buyer or seller affiliated with the transaction of the situation in case of a need to reschedule the meet up.
		<br><br />
		Deviance from these rules can result in termination of the offender and other consequences punishable by law depending on the severity of the committed offense.
		</p>
		<h5>3- Privacy:</h5>
                <p>SFSU Congre-Gators Market likes to keep every user's privacy protected to the utmost level. The company does not work with third parties for any commercial or profit-based purposes and asks for the least amount of information to get its users started.
		<br><br />
		All information is kept confidential save for the user’s San Francisco State University email. This email shall be used by the company only in the event that the corresponding user has engaged in misconduct so that authorities can legally obtain more information on the suspect through the university.
		</p>
		
              </div>

	      <br />

	   </div>               

	  <?php $this->load->view('common/jquery_tether_bootstrap'); ?>
         
  </body>

</html>
