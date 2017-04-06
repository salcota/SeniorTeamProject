<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<?php $this->load->view('common/app_intro'); ?>



<div class="container" style="margin-top: -100px; padding:5px; background-color: #EEE">

<p class="bg-success" style="text-align: center">

<?php if($this->session->flashdata('login_success')): ?>

<?php echo $this->session->flashdata('login_success'); ?>

<?php endif; ?>

</p>



<p class="bg-danger" style="text-align: center">

<?php if($this->session->flashdata('login_failed')): ?>

<?php echo $this->session->flashdata('login_failed'); ?>

<?php endif; ?>

</p>



<!--<div class="container" style="margin-top: -150px; padding:5px; background-color: #EEE">-->

  <br />
  <p class="small text-muted" style="text-align: center">Most Recent Item Listings</p>



  <div class="row">
        <?php foreach ($itemList as $item): ?>
            
	    <div class="col-sm-3">
                
                <div class="card" style="margin: 10 auto 10 auto">
		    <p class="small" style="text-align: center">
			<span style="font-weight: 600; font-size:12pt"><?php echo $item->title; ?></span>
			<br />
			<?php echo "$".$item->price; ?>
			<br />
		    	<a href=#><?php echo '<img class="card-img-top" style="border: solid 2px #9C9; max-width: 95%; height:150px" src="data:image/jpg;base64,' . base64_encode($item->dp_thumbnail) . '" alt="Card image cap">' ?></a>
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
