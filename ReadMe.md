# Witze AddOn

Mit diesem AddOn bringt ihr Spaß auf eure Seite, hier eine kleine Übersicht der Funktionen:

- Witzebox im Layout (siehe Screenshot)
- Witze Top 10
- Witze Flop 10
- Witze können bewertet werden
- Witze können von Usern eingereicht werden
- Witze werden über das Admin Menü verwaltet
- etc

Am besten schaut ihr euch die Screenshots an.
Bei Problemen, Fehlern, Anregungen oder Fragen, wendet euch gerne an mich.

# Haftungsausschluss
Wir übernehmen keinerlei Verantwortung, für Schäden die durch das einbinden der Mod/des Addons entstehen. Das einbinden und nutzen erfolgt demnach auf eigene Gefahr.

Vor den einbinden der Mod/des Addons sollte eine Datenbanksicherung durchgeführt werden.

# Installation
Entpackt das Archiv in einen beliebigen Ordner. Wenn Ihr es entpackt habt, findet Ihr in den entpackten Ordner 3 weitere Ordner (_install, PHP und Template).

Damit es zu keinen Fehler kommt, müssen zuerst die Tabellen in der Datenbank angelegt werden. Hierfür haben wir einen kleinen Installer geschrieben, welchen sich im Ordner _install befindet. Ladet diesen Ordner in das Hauptverzeichnis eures deV!L'z Clanportals.

Ruft anschliesend eure Seite auf und fügt hinter die Adresse folgendes ein:

/_install/install.php

Wenn die Installation erfolgreich verlief löscht zur Sicherheit den Installer-Ordner von euren Webspace.
Nun müssen die restlichen Dateien hochgeladen werden. Den Inhalt aus dem "PHP Ordner" müsst Ihr in das Hauptverzeichnis des deV!L'z Clanportal hochladen. Das Hauptverzeichnis ist das oberste Verzeichnis des deV!L'z Clanportals in welchen sich unter anderen die Dateien __readme.html, antispam.php, index.php, popup.html und die ganzen Ordner der einzelnen Bereiche befinden.

Den Inhalt des "Templates" Ordner müsst Ihr in das Verzeichnis eures Templates hochladen (Pfad: inc/_templates_/TEMPLATE).
In eure Navigation in eurem Template müsst/könnt ihr nun noch folgende Seite verlinken

../jokes/index.php
Also http://deine-clanseite.de/jokes/

Wenn ihr die Witzebox nun in euer Template einbinden wollt, dann tut ihr das einfach in der Template index.html mit diesem Platzhalter

[jokes]
 

Nun ist das AddOn funktionsfähig, die User kommen über den neuen Link zu den Witze Funktionen.

Admin mit den Witze Rechten haben im Adminmenü einen neuen Punkt.

Und bei Bedarf habt ihr in eurem Layout eine "Witz des Tages"-Box.

