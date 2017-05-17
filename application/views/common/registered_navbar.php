<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    if (empty($categories))
        throw new Exception('Navbar needs categories-listing from controller');
?>

<body>    

    <div id='topheader'></div>

    <nav class='navbar navbar-toggleable-lg navbar-light fixed-top' style="min-height: 65px">

        <button style="border-style: none; cursor: pointer; margin-right: -10px" class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'><i class="fa fa-bars xtraMenuBar" style="color: #EEE; font-size: 35px; padding-top: 7px; padding-right: -8px" aria-hidden="true"></i></button>


       <!-- Left Side Menu: Logo & Home-->
        <a href='<?php echo base_url() . 'Home/view/home' ?>'><img style= "background-color: #FFF; border-radius: 6px; height: 55px; width: 55px"  src='<?php echo base_url() . 'public/images/logo.png'?>'></a>

        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item active'>
                    <a class="nav-link fix-align align-pt-16" style='width: 310px' href='<?php echo base_url() . 'Home/view/home' ?>'>Home</a>
                </li>
            </ul>
 
            <!-- this was put in views/home/home.php
            <div class="row justify-content-center text-danger">
	        <div class="col-sm-5">
                    <?php
		        // Loads login failure data of input is not recognized.
		        //if($this->session->flashdata('bad_search')):
             	        //echo "<div class='alert alert-danger' role='alert'><strong>" . $this->session->flashdata('bad_search') . "</strong></div>";
            	        //endif;
	            ?>
	        </div>
            </div>
 	    -->

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
			<!-- attmempting to call controller for form validation on search -->
			 <?php
			// echo form_open modified by scota
			//echo form_open('Users/search');
		        $data = array(
                    	    'class' 	    => 'form-control',
			    'id'	    => 'inlineFormGroup',
                    	    'name' 	    => 'search',
                    	    'placeholder'   => 'Search ...',
			    'type' 	    => 'search',
			    'style'	    => 'height: 40px',
			    'value'	    => $searchTerms
                	);
			echo form_input($data);
               	    ?>     
	
                    <input type='hidden' name='sort' id='sort'>
                    <button class='btn searchTheme' style='cursor: pointer; height: 40px' type='submit'><i class='fa fa-search' aria-hidden='true'></i></button>
                </div>
            </form>

            <!-- Right Side Menu: Cart, Sell, Sign Up, and Login -->            
	    <ul class='navbar-nav'>
                <li class='nav-item'>
                    <a class='nav-link fix-align align-pt-16' href='<?php echo  base_url() . 'add_item' ?>'>Sell</a>
                </li>
		<li class='nav-item'>
                    <a class='nav-link fix-align align-pt-16' href='<?php echo  base_url() . 'user_listings' ?>'>Listings</a>
                </li>

		<!-- Adds a notfication signal if one exists and the number of new notifications -->

		<li class='nav-item'>
                   <a class='nav-link fix-align align-pt-16' href='<?php echo  base_url() . 'Notification' ?>'>Notifications<span id="mailbox" class="notif-signal"style="padding-left: 2px; padding-right: 3px; visibility: hidden">0</span></a>
                </li>
		


                <li class='nav-item'>
                    <div class="btn-group">
                            <a id='logout' class='nav-link fix-align align-pt-16' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' href="#"><?php $username = 'My Account'; echo $username;?>&nbsp;<i class='fa fa-caret-down' aria-hidden='true'></i></a>
                        <div class='dropdown-menu move' aria-labelledby='logout'>
                            <a class='dropdown-item' href='<?php echo  base_url() . 'Profile/me' ?>'>Profile</a>
                            <a class='dropdown-item' href="#" style="text-decoration: none" data-toggle='modal' data-target='#reportModal'>Report</a>
			    <a class='dropdown-item' href="#" style="text-decoration: none" data-toggle='modal' data-target='#themesModal'>Themes</a>
  	                    <a class='dropdown-item' href='<?php echo  base_url() . 'Logout' ?>'>Logout</a>
                        </div>
                    </div>
                </li>
            </ul>

        </div>

    </nav>


    <!-- TRYING TO DISPLAY ERROR MESSAGE WHEN USER PUTS IN BAD INPUT, scota-->
    <div class="row justify-content-center text-danger">
	<div class="col-sm-5">
            <?php
		// Loads login failure data of input is not recognized.
		if($this->session->flashdata('bad_report')):
            	echo "<div class='alert alert-danger' role='alert'><strong>" . $this->session->flashdata('bad_report') . "</strong></div>";
            	endif;
	    ?>
	</div>
    </div> 
   

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

		<div id='badReport' class='alert alert-danger' role='alert' style='display: none;'></div>
	
		<script>
		    function sendReport() 
		    {
			var checkTerms = "";
			if ($("#reportTerms").is(":checked"))
				checkTerms = $("#reportTerms").val();
			var url = '<?php echo base_url() . "Users/report"?>';
			var reportHTMLText = $('#reportID').val();
			var reportRequest = $.post(url,{reportText: reportHTMLText, reportTerms: checkTerms});
			reportRequest.done(receiveReport);
		    }

		    function receiveReport(reportError) 
		    {
			if (reportError.length > 0)
			{
				var theError = '<strong>' + reportError + '</strong>';
				$('#badReport').html(theError);
				$("#badReport").css("display", "block");
			}
			else
			{
				$("#badReport").html("");
				$("#badReport").css("display", "none");
				$("#reportModal").modal("hide");
				$("#reportID").val('');	
			}
		    }
		</script>
 
                <div class="modal-body">
		    <?php
			// echo form_open modified by scota
			echo form_open('Users/report');
		        $data = array(
			    'id'	    => 'reportID',
                    	    'class' 	    => 'form-control',
                    	    'name' 	    => 'reportText',
                    	    'placeholder'   => 'Report misconduct here',
			    'style'	    => 'height: 100px; resize: none'
                	);
                	echo form_textarea($data);
               	    ?>        
		    <?php
			$data = array(
        		    'name' 	    => 'reportTerms',
        		    'id'            => 'reportTerms',
        		    'value'         => 'accept',
        		    'checked'       => TRUE,
        		    'style'         => 'margin-top: 10px'		    	
			);
			echo form_checkbox($data, 'value');
			echo 'I agree the following claim is true';
		    ?>		    
		</div>

		<div class="modal-footer">
                   <button type="button" class="btn  btn-secondary btn-sm" data-dismiss="modal">Close</button>
		   <?php
			$data = array(
			    'class'	    => 'btn btn-danger btn-sm',
			    'name'	    => 'submit',
			    'value'	    => 'true',
			    'content' 	    => 'Send',
			    'onclick'	    => 'sendReport()'
			);
			echo form_button($data);
			//echo form_submit($data);
			echo form_close();
		    ?>
                </div>

            </div>
        </div>
    </div>

    <!-- Pops a modal to offer the user a selection of color themes -->
    <div class="modal fade" id="themesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="border-radius: 6px; postion: relative; top: 25%">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h6 class="modal-title" id="exampleModalLabel" style="color: #333">Customize Your Color Theme</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
		<div class="row justify-content-center">
		<div class="col-sm-4">
		<?php
		$themeURL = base_url() . "Theme/setTheme/";
		?>
                    <a style="text-decoration: none" href="<?php echo $themeURL . "gardenTheme"?>"><button class="form-control btn-sm white" type="button" style="background-color: #449D44; width: 135px">Garden</button></a>
		    <a style="text-decoration: none" href="<?php echo $themeURL . "desertTheme"?>"><button class="form-control btn-sm white" type="button" style="background-color: #AA7; width: 135px">Desert</button></a>
		    <a style="text-decoration: none" href="<?php echo $themeURL . "roseTheme"?>"><button class="form-control btn-sm white" type="button" style="background-color: #933; width: 135px">Rose</button></a>
		    <a style="text-decoration: none" href="<?php echo $themeURL . "bubbleGumTheme"?>"><button class="form-control btn-sm white" type="button" style="background-color: #E69; width: 135px">Bubble Gum</button></a>
		    <a style="text-decoration: none" href="<?php echo $themeURL . "iceTheme"?>"><button class="form-control btn-sm white" type="button" style="background-color: #336; width: 135px">Ice</button></a>
                    <a style="text-decoration: none" href="<?php echo $themeURL . "snowTheme"?>"><button class="form-control btn-sm white" type="button" style="background-color: #EEE; color: #999 !important; width: 135px">Snow</button></a>
                    <a style="text-decoration: none" href="<?php echo $themeURL . "darkTheme"?>"><button class="form-control btn-sm white" type="button" style="background-color: #222; width: 135px">Dark</button></a>
                    <a style="text-decoration: none" href="<?php echo $themeURL . "sunTheme"?>"><button class="form-control btn-sm white" type="button" style="background-color: #FC3; width: 135px">Sun</button></a>
                    <a style="text-decoration: none" href="<?php echo $themeURL . "skyTheme"?>"><button class="form-control btn-sm white" type="button" style="background-color: #369; width: 135px">Sky</button></a>
                    <a style="text-decoration: none" href="<?php echo $themeURL . "sfsuTheme"?>"><button class="form-control btn-sm white" type="button" style="background-color: #414; width: 135px">SFSU</button></a>
		</div>
		</div>
		</div>

            </div>
        </div>
    </div>

<?php
// Required for live notification updates.
$this->load->view('notifications/LiveMessage');
?>

<script>
var mailChecker = new LiveMessage();
function updateNotifications(count)
{
	var oldCount = $("#mailbox").html();
	
	// Do nothing if no change.
	if (oldCount == count)
		return;
	
	// Update mail counter.
	$("#mailbox").html(count);
	
	// Show/hide the notification symbol.
	if (count > 0)
		$("#mailbox").css('visibility', 'visible');
	else
		$("#mailbox").css('visibility', 'hidden');
}
$(document).ready(function()
{
	mailChecker.hasUnread(updateNotifications);
	setInterval(function(){mailChecker.hasUnread(updateNotifications);}, 1000);
});
</script>
