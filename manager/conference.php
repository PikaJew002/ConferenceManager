<?php
session_start();
require("inc/auth.php");
require("inc/conn.php");
$userData = $mysqli->query("SELECT * FROM admin_users WHERE email=\"".$_SESSION['id']."\"")->fetch_assoc();
$conf = $mysqli->query("SELECT * FROM conferences WHERE name=\"".$mysqli->real_escape_string($_GET['name'])."\"")->fetch_assoc();
$page = $_GET['page'];
?>
<!DOCTYPE html>
<html>
<head>
<!-- meta -->
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <meta name="Description" content="description" />
  <meta name="Keywords" content="keywords" />
  <meta name="robots" content="all, follow" />
<!-- title -->
  <title>Conference Manager</title>
<!-- css -->
  <link rel="stylesheet" href="style.conference.css" type="text/css" />
<!-- javascript -->
  <script src="functions.js" type="text/javascript"></script>
</head>
<body>
<div id="main">
  <div id="header">
    <h1><?php echo $conf['name']; ?></h1>
    <p>
      <em>Hello, <?php echo $userData['first_name']; ?>.</em>
    </p>
  </div>
  <div id="body">
    <div id="nav">
      <a href="conference.php?name=<?php echo $conf['name']; ?>&page=index">Overview</a>
      <a href="conference.php?name=<?php echo $conf['name']; ?>&page=papers">Papers Submitted</a>
      <a href="conference.php?name=<?php echo $conf['name']; ?>&page=reviews">Paper Reviewers</a>
      <a href="index.php">Back to Conferences</a>
    </div>
    <div id="content">
<?php
if($page) {
	if(!strpos($page,".")&&!strpos($page,"/")) {
		if(file_exists("conf/".$page.".php")) {
			include("conf/".$page.".php");
		} else {
			echo "Sorry, that page does not exist.<br />";
		}
	} else {
		echo "Not allowed!";
	}
} else {
	include("conf/index.php");
}
?>
    </div>
  </div>
</div>
</body>
</html>
