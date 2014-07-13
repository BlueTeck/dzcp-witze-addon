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
$where = "Installer";
$title = $pagetitle." - ".$where."";
## INSTALLER ##
if(isset($_POST['submit'])) {	

// neue Tabellen/Spalten anlegen
		db("CREATE TABLE ".$sql_prefix."jokes (
						`id` int(5) NOT NULL AUTO_INCREMENT,
						  `uid` int(5) NOT NULL,
						  `title` varchar(32) NOT NULL,
						  `content` text NOT NULL,
						  `date` int(12) NOT NULL DEFAULT '0',
						  `status` int(1) NOT NULL DEFAULT '0',
						PRIMARY KEY  (`id`)) ");	
						
// neue Tabellen/Spalten anlegen
		db("CREATE TABLE ".$sql_prefix."joke_rating (
						`id` int(10) NOT NULL AUTO_INCREMENT,
						  `uid` int(10) NOT NULL,
						  `jid` int(10) NOT NULL,
						  `pkt` int(1) NOT NULL,
						PRIMARY KEY  (`id`)) ");							
						
  db("INSERT INTO ".$sql_prefix."jokes (id,uid,title,content,date,status) VALUES ('1','1','Ball','Rollte ein Ball um die Ecke und f&auml;llt um.','".time()."','1')");
  
  db("ALTER TABLE ".$sql_prefix."permissions ADD `jokes` int(1) NOT NULL default '0'");		
			  

						
// Check ob Install i.O. velief		
		if(cnt($sql_prefix."jokes") > '0') {
    $show = '<tr>
               <td class="contentHead" align="center"><span class="fontGreen"><b>Installation erfolgreich!</b></span></td>
             </tr>
             <tr>
               <td class="contentMainFirst"  align="center">
                 Die ben&ouml;tigten Tabellen konnten erfolgreich erstellt werden.<br>
                 <br>
                 <b>L&ouml;sche unbedingt den installer-Ordner!</b>
               </td>
             </tr>
             <tr>
               <td class="contentBottom"></td>
             </tr>';
  } else {
    $show = '<tr>
               <td class="contentHead" align="center"><span class="fontWichtig"><b>FEHLER</b></span></td>
             </tr>
             <tr>
               <td class="contentMainFirst" align="center">
                 Bei der Installation des Addons ist ein Fehler aufgetreten. Bitte &uuml;berpr&uuml;fe deine Datenbank auf Sch&auml;den und versuche die Installation erneut.
               </td>
             </tr>
             <tr>
               <td class="contentBottom"></td>
             </tr>';
  }
} else {
  $show = '<tr>
             <td class="contentHead" align="center"><b>Jokes-Addon - Installation</b></td>
           </tr>
           <tr>
             <td class="contentMainFirst" align="center">
               Hallo und herzlichen Dank, dass du dieses Addon für das deV!L’z Clanportal von BlueTeck 
               heruntergeladen hast. Dieser Installer soll dir die Arbeit abnehmen, die ben&ouml;tigten Tabellen in der Datenbank manuell erstellen zu m&uuml;ssen.<b>
               <br /><br />
               <b><span style="text-align:center"><u>!!!! WICHTIG !!!!</u></span><br />Erstell vor dem ausf&uuml;hren des Installers ein Datenbank BackUp. Wir haften f&uuml;r keine Sch&auml;den!</b><br />
               <br />
             </td>
           </tr>
           <tr>
             <td class="contentBottom" align="center">
               <form action="?action=install" method="POST">
                 <input class="submit" type="submit" name="submit" value="Tabellen anlegen">
               </form>
             </td>
           </tr>';
}
## SETTINGS ##
$time_end = generatetime();
$time = round($time_end - $time_start,4);
page($show, $title, $where,$time);
?>
