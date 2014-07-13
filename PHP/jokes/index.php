<?php
## OUTPUT BUFFER START ##
include("../inc/buffer.php");
## INCLUDES ##
include(basePath."/inc/debugger.php");
include(basePath."/inc/config.php");
include(basePath."/inc/bbcode.php");
## SETTINGS ##
$time_start = generatetime();
lang($language);
$where = _jokes;
$title = $pagetitle." - ".$where."";
$dir = "jokes";
## SECTIONS ##
if(!isset($_GET['action'])) $action = "";
else $action = $_GET['action'];



//rating speichern

if(isset($_GET['jid']) AND isset($_GET['jokerating']) AND isset($userid) AND $_GET['jokerating'] <= 5) {
$al = mysql_num_rows(db("SELECT id FROM ".$sql_prefix."joke_rating WHERE jid LIKE '".$_get['jid']."' AND uid LIKE '".$userid."'"));	
if($al ==0) {
$qry = db("INSERT INTO ".$sql_prefix."joke_rating 
                       SET `jid`  = '".((int)$_GET['jid'])."',
                           `uid`    = '".((int)$userid)."',
                           `pkt`  = '".((int)$_GET['jokerating'])."'");
	}}
//rating speichern ende

switch ($action):
default:

$show = show($dir."/default", array("top" => "Top 10 "._jokes,
									"flop" => "Flop 10 "._jokes,
									"archiv" => _jokes." "._jokes_archiv,
									"insert" => "Witz einreichen"));
 
 $index = show($dir."/show", array("head" => _jokes, 
  									"img" => '',
									"what" => "",
									"foot"=> "",
									"show" => $show)); 
									 

break;
//#####################################################################################################
case 'show';
if (is_numeric($_GET['id'])) {
 $qry = db("SELECT * FROM ".$sql_prefix."jokes WHERE id LIKE ".$_GET['id']);
}
        while($get = _fetch($qry))
		{ 
if(isset($userid)) {
	$bv = mysql_num_rows(db("SELECT * FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id']." AND uid LIKE ".$userid.""));
if($bv=='0') {
//RATING FUNKTION

?>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="script.js"></script>
<?php

$votee = db("SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'],true,true);
$rating = round($votee[0],1);

if($rating > 0) { $hover1 = 'class="hover"';} else { $hover1 = ""; }
if($rating > 1.5) { $hover2 = 'class="hover"';} else { $hover2 = ""; }
if($rating > 2.5) { $hover3 = 'class="hover"';} else { $hover3 = ""; }
if($rating > 3.5) { $hover4 = 'class="hover"';} else { $hover4 = ""; }
if($rating > 4.5) { $hover5 = 'class="hover"';} else { $hover5 = ""; }

	$newrating = '
		<div id="rating_'.$get['id'].'">
			<span class="star_1"><img src="star_blank.png" alt=""  '.$hover1.'/></span>
			<span class="star_2"><img src="star_blank.png" alt=""  '.$hover2.'/></span>
			<span class="star_3"><img src="star_blank.png" alt=""  '.$hover3.'/></span>
			<span class="star_4"><img src="star_blank.png" alt=""  '.$hover4.'/></span>
			<span class="star_5"><img src="star_blank.png" alt=""  '.$hover5.'/></span>
			</div>	
	<div class="clearleft">&nbsp;</div>	';

//RATING FUNKTION ENDE		
} else {
	?>
<link rel="stylesheet" type="text/css" href="style.css">
<?php
	$votee = db("SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'],true,true);
$rating = round($votee[0],1);

if($rating > 0) { $hover1 = 'class="hover"';} else { $hover1 = ""; }
if($rating > 1.5) { $hover2 = 'class="hover"';} else { $hover2 = ""; }
if($rating > 2.5) { $hover3 = 'class="hover"';} else { $hover3 = ""; }
if($rating > 3.5) { $hover4 = 'class="hover"';} else { $hover4 = ""; }
if($rating > 4.5) { $hover5 = 'class="hover"';} else { $hover5 = ""; }
	$newrating = '
		<div id="rating_'.$get['id'].'">
			<span><img src="star_blank.png" alt=""  '.$hover1.'/></span>
			<span><img src="star_blank.png" alt=""  '.$hover2.'/></span>
			<span><img src="star_blank.png" alt=""  '.$hover3.'/></span>
			<span><img src="star_blank.png" alt=""  '.$hover4.'/></span>
			<span><img src="star_blank.png" alt=""  '.$hover5.'/></span>
			</div>	
	<div class="clearleft">&nbsp;</div>	';
	$ratinga = _jokes_voted;
}
/*$bv = mysql_num_rows(db("SELECT * FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id']." AND uid LIKE ".$userid.""));
if($bv=='0') {
		$ratinga = 'Vote: 
		<a href="?'.$_SERVER['QUERY_STRING'].'&amp;jokerating=1&amp;jid='.$get['id'].'">1</a> 
		<a href="?'.$_SERVER['QUERY_STRING'].'&amp;jokerating=2&amp;jid='.$get['id'].'">2</a> 
		<a href="?'.$_SERVER['QUERY_STRING'].'&amp;jokerating=3&amp;jid='.$get['id'].'">3</a> 
		<a href="?'.$_SERVER['QUERY_STRING'].'&amp;jokerating=4&amp;jid='.$get['id'].'">4</a> 
		<a href="?'.$_SERVER['QUERY_STRING'].'&amp;jokerating=5&amp;jid='.$get['id'].'">5</a>';
} else {
	$ratinga = _jokes_voted;
	}*/
	} else {
		?>
<link rel="stylesheet" type="text/css" href="style.css">
<?php
	$votee = db("SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'],true,true);
$rating = round($votee[0],1);

if($rating > 0) { $hover1 = 'class="hover"';} else { $hover1 = ""; }
if($rating > 1.5) { $hover2 = 'class="hover"';} else { $hover2 = ""; }
if($rating > 2.5) { $hover3 = 'class="hover"';} else { $hover3 = ""; }
if($rating > 3.5) { $hover4 = 'class="hover"';} else { $hover4 = ""; }
if($rating > 4.5) { $hover5 = 'class="hover"';} else { $hover5 = ""; }
	$newrating = '
		<div id="rating_'.$get['id'].'">
			<span><img src="star_blank.png" alt=""  '.$hover1.'/></span>
			<span><img src="star_blank.png" alt=""  '.$hover2.'/></span>
			<span><img src="star_blank.png" alt=""  '.$hover3.'/></span>
			<span><img src="star_blank.png" alt=""  '.$hover4.'/></span>
			<span><img src="star_blank.png" alt=""  '.$hover5.'/></span>
			</div>	
	<div class="clearleft">&nbsp;</div>	';
	
		$ratinga = _jokes_login;
	}	
		
$votee = db("SELECT avg(pkt),count(*) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'],true,true);
$rating = 'Rating: '.round($votee[0],1).'/5  <i>('.$votee[1].' Votes)</i>';

//Rechte

if(isset($userid)) {
$rechteuser = db("SELECT jokes FROM ".$db['permissions']." WHERE user LIKE ".$userid,true,true);
$rechteadmin = db("SELECT level FROM ".$db['users']." WHERE id LIKE ".$userid,true,true);
if($rechteuser[0] == 1 OR $rechteadmin[0] == 4) { 
$rechte = '<div align="right" style="vertical-align:middle"><a href="../admin/?admin=jokes&status=id&id='.$get[id].'"><img src="../inc/images/edit.gif" width="16" height="16" /> bearbeiten</a></div><br>';
//$rechte = "Du hast Rechte";
} else {
	$rechte="";
	}
} else {
	$rechte="";
	}
	//Rechte Ende			 
										   											
  $index = show($dir."/show", array("head" => _jokes." - ".$get['title'], 
  									"img" => '<img src="witze.jpg">',
									"what" => $rechte.""._jokes_eingereicht.": ".autor($get['uid'])." <br><br>".$newrating." ".$rating."<br>".$ratinga,
									"foot"=> "",
									"show" => "<hr><br>".$get['content']."<br><br>")); 
									 }
break;
//#####################################################################################################
case 'danke';
  $index = show($dir."/show", array("head" => _jokes, 
  									"img" => "",
									"foot"=> _jokes_eingereicht." ".autor($userid),
									"what" => "",
									"show" => "<br><br><br>"._joke_wait."<br><br><br><br>")); 
									 
break;
//#####################################################################################################
case 'toplist';
 $qry = db("SELECT * FROM ".$sql_prefix."jokes WHERE status LIKE '1' ORDER BY (SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$sql_prefix."jokes.id) DESC LIMIT 10");
        while($get = _fetch($qry))
		{ 
?>
<link rel="stylesheet" type="text/css" href="style.css">
<?php
	$votee = db("SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'],true,true);
$rating = round($votee[0],1);

if($rating > 0) { $hover1 = 'class="hover"';} else { $hover1 = ""; }
if($rating > 1.5) { $hover2 = 'class="hover"';} else { $hover2 = ""; }
if($rating > 2.5) { $hover3 = 'class="hover"';} else { $hover3 = ""; }
if($rating > 3.5) { $hover4 = 'class="hover"';} else { $hover4 = ""; }
if($rating > 4.5) { $hover5 = 'class="hover"';} else { $hover5 = ""; }
	$newrating = '<img src="star_blank.png" alt=""  '.$hover1.'/><img src="star_blank.png" alt=""  '.$hover2.'/><img src="star_blank.png" alt=""  '.$hover3.'/><img src="star_blank.png" alt=""  '.$hover4.'/><img src="star_blank.png" alt=""  '.$hover5.'/>';		
$votee = db("SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'],true,true);
$rating =$newrating." ".round($votee[0],1).'/5';
		          
				  $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
				  
				  $row .= show($dir."/list_row", array("autor" => autor($get['uid']),
                                                   "title" => $get['title'],
												   "date" => date("d.m.y", $get['date']),
                                                   "rating" => $rating,
												   "id" => $get['id'],
												   "class" => $class));					
							}				
  $index = show($dir."/show", array("head" => _jokes." - Top 10", 
									"foot"=> "",
									"what" => _jokes_top,
									"img" => '<img src="top.jpg">',
									"show" => '<tr><td class="contentMainTop">Titel</td><td class="contentMainTop">Autor</td><td class="contentMainTop">Vote</td></tr>'.$row)); 
									 
break;
//#####################################################################################################
case 'floplist';
 $qry = db("SELECT * FROM ".$sql_prefix."jokes WHERE status LIKE '1' ORDER BY (SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$sql_prefix."jokes.id) ASC LIMIT 10");
        while($get = _fetch($qry))
		{ 
		
?>
<link rel="stylesheet" type="text/css" href="style.css">
<?php
	$votee = db("SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'],true,true);
$rating = round($votee[0],1);

if($rating > 0) { $hover1 = 'class="hover"';} else { $hover1 = ""; }
if($rating > 1.5) { $hover2 = 'class="hover"';} else { $hover2 = ""; }
if($rating > 2.5) { $hover3 = 'class="hover"';} else { $hover3 = ""; }
if($rating > 3.5) { $hover4 = 'class="hover"';} else { $hover4 = ""; }
if($rating > 4.5) { $hover5 = 'class="hover"';} else { $hover5 = ""; }
	$newrating = '<img src="star_blank.png" alt=""  '.$hover1.'/><img src="star_blank.png" alt=""  '.$hover2.'/><img src="star_blank.png" alt=""  '.$hover3.'/><img src="star_blank.png" alt=""  '.$hover4.'/><img src="star_blank.png" alt=""  '.$hover5.'/>';		
$votee = db("SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'],true,true);
$rating =$newrating." ".round($votee[0],1).'/5';
		          
				  $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
				  
				  $row .= show($dir."/list_row", array("autor" => autor($get['uid']),
                                                   "title" => $get['title'],
												   "date" => date("d.m.y", $get['date']),
                                                   "rating" => $rating,
												   "id" => $get['id'],
												   "class" => $class));					
							}				
  $index = show($dir."/show", array("head" => _jokes." - Flop 10", 
									"foot"=> "",
									"img" => '<img src="flop.jpg">',
									"what" => _jokes_flop,
									"show" => '<tr><td class="contentMainTop">Titel</td><td class="contentMainTop">Autor</td><td class="contentMainTop">Vote</td></tr>'.$row)); 
									 
break;
//#####################################################################################################
case 'insert';
 
 if(isset($userid)) {
 $dropdown_date = show(_dropdown_date, array("day" => dropdown("day",date("d")),
				      	                                  "month" => dropdown("month",date("m")),
                                      	          "year" => dropdown("year",date("Y"))));

		$options = '<table width="200"><tr>
		<td><label><input type="radio" name="status" value="0" id="status_1"/>'._jokes_inaktiv.'</label></td>
	</tr><tr>
		<td><label><input type="radio" name="status" value="1" id="status_2" checked="checked"/>'._jokes_nextdate.'</label></td>
	</tr><tr>
		<td><label><input type="radio" name="status" value="2" id="status_3"/>'._jokes_thisdate.'</label></td>
	</tr></table>';

        $index = show($dir."/form", array("head" => _joke_insert,
                                                 "nautor" => _autor,
												 "dropdown_date" => $dropdown_date,
                                                 "autor" => autor($userid),
                                                 "status" => _status,
												 "options" => $options,
                                                 "ntitel" => _titel,
                                                 "titel" => "",
                                                 "joketext" => "",
                                                 "error" => "",
                                                 "lang" => $language,
                                                 "button" => _button_value_add,
                                                 "linkname" => _linkname));
 } else {
	 $index = show($dir."/show", array("head" => _jokes, 
									"foot"=> "",
									"img" => "",
									"what" => "",
									"show" => "<br><br><br>"._jokes_login."<br><br><br><br>")); 
	 }
break;
case 'inserted';
if($_POST)
        {
		if($_POST['status'] == 0) { $status = 0; $date = 0;
		} elseif ($_POST['status'] == 1) { $status = 1; 
		$end = 1;
			$minneu = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
			$maxneu = mktime(23, 59, 59, date("m"), date("d"), date("Y"));
		while($end != 0) {
		$min = $minneu; $max=$maxneu;
		$end = mysql_num_rows(db("SELECT * FROM ".$sql_prefix."jokes WHERE date >= ".$min." AND date < ".$max." AND status != 0"));
		$minneu = $min + 86400;
		$maxneu = $max + 86400;
			} $date = $min;
		} elseif ($_POST['status'] == 2) { 
		$status = 1; 
		$date = mktime(0,0,0,$_POST['m'],$_POST['t'],$_POST['j']);
		$datemax = mktime(23,59,59,$_POST['m'],$_POST['t'],$_POST['j']);
		$kontrolle = mysql_num_rows(db("SELECT * FROM ".$sql_prefix."jokes WHERE date >= ".$date." AND date <= ".$datemax." AND status != 0"));
		}
		
		if($kontrolle != 0) {
//kon
			       $dropdown_date = show(_dropdown_date, array("day" => dropdown("day",$_POST['t']),
				      	                                  "month" => dropdown("month",$_POST['m']),
                                      	          "year" => dropdown("year",$_POST['j'])));

        $do = show(_jokes_edit_link, array("id" => $_GET['id']));

		$options = '<table width="200"><tr>
		<td><label><input type="radio" name="status" value="0" id="status_1" '.$checked1.'/>'._jokes_inaktiv.'</label></td>
	</tr><tr>
		<td><label><input type="radio" name="status" value="1" id="status_2" '.$checked2.'/>'._jokes_nextdate.'</label></td>
	</tr><tr>
		<td><label><input type="radio" name="status" value="2" id="status_3" checked="checked"/>'._jokes_thisdate.'</label></td>
	</tr></table>';

$error = show("errors/errortable", array("error" => _jokes_date_forgiven));

        $index = show($dir."/form", array("head" => _joke_edit,
                                                 "nautor" => _autor,
												 "dropdown_date" => $dropdown_date,
                                                 "autor" => autor($userid),
                                                 "status" => _status,
												 "options" => $options,
                                                 "ntitel" => _titel,
                                                 "titel" => re($_POST['titel']),
                                                 "joketext" => re_bbcode($_POST['jokes']),
                                                 "error" => $error,
                                                 "lang" => $language,
                                                 "button" => _button_value_add,
                                                 "linkname" => _linkname));
		
//konende												 
			}else{	
		 
            $qry = db("INSERT INTO ".$sql_prefix."jokes 
                       SET `uid`  = '".((int)$userid)."',
                           `title`    = '".up($_POST['titel'])."',
                           `content`  = '".up($_POST['jokes'],1)."',
						   `date`  = '".$date."',
                           `status`   = '0'");

$text = show(_jokes_msg, array("title" => up($_POST['titel']),
									"id" => mysql_insert_id(),
                                        "content" => up($_POST['jokes'],1),
                                        "nick" => autor($userid)));			

			$qry = db("SELECT s1.id FROM ".$db['users']." AS s1
                 LEFT JOIN ".$db['permissions']." AS s2
                 ON s1.id = s2.user
                 WHERE s2.jokes = '1' OR s1.`level` LIKE '4' GROUP BY s1.`id`");
				 
      while($get = _fetch($qry))
      {
        $qrys = db("INSERT INTO ".$db['msg']."
                    SET `datum`     = '".((int)time())."',
                        `von`       = '0',
                        `an`        = '".((int)$get['id'])."',
                        `titel`     = '"._jokes_msg_title."',
                        `nachricht` = '".up($text, 1)."'");
      }		   
          
          $index = info(_joke_added, "?action=danke");
		  }
        }
break;
//#####################################################################################################
case 'archiv';

if(isset($_POST['monat'])) $month = $_POST['monat'];
  elseif(isset($_GET['m']))  $month = $_GET['m'];
  else $month = date("m");

  if(isset($_POST['jahr'])) $year = $_POST['jahr'];
  elseif(isset($_GET['y'])) $year = $_GET['y'];
  else $year = date("Y");

for($i = 1; $i <= 12; $i++)
  {
    if($month == $i) $sel = "selected=\"selected\"";
    else $sel = "";

    $mname = array("1" => _jan,
                   "2" => _feb,
                   "3" => _mar,
                   "4" => _apr,
                   "5" => _mai,
                   "6" => _jun,
                   "7" => _jul,
                   "8" => _aug,
                   "9" => _sep,
                   "10" => _okt,
                   "11" => _nov,
                   "12" => _dez);

    $month .= show(_select_field, array("value" => cal($i),
                                        "sel" => $sel,
                                        "what" => $mname[$i]));
  }

  for( $i = date("Y")-5; $i < date("Y")+3; $i++)
  {
    if($year == $i) $sel = "selected=\"selected\"";
    else $sel = "";

    $year .= show(_select_field, array("value" => $i,
                                       "sel" => $sel,
                                       "what" => $i));
  }
  
$min = mktime(0, 0, 0,$month ,1, $year);
$max = mktime(23, 59, 59, $month+1, -1, $year);

 $qry = db("SELECT * FROM ".$sql_prefix."jokes WHERE status LIKE '1' AND date >= ".$min." AND date <= ".$max." ORDER BY date ASC");
        while($get = _fetch($qry))
		{ 
		
?>
<link rel="stylesheet" type="text/css" href="style.css">
<?php
	$votee = db("SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'],true,true);
$rating = round($votee[0],1);

if($rating > 0) { $hover1 = 'class="hover"';} else { $hover1 = ""; }
if($rating > 1.5) { $hover2 = 'class="hover"';} else { $hover2 = ""; }
if($rating > 2.5) { $hover3 = 'class="hover"';} else { $hover3 = ""; }
if($rating > 3.5) { $hover4 = 'class="hover"';} else { $hover4 = ""; }
if($rating > 4.5) { $hover5 = 'class="hover"';} else { $hover5 = ""; }
	$newrating = '<img src="star_blank.png" alt=""  '.$hover1.'/><img src="star_blank.png" alt=""  '.$hover2.'/><img src="star_blank.png" alt=""  '.$hover3.'/><img src="star_blank.png" alt=""  '.$hover4.'/><img src="star_blank.png" alt=""  '.$hover5.'/>';		
$votee = db("SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'],true,true);
$rating =$newrating." ".round($votee[0],1).'/5';
		          
				  $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;
				  
				  $row .= show($dir."/list_row", array("autor" => autor($get['uid']),
                                                   "title" => $get['title'],
												   "date" => date("d.m.y", $get['date']),
                                                   "rating" => $rating,
												   "id" => $get['id'],
												   "class" => $class));					
							}	
							
		
  $index = show($dir."/archiv", array("monate" => $month,
                                        "jahr" => $year,
										"head" => _jokes." - "._jokes_archiv, 
										"what" => _button_value_show,
									"foot"=> "",
									"show" => '<tr><td class="contentMainTop">Titel</td><td class="contentMainTop">Autor</td><td class="contentMainTop">Vote</td></tr>'.$row)); 
									 
break;
endswitch;
## SETTINGS ##
$time_end = generatetime();
$time = round($time_end - $time_start,4);
page($index, $title, $where,$time);
## OUTPUT BUFFER END ##
gz_output();
?>