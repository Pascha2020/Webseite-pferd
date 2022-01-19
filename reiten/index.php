<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
include("templates/header.inc.php")
?>

  

    

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Registrierung</h1>
        <p>Pferde Kontrollübersicht</p>
        <p><a class="btn btn-primary btn-lg" href="register.php" role="button">Jetzt registrieren</a></p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Features</h2>
          <ul>
          	<li>Registrierung & Login</li> 
          	<li>Interner Mitgliederbereich</li>
          	<li>Responsive Webdesign, ideal für PC, Tablet und Smartphone</li>
          	<li>pferd_status </li>
          	<li>Kontrolliste</li>
          </ul>
         
        </div>
        <div class="col-md-4">
          <h2>Dokumentation</h2>
          <p>direkt auf der Seite</p>
       </div>
        <div class="col-md-4">
          <h2>Webhosting</h2>
          <p>&nbsp;</p>
        </div>
      </div>
	</div> <!-- /container -->
      

  
<?php 
include("templates/footer.inc.php")
?>
