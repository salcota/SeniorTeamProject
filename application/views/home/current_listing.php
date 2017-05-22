<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $logged = $this->session->loggedIn; ?>

<?php
if ($logged)
{
        echo <<<END
<script>
var buyCart = new LiveMessage($myInfo->user_id);
buyCart.select($item->seller_id, true, $item->listing_id);
</script>
END;
}
?>

<script>
function buyConfirm()
{
        var message = $("#buyText").val();

        if (message.length == 0)
        {
                $("#buyMessage").text("You must enter a message");
                $("#buyMessage").css("display", "block");
        }
        else
        {
                $("#buyMessage").css("display", "none");
                $("#buyModal").modal("hide");
        }

        $("#buyText").val("");
        
        buyCart.sendMessage(message);
}
</script>

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
                <h1 class="display-4"><?php echo htmlentities($item->title) ?></h1>
                <hr class= "my-4">
            </div>
        </div>
    </div>

    <br/><br /><br />

    <!-- Displays the item in a carousel -->
    <div class="row justify-content-center">
        <div class="col-lg-4" style="margin-bottom: 10px">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <?php $count = 0;
                    for ($i = 0; $i < count($itemPics);$i++){ ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo ($i+1); ?>"></li>
                        <?php } ?>
                </ol>
                <div class="carousel-inner" role="listbox">
                    

			<div class="carousel-item active">
			<a class="img-fluid" rel="lightbox" title="<?php echo htmlentities($item->title)?>" href="<?php echo base_url() . "Images/listingPic/" . $item->listing_id; ?>">
                        <img class="d-block img-fluid" id="image1"
                             src="<?php echo base_url() . "Images/listingThumb/" . $item->listing_id; ?>"
                             alt="First slide">
			</a>
		    </div>
                    <?php foreach ($itemPics as $item_pic): ?>
                        <div class="carousel-item">
		    	<a class="img-fluid" rel="lightbox" title="<?php echo htmlentities($item->title)?>" href="<?php echo base_url() . "Images/itemPic/" . $item_pic->item_pic_id; ?>">
                            <img class="d-block img-fluid" id="image2"
                                 src="<?php echo base_url() . "Images/itemThumb/" . $item_pic->item_pic_id; ?>"
                                 alt="Second slide">
			    </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span></a>
            </div>
        </div>

	<!-- Displays the table containing information on the current item listing -->
        <div class="col-md-6">
            <?php echo
	        "<table class='lightText'>" .
	        "<tr> <th>Name:</th>	<td>"   . htmlentities($item->title) . "</td> </tr>" .
	        "<tr> <th>Category:</th>	<td>"   . $item->category_name . "</td> </tr>" .
	        "<tr> <th>Price:</th>	<td> $" . $item->price . "</td> </tr>" .
	        "<tr> <th>Date:</th>	<td>"   . date_format(date_create($item->posted_on),'d-m-Y') . "</td> </tr>" .
	        "<tr> <th>Seller:</th>	<td>"   . $item->username . "</td> </tr>";

                if($logged)
	            echo "<tr><td><a class='btn btn-success' href='#' data-toggle='modal' data-target='#buyModal' style='cursor: pointer; width: 100%'>Buy</a></td></tr>";
		else
		    echo "<tr><td><a class='btn btn-success' data-toggle='popover' data-placement='right' data-content='You must be logged in to contact seller.' style='color: #fff; cursor: pointer; width: 100%'>Buy</a></td></tr>";

                echo "</table>";
            ?>
        </div>

    </div>

    <!-- Pops a modal to initiate the first message to the seller of the current item listing -->
    <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="postion: relative; top: 25%">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Send a notification to <?php echo $item->username?> to buy this <?php echo htmlentities($item->title)?> </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

               <div id='buyMessage' class='alert alert-danger' role='alert' style='display: none;'></div>

       <div class="modal-body">
	            <span class="small text-muted">(300 chars max)</span>
                    <?php
                        //echo form_open('Controller/function', $attributes);
                        $data = array(
                            'class'         => 'form-control',
                            'name'          => 'buyText',
                            'style'         => 'height: 100px; resize: none',
		            'id'            => 'buyText',
					'maxLength'     => '300'
                        );
                        echo form_textarea($data);
                    ?>
                </div>

                <div class="modal-footer">
                    <span style="width: 100%">Date:&nbsp;&nbsp;&emsp;&emsp; <?php
					$date = new DateTime($item->posted_on);
					$date = $date->format("M d, Y");
					echo $date;
					?>
                    <br /><?php $location = 'Spot 1 - Quad'; echo 'Meet-up:<span>&emsp;</span>' . $location; ?></span>
                    <a class="btn btn-secondary btn-sm" href="<?php echo base_url() . 'Home/view/googlemaps'?>">View Map</a>
                    <button type="button" class="btn  btn-secondary btn-sm" style="cursor: pointer" data-dismiss="modal">Close</button>
                    <?php
                        $data = array(
                            'class'         => 'btn btn-success btn-sm',
                            'name'          => 'submit',
                            'value'         => 'Send',
			    'onclick'	    => 'buyConfirm()'
                        );
                        echo form_submit($data);
                        echo form_close();
                    ?>
                </div>

                <div class="modal-footer" style="color: #AAA; text-align: justify">
                    Note: You may change the meet-up location, but you must both agree on another location from the provided selection.
                </div>

           </div>
        </div>
    </div>

    <br/>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <span class="lightText" style="font-weight: bold">Description:</span>
            <div class="description_box">
                <?php echo htmlentities($item->description) ?><br/>
            </div>
        </div>
    </div>

    <br /><br/><br/><br/>

</div>
