<?php
/**
 * A complete login script with registration and members area.
 *
 * @author: Nils Reimers / http://www.php-einfach.de/experte/php-codebeispiele/loginscript/
 * @license: GNU GPLv3
 */
 
//Tragt hier eure Verbindungsdaten zur Datenbank ein
$db_host = 'mySQL20.webland.ch';
$db_name = 'helil_techniks';
$db_user = 'helil_techniks';
$db_password = '4545domdom';
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);

