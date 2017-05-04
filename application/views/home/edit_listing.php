<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $logged = $this->session->loggedIn; ?>

<div class="container">

    <!-- Notifies user that he or she is logged in if condition is true -->
    <p>
        <?php
        if($this->session->flashdata('login_success')):
            echo "<div class='alert alert-success' role='alert'>" . $this->session->flashdata('login_success') . "</div>";
        endif;
        if($this->session->flashdata('edit_form_errors')):
            echo "<div class='alert alert-danger' role='alert'><strong>" . $this->session->flashdata('item_form_errors') . "</strong></div>";
        endif;
        ?>
    </p>

    <!-- Subtitle Header -->
    <div class="row">
        <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">Update this Listing</h1>
                <hr class= "my-4">
                <p class-"lead">Edit and update your current Listing</p>
            </div>
        </div>
    </div>

    <br/>

    <?php if(isset($error)) echo "<div class='alert alert-success' role='alert'>" . $error . "</div>";?>
    <?php $attributes = array('id' => 'itemlisting_form', 'class' => 'form_horizontal'); ?>
    <?php echo form_open('update_itemlisting', $attributes); ?>

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
                    'placeholder' => 'Name your item',
                    'value' => $item->title
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
                echo form_dropdown('category', $options, $item->category_id);
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
                    'placeholder' => '$00.00',
                    'value' => $item->price
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
                    'style' => 'resize: none; height: 100px',
                    'value' => $item->description
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
    <input type="hidden" name="listing" value="<?php echo $item->listing_id?>"/>
    <?php echo form_close(); ?>
    <hr>
    <!-- Displays the listing in a carousel -->
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card" style="margin: 10 auto 10 auto; padding: 5px">
                <p class="small" style="padding-left: 10px; text-align: center">
                    <img class="card-img-top card-style"  src="<?php echo base_url().'Images/listingPic/'.$item->listing_id; ?>" alt="Card image cap" accept="image/*" id="dp_item">
                    <br /><br />
                    <span class="card-title">Display picture of Item</span>
                </p>
                <br />
                <input class="form-control" type='file' name='dp' id="dp" onchange="readImageFile(this,'#dp_item')"/>
                <input type="hidden" name="h_dp_item" value="noch"/>
                <br/>
                <div class="row justify-content-center">
                    <div class="col-sm-10" style="text-align: right">
                        <input type="submit" class = "btn btn-success" name="Update"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card" style="margin: 10 auto 10 auto; padding: 5px">
                <p class="small" style="padding-left: 10px; text-align: center">
                    <img class="card-img-top card-style"  src="<?php if(!isset($itemPics[0])) {echo base_url().'public/images/images-1.jpeg';} else {echo base_url().'Images/itemPic/'.$itemPics[0]->item_pic_id;}?>" alt="Card image cap" accept="image/*" id="pic2">
                    <br /><br />
                    <span class="card-title">Pic 2</span>
                </p>
                <br />
                <input class="form-control" type='file' name='pic[]' onchange="readImageFile(this,'#pic2')"/>
                <input type="hidden" name="h_pic2" value="noch"/>
                <div class="row justify-content-center">
                    <div class="col-sm-10" style="text-align: right">
                        <a class="btn btn-danger btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" onclick="return confirm('Deleting this item listing will remove all its content from our system and it will not be visible to other users. Are you sure you want to delete?')" href="" >Remove</a>
                        <input type="submit" class = "btn btn-success" name="Update"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card" style="margin: 10 auto 10 auto; padding: 5px">
                <p class="small" style="padding-left: 10px; text-align: center">
                    <img class="card-img-top card-style"  src="<?php if(!isset($itemPics[1])) {echo base_url().'public/images/images-1.jpeg';} else {echo base_url().'Images/itemPic/'.$itemPics[1]->item_pic_id;}?>" alt="Card image cap" accept="image/*" id="pic3">
                    <br /><br />
                    <span class="card-title">Pic 3</span>
                </p>
                <br />
                <input class="form-control" type='file' name='pic[]' onchange="readImageFile(this,'#pic3')"/>
                <input type="hidden" name="h_pic3" value="noch"/>
                <div class="row justify-content-center">
                    <div class="col-sm-10" style="text-align: right">
                        <a class="btn btn-danger btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" onclick="return confirm('Deleting this item listing will remove all its content from our system and it will not be visible to other users. Are you sure you want to delete?')" href="" >Remove</a>
                        <input type="submit" class = "btn btn-success" name="Update"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card" style="margin: 10 auto 10 auto; padding: 5px">
                <p class="small" style="text-align: center">
                    <img class="card-img-top card-style"  src="<?php if(!isset($itemPics[2])) {echo base_url().'public/images/images-1.jpeg';} else {echo base_url().'Images/itemPic/'.$itemPics[2]->item_pic_id;}?>" alt="Card image cap" accept="image/*" id="pic4">
                    <br /><br />
                    <span class="card-title">Pic 4</span>
                </p>
                <br />
                <input class="form-control" type='file' name='pic[]' onchange="readImageFile(this,'#pic4')"/>
                <input type="hidden" name="h_pic4" value="noch"/>
                <div class="row justify-content-center">
                    <div class="col-sm-10" style="text-align: right">
                        <a class="btn btn-danger btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" onclick="return confirm('Deleting this item listing will remove all its content from our system and it will not be visible to other users. Are you sure you want to delete?')" href="" >Remove</a>
                        <input type="submit" class = "btn btn-success" name="Update"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card" style="margin: 10 auto 10 auto; padding: 5px">
                <p class="small" style="text-align: center">
                    <img class="card-img-top card-style"  src="<?php if(!isset($itemPics[3])) {echo base_url().'public/images/images-1.jpeg';} else {echo base_url().'Images/itemPic/'.$itemPics[3]->item_pic_id;}?>" alt="Card image cap" accept="image/*" id="pic5">

                    <br /><br />
                    <span class="card-title">Pic 5</span>
                </p>
                <br />
                <input class="form-control" type='file' name='pic[]' onchange="readImageFile(this,'#pic5')"/>
                <input type="hidden" name="h_pic5" value="noch"/>
                <div class="row justify-content-center">
                    <div class="col-sm-10" style="text-align: right">
                        <a class="btn btn-danger btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" onclick="return confirm('Deleting this item listing will remove all its content from our system and it will not be visible to other users. Are you sure you want to delete?')" href="" >Remove</a>
                        <input type="submit" class = "btn btn-success" name="Update"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card" style="margin: 10 auto 10 auto; padding: 5px">
                <p class="small" style="text-align: center">
                    <img class="card-img-top card-style"  src="<?php if(!isset($itemPics[4])) {echo base_url().'public/images/images-1.jpeg';} else {echo base_url().'Images/itemPic/'.$itemPics[4]->item_pic_id;}?>" alt="Card image cap" accept="image/*" id="pic6">
                    <br /><br />
                    <span class="card-title">Pic 6</span>
                </p>
                <br />
                <input class="form-control" type='file' name='pic[]' onchange="readImageFile(this,'#pic6')"/>
                <input type="hidden" name="h_pic6" value="noch"/>
                <div class="row justify-content-center">
                    <div class="col-sm-10" style="text-align: right">
                        <a class="btn btn-danger btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" onclick="return confirm('Deleting this item listing will remove all its content from our system and it will not be visible to other users. Are you sure you want to delete?')" href="" >Remove</a>
                        <input type="submit" class = "btn btn-success" name="Update"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br /><br /><br />

</div>
<script src="<?php echo base_url()."public/js/addItem.js"?>"></script>
