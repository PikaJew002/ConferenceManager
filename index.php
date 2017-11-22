<?php
$page = $_GET['page'];
//define('MOBILE_SITE_URL', 'http://www.baruchhaba.org/m/index.php?page=index');
//if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== FALSE ||strpos($_SERVER['HTTP_USER_AGENT'], 'iPod') !== FALSE) {
//	header("Location: " . MOBILE_SITE_URL);
//}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- meta -->
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta name="Description" content="description" />
  <meta name="Keywords" content="keywords" />
  <meta name="robots" content="all, follow" />
<!-- title -->
  <title>Conference Manager</title>
<!-- css -->
  <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
</head>
<body>
<div id="main">
	<div id="header-null"><div id="header"></div></div>
	<div id="left-null">
		<div id="left">
		<h2>Menu</h2>
		<ul>
		  <li><a href="?page=index">Home</a></li>
		  <li><a href="?page=about">About</a></li>
		  <li><a href="?page=news_and_events">News and Events</a></li>
		</ul>
		<div id="info">

		</div>
		</div>
	</div>
	<hr class="noscreen" />
	<div id="right-null">
		<div id="right">
			<?php

			if($page) {
				if(!strpos($page,".")&&!strpos($page,"/")) {

					$path = "inc/".$page.".php";

					if(file_exists($path)) {

						include($path);

					} else {

						echo "Sorry, that page does not exist.<br />";

					}

				} else {

					echo "Not allowed!";

				}

			} else {

				$index = "index";
				include("inc/".$index.".php");

			}
			?>
		</div>
	</div>
	<hr class="noscreen" />
	<div id="footer-null">
		<div id="footer"><br />
		Copyright 2008-2015. Baruch Haba Messianic Jewish Congregation, Inc. All rights reserved.<br />
		Designed by Matthew Coons and maintained by Aaron Eisenberg.<br />
		</div>
	</div>
</div>
<?php include("counter/counter.php"); ?>
</body>
</html>
