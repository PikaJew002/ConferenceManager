<?php
$page = $_GET['page']
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
  <link rel="stylesheet" href="style2.css" type="text/css" media="screen" />
</head>
<body>
<div id="main">
  <div id="header">
    <h1>Conference Manager</h1>
  </div>
  <div id="body">
    <div id="nav">
      <a href="?page=index">Home</a>
      <a href="?page=register">Register</a>
      <a href="?page=login">Login</a>
    </div>
    <div id="content">
      <?php
			if($page) {
				if(!strpos($page,".")&&!strpos($page,"/")) {
					if(file_exists("inc/".$page.".php")) {
						include("inc/".$page.".php");
					} else {
						echo "Sorry, that page does not exist.<br />";
					}
				} else {
					echo "Not allowed!";
				}
			} else {
				include("inc/index.php");
			}
			?>
    </div>
  </div>
</div>
</body>
</html>
