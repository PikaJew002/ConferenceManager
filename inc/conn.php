<?php
$mysqli = new mysqli("localhost", "root", "admin", "conference_manager");
if($mysqli->connect_error) {
  header("Location: index.php?page=login&error_msg=db_conn_fail");
}
?>
