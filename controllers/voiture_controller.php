<?php 
require_once "models/voiture_model.php";
require_once "models/place_model.php";
require_once "models/reserver_model.php";

class voiture_controller
{
    private $voitures;
    private $places;
    private $reserver;


    public function __construct()
    {
        $this->voitures = new voiture_model("fictif", "fictif", "fictif", "fictif", 28, 30000);
        $this->voitures->chargementvoiture();//recuperation des donnees dans la base
    
        $this->places = new place_model("fictif", 01, "non");
        $this->reserver = new reserver_model("fictif", "fictif", "fictif", 12, "2024-02-12 20:14:00", "2024-02-12", "fictif", 10000);

    }

    
    public function controller_vue_voiture()
    {
        $voitures = $this->voitures->getvoiture();
        require "views/voiture_afficher_view.php"; //redirection
    }

    public function controller_rechercher_voiture()
    {
        $voitures =  $this->voitures->recherche_voiture($_POST['search']);
        require "views/voiture_afficher_view.php";
    }

    public function controller_page_ajoutvoiture()
    {
        require "views/voiture_ajout_view.php";
    }

    public function controller_ajoutvoiture()
    {
        $this->voitures->ajoutvoitureBd($_POST['idvoit'],$_POST['design'],$_POST['types'],$_POST['nbrplace'],$_POST['frais']);
        header('Location: '. URL . "voiture");
        //boucle qui ajoute tous les places d'une voiture en initialisant toutes les ocupations en "non" au moment d'ajoout d'une nouvelle voiture
        $idvoit = $_POST['idvoit'];
        $nbrplace = $_POST['nbrplace'];
        $occupation = "non";
        for($i=1; $i <= $nbrplace; $i++)
        {
             $this->places->ajoutplaceBd($idvoit,$i,$occupation);
        }
    }
    public function controller_page_modification_voitures($idvoit)//donne une interface de modification
    {
        $voitures = $this->voitures->getvoitureById($idvoit);
        require "views/voiture_modifier_view.php";
    }
    public function controller_modification_voiture()//modificaation bases de donnees
    {
        $idvoit = $_POST['idvoit'];
        
        $design = $_POST['design'];
        $types = $_POST['types'];
        $nbrplace = $_POST['nbrplace'];
        $nbrplaceObsolete = $_POST['nbrplaceObsolete'];
        $frais = $_POST['frais'];

        $this->voitures->modificationvoitureBD($idvoit,$design,$types,$nbrplace,$frais);
        
        if ($nbrplace > $nbrplaceObsolete)
        {
            $occupation = "non";
            for ($i=$nbrplaceObsolete+1; $i <= $nbrplace; $i++)
            {
                $this->places->ajoutplaceBd($idvoit,$i,$occupation);
            }
        }
        else if ($nbrplace < $nbrplaceObsolete)
        {
            for ($i=$nbrplace+1; $i<=$nbrplaceObsolete; $i++)
            {
                $this->places->suppressionPartielleplace($idvoit,$i);
            }
        }
        
        header('Location: '. URL . "voiture");
    }
    public function controller_suppression_voiture($idvoit)
    {
        $this->voitures->suppressionvoiture($idvoit);
        $this->places->suppressionplace($idvoit);
        $this->reserver->suppressionreserverViaVoiture($idvoit);
        header('Location: '. URL . "voiture");
    }
    public function controller_page_retour_modification_voiture()//actualisation interface de liste
    {
        $voitures = $this->voitures->getvoiture();
        require "views/voiture_afficher_view.php";
    }

}   

?>