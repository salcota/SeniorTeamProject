<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $logged = $this->session->loggedIn; ?>

<div class="container">

    <!-- Notifies user that he or she is logged in if condition is true -->
    <p>
        <?php
            if($this->session->flashdata('login_success')):
            echo "<div class='alert alert-success' role='alert'>" . $this->session->flashdata('login_success') . "</div>"; 
            endif;
       
	    // Loads invalid search failure
	    if($this->session->flashdata('bad_search')):
            echo "<div class='alert alert-danger' role='alert'><strong>" . $this->session->flashdata('bad_search') . "</strong></div>";
            endif;
	?>

    </p>

    <!-- Subtitle Header -->
    <div class="row">
	<div class="col">
            <div class="jumbotron">
                <h1 class="display-4">SFSU Congre-Gators</h1>
                <hr class="my-4" >
                <p class="lead">
Welcome to SFSU Congre-Gators, where SFSU students can buy and sell a variety of different items relevant to their needs. Shop anything from books, furniture, laptops, and much more from other students just like you,  who know what it's like to need that extra support to make it through college!
</p>
	        <hr /class="my-4">
                <p class="lead">Want to know more? Use our search and/or category filter to view our options!</p>
	    </div>
	</div>
    </div>

    <br /><br />

    <hr />
    <div class="row justify-content-center">

	<hr />

	<!-- Shows current number of item listings from total number of avilable item listings"-->
	<div class="col" style="padding-top: 20px">
            <?php echo "<h6 class='text-muted'>Showing page " . $currentPage . ' of ' . $maxItems . ' items</h6>'?>
        </div>

        <div class="col" style="padding-top: 20px; text-align: center">
            <h6 class="text-muted" style="text-align: center">Most Recent <?php echo $currentCategory?> Listings</h6>
    	</div>

	<!-- Allows sorting by price, name, and date -->
	<div class="col" style="text-align: right">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <div class="btn-group">
                        <a id="sortable" class="nav-link" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false" href="#"><button class="btn btn-success" style="cursor: pointer">Sort&nbsp;<i class='fa fa-caret-down' aria-hidden='true'></i></button></a>
                        <div class="dropdown-menu move" aria-labelledby="sortable">
                            <a class="dropdown-item" href="#" onclick="$('#sort').val('price');document.forms['searchSubmit'].submit()">Price</a>
                            <a class="dropdown-item" href="#" onclick="$('#sort').val('title');document.forms['searchSubmit'].submit()">Name</a>
                            <a class="dropdown-item" href="#" onclick="$('#sort').val('posted_on');document.forms['searchSubmit'].submit()">Date</a>
                        </div>
                    </div>
                </li>
            </ul>
	</div>
    </div>

    <!-- Displays item listings based on number of successful search results -->
    <div class="row">
        <?php foreach ($itemList as $item): ?>            
	    <div class="col-lg-3">
                <div class="card" style="margin: 10 auto 10 auto">
		    <p class="small" style="text-align: center">
			<span class="card_title"><?php echo htmlentities($item->title); ?></span>
			<?php echo "$".$item->price; ?>
			<br />
		    	<a target="_blank" href="<?php echo base_url().'listing/getitem/'.$item->listing_id ?>"><?php echo '<img class="card-img-top card-style" src="' . (base_url() . 'Images/listingThumb/' . $item->listing_id) . '" alt="Card image cap">' ?></a>
			<br /><br />
			<?php 
			    if($logged)
			        echo "<a class='btn btn-success btn-sm' href='#' data-toggle='modal' data-target='#buyModal'>Buy</a>";
			    else
				echo "<a class='btn btn-success btn-sm' data-toggle='popover' data-placement='top' data-content='You must be logged in to contact seller.' style='color: #fff; cursor: pointer'>Buy</a>";
			?>
		    </p>
		</div>
	    </div>
        <?php endforeach; ?>
    </div>

    <br />

    <!-- Displays pagination buttons to navigate through all item listings -->
    <div class="row justify-content-center">
        <div class="d-flex align-self-center" style="text-align: center">
	    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  	        <div class="btn-group btn-group-sm" role="group" aria-label="First group">
		    <?php
			// Function for creating GET parameters in link
		        function jumpLink($page, $getData)
			{
			    $getParam = $getData;
				
			    // Set the page we want.
			    if (is_numeric($page))
			        $getParam['page'] = $page;
				
				return buildLink($getParam);
			}
			
			function buildLink($getData)
			{
			    $getKeys = array_keys($getData);
			    $url = "";
			    //Concatenate every key in the array
			    foreach($getKeys as $key)
			    {
				$url = $url . $key . "=" . urlencode($getData[$key]) . "&";
			    }
				
			    return $url;
			}
			
			if ($lowestPage != $highestPage)
			{
			    if ($currentPage > $lowestPage)
				echo '<a class="btn btn-secondary" href="' . base_url() . 'home?' . (jumpLink($currentPage - 1, $get)) . '">Previous</a>';
				
				
			    for ($i = $lowestPage; $i <= $highestPage; $i++)
			    {
				// If this button points to current page, don't make a link. Just make the number bold.
				if ($i == $currentPage)
			            echo  '<a class="btn btn-secondary"><b>' . $i . '</b></a>';
				else // Creates a clickable button.
				    echo  '<a class="btn btn-secondary" href="' . base_url() . 'home?' . jumpLink($i, $get) . '">' . $i . '</a>';
			    }
				
			    if ($currentPage < $highestPage)
				echo '<a class="btn btn-secondary" href="' . base_url() . 'home?' . jumpLink($currentPage + 1, $get) . '">Next</a>';
			}
		    ?>
                </div>
            </div>
        </div>
    </div>

    <br />

    <hr />

    <!-- Pops a modal to initiate the first message to the seller of the current item listing -->
    <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="postion: relative; top: 25%">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
		 <h6 class="modal-title" id="exampleModalLabel">Send a notification to buy this item</h6>
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
			    'style'	    => 'cursor: pointer',
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

    <br /><br /><br />

</div>
