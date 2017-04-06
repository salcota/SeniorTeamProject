<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<div class="container">

<!-- Subtitle Header For Registered Users to moved to its own view soon -->

<?php $username = 'Username'; ?>

<div class = "row justify-content-between pagetitle">
<div class="col-sm-6 subtitle" id="subheader">WELCOME, <?php echo $username; ?></div>

    <div class="col-sm-6" style="text-align: right; padding-top: 10px; padding-left: -5px">
	<a class="reguser-link" href="#">Notifications</a>
	<a class="reguser-link" href="#">&nbsp;&nbsp;Profile&nbsp;&nbsp</a>
	<a class="reguser-link" href="#">Listings</a>
    </div>

</div>


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
		    	<a href=<?php echo base_url() . 'Home/view/current_item' ?>"><?php echo '<img class="card-img-top" style="border: solid 2px #9C9; max-width: 95%; height:150px" src="data:image/jpg;base64,' . base64_encode($item->dp_thumbnail) . '" alt="Card image cap">' ?></a>
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
		<?php $numOfItems = 'x'; $totalItems = 'n'; echo "<h6 class='small text-muted'>Showing " . $numOfItems . ' of ' . $totalItems . ' items</h6>' ?>
    </div>

    <div class="col align-self-center">
	
	<?php $prev='prev'; $first='1'; $second='2'; $third='3'; $fourth='4'; $fifth='5'; $next='next'; ?>
	
	<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  	    <div class="btn-group btn-group-sm" role="group" aria-label="First group">
    	        <button type="button" class="btn btn-secondary"><?php echo $prev ?></button>
    		<button type="button" class="btn btn-secondary"><?php echo $first ?></button>
    		<button type="button" class="btn btn-secondary"><?php echo $second?></button>
    		<button type="button" class="btn btn-secondary"><?php echo $third ?></button>
		<button type="button" class="btn btn-secondary"><?php echo $fourth?></button>
		<button type="button" class="btn btn-secondary"><?php echo $fifth ?></button>
		<button type="button" class="btn btn-secondary"><?php echo $next ?></button>
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
