<?php
session_start();
$page = $_GET['page'];
require("manager/inc/conn.php");

if($_POST['login']) {
  session_start();
  #validate login fields
  if(!empty($_POST['email']) && !empty($_POST['password'])) {
    #check login credentials
    $email = $mysqli->real_escape_string($_POST['email']);
    $result = $mysqli->query("SELECT * FROM admin_users WHERE email='{$email}'");
    if($result->num_rows == 1) {
      $admin = $result->fetch_assoc();
      if(password_verify($_POST['password'], $admin['password'])) {
        $_SESSION['id'] = $email;
        header("Location: manager/index.php");
      } else {
        header("Location: index.php?page=login&error_msg=email_password_no_match");
      }
    } else {
      header("Location: index.php?page=login&error_msg=email_not_found");
    }
  } else {
    header("Location: index.php?page=login&error_msg=fields_empty");
  }
}
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
  <link rel="stylesheet" href="style.css" type="text/css" />
  <?php
  if($page) {
    if(!strpos($page,".")&&!strpos($page,"/")) {
      if(file_exists("inc/".$page.".php")) {
        echo "<link rel=\"stylesheet\" href=\"inc/style.".$page.".css\" type=\"text/css\" />\n";
      }
    }
  } else {
    echo "<link rel=\"stylesheet\" href=\"inc/style.index.css\" type=\"text/css\" />\n";
  }
  ?>
</head>
<body>
<div id="main">
  <div id="header">
    <h1>Conference Manager</h1>
    <p>
      <em>Excellence in conference management since like a week ago</em>
    </p>
  </div>
  <div id="body">
    <div id="nav">
      <a href="?page=index">Home</a>
      <a href="?page=conferences">View Conferences</a>
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
