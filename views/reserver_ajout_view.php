<?php 
ob_start();
?>
<div class="modification">

    <form method="POST" action="<?= URL ?>reservation/ajouterbdd" enctype="multipart/form-data">
        
    <div class="form-group">
            <label for="idreserv">Numero de reservation : </label>
            <input type="text" class="form-control" id="idreserv" name="idreserv" required>

        </div>   
    <div class="form-group">
            <label for="idvoit">Reference voiture : </label>
            <input type="text" class="form-control" id="idvoit" name="idvoit" value="<?= $idvoit?>" readonly >
        </div>
        <div class="form-group">
            <label for="idcli">Numero Client : </label>
            <select name="idcli" id="idcli" class="form-control">
                <?php for ($i=0; $i < count($listeclient); $i++) : ?>
                    <option><?= $listeclient[$i]->getIdcli(); ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="place">Numero place : </label>
            <input type="text" class="form-control" id="place" name="place" value="<?= $place?>" readonly >
        </div>

        <div class="form-group">
            <label for="date_voyage">Date de voyage : </label>
            <input type="date" class="form-control" id="date_voyage" name="date_voyage" required>
        </div>
        <div class="form-group">
            <label for="payment">Payement : </label>
            <select name="payment" id="payment" class="form-control">
                <option>Sans avance</option>
                <option>Avec avance</option>
                <option>Tout payee</option>
            </select>
        </div>
        <div class="form-group">
            <label for="montant_avance">Montant a l'avance : </label>
            <input type="text" pattern="\d+" title="Nombre entier positif seulement" class="form-control" id="montant_avance" name="montant_avance" required>
        </div>
        <button type="submit" class="btn btn-info add-new"><i class="material-icons">add</i>Ajouter</button>
    </form>
</div>
<?php
$content = ob_get_clean();
$titre = "Enregistrement d'une reservation";
require "template.php";
?>