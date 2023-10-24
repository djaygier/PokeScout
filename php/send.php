<?php
$db = new SQLite3(filename: '../dbs/database.db');

$db->busyTimeout(milliseconds: 3000);

$naam = SQLite3::escapeString(($_POST["name"]));

$achternaam = SQLite3::escapeString(($_POST["surname"]));

$telefoonnummer = SQLite3::escapeString(($_POST["telefoonnummer"]));

$email = SQLite3::escapeString(($_POST["email"]));

$bericht = SQLite3::escapeString(($_POST["bericht"]));


$query =

    "INSERT INTO berichten (naam, achternaam, telefoonnummer, email, naam)

VALUES ('$naam','$achternaam','$telefoonnummer','$email', '$naam')";

$db->exec($query);

?>