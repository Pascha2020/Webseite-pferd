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

<h1>Pferde</h1>

<p>Hallo <?php echo htmlentities($user['vorname']); ?> <?php echo htmlentities($user['nachname']); ?>,
  <br> Herzlich Willkommen bei der Reitorginisation. Hier kannst du deine Aktivitäten eintragen und die letzten Aktivitäten ablesen.</p>
<p><a href="internal.php">Reittagebuch</a> | <a href="pferd_status.php">Pferd Status</a><br>
  <br>
</p>

    <div class="panel panel-default">
    

<table width="1140" class="table">
<tr>
	<th width="54">#</th>
    <th width="65">Foto</th>
	<th width="71">Name Pferd</th>
	<th width="90">Besitzer</th>
	<th width="69">Tierarzt</th>
	<th width="91">Hufschmied</th>
    <th width="136">Kommentar</th>
    <th width="65">&nbsp;</th>
</tr>

<?php 
$statement = $pdo->prepare("SELECT `id`, `foto`, `name_pferd`, `besitzer`, `tierarzt`, `hufschmied`, `bemerkung` FROM reiten_pferde  ORDER BY id");
$result = $statement->execute();
$count = 1;
while($row = $statement->fetch()) { ?>
   
    
	<tr>
	<td> <? echo $row['id']; ?> </td>
        <td> <a href="images/<? echo $row['foto'];?>" target="_blank"><img height="20px" width="20px" src="images/<? echo $row['foto'];?>"/></a></td>
        <td> <? echo $row['name_pferd']; ?></td>
        <td> <? echo $row['besitzer'];?> </td>
        <td> <? echo $row['tierarzt'];?></td>
        <td> </td>
        <td> <?  ?> </td>
  
    <td><a href="aktivitaet_eintragen.php?Pferd=<? echo $row['name_pferd']; ?>&Name=<? echo $row['Name']; ?>">Aktivität eintragen</a></td>
    </tr>
<?php }
?>
</table> 
</div>


</div>
<?php 
include("templates/footer.inc.php")
?>
