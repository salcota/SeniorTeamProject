<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (empty($categories))
    throw new Exception('Navbar needs categories-listing from controller');
?>
<body>

<div id="topheader"></div>

<!-- Left Side Menu: Logo, Home, and Sort By ... -->
<nav class="navbar navbar-toggleable-sm navbar-light fixed-top navbar">

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

    <a class="navbar-brand">LOGO</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link fix-align" href="<?php echo base_url() . "Home/view/home" ?>">Home</a>
                </li>
                <li class="nav-item fix-align">
                    <div class="btn-group">
                        <a id="sortable" class="nav-link" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false" href="#">Sort&nbsp;By&nbsp;...</a>
                        &nbsp;
                        <div class="dropdown-menu move" aria-labelledby="sortable">
                            <a class="dropdown-item" href="#" onclick="$('#sort').val('price');document.forms['searchSubmit'].submit()">Price</a>
                            <a class="dropdown-item" href="#" onclick="$('#sort').val('title');document.forms['searchSubmit'].submit()">Name</a>
                            <a class="dropdown-item" href="#" onclick="$('#sort').val('posted_on');document.forms['searchSubmit'].submit()">Date</a>
                        </div>
                    </div>
                </li>
            </ul>

            <!-- Centered Search Bar -->
        <form class="form-inline mr-auto fix-align" action="<?php echo base_url() . "home" ?>" id="searchSubmit" method=GET>
            <label class="sr-only" for="inlineFormInputGroup">Search</label>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="form-group">
                    <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="categories" name="category"
                            onchange='document.forms["searchSubmit"].submit()'>
                        <option value="">All</option>
                        <?php
                        // Populate category list
                        foreach ($categories as $category) {
                            // If user chose category, mark that option as selected.
                            $selector = "";
                            if ($currentCategory == $category->category_id)
                                $selector = " selected=\"selected\"";

                            // Add category option to list.
                            print "<option value=$category->category_id$selector>$category->category_name</option>\r\n";
                        }
                        ?>
                    </select>
                </div>
                <input style="height: 40px" type="search" class="form-control" id="inlineFormInputGroup" placeholder="Search ..."
                       name="search" value="<?php echo $searchTerms ?>">
                <input type="hidden" name="sort" id="sort">
                <button style="height: 40px" class="btn btn-success" type="submit"><i class="fa fa-search"                                                                              aria-hidden="true"></i></button>
            </div>
        </form>

        <!-- Right Side Menu: Cart, Sign Up, and Login -->

	<?php
	    $registered = false;
	    if ($registered)
	    {
		$this->load->view('common/rightnavbar_reglinks');
	    }
	    else
	    {
	        $this->load->view('common/rightnavbar_links');
	    }?>
	    
	    
        	<!--<ul class='navbar-nav'>
            	    <li class='nav-item'>
                        <a class='nav-link fix-align' href='#'><i class='fa fa-shopping-cart' aria-hidden='true'
                                                          style='padding-top: 4px'></i></a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link fix-align' href='#'>Sign&nbsp;Up</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link fix-align' href='//echo  base_url() . 'Home/view/login' ?>'>Login</a>
                    </li>
                </ul>-->
    </div>

</nav>
