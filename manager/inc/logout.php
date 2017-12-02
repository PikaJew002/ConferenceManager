<?php
session_destroy();
$mysqli->close();
header("Location: ../index.php")
?>
