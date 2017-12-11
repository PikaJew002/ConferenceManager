<?php
if(isset($_SESSION['id'])) {
  $query = "SELECT * FROM researchers WHERE email='{$_SESSION['id']}'";
  $result = $mysqli->query($query);
  if($result->num_rows == 0) {
    header("Location: ../index.php?page=login&error_msg=wrong_user_type");
  }
} else {
  header("Location: ../index.php?page=login&error_msg=not_logged_in");
}
?>
