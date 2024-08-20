<?php ob_start(); ?>

    <div class="form-group">
        <table>
            <tr><td style='background-color: #EEF5FF;'>
    <img src='public/bleu.png' alt='volant' style='width:50px ; height: auto; padding-left: 3px; background-color: #EEF5FF;'>
    <b>Place libre</b>
    </td>
    
    </tr>
    <tr>
    <td style='background-color: #EEF5FF;'>  
    <img src='public/seza.png' alt='volant' style='width:50px ; height: auto; padding-left: 3px; background-color: #EEF5FF;'>
    <b>Place occupee</b>

    </td>
    </tr>
    </table>
    </div>

<form method="POST" action="<?= URL ?>reserver/interfaceajout" enctype="multipart/form-data">
    <div class="voitures" style='align: center'>
        <?php 
        // Tableau pour stocker les occupations de chaque voiture
        $occupations_par_voiture = array();

        // Regroupement des occupations par voiture
        foreach ($places as $place) {
            $idvoit = $place->getidvoit();
            $place_number = $place->getplace();
            $occupation = $place->getoccupation();
            
            // Stockage de l'occupation dans le tableau associatif
            if (!isset($occupations_par_voiture[$idvoit])) {
                $occupations_par_voiture[$idvoit] = array();
            }
            $occupations_par_voiture[$idvoit][] = array('place' => $place_number, 'occupation' => $occupation);
        }

        // Affichage de chaque voiture avec ses occupations regroupées dans un tableau
        foreach ($occupations_par_voiture as $idvoit => $occupations) {
            $voiturebyId = $this->voitures->getvoitureById("$idvoit");
            $voiture_type = $voiturebyId->gettypes();
            $frais = $voiturebyId->getfrais();
            $largeur_voiture = 4 * 40; // Supposant que chaque place a une largeur de 40px

            echo "<div class='voiture' style='display: inline-block; margin: 10px; border : 1px solid #000000; border-radius: 10px;'>";
            echo "<h3>$idvoit:$voiture_type<br> $frais Ar</h3>";
            echo "<table>";

            // Première ligne avec deux liens images vides
            echo "<tr>";

            // Si la voiture est de type VIP, afficher une place spéciale
            if ($voiture_type == 'V.I.P') {
                echo "<td><div class='icon-container'><img src='public/volant.png' alt='volant' style='width:40px ; height: auto; padding-left: 3px;'></div></td>";
                echo "<td><div class='icon-container'style='width:40px ; height: auto; padding-left: 3px;'></div></td>";
                
                for ($j = 0; $j < min(1, count($occupations)); $j++) {
                    $place_info = $occupations[$j];
                    $place_number = $place_info['place'];
                    $occupation = $place_info['occupation'];
                    $icon_path = ($occupation == 'oui') ? 'public/seza.png' : 'public/bleu.png';

                    echo "<td><div class='icon-container'>";
                    if ($occupation != 'oui') {
                        echo "<a href='" . URL . "reservation/interfaceajout/$place_number/$idvoit'>";
                    }
                    echo "<img src='$icon_path' alt='$place_number' style='width: 40px; height: 40px;'>";
                    if ($occupation != 'oui') {
                        echo "</a>";
                    }
                    echo "<br>$place_number</div></td>";
                }
                
                // Affichage des occupations restantes à partir de la quatrième cellule
                for ($i = 1; $i < count($occupations); $i += 2) {
                    echo "<tr>";
                    //echo "<td></td>";
                    // Affichage des deux premières occupations (sauf pour les voitures VIP)
                    for ($j = $i; $j < min($i + 2, count($occupations)); $j++) {
                        $place_info = $occupations[$j];
                        $place_number = $place_info['place'];
                        $occupation = $place_info['occupation'];
                        $icon_path = ($occupation == 'oui') ? 'public/seza.png' : 'public/bleu.png';

                    echo "<td><div class='icon-container'>";
                    if ($occupation != 'oui') {
                        echo "<a href='" . URL . "reservation/interfaceajout/$place_number/$idvoit'>";
                    }
                    echo "<img src='$icon_path' alt='$place_number' style='width: 40px; height: 40px;'>";
                    if ($occupation != 'oui') {
                        echo "</a>";
                    }
                    echo "<br>$place_number</div><td></td></td>";                        
                        
                    }
                    
                    // Troisième cellule vide
                    
                    
                    echo "</tr>";
                }
                
            } else {
                echo "<td><div class='icon-container'><img src='public/volant.png' alt='volant' style='width:40px ; height: auto; padding-left: 3px;'></div></td>";
                echo "<td><div class='icon-container'><img src='lien_image_vide' alt=''></div></td>";
                echo "<td><div class='icon-container' style='width:40px ; height: auto; padding-left: 3px;'></div></td>";

                for ($j = 0; $j < min(2, count($occupations)); $j++) 
                {
                    $place_info = $occupations[$j];
                    $place_number = $place_info['place'];
                    $occupation = $place_info['occupation'];
                    $icon_path = ($occupation == 'oui') ? 'public/seza.png' : 'public/bleu.png';

                    echo "<td><div class='icon-container'>";
                    if ($occupation != 'oui') {
                        echo "<a href='" . URL . "reservation/interfaceajout/$place_number/$idvoit'>";
                    }
                    echo "<img src='$icon_path' alt='$place_number' style='width: 40px; height: 40px;'>";
                    if ($occupation != 'oui') {
                        echo "</a>";
                    }
                    echo "<br>$place_number</div></td>";
                }
        
                // Affichage des occupations restantes à partir de la quatrième cellule
                for ($i = 2; $i < count($occupations); $i += 4) {
                    echo "<tr>";
                    
                    // Affichage des deux premières occupations (sauf pour les voitures VIP)
                    for ($j = $i; $j < min($i + 2, count($occupations)); $j++) {
                        $place_info = $occupations[$j];
                        $place_number = $place_info['place'];
                        $occupation = $place_info['occupation'];
                        $icon_path = ($occupation == 'oui') ? 'public/seza.png' : 'public/bleu.png';

                    echo "<td><div class='icon-container'>";
                    if ($occupation != 'oui') {
                        echo "<a href='" . URL . "reservation/interfaceajout/$place_number/$idvoit'>";
                    }
                    echo "<img src='$icon_path' alt='$place_number' style='width: 40px; height: 40px;'>";
                    if ($occupation != 'oui') {
                        echo "</a>";
                    }
                    echo "<br>$place_number</div></td>";                        
                    }
                    
                    // Cellule vide à la cinquième position
                    echo "<td></td>";
                    
                    // Affichage des places restantes dans les cellules suivantes
                    for ($j = $i + 2; $j < min($i + 4, count($occupations)); $j++) {
                        $place_info = $occupations[$j];
                        $place_number = $place_info['place'];
                        $occupation = $place_info['occupation'];
                        $icon_path = ($occupation == 'oui') ? 'public/seza.png' : 'public/bleu.png';

                    echo "<td><div class='icon-container'>";
                    if ($occupation != 'oui') {
                        echo "<a href='" . URL . "reservation/interfaceajout/$place_number/$idvoit'>";
                    }
                    echo "<img src='$icon_path' alt='$place_number' style='width: 40px; height: 40px;'>";
                    if ($occupation != 'oui') {
                        echo "</a>";
                    }
                    echo "<br>$place_number</div></td>";
                    }
                    
                    echo "</tr>";
                }

            }

            // Affichage des deux premières occupations (sauf pour les voitures VIP)
            
            

            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>
</form>

<?php
$content = ob_get_clean();
$titre = "Les places de la coopérative";
require "template.php";
?>
