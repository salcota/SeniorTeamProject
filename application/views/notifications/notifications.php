<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
<?php
echo <<<END
var messenger = new LiveMessage($userID);
var myName = "$username";
END;
?>

var otherName = "";

function showBuyers(list)
{
	var buyBox = "";
	for (var i = 0; i < list.length; i++)
	{
		buyBox += '<li onclick="messenger.select(' + list[i][1] + ', false);otherName=\'' + list[i][0] + '\';refreshMessages();">' + list[i][0] + "</li>";
	}
	$("#buyers ul").html(buyBox);
}

function showSellers(list)
{
	var sellBox = "";
	for (var i = 0; i < list.length; i++)
	{
		sellBox += '<li onclick="messenger.select(' + list[i][1] + ', true);otherName=\'' + list[i][0] + '\';refreshMessages();">' + list[i][0] + "</li>";
	}
	$("#sellers ul").html(sellBox);
}

function refreshMessages()
{
	messenger.getMessages(showMessages);
}

function showMessages(data)
{
	var messageBox = "";
	for (var i = 0; i < data.length; i++)
	{
		if (data[i][0] == messenger.myID)
			messageBox += myName + ": ";
		else
			messageBox += otherName + ": ";
		
		messageBox += data[i][1] + "\r\n";
	}
	$("#messageThread").val(messageBox);
}

function sendMessage()
{
	messenger.sendMessage($("#sendText").val(), refreshMessages);
	$("#sendText").val("");
}

$(document).ready(function()
	{
	messenger.getBuyers(showBuyers);
	messenger.getSellers(showSellers);
	
	setInterval(refreshMessages, 1000);
	});
</script>

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

	    <div class="small" id="buyers" style="color: #C93; height: 40%; overflow-y: auto">
	        <ul style="list-style-type: none; cursor: pointer"></ul>
	    </div>

	    <hr />
	    
            <div class="small" id="sellers" style="color: #39C; height: 40%; overflow-y: auto">
                <ul style="list-style-type: none; cursor: pointer"></ul>
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
				<a class="btn btn-secondary btn-sm" style="float: right; margin: 10 0 10 0; width: 75px" href="<?php echo base_url() . 'Profile/user'?>">Profile</a>
    			        <label for="messageThread" style="color: #39C; margin-top: 10px; padding-top: 10px"><?php echo $username;?></label>

				<!-- Message Thread Text goes here and is read-only -->
    			        <textarea readonly class="form-control" id="messageThread" rows="3" style="resize: none; min-height: 150px; height: 35%"></textarea>
		
				<br />
				<span class="small text-muted">Send a new message</span>

				<!-- New messages can be inserted here to update the message thread box above -->
				<textarea class="form-control" id="sendText" rows="1" style="resize: none; min-height: 25px"></textarea>
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

			    <button type="button" class="btn btn-success btn-sm" style="float: right; margin-bottom: 10px; width: 75px" onclick="sendMessage()">Send</button>
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
