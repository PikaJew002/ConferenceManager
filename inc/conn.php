<?php
$mysqli = new mysqli("csdatabase.eku.edu", "aaron_eisenberg1", "Eisenberg1", "eisenberg");
if($mysqli->connect_error) {
  header("Location: index.php?page=login&error_msg=db_conn_fail");
}
?>
