<?php
/////////// ADMINNAVI \\\\\\\\\
// Typ:       contentmenu
// Rechte:    permission('jokes')
///////////////////////////////
if(_adminMenu != 'true') exit;

    $where = $where.': '._jokes;
    if(permission("jokes"))
    {
      //$wysiwyg = '_word';
      if($_GET['do'] == "add")
      {
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

        $show = show($dir."/jokes_form", array("head" => _joke_edit,
                                                 "nautor" => _autor,
												 "dropdown_date" => $dropdown_date,
                                                 "autor" => autor($userid),
                                                 "do" => "insert",
												 "status" => _status,
												 "options" => $options,
                                                 "ntitel" => _titel,
                                                 "titel" => "",
                                                 "joketext" => "",
                                                 "error" => "",
                                                 "lang" => $language,
                                                 "button" => _button_value_add,
                                                 "linkname" => _linkname));
      } elseif($_GET['do'] == "insert") {
  	    
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

        $show = show($dir."/jokes_form", array("head" => _joke_edit,
                                                 "nautor" => _autor,
												 "dropdown_date" => $dropdown_date,
                                                 "autor" => autor($userid),
                                                 "do" => "insert",
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
                           `status`   = '".$status."'");
          
          $show = info(_joke_added, "?admin=jokes");
		  }
        }
      } elseif($_GET['do'] == "edit") {
//##################################		  
        $qry = db("SELECT * FROM ".$sql_prefix."jokes
                   WHERE id = '".intval($_GET['id'])."'");
        $get = _fetch($qry);

       $dropdown_date = show(_dropdown_date, array("day" => dropdown("day",date("d",$get['date'])),
				      	                                  "month" => dropdown("month",date("m",$get['date'])),
                                      	          "year" => dropdown("year",date("Y",$get['date']))));

        $do = show(_jokes_edit_link, array("id" => $_GET['id']));

if($get['status'] == 0) { $checked1 =  'checked="checked"';
} elseif ($get['status'] == 1 AND $get['date'] == 0) {$checked2 =  'checked="checked"';
} elseif ($get['status'] == 1 AND $get['date'] != 0) {$checked3 =  'checked="checked"';
}

		$options = '<table width="200"><tr>
		<td><label><input type="radio" name="status" value="0" id="status_1" '.$checked1.'/>'._jokes_inaktiv.'</label></td>
	</tr><tr>
		<td><label><input type="radio" name="status" value="1" id="status_2" '.$checked2.'/>'._jokes_nextdate.'</label></td>
	</tr><tr>
		<td><label><input type="radio" name="status" value="2" id="status_3" '.$checked3.'/>'._jokes_thisdate.'</label></td>
	</tr></table>';

        $show = show($dir."/jokes_form", array("head" => _joke_edit,
                                                 "nautor" => _autor,
												 "dropdown_date" => $dropdown_date,
                                                 "autor" => autor($get['uid']),
                                                 "do" => $do,
												 "status" => _status,
												 "options" => $options,
                                                 "ntitel" => _titel,
                                                 "titel" => re($get['title']),
                                                 "joketext" => re_bbcode($get['content']),
                                                 "error" => "",
                                                 "lang" => $language,
                                                 "button" => _button_value_edit,
                                                 "linkname" => _linkname));
      } elseif($_GET['do'] == "editjokes") {
//################################		  
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
		$kontrolle = mysql_num_rows(db("SELECT * FROM ".$sql_prefix."jokes WHERE date >= ".$date." AND date <= ".$datemax." AND status != 0 AND id != '".$_GET['id']."'"));
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

        $show = show($dir."/jokes_form", array("head" => _joke_edit,
                                                 "nautor" => _autor,
												 "dropdown_date" => $dropdown_date,
                                                 "autor" => "-",
                                                 "do" => $do,
												 "status" => _status,
												 "options" => $options,
                                                 "ntitel" => _titel,
                                                 "titel" => re($_POST['titel']),
                                                 "joketext" => re_bbcode($_POST['jokes']),
                                                 "error" => $error,
                                                 "lang" => $language,
                                                 "button" => _button_value_edit,
                                                 "linkname" => _linkname));
		
//konende												 
			}else{	
          $qry = db("UPDATE ".$sql_prefix."jokes 
                     SET `date`  = '".$date."',
					 	 `title`  = '".up($_POST['titel'])."',
                         `content`   = '".up($_POST['jokes'],1)."',
                         `status`  = '".$status."'
                     WHERE id = '".intval($_GET['id'])."'");
					 
        $show = info(_joke_edited, "?admin=jokes");
		}
        }
      } elseif($_GET['do'] == "delete") {
//###############################		  
        $qry = db("DELETE FROM ".$sql_prefix."jokes 
                   WHERE id = '".intval($_GET['id'])."'");
		$qryr = db("DELETE FROM ".$sql_prefix."joke_rating 
                   WHERE jid = '".intval($_GET['id'])."'");		   
        $show = info(_joke_deleted, "?admin=jokes");
      } elseif($_GET['do'] == 'public') {
//###############################
        if($_GET['what'] == 'set')
        {
			$end = 1;
			$minneu = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
			$maxneu = mktime(23, 59, 59, date("m"), date("d"), date("Y"));
		while($end != 0) {
		$min = $minneu; $max=$maxneu;
		$end = mysql_num_rows(db("SELECT * FROM ".$sql_prefix."jokes WHERE date >= ".$min." AND date < ".$max." AND status != 0"));
		$minneu = $min + 86400;
		$maxneu = $max + 86400;
			}
				
          $upd = db("UPDATE ".$sql_prefix."jokes
                     SET `status` = '1',
          					     `date`  = '".$min."'
                     WHERE id = '".intval($_GET['id'])."'");
        } elseif($_GET['what'] == 'unset') {
          $upd = db("UPDATE ".$sql_prefix."jokes 
                     SET `status` = '0'
                     WHERE id = '".intval($_GET['id'])."'");
        }

        header("Location: ?admin=jokes&status=".$_GET['status']);
      } else {
//###############################
//############ Liste ############	  
        
	  
  if(isset($_POST['jahr']) AND isset($_POST['monat'])) {$month = $_POST['monat']; $year = $_POST['jahr']; $status = "date";}
  elseif(isset($_GET['y']) AND isset($_GET['m'])) {$month = $_GET['m'];$year = $_GET['y']; $status = "date";}
  else {$month = date("m");  $year = date("Y"); $status = $_GET['status'];}



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

    $monat .= show(_select_field, array("value" => cal($i),
                                        "sel" => $sel,
                                        "what" => $mname[$i]));
  }

  for( $i = date("Y")-5; $i < date("Y")+3; $i++)
  {
    if($year == $i) $sel = "selected=\"selected\"";
    else $sel = "";

    $jahr .= show(_select_field, array("value" => $i,
                                       "sel" => $sel,
                                       "what" => $i));
  }
	
$mindate = mktime(0, 0, 0,$month ,1, $year);
$maxdate = mktime(23, 59, 59, $month+1, -1, $year);
		
		if($status == 'archiv') {
			$head = _jokes." - "._jokes_archiv;
			  $wheresql = "WHERE date <= ".time()." AND status != 0 "; 
			  }
			  elseif ($status == 'planned'){
				  $head = _jokes." - "._jokes_geplant;
				  $wheresql = "WHERE date >= ".time()." AND status != 0 ";
				  }
				   elseif ($status == 'id'){
				  $head = _jokes." - ".ID;
				  $wheresql = 'WHERE id LIKE '.$_GET["id"].'';
				  }
				  elseif ($status == 'new'){
					  $head = _jokes." - "._jokes_unbearbeitet;
				  $wheresql = "WHERE status LIKE 0";
				  } 
				  elseif ($status == 'all') { $head = _jokes." - "._all; $wheresql =""; 
				  }
        			elseif ($status=="date") { $head = _jokes." - "._datum; $wheresql ="WHERE date >= ".$mindate." AND date <= ".$maxdate." AND status != 0"; 
					} 
					else { $head = _jokes." - "._all; $wheresql =""; }
 
        
		$nav = 'Filter: <a href="?admin=jokes&status=new">'._jokes_unbearbeitet.'</a> | 
		<a href="?admin=jokes&status=planned">'._jokes_geplant.'</a> | 
		<a href="?admin=jokes&status=archiv">'._jokes_archiv.'</a> | 
		<a href="?admin=jokes&status=all">'._all.'</a>';
		
			
        $qry = db("SELECT * FROM ".$sql_prefix."jokes ".$wheresql."
                   ORDER BY `status` ASC,`date` ASC");
        
		while($get = _fetch($qry))
        {
          $edit = show("page/button_edit_single", array("id" => $get['id'],
                                                        "action" => "admin=jokes&amp;do=edit",
                                                        "title" => _button_title_edit));
          $delete = show("page/button_delete_single", array("id" => $get['id'],
                                                            "action" => "admin=jokes&amp;do=delete",
                                                            "title" => _button_title_del,
                                                            "del" => convSpace(_confirm_del_joke)));
          
  
          $class = ($color % 2) ? "contentMainSecond" : "contentMainFirst"; $color++;

          $public = ($get['status'] != 0)
               ? '<a href="?admin=jokes&amp;status='.$_GET['status'].'&amp;do=public&amp;id='.$get['id'].'&amp;what=unset"><img src="../inc/images/public.gif" alt="" title="'._non_public.'" /></a>'
               : '<a href="?admin=jokes&amp;status='.$_GET['status'].'&amp;do=public&amp;id='.$get['id'].'&amp;what=set"><img src="../inc/images/nonpublic.gif" alt="" title="'._public.'" /></a>';

//rating
$votee = mysql_fetch_array(db("SELECT avg(pkt) AS rating FROM ".$sql_prefix."joke_rating WHERE jid LIKE ".$get['id'].""));
$rating = round($votee[0],1).'/5';		 
//Status
		  $heute = mktime(23, 59, 59, date("m"), date("d"), date("Y"));		  
		  if($get['status'] == '0' OR $get['date'] == 0) {$status = "--.--.-- "._jokes_unbearbeitet;} 
		  elseif($get['status'] == '1' AND $get['date'] >= $heute) {$status = date("d.m.y", $get['date'])." "._jokes_geplant;}
		  elseif($get['status'] == '1' AND $get['date'] <= $heute) {$status = date("d.m.y", $get['date'])." "._jokes_archiv;}

 if($allowHover == 1) {
          $hover = 'onmouseover="DZCP.showInfo(\'<tr><td colspan=2 align=center padding=3 class=infoTop>'.jsconvert(re($get['title'])).'</td></tr><tr><td>'.$get['content'].'</td></tr>\')" onmouseout="DZCP.hideInfo()"';
		  }
		  
$titel = show(_jokes_show_link, array("titel" => re(cut($get['title'],$lnewsadmin)),
												   "hover" => $hover,
                                                  "id" => $get['id']));
											  
		 
		  
          $show_ .= show($dir."/jokes_row", array("status" => $status,
                                                   "titel" => $titel,
                                                   "rating" => " Vote: ".$rating,
												   "class" => $class,
                                                   "autor" => autor($get['uid']),
  							  				       "public" => $public,
                                                   "edit" => $edit,											   
                                                   "delete" => $delete));
        }
        
        $show = show($dir."/jokes_show", array("head" => $head,
                                               "nav" => $nav,
                                               "autor" => _autor,
                                               "titel" => _titel,
                                               "date" => _status,
                                               "show" => $show_,
                                               "val" => "jokes",
											   "monate" => $monat,
                                        "jahr" => $jahr,
										"what" => _button_value_show,
                                               "edit" => _editicon_blank,
                                               "delete" => _deleteicon_blank,
                                               "add" => _joke_add));
      }
    } else {
      $show = error(_error_wrong_permissions, 1);
    }
?>