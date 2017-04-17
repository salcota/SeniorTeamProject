<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    if (empty($categories))
        throw new Exception('Navbar needs categories-listing from controller');
?>

<body>    

    <div id='topheader'></div>

    <nav class='navbar navbar-toggleable-lg navbar-light fixed-top navbar' style="min-height: 85px">

        <button style="border: solid 1px #696; border-radius: 6px" class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'><i class="fa fa-bars" style="color: #EEE; font-size: 50px; height: 60px; padding-top: 5px; width: 60px" aria-hidden="true"></i></button>

        <!-- Left Side Menu: Logo & Home-->
        <a href='<?php echo base_url() . 'Home/view/home' ?>'><img style= "background-color: #FFF; border-radius: 6px; height: 70px; width: 70px"  src='<?php echo base_url() . 'public/images/logo.png'?>'></a>

        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item active'>
                    <a class="nav-link fix-align align-pt-16" style='width: 310px' href='<?php echo base_url() . 'Home/view/home' ?>'>Home</a>
                </li>
            </ul>

            <!-- Centered Category Search & Input Search -->
            <form class='form-inline mr-auto fix-align' style='padding-top: 4px' action="<?php echo base_url() . "home" ?>" id="searchSubmit" method=GET>
                <label class='sr-only' for='inlineFormInputGroup'>Search</label>
                    <div class='input-group mb-2 mr-sm-2 mb-sm-0'>
                        <div class='form-group'>
                            <select class='custom-select mb-2 mr-sm-2 mb-sm-0' id='categories' name='category' onchange='document.forms["searchSubmit"].submit()'>
                            <option value="">All</option>
                            <?php
                                // Populates category list
                                foreach ($categories as $category) {
                                    // If user chose category, mark that option as selected
                                    $selector = "";
                                    if ($currentCategory == $category->category_id)
                                        $selector = " selected=\"selected\"";

                                    // Adds category option to list
                                    print "<option value=$category->category_id$selector>$category->category_name</option>\r\n";
                                }
                            ?>
                        </select>
                    </div>
                    <input style='height: 40px' type='search' class='form-control' id='inlineFormInputGroup' placeholder='Search ...'
                       name='search' value="<?php echo $searchTerms ?>">
                    <input type='hidden' name='sort' id='sort'>
                    <button class='btn btn-success' style='height: 40px' type='submit'><i class='fa fa-search' aria-hidden='true'></i></button>
                </div>
            </form>

            <!-- Right Side Menu: Cart, Sell, Sign Up, and Login -->            
	    <ul class='navbar-nav'>
                <li class='nav-item'>
                    <a class='nav-link fix-align align-pt-16' href='<?php echo  base_url() . 'Home/view/edit_listing' ?>'>Sell</a>
                </li>
		<li class='nav-item'>
                    <a class='nav-link fix-align align-pt-16' href='<?php echo  base_url() . 'Home/view/item_listings' ?>'>Listings</a>
                </li>
		<li class='nav-item'>
                   <a class='nav-link fix-align align-pt-16' href='<?php echo  base_url() . 'Home/view/notifications' ?>'>Notifications</a>
                </li>
                <li class='nav-item'>
                    <div class="btn-group">
                        <a id='logout' class='nav-link fix-align align-pt-16' data-toggle='dropdown' aria-haspopup='true'
                                aria-expanded='false' href="#"><?php $username = 'My Account'; echo $username;?>&nbsp;<i class='fa fa-caret-down' aria-hidden='true'></i></a>
                        <div class='dropdown-menu move' aria-labelledby='logout'>
			    <a class='dropdown-item' href='<?php echo  base_url() . 'Profile/me' ?>'>Profile</a>
                            <a class='dropdown-item' href="#" style="text-decoration: none" data-toggle='modal' data-target='#reportModal'>Report</a>
  	                    <a class='dropdown-item' href='<?php echo  base_url() . 'Logout' ?>'>Logout</a>		
                        </div>
                    </div>
                </li>
            </ul>

        </div>

    </nav>

    <!-- Pops a modal to initiate the first message to the seller of the current item listing-->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="border-radius: 6px; postion: relative; top: 25%">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h6 class="modal-title" id="exampleModalLabel" style="color: #FFF">Report Misconduct to Admin</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
		    <?php
			//echo form_open('Controller/function', $attributes);
		        $data = array(
                    	    'class' 	    => 'form-control',
                    	    'name' 	    => 'reportText',
                    	    'placeholder'   => 'Report misconduct here',
			    'style'	    => 'height: 100px; resize: none'
                	);
                	echo form_textarea($data);
               	    ?>        
		    <?php
			$data = array(
        		    'name' 	    => 'newsletter',
        		    'id'            => 'newsletter',
        		    'value'         => 'accept',
        		    'checked'       => TRUE,
        		    'style'         => 'margin:10px'
		    	);
			echo form_checkbox($data, 'value');
			echo 'I agree the following claim is true';
		    ?>		    
		</div>

		<div class="modal-footer">
                   <h6 style="width: 100%">Date: </h6>
                   <button type="button" class="btn  btn-secondary btn-sm" data-dismiss="modal">Close</button>
		   <?php
			$data = array(
			    'class'	    => 'btn btn-danger btn-sm',
			    'name'	    => 'submit',
			    'value'	    => 'Send'
			);
			echo form_submit($data);
			echo form_close();
		    ?>
                </div>

            </div>
        </div>
    </div>
