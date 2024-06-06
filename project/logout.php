<?php
session_start();
include './database.php';
session_destroy();
header("Location: login.php");
exit();
?>