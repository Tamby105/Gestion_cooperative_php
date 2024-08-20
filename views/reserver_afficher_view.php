<?php 
ob_start(); 
?>
<div class="equipement">
    <form method="POST" action="<?= URL ?>reservation/rechercher" enctype="multipart/form-data">
        <div class="form-group">
            
            <input type="text" class="form-control me-2" id="search" name="search" placeholder="Rechercher" aria-label="Rechercher">
        </div>
        <button type="submit" class="btn_rechercher"><i class="material-icons">search</i></button>
    </form>

    <form method="POST" action="<?= URL ?>reservation/Clientsearch" enctype="multipart/form-data">
        <div class="form-group">
        <label for="idvoit">Recherche des voyageurs selon leur payment <br>par voiture : </label> <br>
            <select class="form-control me-2" name="idvoit" id="idvoit" >
                <?php 
                if (!empty($voitures))
                {
                    for ($i=0; $i < count($voitures); $i++) : ?>
                        <option><?= $voitures[$i]->getidvoit(); ?></option>
                <?php 
                    endfor; 
                }?>
            </select><br>
            <select class="form-control me-2" name="payment" id="payment">
                <option>Sans avance</option>
                <option>Avec avance</option>
                <option>Tout payee</option>
            </select><br>
            <button type="submit" class="btn_rechercher"><i class="material-icons">search</i></button>
        </div>
    </form>
</div>

<div class="container-lg">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Reservations <b>Details</b></h2></div>
                </div>
            </div>
            <?php if($test==0){?>
                <div class="hahaha">
                    <h5>TOTAL ACCUMULEE =<b><?= $total_accumulee; ?> Ar</b></h5>
                </div>
            <table class="table text-center table-custom">
                <thead>
                    <tr>
                        <th>Numero de reservation </th>
                        <th>Reference voiture</th>
                        <th>Reference client</th>
                        <th>Place</th>
                        <th>Date de reservation</th>
                        <th>Date de voyage</th>
                        <th>Payment</th>
                        <th>Montant a l'avance</th>
                        <th colspan="3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if (!empty($reserver))
                {
                    for($i=0; $i < count($reserver); $i++) : 
                    ?>
                    <tr> 
                        <td class="align-middle"><?= $reserver[$i]->getidreserv(); ?></td>
                        <td class="align-middle"><?= $reserver[$i]->getidvoit(); ?></td>
                        <td class="align-middle"><?= $reserver[$i]->getidcli(); ?></td>
                        <td class="align-middle"><?= $reserver[$i]->getplace(); ?></td>
                        <td class="align-middle"><?= $reserver[$i]->getdate_reserv(); ?></td>
                        <td class="align-middle"><?= $reserver[$i]->getdate_voyage(); ?></td>
                        <td class="align-middle"><?= $reserver[$i]->getpayment(); ?></td>
                        <td class="align-middle"><?= $reserver[$i]->getmontant_avance(); ?></td>

                        <td class="edit" title="Edit" data-toggle="tooltip"><a href="<?= URL ?>reservation/interfacemodif/<?= $reserver[$i]->getidreserv(); ?>" class="edit"><i class="material-icons">&#xE254;</i></a></td>
                        <td class="align-middle">
                            <form method="POST" action="<?= URL ?>reservation/suppr/<?= $reserver[$i]->getidreserv(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer cette reservation ? cela pourrait modifier les occupations des places');">
                                <button class="delete" title="Delete" type="submit" data-toggle="tooltip" ><i class="material-icons">&#xE872;</i></button>
                            </form>
                        </td>
                        <td class="print" title="Print" data-toggle="tooltip"><a href="<?= URL ?>reservation/impression/<?= $reserver[$i]->getidreserv(); ?>" class="print"><i class="material-icons">&#xe8ad;</i></a></td>
                    </tr>
                    <?php endfor;
                } 
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php }else{?>
    <b> Nombre = <?= $clientPayment_count?></b>
    <table class="table text-center">
            <tr>
                <th>Reference client</th>
                <th>Nom client</th>
                <th>Numero telephone</th>
                <th>Reste a payer</th>
            </tr>
            <?php 
            if (!empty($clientPayment))
            {
                for($i=0; $i < count($clientPayment); $i++) : 
                ?>
                <tr>
                    <td class="align-middle"><?= $clientPayment[$i]->getidcli(); ?></td>
                    <td class="align-middle"><?= $clientPayment[$i]->getnom(); ?></td>
                    <td class="align-middle"><?= $clientPayment[$i]->getnumtel(); ?></td>
                    <td class="align-middle"><?= $reste_payment[$i]?> Ar</td>
                </tr>
                <?php endfor; 
            }
            //asiatsika function anaky 2 am model ray count ray sum de am views no manao calcul en appellant function retournant entier /count pour le fois sum pour la total
            ?>
        </table>

<?php
}
$content = ob_get_clean();
$titre = "Les reservations de la cooperative";
require "template.php";
?>
