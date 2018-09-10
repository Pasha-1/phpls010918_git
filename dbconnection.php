<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'loftschool-1';
//DSN
$dsn = 'mysql:host=' . $host . '; dbname=' . $dbname;
$options = array(
PDO::ATTR_PERSISTENT => true,
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
);
//PDO
try {
$pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
$error = $e->getMessage();
echo $error;
}