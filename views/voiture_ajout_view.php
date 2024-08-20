<?php 
ob_start(); 
?>
<div class="modification">

    <form method="POST" action="<?= URL ?>voiture/ajouterbdd" enctype="multipart/form-data">
        <div class="form-group">
            <label for="idvoit">Reference voiture : </label>
            <input type="text" class="form-control" id="idvoit" name="idvoit" required>
        </div>
        <div class="form-group">
            <label for="design">Design : </label>
            <input type="text" class="form-control" id="design" name="design" required>
        </div>
        <div class="form-group">
            <label for="types">Types : </label>
            <select name="types" id="types" class="form-control">
                <option value="Lite">Lite</option>
                <option value="Premium">Premium</option>
                <option value="V.I.P">V.I.P</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nbrplace">Nombre de place : </label>
            <input type="text" class="form-control" id="nbrplace" name="nbrplace" readonly>
        </div>
        <div class="form-group">
            <label for="frais">Frais : </label>
            <input type="text" class="form-control" id="frais" name="frais" readonly>
        </div>
        <button type="submit" class="btn btn-info add-new"><i class="material-icons">add</i>Ajouter</button>
    </form>
</div>

<script>
    // Fonction pour mettre à jour le nombre de places et les frais lorsque l'option est modifiée
    document.getElementById("types").addEventListener("change", function() {
        var select = document.getElementById("types");
        var nbrplaceInput = document.getElementById("nbrplace");
        var fraisInput = document.getElementById("frais");

        // Récupérer la valeur sélectionnée dans le menu déroulant
        var selectedValue = select.value;

        // Déterminer le nombre de places en fonction de la valeur sélectionnée
        var nbrplace = 18; // Valeur par défaut
        switch (selectedValue) {
            case "V.I.P":
                nbrplace = 9;
                break;
            // Ajouter d'autres cas pour d'autres types si nécessaire
        }

        // Mettre à jour la valeur du champ "Nombre de place"
        nbrplaceInput.value = nbrplace;

        // Déterminer les frais en fonction de la valeur sélectionnée
        var frais = 0; // Valeur par défaut
        switch (selectedValue) {
            case "Lite":
                frais = 40000;
                break;
            case "Premium":
                frais = 100000;
                break;
            case "V.I.P":
                frais = 150000;
                break;
        }

        // Mettre à jour la valeur du champ "Frais"
        fraisInput.value = frais;
    });

    // Mettre à jour les frais lorsque le menu déroulant est cliqué
    document.getElementById("types").addEventListener("click", function() {
        var select = document.getElementById("types");
        var fraisInput = document.getElementById("frais");

        // Récupérer la valeur sélectionnée dans le menu déroulant
        var selectedValue = select.value;

        // Déterminer les frais en fonction de la valeur sélectionnée
        var frais = 0; // Valeur par défaut
        switch (selectedValue) {
            case "Lite":
                frais = 40000;
                break;
            case "Premium":
                frais = 100000;
                break;
            case "V.I.P":
                frais = 150000;
                break;
        }

        // Mettre à jour la valeur du champ "Frais"
        fraisInput.value = frais;
    });
</script>


<?php
$content = ob_get_clean();
$titre = "Ajout d'une voiture";
require "template.php";
?>