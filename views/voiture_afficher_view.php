<?php 
ob_start(); 
?>
<div class="equipement">
    <form method="POST" action="<?= URL ?>voiture/rechercher" enctype="multipart/form-data">
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
                    <div class="col-sm-8"><h2>Voiture <b>Details</b></h2></div>
                    <div class="col-sm-4">
                    <a href="<?= URL ?>voiture/interfaceajout" class="btn btn-info add-new"><i class="fa fa-plus"></i> Ajouter</a>
                    </div>
                </div>
            </div>
            <table class="table text-center">
                <thead>
                    <tr>
                    <th>Reference voiture</th>
                    <th>Design</th>
                    <th>Type de voiture</th>
                    <th>Nombre de place</th>
                    <th>Frais</th>
                    <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if (!empty($voitures))
                {
                    for($i=0; $i < count($voitures); $i++) : 
                    ?>
                    <tr> 
                        <td class="align-middle"><?= $voitures[$i]->getidvoit(); ?></td>
                        <td class="align-middle"><?= $voitures[$i]->getdesign(); ?></td>
                        <td class="align-middle"><?= $voitures[$i]->gettypes(); ?></td>
                        <td class="align-middle"><?= $voitures[$i]->getnbrplace(); ?></td>
                        <td class="align-middle"><?= $voitures[$i]->getfrais(); ?></td>

                        <td class="edit" title="Edit" data-toggle="tooltip"><a href="<?= URL ?>voiture/interfacemodif/<?= $voitures[$i]->getidvoit(); ?>" class="edit"><i class="material-icons">&#xE254;</i></a></td>
                        <td class="align-middle">
                            <form method="POST" action="<?= URL ?>voiture/suppr/<?= $voitures[$i]->getidvoit(); ?>" onSubmit="return confirm('Voulez-vous vraiment supprimer la voiture ? Cela supprimera a la fois les places et reservations enregistree correspondant a cette voiture');">
                                <button class="delete" title="Delete" type="submit" data-toggle="tooltip" ><i class="material-icons">&#xE872;</i></button>
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
$titre = "Les voitures de la cooperative";
require "template.php";
?>