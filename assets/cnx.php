<?php
date_default_timezone_set("Europe/Lisbon");
error_reporting(E_ALL ^ E_NOTICE);
//$dbh = mysql_connect('internal-db.s159531.gridserver.com', 'db159531_4', 'valterlouro') or die ('Erro: '.mysql_error());
$dbh = mysql_connect('localhost', 'root', '') or die ('Erro: '.mysql_error());
//mysql_select_db('db159531_4');
mysql_select_db('colecao');
?>