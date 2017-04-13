<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container" style="margin-top: 100px">

    <!-- Subtitle Header -->
    <div class="row">
        <div class="col">
            <div class="jumbotron" style="background-color:#FFF; margin-top: 25px; text-align: center">
                <h1 class="display-4"><?php echo $item[0]->title ?></h1>
                <hr class= "my-4">
            </div>
        </div>
    </div>

    <br/><br /><br />

    <!-- Displays the item in a carousel -->
    <div class="row justify-content-center">
        <div class="col-sm-4" style="margin-bottom: 25px">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <?php $count = 0;
                    foreach ($itemPics as $item_pic): ?>
                    <li data-target="#carouselExampleIndicators" data-slide-to=<?php ++$count; ?></li>
                        <?php endforeach; ?>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" id="image1"
                             src="data:image/jpg;base64,<?php echo base64_encode($item[0]->display_pic) ?>"
                             alt="First slide">
                    </div>
                    <?php foreach ($itemPics as $item_pic): ?>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" id="image2"
                                 src="data:image/jpg;base64,<?php echo base64_encode($item_pic->pic) ?>"
                                 alt="Second slide">
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

	<!-- Displays the table containing information on the current item listing -->
        <div class="col-md-6">
            <?php echo
                "<table>" .
                "<tr> <th>Name:</th>	<td>" . $item[0]->title . "</td> </tr>" .
                "<tr> <th>Category:</th>	<td>" . $item[0]->category_name . "</td> </tr>" .
                "<tr> <th>Price:</th>	<td> $" . $item[0]->price . "</td> </tr>" .
                "<tr> <th>Date:</th>	<td>" .date_format(date_create($item[0]->posted_on),'d-m-Y') . "</td> </tr>" .
                "<tr> <th>Seller:</th>	<td>" . $item[0]->username . "</td> </tr>" .
                "<tr> <td><button class='btn btn-success'>Add to Cart</button></td>" .
		"<td><button class='btn btn-success' style='width:115px' data-toggle='modal' data-target='#myModal'>Buy</button></td> </tr>" .
                "</table>"
            ?>
        </div>

    </div>

    <!-- Pops a modal to initiate the first message to the seller of the current item listing-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="postion: relative; top: 50%">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Send a notification to <?php echo $item[0]->username?> to buy <?php echo $item[0]->title?> </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
		   <h6 style="width: 100%">Date: </h6>
                   <button type="button" class="btn  btn-secondary btn-sm" data-dismiss="modal">Close</button>
                   <button type="button" class="btn  btn-success btn-sm">Send</button>
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
