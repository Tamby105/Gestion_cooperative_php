<?php 
ob_start(); 
?>

<div class="equipement">
    <form method="POST" action="<?= URL ?>client/rechercher" enctype="multipart/form-data">
        <div class="form-group">
            
            <input type="text" class="form-control me-2" id="search" name="search" placeholder="Rechercher" aria-label="Rechercher">
        </div>
        <button type="submit" class="btn_rechercher"><i class="material-icons">search</i></button>
    </form>
</div>

<div class="container-lg">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Clients <b>Details</b></h2></div>
                    <div class="col-sm-4">
                    <a href="<?= URL ?>client/interfaceajout" class="btn btn-info add-new"><i class="material-icons">add</i> Ajouter</a>
                    </div>
                </div>
            </div>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Reference client</th>
                        <th>Nom</th>
                        <th>Numero telephone</th>
                        <th colspan=2>Actions </th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if (!empty($clients))
                {
                    for($i=0; $i < count($clients) ;$i++) : 
                    ?>
                    <tr>
                        <td class="align-middle"><?= $clients[$i]->getIdcli(); ?></td>
                        <td class="align-middle"><?= $clients[$i]->getnom(); ?></td>
                        <td class="align-middle"><?= $clients[$i]->getnumtel(); ?></td>

                        <td class="edit" title="Edit" data-toggle="tooltip"><a href="<?= URL ?>client/interfacemodif/<?= $clients[$i]->getIdcli(); ?>" class="edit"><i class="material-icons">&#xE254;</i></a></td>
                        <td class="align-middle">
                            <form method="POST" action="<?= URL ?>client/suppr/<?= $clients[$i]->getIdcli(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer le client ? Cela pourrait modifier les reservations correspondants');">
                                <button class="delete" type="submit" title="Delete" data-toggle="tooltip" ><i class="material-icons">&#xE872;</i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endfor; 
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php

$content = ob_get_clean();
$titre = "Les clients de la cooperative";
require "template.php";
?>