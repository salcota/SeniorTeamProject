<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $logged = $this->session->loggedIn; ?>

<div class="container">

    <!-- Notifies user that he or she is logged in if condition is true -->
    <p>
        <?php
            if($this->session->flashdata('login_success')):
            echo "<div class='alert alert-success' role='alert'>" . $this->session->flashdata('login_success') . "</div>";
            endif;
        ?>
    </p>

    <!-- Subtitle Header -->
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">Post a New Listing</h1>
                <hr class= "my-4">
                <p class-"lead">Edit your new listing or update your current one</p>
            </div>
        </div>
    </div>

    <br/>

    <?php $attributes = array('id' => 'itemlisting_form', 'class' => 'form_horizontal'); ?>
    <?php echo form_open_multipart('post_itemlisting', $attributes); ?>

    <div class="row justify-content-center">
        <div class="col-sm-10">
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
                
                foreach ($categories as $category) {
                    $options[$category->category_id] = $category->category_name;
                }
                echo form_dropdown('category', $options, '1');
                ?>
            </div>
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
        </div>
    </div>

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

    <!-- Displays the listing in a carousel -->
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card" style="margin: 10 auto 10 auto; padding: 5px">
		<p class="small" style="padding-left: 10px; text-align: center">
                    <img class="card-img-top card-style"  src="<?php echo base_url().'public/images/images-1.jpeg'?>" alt="Card image cap" accept="image/*" id="dp_item">
		    <br /><br />
                    <span class="card-title">Display picture of Item</span>
		</p>
		<br />
                <input class="form-control" type='file' name='dp' id="dp" onchange="readImageFile(this,'#dp_item')"/>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card" style="margin: 10 auto 10 auto; padding: 5px">
                <p class="small" style="padding-left: 10px; text-align: center">
                    <img class="card-img-top card-style"  src="<?php echo base_url().'public/images/images-1.jpeg'?>" alt="Card image cap" accept="image/*" id="pic2">
		    <br /><br />
                    <span class="card-title">Pic 2</span>
		</p>
                <br />
                <input class="form-control" type='file' name='pic[]' onchange="readImageFile(this,'#pic2')"/>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card" style="margin: 10 auto 10 auto; padding: 5px">
                <p class="small" style="padding-left: 10px; text-align: center">
                    <img class="card-img-top card-style"  src="<?php echo base_url().'public/images/images-1.jpeg'?>" alt="Card image cap" accept="image/*" id="pic3">
		    <br /><br />
                    <span class="card-title">Pic 3</span>
		</p>
                <br />
                <input class="form-control" type='file' name='pic[]' onchange="readImageFile(this,'#pic3')"/>
            </div>
        </div>    
        <div class="col-lg-5">
            <div class="card" style="margin: 10 auto 10 auto; padding: 5px">
                <p class="small" style="text-align: center">
                    <img class="card-img-top card-style"  src="<?php echo base_url().'public/images/images-1.jpeg'?>" alt="Card image cap" accept="image/*" id="pic4">
		    <br /><br />
                    <span class="card-title">Pic 4</span>
  	        </p>
                <br />
                <input class="form-control" type='file' name='pic[]' onchange="readImageFile(this,'#pic4')"/>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card" style="margin: 10 auto 10 auto; padding: 5px">
                <p class="small" style="text-align: center">
                    <img class="card-img-top card-style"  src="<?php echo base_url().'public/images/images-1.jpeg'?>" alt="Card image cap" accept="image/*" id="pic5">
		    <br /><br />
                    <span class="card-title">Pic 5</span>
    		</p>
                <br />
                <input class="form-control" type='file' name='pic[]' onchange="readImageFile(this,'#pic5')"/>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card" style="margin: 10 auto 10 auto; padding: 5px">
                <p class="small" style="text-align: center">
                    <img class="card-img-top card-style"  src="<?php echo base_url().'public/images/images-1.jpeg'?>" alt="Card image cap" accept="image/*" id="pic6">
		    <br /><br />
                    <span class="card-title">Pic 6</span>
		</p>
                <br />
                <input class="form-control" type='file' name='pic[]' onchange="readImageFile(this,'#pic6')"/>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-10" style="text-align: right">
            <?php
            $data = array(
                'style' => 'width: 100px',
                'class' => 'btn btn-success',
                'name' => 'reset',
                'value' => 'Reset',
                'style' => 'cursor: pointer; margin-top: 10px; width: 100px'
            );
            echo form_reset($data);
            ?>
            &emsp;
            <?php
		if (!$logged)
		{
                    echo "<a class='btn btn-success' data-toggle='popover' data-placement='left' style='color: #fff; cursor: pointer; margin-top: 10px; width: 100px' title='Warning' data-content='You must be logged in to save a new or edited listing.'>Submit</a>"; 
		}
		else
		{
            	    $data = array(
                        'style' => 'width: 100px',
                    	'class' => 'btn btn-success',
                    	'name' => 'submit',
                    	'value' => 'Save',
                    	'style' => 'cursor: pointer; margin-top: 10px; width: 100px'
                    	);
                    echo form_submit($data);
		}
            ?>
        </div>
    </div>


    <?php form_close(); ?>

    <br /><br /><br />

</div>
<script src="<?php echo base_url()."public/js/addItem.js"?>"></script>
