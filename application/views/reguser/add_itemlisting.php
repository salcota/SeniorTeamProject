<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container" style="margin-top: 100px">

    <!-- Subtitle Header -->
    <div class="row">
        <div class="col">
            <div class="jumbotron" style="background-color:#FFF; margin-top: 25px; text-align: center">
                <h1 class="display-4">Current Listing</h1>
                <hr class= "my-4">
                <p class-"lead">Edit your new listing or update your current one</p>
            </div>
        </div>
    </div>

    <br/><br /><br />

    <!-- Displays the listing in a carousel -->
    <div class="row justify-content-center">
        <div class="col-xs-6 col-sm-4 col-lg-6">
            <div class="card">
                <img class="card-img-top img-responsive" src="<?php echo base_url().'public/images/images-1.jpeg'?>" alt="Card image cap" id="dp_item">
                <div class="card-block">
                    <h4 class="card-title">Display picture of Item</h4>
                    <input type='file' id="dp" onchange="readImageFile(this,'#dp_item')"/>
<!--                    <a href="#" class="btn btn-primary">Go somewhere</a>-->
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-lg-3">
            <div class="card" >
                <img class="card-img-top img-responsive" src="<?php echo base_url().'public/images/images-1.jpeg'?>" alt="Card image cap" id="pic2">
                <div class="card-block">
                    <h4 class="card-title">Pic 2</h4>
                    <input type='file' name="pic2" id="pic2" onchange="readImageFile(this,'#pic2')"/>
                    <!--                    <a href="#" class="btn btn-primary">Go somewhere</a>-->
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-lg-6">
            <div class="card" >
                <img class="card-img-top img-responsive" src="<?php echo base_url().'public/images/images-1.jpeg'?>" alt="Card image cap" id="pic3">
                <div class="card-block">
                    <h4 class="card-title">Pic 3</h4>
                    <input type='file' name="pic3" id="pic3" onchange="readImageFile(this,'#pic3')"/>
                    <!--                    <a href="#" class="btn btn-primary">Go somewhere</a>-->
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-lg-3">
            <div class="card" >
                <img class="card-img-top img-responsive" src="<?php echo base_url().'public/images/images-1.jpeg'?>" alt="Card image cap" id="pic4">
                <div class="card-block">
                    <h4 class="card-title">Pic 4</h4>
                    <input type='file' name="pic4" id="pic4" onchange="readImageFile(this,'#pic4')"/>
                    <!--                    <a href="#" class="btn btn-primary">Go somewhere</a>-->
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-lg-6">
            <div class="card" >
                <img class="card-img-top img-responsive" src="<?php echo base_url().'public/images/images-1.jpeg'?>" alt="Card image cap" id="pic5">
                <div class="card-block">
                    <h4 class="card-title">Pic 5</h4>
                    <input type='file' name="pic5" id="pic5" onchange="readImageFile(this,'#pic5')"/>
                    <!--                    <a href="#" class="btn btn-primary">Go somewhere</a>-->
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-lg-3">
            <div class="card" >
                <img class="card-img-top img-responsive" src="<?php echo base_url().'public/images/images-1.jpeg'?>" alt="Card image cap" id="pic6">
                <div class="card-block">
                    <h4 class="card-title">Pic 6</h4>
                    <input type='file' name="pic6" id="pic6" onchange="readImageFile(this,'#pic6')"/>
                    <!--                    <a href="#" class="btn btn-primary">Go somewhere</a>-->
                </div>
            </div>
        </div>

        <div class="col-sm-10">
            <?php $attributes = array('id' => 'itemlisting_form', 'class' => 'form_horizontal'); ?>
            <?php    echo form_open('home/view/item_listings', $attributes); ?>
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
        </div>

    </div>
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="form-group">
                <?php
                echo '<span>Description</span>';
                //
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
