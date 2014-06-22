<?php
function jokes()
{
  global $db,$sql_prefix,$userid;
//###### Settings #####
$maxl = 600;
//### Settings Ende ###

//rating speichern

if(isset($_GET['jid']) AND isset($_GET['jokerating']) AND isset($userid) AND $_GET['jokerating'] <= 5) {
$al = mysql_num_rows(db("SELECT id FROM ".$sql_prefix."joke_rating WHERE jid LIKE '".$_get['jid']."' AND uid LIKE '".$userid."'"));	
if($al ==0) {
$qry = db("INSERT INTO ".$sql_prefix."joke_rating 
                       SET `jid`  = '".((int)$_GET['jid'])."',
                           `uid`    = '".((int)$userid)."',
                           `pkt`  = '".((int)$_GET['jokerating'])."'");
	}}

//Ausgabe
$min = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
$max = mktime(23, 59, 59, date("m"), date("d"), date("Y"));


$qrys = db("SELECT * FROM ".$sql_prefix."jokes WHERE date >= ".$min." AND date < ".$max." AND status != 0 ORDER BY RAND()");
if(mysql_num_rows($qrys) != 0) {
        $get = _fetch($qrys);

$content=$get['content'];
$textparts= explode("\n", wordwrap($content, 200, "\n"));
if($get['content']!= $textparts[0]) {	
	$content=$textparts[0]." [...]";
	$more = '<a href="../jokes/?action=show&id='.$get['id'].'">'._jokes_more.'</a>';
} else {
	$content = $textparts[0];
	$more = '<a href="../jokes/?action=show&id='.$get['id'].'">'._jokes_show.'</a>';
	}

//rating
if(isset($userid)) {
$bv = mysql_num_rows(db("SELECT * FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id']." AND uid LIKE ".$userid.""));
if($bv=='0') {
		/*$rating = 'Vote: 
		<a href="?'.$_SERVER['QUERY_STRING'].'&amp;jokerating=1&amp;jid='.$get['id'].'">1</a> 
		<a href="?'.$_SERVER['QUERY_STRING'].'&amp;jokerating=2&amp;jid='.$get['id'].'">2</a> 
		<a href="?'.$_SERVER['QUERY_STRING'].'&amp;jokerating=3&amp;jid='.$get['id'].'">3</a> 
		<a href="?'.$_SERVER['QUERY_STRING'].'&amp;jokerating=4&amp;jid='.$get['id'].'">4</a> 
		<a href="?'.$_SERVER['QUERY_STRING'].'&amp;jokerating=5&amp;jid='.$get['id'].'">5</a>';*/
//RATING FUNKTION
?>
<link rel="stylesheet" type="text/css" href="../jokes/style.css">
<script type="text/javascript" src="../jokes/jquery.js"></script>
<script type="text/javascript" src="../jokes/script.js"></script>
<?php

$votee = mysql_fetch_array(db("SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'].""));
$rating = round($votee[0],1);

if($rating > 0) { $hover1 = 'class="hover"';} else { $hover1 = ""; }
if($rating > 1.5) { $hover2 = 'class="hover"';} else { $hover2 = ""; }
if($rating > 2.5) { $hover3 = 'class="hover"';} else { $hover3 = ""; }
if($rating > 3.5) { $hover4 = 'class="hover"';} else { $hover4 = ""; }
if($rating > 4.5) { $hover5 = 'class="hover"';} else { $hover5 = ""; }

	$rating = '
		<div id="rating_'.$get['id'].'">
			<span class="star_1"><img src="../jokes/star_blank.png" alt=""  '.$hover1.'/></span>
			<span class="star_2"><img src="../jokes/star_blank.png" alt=""  '.$hover2.'/></span>
			<span class="star_3"><img src="../jokes/star_blank.png" alt=""  '.$hover3.'/></span>
			<span class="star_4"><img src="../jokes/star_blank.png" alt=""  '.$hover4.'/></span>
			<span class="star_5"><img src="../jokes/star_blank.png" alt=""  '.$hover5.'/></span>
			</div>	
	<div class="clearleft">&nbsp;</div>	';

//RATING FUNKTION ENDE		
		
		}else{
		?>
 <style type="text/css">
.hover {
	background: url('../jokes/star.png'); 
	z-index: 1;
}
img {
	border: 0;
}
    </style>
<?php
	$votee = mysql_fetch_array(db("SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'].""));
$rating = round($votee[0],1);

if($rating > 0) { $hover1 = 'class="hover"';} else { $hover1 = ""; }
if($rating > 1.5) { $hover2 = 'class="hover"';} else { $hover2 = ""; }
if($rating > 2.5) { $hover3 = 'class="hover"';} else { $hover3 = ""; }
if($rating > 3.5) { $hover4 = 'class="hover"';} else { $hover4 = ""; }
if($rating > 4.5) { $hover5 = 'class="hover"';} else { $hover5 = ""; }
	$rating = '
		<div id="rating_'.$get['id'].'">
			<span><img src="../jokes/star_blank.png" alt=""  '.$hover1.'/></span>
			<span><img src="../jokes/star_blank.png" alt=""  '.$hover2.'/></span>
			<span><img src="../jokes/star_blank.png" alt=""  '.$hover3.'/></span>
			<span><img src="../jokes/star_blank.png" alt=""  '.$hover4.'/></span>
			<span><img src="../jokes/star_blank.png" alt=""  '.$hover5.'/></span>
			</div>	
	<div class="clearleft">&nbsp;</div>'._jokes_voted;

		}
} else {
	?>
 <style type="text/css">
.hover {
	background: url('../jokes/star.png'); 
	z-index: 1;
}
img {
	border: 0;
}
    </style>
<?php
	$votee = mysql_fetch_array(db("SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'].""));
$rating = round($votee[0],1);

if($rating > 0) { $hover1 = 'class="hover"';} else { $hover1 = ""; }
if($rating > 1.5) { $hover2 = 'class="hover"';} else { $hover2 = ""; }
if($rating > 2.5) { $hover3 = 'class="hover"';} else { $hover3 = ""; }
if($rating > 3.5) { $hover4 = 'class="hover"';} else { $hover4 = ""; }
if($rating > 4.5) { $hover5 = 'class="hover"';} else { $hover5 = ""; }
	$rating = '
		<div id="rating_'.$get['id'].'">
			<span><img src="../jokes/star_blank.png" alt=""  '.$hover1.'/></span>
			<span><img src="../jokes/star_blank.png" alt=""  '.$hover2.'/></span>
			<span><img src="../jokes/star_blank.png" alt=""  '.$hover3.'/></span>
			<span><img src="../jokes/star_blank.png" alt=""  '.$hover4.'/></span>
			<span><img src="../jokes/star_blank.png" alt=""  '.$hover5.'/></span>
			</div>	
	<div class="clearleft">&nbsp;</div>'._jokes_login;

	}
    
	
	$index = show("menu/jokes", array("title" => "Witz von ".autor($get['uid']),
                                               "content"    => bbcode($content),
											   "more"    => $more,
											   "rating" => $rating));
} else {
//nichts eingetragen
$index = show("menu/jokes", array("title" => "",
                                               "content"    => _jokes_empty,
											   "more"    => "",
											   "rating" => ""));
	
}
  return empty($index) ? '' : '<table class="navContent" cellspacing="0">'.$index.'</table>';
}
?>
