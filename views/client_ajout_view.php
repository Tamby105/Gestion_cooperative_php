<?php 
ob_start(); 
?>
<div class="modification">

    <form method="POST" action="<?= URL ?>client/ajouterbdd" enctype="multipart/form-data">
        <div class="form-group">
            <label for="idcli">Reference client : </label>
            <input type="text" class="form-control" id="idcli" name="idcli" required>
        </div>
        <div class="form-group">
            <label for="nom">Nom client: </label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="numtel">Numero telephone : </label>
            <input type="text" class="form-control" id="numtel" name="numtel" required>
        </div>
        <button type="submit" class="btn btn-info add-new"><i class="material-icons">add</i>Ajouter</button>
    </form>
</div>
<?php
$content = ob_get_clean();
$titre = "Ajout d'un client";
require "template.php";
?>