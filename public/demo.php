<?php
$servername = "192.168.10.156";
$username = "root";
$password = "123456";
$port = '3306';

try {
  $conn = new PDO("mysql:host=$servername;dbname=test;port=$port", $username, $password);
  echo "连接成功";
} catch (PDOException $e) {
  echo $e->getMessage();
}