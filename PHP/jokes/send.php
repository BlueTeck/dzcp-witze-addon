<?php
session_start();
require('../inc/mysql.php'); 

mysql_connect($sql_host, $sql_user, $sql_pass) or die(mysql_error());
mysql_select_db($sql_db) or die(mysql_error());

$rating = (int)$_POST['rating'];
$id = (int)$_POST['id'];

$query = mysql_query("SELECT * FROM ".$sql_prefix."joke_rating WHERE jid LIKE '".$id."' AND uid LIKE '".$_SESSION['id']."'") or die(mysql_error());

$al = mysql_num_rows($query); 

	if($rating > 5 OR $rating < 1) {
		echo"Rating can't be below 1 or more than 5";
	}
	
	elseif($al != 0) {
		echo"<div class='highlight'>Bereits bewertet!</div>";
	}
	else {
mysql_query("INSERT INTO ".$sql_prefix."joke_rating 
                       SET `jid`  = '".((int)$id)."',
                           `uid`    = '".((int)$_SESSION['id'])."',
                           `pkt`  = '".((int)$rating)."'") or die(mysql_error());

		echo"<div class='highlight'>Bewertung gespeichert!</div>";
	}
?>