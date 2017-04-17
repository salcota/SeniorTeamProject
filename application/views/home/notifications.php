<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">

    <!-- For UI consistency wehere a p tag exists to greet user if logged in -->
    <p></p>

    <!-- Subtitle Header -->
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">Notifications</h1>
                <hr class= "my-4">
                <p class="lead">Communicate with sellers and buyers you've developed a connection with. Whether you've initiated contact to purchase a product, or you've received a notification to make a sale, all messaging is done here. For clarity, <span style="color: #C93; font-weight: bold">buyers</span> are color-coded in gold and <span style="color: #39C; font-weight: bold">sellers</span> are in the blue.
		<br /><br />
		Once you make an agreement, choose a meetup location and proceed with the transaction when both parties confirm.</p>
	    </div>
        </div>
    </div>

    <br /><br /><br />

    <div class="row justify-content-center">

	<div class="col-lg-2" style="background-color: #FFF; border: solid 2px #363; border-radius: 6px; color: #696; margin: 10px; padding: 5px">
	
	    <h5 style="margin-top: 10px; text-align: center">USER LIST</h5>

       	    <hr />

	    <div class="small" id="buyers" style="color: #C93">
	        <ul style="list-style-type: none">
	    	    <li>JackTheWrapper</li>
	    	    <li>Kevin</li>
	    	    <li>Moonshine</li>
	    	    <li>Petkovic</li>
	    	    <li>pGupta2</li>
		    <li>theDemoCrate</li>
	        </ul>
	    </div>

	    <hr />
	    
            <div class="small" id="sellers" style="color: #39C">
                <ul style="list-style-type: none">
                    <li>Darel_OG</li>
                    <li>Kunal</li>
                    <li>pGupta2</li>
                    <li>Rodrigo</li>
                    <li>Sarah333</li>
                    <li>ToroZoro</li>
                </ul>
            </div>

	</div>

	<div class="col-lg-8" style="background-color: #222; border: solid 2px #696; border-radius: 6px;  margin: 10px; padding: 5px">

	    <h5 style="color: #696; margin-top: 10px; text-align: center">MESSAGES</h5>

            <hr style="background-color: #DDD">

	    <div class="container" style="background-color: #222">

		<div class="row justify-content-center">
		    <div class="col" style="background-color: #FFF; border: solid 2px #363; border-radius: 6px">
			<form>
		            <div class="form-group">
				<a class="btn btn-secondary btn-sm" style="float: right; margin: 10 0 10 0; width: 75px" href="<?php echo base_url() . 'Home/view/users_profile'?>">Profile</a>
    			        <label for="messageThread" style="color: #39C; margin-top: 10px; padding-top: 10px">Kunal</label>
    			        <textarea class="form-control" id="messageThread" rows="3" style="resize: none; min-height: 150px; height: 40%"></textarea>
  			    </div>
			    <h6 class="small" style="padding-top: 10px">Date:</h6>
			    <hr />

			<?php $attributes = array('id' => 'meetup_form', 'class' => 'form_horizontal'); ?>
	                <?php    echo form_open('home/view/notifications', $attributes); ?>

                        <div class="form-group input-group" style="float: left">
                            <?php
                                echo '<span class="input-group-addon">Meet Up</span>';
                                    // 
                                    $options = array(
                                    '1' => 'Quad',
                                    '2' => 'Bee Garden',
                                );
                                echo form_dropdown('name', $options, '1');
                            ?>
                        </div>

                            <button type="submit" class="btn btn-danger btn-sm" style="float: left; margin-bottom: 10px; width: 75px">Decline</button>

			    <button type="submit" class="btn btn-success btn-sm" style="float: right; margin-bottom: 10px; width: 75px">Send</button>
			    <br />
			</form>
		    </div>
		</div>

		<br />  

		<div class="row justify-content-center">
		    <div class="col-sm-12">
		    	<a class="btn btn-success btn-sm" style="float: left; margin-left: -15px; width: 150px" href="<?php echo base_url() . 'Home/view/googlemaps_test'?>">View Map</a>	
		        <!--<button type="submit" class="btn btn-success btn-sm" style="float: right; margin-right: -15px; width: 150px"  href="#">Confirm Transaction</button>-->

		        <?php
                            $data = array(
                            	'class' => 'btn btn-success btn-sm',
                            	'name' => 'submit',
                       	    	'value' => 'Confirm Transaction',
                    	    	'style' => 'float: right; margin-right: -15px; width: 150px'
                	);
                	    echo form_submit($data);
            		?>
			<?php echo form_close(); ?>
		    </div>
	        </div>

	    </div>

	    <br />

        </div>
    </div>

    <br /><br /><br />

</div>
