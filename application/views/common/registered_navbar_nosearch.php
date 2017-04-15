<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    if (empty($categories))
        throw new Exception('Navbar needs categories-listing from controller');
?>

<body>    

    <div id='topheader'></div>

    <nav class='navbar navbar-toggleable-lg navbar-light fixed-top navbar' style="min-height: 85px">

        <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>

        <!-- Left Side Menu: Logo & Home-->
        <a class='navbar-brand'>LOGO</a>

        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item active'>
                    <a class='nav-link fix-align' style='width: 310px' href='<?php echo base_url() . 'Home/view/home' ?>'>Home</a>
                </li>
            </ul>

            <!-- Right Side Menu: Cart, Sell, Sign Up, and Login -->            
	    <ul class='navbar-nav'>
                <li class='nav-item'>
                    <a class='nav-link fix-align' href='#'><i class='fa fa-shopping-cart' aria-hidden='true' style='padding-top: 4px'></i></a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link fix-align' href='<?php echo  base_url() . 'Home/view/add_item' ?>'>Sell</a>
                </li>
		<li class='nav-item'>
                    <a class='nav-link fix-align' href='<?php echo  base_url() . 'user_listings' ?>'>Listings</a>
                </li>
		<li class='nav-item'>
                    <a class='nav-link fix-align' href='<?php echo  base_url() . 'Home/view/notifications' ?>'>Notifications</a>
                </li>
                <li class='nav-item'>
                    <div class="btn-group">
                        <a id="logout" class="nav-link fix-align" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" href="#"><?php $username = 'My Account'; echo $username;?>&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                        <div class="dropdown-menu move" aria-labelledby="logout">
			    <a class="dropdown-item" href='#'>Profile</a>
                            <a class="dropdown-item" href="#" style="text-decoration: none" data-toggle='modal' data-target='#reportModal'>Report</a>
  	                    <a class="dropdown-item" href='<?php echo  base_url() . 'Home/view/home' ?>'>Logout</a>		
                        </div>
                    </div>
                </li>
            </ul>

        </div>

    </nav>

    <!-- Pops a modal to initiate the first message to the seller of the current item listing-->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="postion: relative; top: 50%">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h6 class="modal-title" id="exampleModalLabel" style="color: #FFF">Report Misconduct to Admin</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Lorem Ipsum has been bluffing one time too many on proceeding with transcations we agree upon days before the meet up day.</p>
                    <hr />
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1"> I agree that the information reported is true
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                   <h6 style="width: 100%">Date: </h6>
                   <button type="button" class="btn  btn-secondary btn-sm" data-dismiss="modal">Close</button>
                   <button type="button" class="btn  btn-danger btn-sm">Send</button>
                </div>

            </div>
        </div>
    </div>
