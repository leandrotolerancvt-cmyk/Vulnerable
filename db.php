<?php
// Database connection (MySQL via XAMPP) + session start
session_start();
$dbname = 'attendance_vulnerable';
$db = new PDO('mysql:host=127.0.0.1;charset=utf8mb4', 'root', '');   // XAMPP default: user root, no password
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4");
$db->exec("USE `$dbname`");
$db->exec("CREATE TABLE IF NOT EXISTS users(id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50) UNIQUE, password VARCHAR(255))");
$db->exec("CREATE TABLE IF NOT EXISTS logs(id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50), action VARCHAR(30), remarks TEXT, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
function log_action($db,$u,$a,$r=''){ $s=$db->prepare("INSERT INTO logs(username,action,remarks) VALUES(?,?,?)"); $s->execute([$u,$a,$r]); }
