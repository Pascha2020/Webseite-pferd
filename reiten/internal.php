<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

include("templates/header.inc.php");
?>

<div class="container main-container">

<h1>Herzlich Willkommen!</h1>

<p>Hallo <?php echo htmlentities($user['vorname']); ?> <?php echo htmlentities($user['nachname']); ?>,<br>
  Herzlich Willkommen Bei der Reitorginisation!<br>Hier siehst du alle Reitaktivitäten der Letzten Zeit und kannst neue Hinzufügen.</p>
<p><a href="internal.php">Reittagebuch</a> | <a href="pferd_status.php">Pferd Status</a><br>
  <br>
</p>
<div class="panel panel-default">
  
  <table class="table">
<tr>
	<th>#</th>
	<th>Vorname</th>
	<th>Nachname</th>
	<th>E-Mail</th>
</tr>
<?php 
$statement = $pdo->prepare("SELECT * FROM users_reiten ORDER BY id");
$result = $statement->execute();
$count = 1;
while($row = $statement->fetch()) {
	echo "<tr>";
	echo "<td>".$count++."</td>";
	echo "<td>".$row['vorname']."</td>";
	echo "<td>".$row['nachname']."</td>";
	echo '<td><a href="mailto:'.$row['email'].'">'.$row['email'].'</a></td>';
	echo "</tr>";
}
?>
</table>
</div>
    <br>
    <div class="panel panel-default">
<table class="table">
<tr>
	<th>#</th>
	<th width="100">Datum</th>
	<th>Pferd</th>
	<th>Name reiter</th>
	<th>Was habe ich gemacht</th>
    <th>Bemerkung</th>
</tr>
<?php 
$statement = $pdo->prepare("SELECT `id`, `pferd`, `datum`, `reiter`, `id_reiter`, `was_gemacht`, `bemerkung`  FROM reiten_tagebuch ORDER BY id DESC");
$result = $statement->execute();
$count = 1;
while($row = $statement->fetch()) {
	echo "<tr>";
	echo "<td>".$count++."</td>";
	echo "<td>".$row['datum']."</td>";
	echo "<td>".$row['pferd']."</td>";
	echo "<td>".$row['reiter']."</td>";
    echo "<td>".$row['was_gemacht']."</td>";
	echo "<td>".$row['bemerkung']."</td>";
	echo "</tr>";
}
?>
</table> 
</div>


</div>
<?php 
include("templates/footer.inc.php")
?>
