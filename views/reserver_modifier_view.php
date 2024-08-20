<?php 
ob_start(); 
?>
<div class="modification">

    <form method="POST" action="<?= URL ?>reservation/modifBdd" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" class="form-control" id="idreserv" name="idreserv" value="<?= $reserver->getidreserv() ?>">
        </div>
        <div class="form-group">
            <label for="idvoit">Reference voiture : </label>
            <select name="idvoit" id="idvoit" class="form-control">
                <?php for ($i=0; $i < count($listevoit); $i++) : ?>
                    <option value="<?= $listevoit[$i]->getidvoit(); ?>"><?= $listevoit[$i]->getidvoit(); ?></option>
                <?php endfor; ?>
            </select>    
        </div>
        <div>
            <input type="hidden" class="form-control" id="idvoitobsolete" name="idvoitobsolete" value="<?= $reserver->getidvoit() ?>">
        </div>
        <div class="form-group">
            <label for="idcli">Numero Client : </label>
            <select name="idcli" id="idcli" class="form-control">
                <?php for ($i=0; $i < count($listeclient); $i++) : ?>
                    <option value="<?= $listeclient[$i]->getIdcli(); ?>"><?= $listeclient[$i]->getIdcli(); ?></option>
                <?php endfor; ?>
            </select>    
        </div>
        <div class="form-group">
            <label for="place">Numero place : </label>
            <input type="text" pattern="\d+" title="Nombre entier positif seulement" class="form-control" id="place" name="place" value="<?= $reserver->getplace() ?>" required>
        </div>
        <div>
            <input type="hidden" class="form-control" id="placeobsolete" name="placeobsolete" value="<?= $reserver->getplace() ?>">
        </div>
        
        <div class="form-group">
            <label for="date_voyage">Date de voyage : </label>
            
            <input type="date" class="form-control" id="date_voyage" name="date_voyage" value="<?= $reserver->getdate_voyage() ?>" required>
        </div>
        <div class="form-group">
            <label for="payment">Payement : </label>
            <select name="payment" id="payment" class="form-control">
                <option><?= $reserver->getpayment() ?></option>
                <option>Sans avance</option>
                <option>Avec avance</option>
                <option>Tout payee</option>
            </select>    
        </div>
        <div class="form-group">
            <label for="montant_avance">Montant a l'avance : </label>
            <input type="text" pattern="\d+" title="Nombre entier positif seulement" class="form-control" id="montant_avance" name="montant_avance" value="<?= $reserver->getmontant_avance() ?>" required>
        </div>
        
        <button type="submit" class="btn btn-info add-new">Enregistrer</button>
        <!--<a href="reservation/backaffiche" class="btn btn-success d-block">Annuler</a>-->
    </form>
</div>
<?php
$content = ob_get_clean();
$titre = "Modification du la reservation N : ".$reserver->getidreserv();
require "template.php";
?>