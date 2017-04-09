<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<div class="container">



    <!--<p class="bg-success" style="text-align: center">-->

        <?php //if($this->session->flashdata('login_success')): ?>

	<?php  
	    //echo $this->session->flashdata('login_success');
	    $username = 'Prateek';
	    $registered = false;
        
	    echo "<div class = 'row justify-content-center pagetitle'>" .
                      "<div class ='col-sm-6 subtitle' id='subheader'>HOME</div>
		
		      <div class = 'col-sm-6' style='text-align: right; padding-top: 10px; padding-left: -5px'>";
 
                           if ($registered)
                           {
                               $this->load->view('reguser/reguser_navbar');
                           }

	    echo "</div></div>";
	?>

	<?php //endif; ?>

    </p>



    <p class="bg-danger" style="text-align: center">

	<?php if($this->session->flashdata('login_failed')): ?>

	<?php echo $this->session->flashdata('login_failed'); ?>

	<?php endif; ?>

    </p>

    <?php
	if (!$registered)
    {
    	echo '<div class="row-sm-12">
            <div class="jumbotron" style="text-align: center; background-color: #FFF">

                <h1 class="display-4">SFSU Congre-Gators</h1>

                <hr class="my-4" >

                <p class="lead">
Welcome to SFSU Congre-Gators, where SFSU students can buy and sell a variety of different items relevant to their needs. Shop anything from books, furniture, laptops, and much more from other students just like you,  who know what its like to need that extra support to make it through college!
</p>

                <hr class="my-4" >

                <p>Want to know more? Search our options!</p>

            </div>

    </div>';

    }
    ?>


	
<!--<div class="container" style="margin-top: -150px; padding:5px; background-color: #EEE">-->

    <br />

    <div class="row justify-content-center">
        <p class="small text-muted" style="text-align: center">Most Recent Item Listings</p>
    </div>


    <div class="row">
        <?php foreach ($itemList as $item): ?>
            
	    <div class="col-sm-3">
                
                <div class="card" style="margin: 10 auto 10 auto">
		    <p class="small" style="text-align: center">
			<span style="font-weight: 600; font-size:12pt"><?php echo htmlentities($item->title); ?></span>
			<br />
			<?php echo "$".$item->price; ?>
			<br />
		    	<a target="_blank" href="<?php echo base_url().'listing/getitem/'.$item->listing_id ?>"><?php echo '<img class="card-img-top" style="border: solid 2px #9C9; max-width: 95%; height:150px" src="data:image/jpg;base64,' . base64_encode($item->dp_thumbnail) . '" alt="Card image cap">' ?></a>
			<br />
			<a href="#" style="text-decoration: none; color: #696">Add to Cart</a>
			<br />
    			<a href="#" style="text-decoration: none; color: #696">Buy</a>
		    </p>
		</div>
            
	    </div>

        <?php endforeach; ?>

    </div>


    <br />

    <div class="row">

        <div class="col align-self-start" style="padding-top: 5px">
		<?php
			echo "<h6 class='small text-muted'>Showing page " . $currentPage . ' of ' . $maxItems . ' items</h6>'
		?>
        </div>

        <div class="col align-self-center">
	
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
					echo '<button type="button" class="btn btn-secondary"><a href="' . base_url() . 'home?' . (jumpLink($currentPage - 1, $get)) . '">Previous</a></button>';
				
				
				for ($i = $lowestPage; $i <= $highestPage; $i++)
				{
					// If this button points to current page, don't make a link. Just make the number bold.
					if ($i == $currentPage)
						echo  '<button type="button" class="btn btn-secondary"><b>' . $i . '</b></button>';
					else // Create a clickable button.
						echo  '<button type="button" class="btn btn-secondary"><a href="' . base_url() . 'home?' . jumpLink($i, $get) . '">' . $i . '</a></button>';
				}
				
				if ($currentPage < $highestPage)
					echo '<button type="button" class="btn btn-secondary"><a href="' . base_url() . 'home?' . jumpLink($currentPage + 1, $get) . '">Next</a></button>';
			}
			?>
                </div>

            </div>

        </div>

        <div class="col align-self-end"></div>

    </div>

    <br />

</div>

    <?php $this->load->view('common/jquery_tether_bootstrap'); ?>

</body>

</html>

