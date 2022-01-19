<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

$pferd = $_GET['Pferd'];
$name = $_GET['Name'];
$tierarzt = $_GET['Tierarzt'];



//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

include("templates/header.inc.php");
?>

<div class="container main-container ">
<h1>Aktivität eintragen</h1>
<p></p>
<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
	$error = false;
	$vorname = trim($_POST['vorname']);
	$nachname = trim($_POST['nachname']);
    $id_reiter = trim($_POST['id_reiter']);
    $reiter= $vorname." ".$nachname;
	  $datum = trim($_POST['datum']);
    $pferd= trim($_POST['pferd']);
    $was_gemacht = trim($_POST['was_gemacht']);
	  $bemerkung = trim($_POST['bemerkung']);
    $besitzer = trim($_POST['besitzer']);
    $hufschmied = trim($_POST['hufschmied']);
   
    //|| empty($was_gemacht)
    
	
	  if(empty($vorname) || empty($nachname) || empty($datum) || empty($was_gemacht)){
    echo 'Bitte alle Felder ausfüllen<br>';
		$error = true;
        $error_2 = true;
	}
   // if(strlen($was_gemacht) == 0) {
		//echo 'Bitte Kontrollpunkt auswählen<br>';
		//$error = true;
        //$error_2 = true;
	//}
    
    if(check_date($datum,"Ymd","-"))
        { } else {
        echo 'Datum Format nicht korrekt<br>';
        $error = true;
        $error_2 = true;
	}
    if(strlen($pferd) == 0) {
        
        echo 'Bitte Pferd auswählen<br>';
		    $error_2 = true;
        
    }
	
	
	//Keine Fehler, wir können den Nutzer registrieren
	if(!$error) {	
  }
		
		
		$statement = $pdo->prepare("INSERT INTO reiten_tagebuch (pferd, datum, reiter, id_reiter, was_gemacht, bemerkung ) VALUES (:pferd, :datum, :reiter, :id_reiter, :was_gemacht, :bemerkung)");
		$result = $statement->execute(array('pferd' => $pferd, 'datum' => $datum,  'reiter' => $reiter, 'id_reiter' => $id_reiter, 'was_gemacht' => $was_gemacht, 'bemerkung' => $bemerkung));
		
		if($result) {		
			echo 'Aktivität wurde erfolreich eingetragen. <a href="internal.php">Zur Kontrollübersicht</a><br>';
            
			$showFormular = false;
		} else {
			echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
            echo $statement->errorInfo()[2];
		}
	}
    if(!$error_2) {	
		
		
		$statement = $pdo->prepare("UPDATE reiten_pferde SET `besitzer`= :besitzer, `letzter_reittag`= :letzter_reittag, `hufschmied`= :hufschmied, `bemerkung`= :bemerkung
        WHERE name_pferd = :pferd");
		$result = $statement->execute(array('besitzer' => $besitzer, 'letzter_reittag'=> $datum, 'hufschmied'=> $hufschmied,  'bemerkung'=> $bemerkung, 'pferd' => $pferd ));
		
		if($result) {		
			
		} else {
			echo 'Beim Abspeichern ist leider ein Fehler aufgetreten!!!!<br>';
            echo $statement->errorInfo()[2];
		}
	} 


if($showFormular) { 
?>
    <? // `id`, `pferd`, `foto`, `express`, `express_date`, `wand`, `wand_date`, `umlenkung`, `umlenkung_date`, `toprope_seil`, `toprope_kontrolle_date`, `topropeseil_change_date`, `bemerkung`
$statement = $pdo->prepare("SELECT * FROM reiten_pferde WHERE name_pferd	= '$pferd'");
$statement->execute(array('1'));   
while($rows = $statement->fetch()) { 
   
}   
 ?>
    
<div class="panel panel-default">
<form <? echo 'action="?register=1&pferd='.$pferd.'"'; ?> method="post">

<table class="table">
<tr>
  <th colspan="2" height="23" align="left">Ausgeführt durch:</th>
  <th >&nbsp;</th>
  
</tr>
<tr>
  <td width="164" height="23" align="left">Vorname:</td>
  <td width="89"><?php echo htmlentities($user['vorname']); echo "<input type='hidden' size='15' name='vorname' value='".$user['vorname']."' />";?><?php echo "<input type='hidden' size='15' name='id_reiter' value='".$user['id']."' />";?></td>
  <td width="800">&nbsp;</td>
</tr>
<tr>
  <td>Nachname:</td>
  <td><?php echo htmlentities($user['nachname']); echo "<input type='hidden' size='15' name='nachname' value='".$user['nachname']."' />";?></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>Ausgeführt am:</td>
  <td><?php $timestamp = time();
$datum = date("Y-m-d", $timestamp);
echo "<input type='datum' size='10' name='datum' value='".$datum."' class='form-control' required/>";?></td>
  <td>jjjj-mm-tt</td>
  
</tr>
<tr>
 
  <td>Was habe ich mit <?php echo $pferd; ?> gemacht: <?php echo "<input type='hidden' size='5' name='pferd' value='".$pferd."' />";?></td>
  <td><select name="was_gemacht" id="was_gemacht">
    <option value="">Bitte auswählen</option>
    <optgroup label="Ausreiten">
    <option value="Buchberg">Buchberg</option>
      <option value="Benknerbüchel">Benknerbüchel</option>
      <option value="Ried">Ried</option>
    </optgroup>
    <optgroup label="Platz">
      <option value="Normal">Normal</option>
      <option value="Stangenarbeit">Stangenarbeit</option>
      <option value="Springen">Springen</option>
      <option value="Dressur">Dressur</option>
      <option value="Roundpen/Longieren">Roundpen/Longieren</option>
    </optgroup>
    
   </select>
   </td>
   <td>&nbsp;</td>
</tr> 


<tr>
  <td>Bemerkungen:</td>
  <td colspan="2"><label for="bemerkung"></label>
    <textarea name="bemerkung" cols="80" rows="3" id="bemerkung"></textarea></td>
  </tr>

<tr>
  <td>&nbsp;</td>
  <td><button type="submit" class="btn btn-lg btn-primary btn-block">eintragen</button></td>
  <td>&nbsp;</td>
  </tr>


  </table>

</form>
 
<?php
}//Ende von if($showFormular)
	

?>
    </div>
</div>

</div>
<?php 
include("templates/footer.inc.php")
?>
