<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $logged = $this->session->loggedIn; ?>

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
                <h1 class="display-4"><?php echo $item[0]->title ?></h1>
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
			<a class="img-fluid" href="data:image/jpg;base64,<?php echo base64_encode($item[0]->display_pic) ?>" rel="lightbox" title="Image">
                        <img class="d-block img-fluid" id="image1"
                             src="data:image/jpg;base64,<?php echo base64_encode($item[0]->display_pic) ?>"
                             alt="First slide">
			</a>
		    </div>
                    <?php foreach ($itemPics as $item_pic): ?>
                        <div class="carousel-item">

			    <!-- Lightbox Testing - Need Help fixing PHP error: unidentified variable item_pic for carousel with a single item -->

			    <a class="img-fluid" href="data:image/jpg;base64,<?php echo base64_encode($item_pic->pic) ?>" rel="lightbox" title="Image">
                            <img class="d-block img-fluid" id="image2"
                                 src="data:image/jpg;base64,<?php echo base64_encode($item_pic->pic) ?>"
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
	        "<table>" .
	        "<tr> <th>Name:</th>	<td>"   . $item[0]->title . "</td> </tr>" .
	        "<tr> <th>Category:</th>	<td>"   . $item[0]->category_name . "</td> </tr>" .
	        "<tr> <th>Price:</th>	<td> $" . $item[0]->price . "</td> </tr>" .
	        "<tr> <th>Date:</th>	<td>"   . date_format(date_create($item[0]->posted_on),'d-m-Y') . "</td> </tr>" .
	        "<tr> <th>Seller:</th>	<td>"   . $item[0]->username . "</td> </tr>";

                if($logged)
	            echo "<tr><td><a class='btn btn-success' href='#' data-toggle='modal' data-target='#buyModal' style='cursor: pointer; width: 100%'>Buy</a></td></tr>";
		else
		    echo "<tr><td><a class='btn btn-success' data-toggle='popover' data-placement='right' data-content='You must be logged in to contact seller.' style='color: #fff; cursor: pointer; width: 100%'>Buy</a></td></tr>";

                echo "</table>";
            ?>
        </div>

    </div>

    <!-- Pops a modal to initiate the first message to the seller of the current item listing -->
    <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="postion: relative; top: 50%">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Send a notification to <?php echo $item[0]->username?> to buy <?php echo $item[0]->title?> </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        //echo form_open('Controller/function', $attributes);
                        $data = array(
                            'class'         => 'form-control',
                            'name'          => 'reportText',
                            'style'         => 'height: 100px; resize: none'
                        );
                        echo form_textarea($data);
                    ?>
                </div>

                <div class="modal-footer">
                    <span style="width: 100%">Date:&nbsp;&nbsp;&emsp;&emsp; <?php echo "March 10, 2017"; ?>
                    <br /><?php $location = 'Spot 1 - Quad'; echo 'Meet-up:<span>&emsp;</span>' . $location; ?></span>
                    <a class="btn btn-secondary btn-sm" href="<?php echo base_url() . 'Home/view/googlemaps_test'?>">View Map</a>
                    <button type="button" class="btn  btn-secondary btn-sm" style="cursor: pointer" data-dismiss="modal">Close</button>
                    <?php
                        $data = array(
                            'class'         => 'btn btn-success btn-sm',
                            'name'          => 'submit',
                            'value'         => 'Send'
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
            <span style="font-weight: bold">Description:</span>
            <div class="description_box">
                <?php echo $item[0]->description ?><br/>
            </div>
        </div>
    </div>

    <br/><br/><br/>

</div>
