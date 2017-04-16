<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
<head>
<title>Kevin Chu</title>

<style>
html 
{
	margin-top: 85px;
}

html, body
{
	width: 98%;
	height: 98%;
	font-size: 4vmin;
}
.big
{
	font-size: 200%;
}
#main
{
	width: 100%:
	height: 100%;
}

#sideInfo, #journal
{
	display: inline-block;
	vertical-align: top;
}

#sideInfo
{
	width: 23%;
	overflow-x: hidden;
	border-right: solid 2px #000000;
	padding-bottom: 100px;
}
#sideInfo img
{
	width: 50%;
}

#journal
{
	width: 73%;
}
.entry
{
	background: #DDDDFF;
	margin-bottom: 30px;
	margin-left: 5%;
	border-top: solid 4px #000000;
}

</style>
</head>
<body>

<div id="topheader"></div>
<div id="main">

<div id="sideInfo">
<center>
<span class="big">Kevin Chu</span><br>
<img src="<?php echo base_url() . "public/images/aboutKevin.jpg"?>"><br><br>
Front-End Developer<br>
for the SP17G04 Buy/Sell website<br>
(Website Name pending)
</center>
</div>

<div id="journal">
	<span class="big">Developer Journal</span>

	<div class="entry">
	<b>Be wary of leaving .git accessible in public_html</b><br>
	Originally, the webpages served on our server was located directly inside the git repository, though, that also meant our .git folder was also exposed to the outside.<br>
	From what I've read so far, this is a security hole since an attacker could potentially DL our source files which are kept inside .git for versioning purposes.<br>
	To resolve this, we could manually copy the master branch over to public_html (without the .git files/folders) everytiime we want to deploy a new update,<br>
	though, I think the best solution would be to have the entire CodeIgniter system put into a subdirectory of the .git repository, then replace public_html with a symbolic link pointing to that subdirectory within the server's local git repository.<br>
	This would allow us to pull new updates from the master branch without exposing any of the .git data.
	<br><br>
	Link:<br>
	<a href="http://pythonsweetness.tumblr.com/post/52587443706/devs-please-stop-serving-git-to-the-outside">Devs, please stop serving .git to the outside world! - Python Sweetness</a>
	</div>
	<div class="entry">
	<b>Init</b><br>
	A new webpage.
	</div>

</div>

</div>
</body>
</html>
