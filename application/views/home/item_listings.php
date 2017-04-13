<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container" style="margin-top: 100px">

    <!-- Subtitle Header -->
    <div class="row">
        <div class="col">
            <div class="jumbotron" style="background-color:#FFF; margin-top: 25px; text-align: center">
                <h1 class="display-4">Post an Item Listing</h1>
                <hr class= "my-4">
                <p class="lead">View your current items posted for sale. You can edit or remove a current listing, or add a new listing.</p>
            </div>
        </div>
    </div>

    <br /><br /><br />

    <!-- Adds a new item listing -->
    <div class="row justify-content-center">
        <div class="col-sm-10" style="text-align: right">
            <a class="btn btn-success" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">ADD ITEM</a>
    	</div>
    </div>

    <br />

    <!-- Displays current list of item listings posted for sale -->	
    <div class="row justify-content-center">
	<div class="col-sm-10">
	    <table class="table table-bordered table-hover table-info table-striped" style="border: solid 2px #ACF; font-size: 10pt">
                <tr>
		    <th>#</th>
                    <th>Item Name</th>
                    <th>Category</th>
                    <th>Price</th>
              	    <th>Date</th>
               	    <th>Update Listing</th>
      	        </tr>

                <tr>
	            <td>1</td>
                    <td>Table Lamp</td>
                    <td>Furniture</td>
                    <td>$10.00</td>
                    <td>Aug 8, 2016</td>
                    <td>
		        <a class="btn btn-secondary btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">Edit</a>
                        &emsp;
		        <a class="btn btn-danger btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">Remove</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Mac Book</td>
                    <td>Electronics</td>
                    <td>$1000.00</td>
                    <td>Sep 20, 2016</td>
                    <td> 
                        <a class="btn btn-secondary btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">Edit</a> 
                        &emsp; 
                        <a class="btn btn-danger btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">Remove</a> 
                    </td>                              
		</tr>
                <tr>
                    <td>3</td>
                    <td>Lamp</td>
                    <td>Furniture</td>
                    <td>$8.00</td>
                    <td>Aug 15, 2016</td>
                    <td> 
                        <a class="btn btn-secondary btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">Edit</a> 
                        &emsp; 
                        <a class="btn btn-danger btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">Remove</a> 
                    </td> 
                </tr>
	    </table>
	</div>
    </div>

    <br /><br /><br />

</div>
