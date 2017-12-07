<?php
if(isset($_SESSION['id'])) {
  $query = "SELECT * FROM admin_users WHERE email='".$_SESSION['id']."'";
  $result = $mysqli->query($query);
  if($result->num_rows == 0) {
    header("Location: ../index.php?page=login&error_msg=auth_fail");
  }
} else {
  header("Location: ../index.php?page=login&error_msg=auth_fail");
}
?>
