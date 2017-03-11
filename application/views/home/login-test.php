<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
?>
<!DOCTYPE html>
<html lang="en">
    
  <head>      
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
      
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "public/guis/Font-Awesome/css/font-awesome.min.css"?>">

    <style type="text/css">
        body {
            position: relative;
        }
        
        .nav {
            position: fixed;
            
        }
        
        .form-inline {
            display: inline-block;
            text-align: center;
        }
        
        .navbar {
            background-color: #363;
            color: white;
            margin-top: 25px;
            
        }
        
        .nav-link {
            color: #9C9 !important;
        }
        
        .nav-link:hover {
            color: #FFF !important;
        }
        
        #btnGroupDrop1 {
            background-color: #EEE;
            width:125px;
            font-size: 12px;
        }
        
        .container {
	   background-color: #EEE;
           margin-top: 105px;
        }
        
        #topheader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 80px;
            z-index: 100;
            background-color: #FFF;
        }
        
        .dropdown-menu {
            min-width: 0px !important;
            font-size: 12px;
        }
        
        .move {
            margin-bottom: -100px;
        }

        .fix-align {
           margin-top: 10px;
        }
        
        .bordertest {
            margin-top: 0;
            background-color: #595;
        }
        
        .subtitle {
            font-size: 24px;
            color: #040 !important;
        }
        
    </style>   
  </head>
       
  <body>
    <div id="topheader"></div>
    <!-- Left Side Menu: Logo, Home, and Sort By ... -->
    <nav class="navbar navbar-toggleable-sm navbar-light fixed-top navbar">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" style="text-align: center; background-color: #030; width: 75px; height: 40px; border-radius: 10px">LOGO</a>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link fix-align" href="#">Home</a>
          </li>
          <li class="nav-item fix-align">
            <div class="btn-group">
            <a id="sortable" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Sort&nbsp;By&nbsp;...</a>
&nbsp;               <div class="dropdown-menu move" aria-labelledby="sortable">
                  <a class="dropdown-item" href="#">Price</a>
                  <a class="dropdown-item" href="#">Name</a>
                  <a class="dropdown-item" href="#">Date</a>
                  <a class="dropdown-item" href="#">Seller</a>
                </div>
              </div>
          </li>
        </ul>
         
          
        
    <!-- Centered Search Bar -->    
    <form class="form-inline mr-auto fix-align">
        <label class="sr-only" for="inlineFormInputGroup">Search</label>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  All
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item category" href="#">Books&nbsp;</a>
                  <a class="dropdown-item category" href="#">Electronics&nbsp;</a>
                  <a class="dropdown-item category" href="#">Furniture&nbsp;</a>
                  <a class="dropdown-item category" href="#">Lab Equipment&nbsp;</a>
                  <a class="dropdown-item category" id="default" href="#">All&nbsp;</a>
                </div>
            </div>
            
            <input type="search" class="form-control" id="inlineFormInputGroup" placeholder="Search ...">
            <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </form>         
        
        
          
        <!-- Right Side Menu: Cart, Sign Up, and Login -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link fix-align" href="#"><i class="fa fa-shopping-cart" aria-hidden="true" style="padding-top: 4px"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link fix-align" href="#">Sign&nbsp;Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fix-align" href="#">Login</a>
          </li>
        </ul>

      </div>
    </nav>
      
    <div class="container" style="max-width: 768px">
        
        <div class = "row justify-content-center bordertest">
            <div class="col-12 subtitle" id="subheader">LOGIN</div>
            <!--<div class='col-6'>
                <a class="subtitle">Welcome,&nbsp;username!</a>
            </div>
            <div class='col-6'>
                <a class="nav-link" style="float: right">Notifications</a>
                <a class="nav-link" style="float: right">Profile</a>
                <a class="nav-link" style="float: right">Postings</a>
            </div>-->
        </div>
        <br /><br /><br />
        <form>
        <div class="row justify-content-center">
            <div class="col-6 input-group">
              <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
              <input type="email" class="form-control" placeholder="Username" aria-describedby="basic-addon1" style="max-width: 300px">
            </div>
        </div>
        <br />   
        <div class="row justify-content-center">
            <div class="col-6 input-group">
              <span class="input-group-addon" id="basic-addon2" style="width: 41px;"><i class="fa fa-lock" aria-hidden="true"></i></span>
              <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1"  style="max-width: 300px">
            </div>
        </div>

        <div class="row justify-content-center">
            <small class="form-text text-muted">Forgot password?</small>
        </div>
        <div class="row justify-content-center">
            <div class="col-6">
            <button type="submit" class="btn btn-success" style="width: 90px">Submit</button>
            </div>
        </div>
        </form>
        
        <br /><br />
        
        <div class="row justify-content-center">
            <div class="col-6">
            <h5>Not a member? Sign up!</h5>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6">
            <button type="submit" class="btn btn-success">Sign Up</button>
        </div>
                
      </div>
      <br />
      

      
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>



    <script type="text/javascript">
      // changes the current category in the search bar to the chosen dropdown value
      $(".category").click(function() {
        if ($(this).attr("id") == "default") {
          $("#btnGroupDrop1").html("All");
        }
        else {
          $("#btnGroupDrop1").html($(this).html());
        }
      })
      
      
      $("#filechooser").click(function() {
          for (var i = 1; i<= 3; i++) {
            $source = $('#file' + i).val().replace("C:\\fakepath\\", "");
            $("#image" + i).attr('src', $source);
            alert($("#image" + i).attr("src"));
          }
      })
    </script>
      
  </body>    
</html>
