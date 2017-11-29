<?php

$mysqli = new mysqli("localhost", "root", "admin", "conference_manager");
if($mysqli->connect_error) {
	die("Connect Error (".$mysqli->connect_errno.") ".$mysqli->connect_error."");
} else {
	echo "Connect good.";
}

?>
