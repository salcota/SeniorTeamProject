<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">

    <div class="row pagetitle">
        <div class="col-sm-10 subtitle" id="subheader">EDIT ITEM LISTING</div>
    </div>


    <br/><br /><br />


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

	<div class="col-sm-6">

	    <?php $attributes = array('id' => 'itemlisting_form', 'class' => 'form_horizontal'); ?>

	    <?php    echo form_open('home/view/itemlistings', $attributes); ?>
 
	    <div class="form-group input-group">

	    <?php
		echo '<span class="input-group-addon" style="width: 100px; text-align: left">Name</span>';
            	//
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
	    <div class="form-group input-group">
            <?php
                echo '<span class="input-group-addon" style="width: 100px; text-align: left">Category</span>';
                // 
                $options = array(
                    'class' => 'form-control',
		    'name' => 'category',
		    'size' => '110',
                    '1' => 'Accounting',
		    '2' => 'Broadcast & Electronic Arts&nbsp;&nbsp;',
		    '3' => 'Computer Science',
		    '4' => 'Electric Engineering',
		    '5' => 'Math',
                );
                echo form_dropdown('name', $options, '1');
            ?>
	    </div>
	    <div class="form-group input-group">
	    <?php
                echo '<span class="input-group-addon" style="width: 100px; text-align: left">Price</span>';
                // 
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

            <div class="form-group input-group">
            <?php
                echo '<span class="input-group-addon" style="width: 100px; text-align: left">Photo(s)</span>';
                // 
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
	    

	    <?php form_close(); ?>

	    

        </div>
	</div>

	<br /><br /><br />

    </div>

</div>
