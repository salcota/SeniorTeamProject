<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">

    <!-- Notifies user that he or she is logged in if condition is true -->
    <p style="text-align: center">
        <?php
            if($this->session->flashdata('login_success')):
            echo "<div class='alert alert-success' role='alert'>" . $this->session->flashdata('login_success') . "</div>";
            endif;
            if($this->session->flashdata('delete_listing_error')):
            echo "<div class='alert alert-danger' role='alert'>" . $this->session->flashdata('delete_listing_error') . "</div>";
        endif;
        ?>
    </p>

    <!-- Subtitle Header -->
    <div class="row">
        <div class="col">
            <div class="jumbotron" style="background-color:#FFF; margin-top: 25px; text-align: center">
                <h1 class="display-4">Your Current Listings for Sale</h1>
                <hr class= "my-4">
                <p class="lead">View your current items posted for sale. You can edit or remove a current listing, or add a new listing.</p>
            </div>
        </div>
    </div>

    <br /><br /><br />

    <!-- Adds a new item listing -->
    <div class="row justify-content-center">
        <div class="col-sm-10" style="text-align: right">
            <a class="btn btn-success" href="<?php echo base_url() . 'add_item'?>" target="blank">ADD ITEM</a>
    	</div>
    </div>

    <br />

    <!-- Displays current list of item listings posted for sale (Hard Coded for now) -->
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
                <?php $cnt = 0; foreach ($items as $item): ?>
                <tr>
	            <td><?php echo ++$cnt?></td>
                    <td><?php echo $item->title ?></td>
                    <td><?php echo $item->category_name ?></td>
                    <td><?php echo "$".$item->price ?></td>
                    <td><?php echo date_format(date_create($item->posted_on),'d-m-Y')?></td>
                    <td>
		        <a class="btn btn-secondary btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" href="<?php echo base_url() . 'Itemlisting/view/add_itemlisting'?>" target="blank">Edit</a>
                        &emsp;
		        <a class="btn btn-danger btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" onclick="return confirm('Deleting this item listing will remove all its content from our system and it will not be visible to other users. Are you sure you want to delete?')" href="<?php echo base_url() . 'remove_listing/'.$item->listing_id?>" >Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
	    </table>
	</div>
    </div>

    <br /><br /><br />

</div>
