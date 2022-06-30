<?php
$mysql = new mysqli('localhost', 'root', '', 'm3_db');

if($mysql->connect_errno){
	exit ('Ошибка подключения к БД');
}

$teams = $mysql->query("SELECT * FROM `teams`");
$result = $mysql->query("SELECT * FROM `game`");

// $mysql->close();
 ?>
