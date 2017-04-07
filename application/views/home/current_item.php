<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<!-- Hard coded PHP data for reference -->
<?php 
    $display_pic1 = "";
    $display_pic2 = "";
    $display_picN = "public/images/aboutKevin.jpg"; 
    $category_id = "Electronics";
    $price = "$25";
    $title = "Power Bank Charger";
    $posted_on = "04/20/17"; 
    $seller_id = "Bob Marley";
    $description = "An amazing adapter that will juice up your phone battery in no time. It comes with a USB cable to recharge at any computer or device with a USB port, so you can go anywhere with back up power to get those low batteries high once again and energized for your convenience.";
?>


   
<div class = "container">

    <div class="row pagetitle">
        <div class="col-sm-6 subtitle" id="subheader"><?php echo $title ?></div>
    </div>



    <div class="row justify-content-center">
        <div class="col-md-10">
            <br />
            <button class="btn btn-success">BACK</button>
            <br />
        </div>
    </div>



    <br />



    <div class="row justify-content-center">
	<div class="col-sm-4">
	    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		  <ol class="carousel-indicators">
    		    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    		    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  		</ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                      <img class="d-block img-fluid" id="image1" src="<?php echo base_url() . "public/images/aboutDarel.jpg"?>" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" id="image2" src="<?php echo base_url() . "public/images/aboutKevin.jpg"?>" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" id="image3" src="<?php echo base_url() . $display_picN ?>" alt="Third slide">
                    </div>
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

	<div class="col-md-6">
	    <?php echo
		"<table>".
		    "<tr> <th>Name:</th>	<td>"	.$title.	"</td> </tr>".
		    "<tr> <th>Category:</th>	<td>"	.$category_id.	"</td> </tr>".
		    "<tr> <th>Price:</th>	<td>"	.$price.	"</td> </tr>".
                    "<tr> <th>Date:</th>	<td>"	.$posted_on.	"</td> </tr>".
                    "<tr> <th>Seller:</th>	<td>"	.$seller_id.	"</td> </tr>".
		    "<tr> <td><button class='btn btn-success'>Add to Cart</button></td><td><button class='btn btn-success' style='width:115px' >Buy</button></td> </tr>".
		"</table>"
	    ?>
	</div>

    </div>



    <br />



    <div class="row justify-content-center">
	<div class="col-md-10">
	    <span style="font-weight: bold">Description:</span>
	    <div class="description_box">
	    	<?php echo $description?><br /><?php echo $description?>
	    </div>
	</div>
    </div>



    <br /><br /><br />


</div>

<?php $this->load->view('common/jquery_tether_bootstrap'); ?>
