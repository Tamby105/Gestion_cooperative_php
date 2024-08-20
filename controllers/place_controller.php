<?php 
require_once "models/place_model.php";
require_once "models/voiture_model.php";


class place_controller
{
    private $place;

    public function __construct()
    {
        $this->place = new place_model("fictif", "fictif", "fictif");
        $this->place->chargementplace();//recuperation des donnees dans la base
        $this->voitures = new voiture_model("fictif","fictif","fictif",10,10000);
        //print_r($this->voitures);
        $this->voitures->chargementvoiture();
    }

    public function controller_vue_place()
    {
        $places = $this->place->getplaces();
        //$voitures = $this->voitures->getvoiture();
        require "views/place_afficher_view.php"; //mtifitra makany @vue
    }

    public function controller_rechercher_place()
    {
        $places =  $this->place->recherche_place($_POST['search']);
        //print_r($places);
        require "views/place_afficher_view.php";
    }
}   

?>