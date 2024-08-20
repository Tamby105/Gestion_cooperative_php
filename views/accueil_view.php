<?php 
ob_start(); 
?>
<div class="special">
    <h8 class="accueil">
        Bonjour et bienvenue a vous   <br>
        sur notre Projet PHP de deuxieme annee de licence concernant<br>
        <b>la realisation d'une application web pour une gestion de reservation de place de cooperative</b><br><br><br><br><br>
        Bonne navigation et utilisation
    </h8>
</div>
<?php
$content = ob_get_clean();
$titre = "RESERVATION DES PLACES DE COOPERATIVES";
require "template.php";
?>