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
  <p style="text-align: center; font-size:12px">Most Recent Item Listings</p>

  <div class="row">
        <?php foreach ($itemList as $item): ?>
            
	    <div class="col-sm-3">
                
                <div class="card" style="margin: 10 auto 10 auto">
		    <p style="font-size: 10pt; text-align: center">
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

</div>

  <?php $this->load->view('common/jquery_tether_bootstrap'); ?>

  </body>

</html>
