<?php
include 'phpmysql.php';
session_start();
//destroy the session
session_unset();
//redirect to login page
header("location: index.php");
?>