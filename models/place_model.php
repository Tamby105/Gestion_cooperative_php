<?php 
require_once "connexion_model.php";

class place_model extends connexion_class
{
    private $idvoit;
    private $place;
    private $occupation;

    private $places;
    private $placesrecherches;



    //init constructeur
    public function __construct($idvoit,$place,$occupation)
    {
        $this->idvoit = $idvoit;
        $this->place = $place;
        $this->occupation = $occupation;
    }
 
    /*********************** Init_Accesseur ************************/
 public function getidvoit()
 {
     return $this->idvoit;
 }
 public function setidvoit($idvoit)
 {
     $this->idvoit = $idvoit;
 }

 public function getplace()
 {
     return $this->place;
 }
 public function setplace($place)
 {
     $this->place = $place;
 }

 public function getoccupation()
 {
     return $this->occupation;
 }
 public function setoccupation($occupation)
 {
     $this->occupation = $occupation;
 }

 public function setplaces($places)
 {
     $this->places[] = $places;
 }
 public function getplaces()
 {
     return $this->places;
 }

 public function setplacesrecherche($placesrecherches)
 {
     $this->placesrecherches[] = $placesrecherches;
 }
 public function getplacesrecherche()
 {
     return $this->placesrecherches;
 }


 public function chargementplace()
    {
        $query = $this->getconnexionbd()->prepare("SELECT * FROM place");
        $query->execute();
        $placeDatas = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        //inscription des donnees dans la  base dans le tableau d'affichage
        foreach($placeDatas as $places)
        {
            $placeListe = new place_model($places['idvoit'],$places['place'],$places['occupation']);
            $this->setplaces($placeListe);
        }
    }

    public function getplaceById($places)
    {
        for($i=0; $i < count($this->places); $i++)
        {
            if($this->places[$i]->getidvoit() === $places)
            {
                return $this->places[$i];
            }
        }
    }

    public function suppressionplace($idvoit)
    {
        $queryStr = "DELETE FROM place WHERE idvoit = :idvoit";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $resultat = $query->execute();
        $query->closeCursor();
    }
   

    public function suppressionPartielleplace($idvoit,$place)
    {
        $queryStr = "DELETE FROM place WHERE idvoit = :idvoit AND place = :place";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $query->bindValue(":place",$place,PDO::PARAM_INT);
        $resultat = $query->execute();
        $query->closeCursor();
    }

    /*public function modificationplaceBD($idvoit,$nom,$occupation)
    {
        $queryStr = "UPDATE place SET idvoit = :idvoit, place = :place WHERE occupation = :occupation";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $query->bindValue(":place",$place,PDO::PARAM_INT);
        $query->bindValue(":occupation",$occupation,PDO::PARAM_STR);
        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        if($resultat > 0)
        {
            $this->getplaceById($idvoit)->setplace($place);
            $this->getplaceById($idvoit)->setoccupation($occupation);
        }
    }*/

//////////ajout a travers l'ajout de voiture
    public function ajoutplaceBd($idvoit,$place,$occupation)
    {
        $queryStr = "INSERT INTO place (idvoit, place, occupation) VALUES(:idvoit, :place, :occupation)";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $query->bindValue(":place",$place,PDO::PARAM_INT);
        $query->bindValue(":occupation",$occupation,PDO::PARAM_STR);
        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        if($resultat > 0)
        {
            $places = new place_model($this->getconnexionbd()->lastInsertId(),$idvoit,$place,$occupation);
            $this->setplaces($places);
        }        
    }
                
    /*public function ajoutplaceBd($idvoit,$place)
    {
        $queryStr = "INSERT INTO place (idvoit, place, occupation) VALUES(:idvoit, :place, :occupation)";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $query->bindValue(":place",$place,PDO::PARAM_INT);
        $query->bindValue(":occupation",$occupation,PDO::PARAM_STR);
        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        if($resultat > 0)
        {
            $place = new place_model($this->getconnexionbd()->lastInsertId(),$idvoit,$place,$occupation);
            $this->setplaces($places);
        }        
    }*/

    public function occupON_BD($idvoit,$place)
    {
        $queryStr = "UPDATE place SET occupation = 'oui' WHERE idvoit = :idvoit AND place = :place";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $query->bindValue(":place",$place,PDO::PARAM_INT);
        $resultat = $query->execute();
        $query->closeCursor();
             
       
    }   


    public function occupOFF_BD($idvoit,$place)
    {
        $queryStr = "UPDATE place SET occupation = 'non' WHERE idvoit = :idvoit and place = :place ";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $query->bindValue(":place",$place,PDO::PARAM_INT);
        $resultat = $query->execute();
        $query->closeCursor();
             
       
    }   
    public function occupOFF_BD_cli($idcli)
    {
        $queryStr = "SELECT idvoit , place  FROM reserver WHERE idcli = :idcli ";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idcli",$idcli,PDO::PARAM_STR);


        $resultat = $query->execute();
        $clientDatas = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        foreach($clientDatas as $client)
        {
            $queryStr = "UPDATE place SET occupation = 'non' WHERE idvoit = :idvoit AND place = :place ";
            $query = $this->getconnexionbd()->prepare($queryStr);
            
            $query->bindValue(":idvoit",$client['idvoit'],PDO::PARAM_STR);
            $query->bindValue(":place",$client['place'],PDO::PARAM_INT);
    
            $resultat = $query->execute();
            $query->closeCursor();
            
        }
       
    }

        
             
       
       

    public function recherche_place($recherche)
    {
        $queryStr = "SELECT * FROM place WHERE idvoit = :recherche ";
        $query = $this->getconnexionbd()->prepare($queryStr);
       $query->bindValue(":recherche",$recherche,PDO::PARAM_STR);
        $resultat = $query->execute();
        $placesDatas = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        foreach($placesDatas as $places)
        {
            $placesrecherche = new place_model($places['idvoit'],$places['place'],$places['occupation']);
            $this->setplacesrecherche($placesrecherche);
        }
        return $this->getplacesrecherche();

    }
}
?>