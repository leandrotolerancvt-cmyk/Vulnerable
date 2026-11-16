<?php require 'db.php';
if(isset($_SESSION['user'])) log_action($db,$_SESSION['user'],'LOGOUT');
session_destroy(); header('Location: login.php');
