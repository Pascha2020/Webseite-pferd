<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

include("templates/header.inc.php");
?>
 <div class="container small-container-330">
	<h2 >Passwort vergessen</h2>


<?php 
$showForm = true;
 
if(isset($_GET['send']) ) {
	if(!isset($_POST['email']) || empty($_POST['email'])) {
		$error = "<b>Bitte eine E-Mail-Adresse eintragen</b>";
	} else {
		$statement = $pdo->prepare("SELECT * FROM users_reiten WHERE email = :email");
		$result = $statement->execute(array('email' => $_POST['email']));
		$user = $statement->fetch();		
 
		if($user === false) {
			$error = "<b>Kein Benutzer gefunden</b>";
		} else {

			
			$passwortcode = random_string();
			$statement = $pdo->prepare("UPDATE users_reiten SET passwortcode = :passwortcode, passwortcode_time = NOW() WHERE id = :userid");
			$result = $statement->execute(array('passwortcode' => sha1($passwortcode), 'userid' => $user['id']));
			
			$empfaenger = $user['email'];
			$betreff = "Neues Passwort für deinen Account auf dem Hallenübersichtsplan"; //Ersetzt hier den Domain-Namen
			$Absendername = "Marcel Frank"; //Ersetzt hier euren Name und E-Mail-Adresse
			$email = "<mountainpro.marcel@gmail.com>";
			$extra .= "Content-Type: text/html\n";
			$extra .= "Content-Transfer-Encoding: 8bit\n";
			$url_passwortcode = getSiteURL().'passwortzuruecksetzen.php?userid='.$user['id'].'&code='.$passwortcode; //Setzt hier eure richtige Domain ein
			
			$text = 'Hallo '.$user['vorname'].',
für deinen Account auf dem Hallenübersichtsplan, wurde nach einem neuen Passwort gefragt. Um ein neues Passwort zu vergeben, rufe innerhalb der nächsten 24 Stunden die folgende Website auf:
'.$url_passwortcode.'
 
Sollte dir dein Passwort wieder eingefallen sein oder hast du dies nicht angefordert, so bitte ignoriere diese E-Mail.
 
Viele Grüße,
Marcel Frank';
			
			//echo $text;
            echo $empfaenger; ?> 
			 
			<? 
			mail($empfaenger, $betreff, $text, $Absendername, $email ); ?>
				
		<?	echo "Ein Link um dein Passwort zurückzusetzen wurde an deine E-Mail-Adresse gesendet.";	
			$showForm = false;
		} 
	}
}
 
if($showForm):
?> 
	Gib hier deine E-Mail-Adresse ein, um ein neues Passwort anzufordern.<br><br>
	 
	<?php
	if(isset($error) && !empty($error)) {
		echo $error;
	}
	
	?>
	<form action="?send=1" method="post">
		<label for="inputEmail">E-Mail</label>
		<input class="form-control" placeholder="E-Mail" name="email" type="email" value="<?php echo isset($_POST['email']) ? htmlentities($_POST['email']) : ''; ?>" required>
		<br>
		<input  class="btn btn-lg btn-primary btn-block" type="submit" value="Neues Passwort">
	</form> 
<?php
endif; //Endif von if($showForm)
?>

</div> <!-- /container -->
 

<?php 
include("templates/footer.inc.php")
?>