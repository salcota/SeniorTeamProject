<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

                <ul class='navbar-nav'>
                    <li class='nav-item'>
                        <a class='nav-link fix-align' href='#'><i class='fa fa-shopping-cart' aria-hidden='true'
                                                          style='padding-top: 4px'></i></a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link fix-align' href='#'>Report</a>
                    </li>
                    <li class='nav-item'>
			    <div class="btn-group">
                            <a id="logout" class="nav-link fix-align" data-toggle="dropdown" aria-haspopup="true"
				aria-expanded="false" href="#"><?php $username = 'Prateek'; echo $username;?>&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                            <div class="dropdown-menu move" aria-labelledby="logout">
                                <a class="dropdown-item" href='<?php echo  base_url() . 'Home/view/home' ?>'>Logout</a>
                            </div>
                    	</div>
                    </li>
                </ul>
