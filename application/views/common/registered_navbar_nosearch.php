<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    if (empty($categories))
        throw new Exception('Navbar needs categories-listing from controller');
?>

<body>    

    <div id='topheader'></div>

    <nav class='navbar navbar-toggleable-lg navbar-light fixed-top navbar'>

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
                    <a class='nav-link fix-align' href='<?php echo  base_url() . 'Home/view/edit_listing' ?>'>Sell</a>
                </li>
		<li class='nav-item'>
                    <a class='nav-link fix-align' href='<?php echo  base_url() . 'Home/view/item_listings' ?>'>Listings</a>
                </li>
		<li class='nav-item'>
                    <a class='nav-link fix-align' href='#'>Notifocations</a>
                </li>
                <li class='nav-item'>
                    <div class="btn-group">
                        <a id="logout" class="nav-link fix-align" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" href="#"><?php $username = 'My Account'; echo $username;?>&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                        <div class="dropdown-menu move" aria-labelledby="logout">
			    <a class="dropdown-item" href='#'>Profile</a>
                            <a class="dropdown-item" href='#'>Report</a>
  	                    <a class="dropdown-item" href='<?php echo  base_url() . 'Home/view/home' ?>'>Logout</a>		
                        </div>
                    </div>
                </li>
            </ul>

        </div>

    </nav>
