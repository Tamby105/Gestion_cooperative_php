<?php 
require_once "connexion_model.php";

class client_model extends connexion_class
{
    private $idcli;
    private $nom;
    private $numtel;

    private $client;
    private $clientrecherche;

    private $clientPayment;

    //init constructeur
    public function __construct($idcli,$nom,$numtel)
    {
        $this->idcli = $idcli;
        $this->nom = $nom;
        $this->numtel = $numtel;
    }

    /*********************** Init_Accesseur ************************/
    public function getIdcli()
    {
        return $this->idcli;
    }
    public function setIdcli($idcli)
    {
        $this->idcli = $idcli;
    }
    public function getnom()
    {
        return $this->nom;
    }
    public function setnom($nom)
    {
        $this->nom = $nom;
    }
    public function getnumtel()
    {
        return $this->numtel;
    }
    public function setnumtel($numtel)
    {
        $this->numtel = $numtel;
    }

    public function setclient($client)
    {
        $this->client[] = $client;
    }
    public function getclient()
    {
        return $this->client;
    }

    public function setclientrecherche($clientrecherche)
    {
        $this->clientrecherche[] = $clientrecherche;
    }
    public function getclientrecherche()
    {
        return $this->clientrecherche;
    }


    public function setclientPayment($clientrecherche)
    {
        $this->clientPayment[] = $clientrecherche;
    }
    public function getclientPayment()
    {
        return $this->clientPayment;
    }


    public function chargementclient()
    {
        $query = $this->getconnexionbd()->prepare("SELECT * FROM client ORDER BY idcli DESC");
        $query->execute();
        $clientDatas = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        //inscription des donnees dans la  base dans le tableau d'affichage
        foreach($clientDatas as $client)
        {
            $clientListe = new client_model($client['idcli'],$client['nom'],$client['numtel']);
            $this->setclient($clientListe);
        }
    }
    public function clientpdf($idcli)
    {
        $queryStr = "SELECT nom,numtel FROM client WHERE idcli = :idcli";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idcli",$idcli,PDO::PARAM_STR);
        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        
    }

    public function getclientById($idcli)
    {
        for($i=0; $i < count($this->client);$i++)
        {
            if($this->client[$i]->getIdcli() === $idcli)
            {
                return $this->client[$i];
            }
        }
    }

    public function ajoutclientBd($idcli,$nom,$numtel)
    {
        $queryStr = "INSERT INTO client (idcli, nom, numtel) VALUES(:idcli, :nom, :numtel)";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idcli",$idcli,PDO::PARAM_STR);
        $query->bindValue(":nom",$nom,PDO::PARAM_STR);
        $query->bindValue(":numtel",$numtel,PDO::PARAM_STR);
        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        if($resultat > 0)
        {
            $client = new client_model($this->getconnexionbd()->lastInsertId(),$idcli,$nom,$numtel);
            $this->setclient($client);
        }     
        /*else{
            return confirm('la voiture existe deja');
        }   */
    }

    public function suppressionclient($idcli)
    {
        $queryStr = "DELETE FROM client WHERE idcli = :idcli";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idcli",$idcli,PDO::PARAM_STR);
        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        if($resultat > 0)
        {
            $client = $this->getclientById($idcli);
            unset($client);
        }
    }

    public function modificationclientBD($idcli,$nom,$numtel)
    {
        $queryStr = "UPDATE client SET nom = :nom, numtel = :numtel WHERE idcli = :idcli" ;
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idcli",$idcli,PDO::PARAM_STR);
        $query->bindValue(":nom",$nom,PDO::PARAM_STR);
        $query->bindValue(":numtel",$numtel,PDO::PARAM_STR);

        $resultat = $query->execute();
        $query->closeCursor();
        //actualisation interface
        if($resultat > 0)
        {
            $this->getclientById($idcli)->setnom($nom);
            $this->getclientById($idcli)->setnumtel($numtel);
        }
    }
    public function recherche_client($recherche)
    {
        $queryStr = "SELECT * FROM client WHERE idcli LIKE '%".$recherche."%' OR nom LIKE '%".$recherche."%' OR numtel LIKE '%".$recherche."%' ";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $resultat = $query->execute();
        $clientDatas = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        foreach($clientDatas as $client)
        {
            $clientrecherche = new client_model($client['idcli'],$client['nom'],$client['numtel']);
            $this->setclientrecherche($clientrecherche);
        }
        return $this->getclientrecherche();

    }

    public function search_client_payment($idvoit,$payment)
    {
        $queryStr = "SELECT DISTINCT client.* FROM client,voiture,reserver WHERE reserver.idcli = client.idcli AND reserver.idvoit = :idvoit AND reserver.payment = :payment";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $query->bindValue(":payment",$payment,PDO::PARAM_STR);


        $resultat = $query->execute();
        $clientDatas = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
       // print_r($clientDatas);
        foreach($clientDatas as $client)
        {
            $clientrecherche = new client_model($client['idcli'],$client['nom'],$client['numtel']);
            $this->setclientPayment($clientrecherche);
        }
        return $this->getclientPayment();

    }

    public function integrite_client($numtel,$idcli,$nom)
    {
        $queryStr = "SELECT COUNT(idcli) AS effectif FROM client WHERE numtel= :numtel AND idcli= :idcli AND nom= :nom";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":numtel",$numtel,PDO::PARAM_STR);
        $query->bindValue(":idcli",$idcli,PDO::PARAM_STR);
        $query->bindValue(":nom",$nom,PDO::PARAM_STR);

        $resultat = $query->execute();
        $nbr_ligne = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        
        
        foreach($nbr_ligne as $client)
        { 
            $test = $client['effectif'];
        }
        return $test;

    }

    public function search_client_payment_count($idvoit,$payment)
    {
        $queryStr = "SELECT COUNT(DISTINCT client.idcli) AS compte FROM client,voiture,reserver WHERE reserver.idcli = client.idcli AND reserver.idvoit = :idvoit AND reserver.payment = :payment";
        $query = $this->getconnexionbd()->prepare($queryStr);
        $query->bindValue(":idvoit",$idvoit,PDO::PARAM_STR);
        $query->bindValue(":payment",$payment,PDO::PARAM_STR);


        $resultat = $query->execute();
        $clientDatas = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        foreach($clientDatas as $client)
        {
            $clientrecherche = $client['compte'];
        }
        return $clientrecherche;

    }
}
?>