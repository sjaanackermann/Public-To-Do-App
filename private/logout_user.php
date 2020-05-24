<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['pwhash']);
unset($_SESSION['userID']);
header("Location: ../public/index.php");
?>
