<?php

session_destroy();
session_unset($_SESSION['username']);
header("location:Index.php");

?>
