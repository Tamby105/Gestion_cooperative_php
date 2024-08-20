<?php 
ob_start(); 
?>
<div class="modification">
    <form method="POST" action="<?= URL ?>client/modifBdd" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" class="form-control" id="idcli" name="idcli" value="<?= $clients->getIdcli() ?>">
        </div>
        <div class="form-group">
            <label for="nom">Nom client : </label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= $clients->getnom() ?>" required>
        </div>
        <div class="form-group">
            <label for="numtel">Numero telephone : </label>
            <input type="text" class="form-control" id="numtel" name="numtel" value="<?= $clients->getnumtel() ?>" required>
        </div>
        <button type="submit" class="btn btn-info add-new">Enregistrer</button>
    </form>
</div>
<?php
$content = ob_get_clean();
$titre = "Modification client : ".$clients->getIdcli();
require "template.php";
?>