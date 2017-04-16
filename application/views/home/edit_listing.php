<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container" style="margin-top: 100px">

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
            <div class="jumbotron" style="background-color:#FFF; margin-top: 25px; text-align: center">
                <h1 class="display-4">Edit Listing</h1>
                <hr class= "my-4">
		<p class="lead">Edit your new listing or update your current one.</p>
            </div>
        </div>
    </div>

    <br/><br /><br />

    <!-- Displays the listing in a carousel -->
    <div class="row justify-content-center">
        <div class="col-sm-4" style="margin-bottom: 25px">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img class="d-block img-fluid" id="image1" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" id="image2" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block img-fluid" id="image3" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    &nbsp;&nbsp;&nbsp;<span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
           </div>
        </div>

        <!-- Displays information on the current item -->
	<div class="col-sm-6">
	    <?php $attributes = array('id' => 'itemlisting_form', 'class' => 'form_horizontal'); ?>
	    <?php    echo form_open('home/view/item_listings', $attributes); ?>

	    <!-- Item Name -->
	    <div class="form-group input-group">
	    	<?php
		    echo '<span class="input-group-addon" style="width: 100px; text-align: left">Name</span>';
            	    $data = array(
               	        'class' => 'form-control',
                        'name' => 'name',
		        'type' => 'text',
		        'size' => '100',
                        'placeholder' => 'Name your item'
            	    );
            	    echo form_input($data);
                ?>
            </div>

	    <!-- Catagory type -->
	    <div class="form-group input-group">
                <?php
                    echo '<span class="input-group-addon" style="width: 100px; text-align: left">Category</span>'; 
                    $options = array(
                        '1' => 'Books',
		        '2' => 'Furniture',
		        '3' => 'Electronics',
		        '4' => 'Lab Equipment',
		        '5' => 'Clothing',
			'6' => 'Sports',
			'7' => 'Bathroom',
			'8' => 'Miscellaneous'
                    );
                    echo form_dropdown('name', $options, '1');
                ?>
	    </div>

	    <!-- Price -->
	    <div class="form-group input-group">
	        <?php
                    echo '<span class="input-group-addon" style="width: 100px; text-align: left">Price</span>';
                    $data = array(
                        'class' => 'form-control',
                        'name' => 'price',
		        'type' => 'text',
		        'size' => '100',
                        'placeholder' => '$00.00'
                    );
                    echo form_input($data);
                ?>
	    </div>

	    <!-- Photo(s) -->
            <div class="form-group input-group">
                <?php
                    echo '<span class="input-group-addon" style="width: 100px; text-align: left">Photo(s)</span>';
                    $data = array(
                        'class' => 'form-control',
                        'name' => 'photos',
                        'type' => 'file',
                        'size' => '100',
                    );
		    $value = "";
                    echo form_upload($data, $value);
                ?>
            </div>
	</div>
    </div>

    <!-- Description -->
    <div class="row justify-content-center">
	<div class="col-sm-10">
	    <div class="form-group">
		<?php
		    echo '<span>Description</span>';
		    $data = array(
			'class' => 'form-control',
			'name' => 'description',
			'type' => 'textarea',
			'maxlength' => '300',
			'style' => 'resize: none; height: 100px'
		    );
		    $value = "";
		    echo form_textarea($data, $value);
		?>
	    </div>
	</div>
    </div>

    <!-- Submit -->
    <div class="row justify-content-center">
	<div class="col-sm-10" style="text-align: right">
	    <?php
                $data = array(
                    'style' => 'width: 100px',
                    'class' => 'btn btn-success',
                    'name' => 'reset',
                    'value' => 'Reset',
		    'style' => 'width: 100px'
                );
                echo form_reset($data);
            ?>
	    &emsp;
	    <?php
        	$data = array(
                    'style' => 'width: 100px',
                    'class' => 'btn btn-success',
                    'name' => 'submit',
                    'value' => 'Save',
		    'style' => 'width: 100px'
        	);
            	echo form_submit($data);
	    ?>
	</div>
    </div>

    <?php form_close(); ?>

    <br /><br /><br />

</div>
