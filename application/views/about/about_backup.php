<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>About Team 4</title>

    <style type="text/css">

    body {
	    margin-top: 85px;
            font-family: sans-serif;
    }

    #container {
        background-color: #DDDDDD;
        border-radius: 10px;
        width: 600px;
        height: 600px;
        margin: auto;
        padding: 10px;
    }

    h2 {
        text-align: center;
    }

    a {
        text-decoration: none;
        color: #0099CC;
    }

    a:hover {
        color: #FFFFFF;
    }

    li {

    }

    </style>

</head>
<body>
	<div id="topheader"></div>
        <div id="container">

                <h2>Welcome to Team 4</h2>
                <hr />
                <h4>
                    Software Engineering class SFSU
                    <br />Spring 2017
                    <br />Section 1
                    <br />Team 4
		    <br /><a href="<?php echo base_url() . 'home'?>">Return Home</a>
                </h4>
                <hr />
                <h4>Click Below to View Our Individual Pages</h4>

                <ul>
                    <li><a href="<?php echo base_url() . 'About/view/ihsan'?>">Ihsan Taha</a></li>
                    <br />
                    <li><a href="<?php echo base_url() . 'About/view/prateek'?>">Prateek Gupta</a></li>
                    <br />
                    <li><a href="<?php echo base_url() . 'About/view/darel'?>">Darel Ogbonna</a></li>
                    <br />
                    <li><a href="<?php echo base_url() . 'About/view/shane'?>">Shane Cota</a></li>
                    <br />
                    <li><a href="<?php echo base_url() . 'About/view/kevin'?>">Kevin Chu</a></li>
                    <br />
                    <li><a href="<?php echo base_url() . 'About/view/mark'?>">Mark Tompong</a></li>
                    <br />
                </ul>

        </div>
</body>
</html>