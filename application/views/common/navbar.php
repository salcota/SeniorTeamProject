<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    if (empty($categories))
        throw new Exception('Navbar needs categories-listing from controller');
?>

<body>    

    <div id='topheader'></div>

    <nav class='navbar navbar-toggleable-sm navbar-light fixed-top navbar' style="min-height: 82px">

        <button style="border: solid 1px #696; border-radius: 6px" class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'><i class="fa fa-bars" style="color: #EEE; font-size: 50px; height: 60px; padding-top: 5px; width: 60px" aria-hidden="true"></i></button>

	<!-- Left Side Menu: Logo & Home-->
        <a href='<?php echo base_url() . 'Home/view/home' ?>'><img style= "background-color: #FFF; border-radius: 6px; height: 70px; width: 70px"  src='<?php echo base_url() . 'public/images/logo.png'?>'></a>

        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item active'>
                    <a class="nav-link fix-align align-pt-16" style='width: 125px' href='<?php echo base_url() . 'Home/view/home' ?>'>Home</a>
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
                    <button class='btn btn-success' style='cursor: pointer; height: 40px' type='submit'><i class='fa fa-search' aria-hidden='true'></i></button>
                </div>
            </form>

            <!-- Right Side Menu: Sell, Sign Up, and Login -->
            <ul class='navbar-nav'>
                <li class='nav-item'>
                    <a class='nav-link fix-align align-pt-16' href='<?php echo base_url() . 'add_item'?>'>Sell</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link fix-align align-pt-16' href='<?php echo base_url() . 'Home/view/signup'?>'>Sign&nbsp;Up</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link fix-align align-pt-16' href='<?php echo  base_url() . 'Home/view/login' ?>'>Login</a>
                </li>
            </ul>
        </div>

    </nav>
