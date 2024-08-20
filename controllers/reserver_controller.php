<?php 
require_once "models/client_model.php";
require_once "models/voiture_model.php";
require_once "models/place_model.php";
require_once "models/reserver_model.php";


class reserver_controller
{
    private $clients;
    private $places;
    private $reserver;

    public function __construct()
    {
        $this->reserver = new reserver_model("fictif", "fictif", "fictif", 12, "2024-02-12 20:14:00", "2024-02-12", "fictif", 10000);
        $this->reserver->chargementreserver();//recuperation des donnees dans la base
        $this->places = new place_model("fictif",1,"non");
       // $this->places->chargementplace();        
        $this->clients = new client_model("fictif","fictif","fictif");
        $this->clients->chargementclient();
        $this->voitures = new voiture_model("fictif","fictif","fictif",10,10000);
        //print_r($this->voitures);
        $this->voitures->chargementvoiture();

    }

    public function controller_vue_reserver()
    {
        $reserver = $this->reserver->getreserver();
        $voitures = $this->voitures->getvoiture();
        $test = 0;
        $total_accumulee_test=$this->reserver->total_accumulee();
        if($total_accumulee_test == 0){
            $total_accumulee =0;
        }
        else{
            $total_accumulee = $total_accumulee_test;
        }
       // print_r($total_accumulee);
       
        require "views/reserver_afficher_view.php";
    }

    /*public function controller_page_retour_affichage_reserver()//actualisation interface de liste
    {
        $reserver = $this->reserver->getreserver();
        require "views/reserver_afficher_view.php";
    }*/

    public function controller_rechercher_reserver()
    {
        $reserver =  $this->reserver->recherche_reserver($_POST['search']);
        $voitures = $this->voitures->getvoiture();
        $test = 0;
        $total_accumulee_test=$this->reserver->total_accumulee();
        if($total_accumulee_test == 0){
            $total_accumulee =0;
        }
        else{
            $total_accumulee = $total_accumulee_test;
        }
        require "views/reserver_afficher_view.php";
    }

    public function controller_page_ajoutreserver($place,$idvoit)
    {  
         $listevoit = $this->voitures->getvoiture();
         $listeclient = $this->clients->getclient();
         print_r($place);
         print_r($idvoit);


        require "views/reserver_ajout_view.php";
    }

    public function controller_ajoutreserver()
    {
        $idvoit=$_POST['idvoit'];
        $place=$_POST['place'];
        print_r($place);
         print_r($idvoit);
        $test = $this->reserver-> integrite_reserver($idvoit,$place,$_POST['date_voyage']);
        $test2 = $this->voitures->getfraisById($_POST['idvoit']);
        $date_reserv = date('Y-m-d H:i:s');
      // print_r($test2);
       //print_r($_POST['montant_avance']);
        if ($test == 0)
        {
            if($test2 >= $_POST['montant_avance'])
            {
                $this->reserver->ajoutreserverBd($_POST['idreserv'],$_POST['idvoit'],$_POST['idcli'],$_POST['place'],$date_reserv,$_POST['date_voyage'],$_POST['payment'],$_POST['montant_avance']);
                $this->places->occupON_BD($_POST['idvoit'],$_POST['place']);
                echo ("Operation avec succes.");
                header('Location: '. URL . "reservation");
            }
            else if ($test2 < $_POST['montant_avance'])
            {
                $message = "Montant en avancee depasse le frais !";
                //header('Location: '. URL . "reservation/interfaceajout");
                echo "<script>showNotification('$message');</script>";
            }
                    }
        else if ($test > 0)
        {
            $message = "Place deja occupee. Veuillez-choisir une autre.";
            //header('Location: '. URL . "reservation/interfaceajout");
            echo "<script>showNotification('$message');</script>";
            
        }

        
    }

    public function controller_suppression_reserver($idreserv)
    {
        $this->reserver->suppressionreserver($idreserv);
        $this->places->occupOFF_BD($_POST['idvoit'],$_POST['place']);
        header('Location: '. URL . "reservation");
    }

    public function controller_page_modification_reserver($idreserv)//donne une interface de modification
    {
        $reserver = $this->reserver->getreserverById($idreserv);
        //$voitures = $this->voitures->chargementvoiture();

        $listevoit = $this->voitures->getvoiture();
        
       // print_r(count($listevoit));
        $listeclient = $this->clients->getclient();
       // print_r($listeclient);

        require "views/reserver_modifier_view.php";
    }
    
    public function controller_modification_reserver()//modificaation bases de donnees
    {
        $idreserv = $_POST['idreserv'];
        $idvoit = $_POST['idvoit'];
        $idvoitobsolete = $_POST['idvoitobsolete'];
        $idcli = $_POST['idcli'];
        $place = $_POST['place'];
        $placeobsolete = $_POST['placeobsolete'];
        //$date_reserv = $_POST['date_reserv'];
        $date_voyage = $_POST['date_voyage'];
        $payment = $_POST['payment'];
        $montant_avance = $_POST['montant_avance'];
        //print_r($montant_avance);
        $test = $this->reserver-> integrite_reserver_modif($idvoit,$place,$date_voyage,$montant_avance);
        $test2 = $this->voitures->getfraisById($idvoit);
        //print_r($test2);
        if ($test == 0)
        {
            if($test2>=$montant_avance)
            {
                        //s'il y a modification de voiture et place en meme temps 
                if ($idvoit != $idvoitobsolete AND $place != $placeobsolete )
                {
                    $this->places->occupOFF_BD($idvoitobsolete,$placeobsolete);
                    $this->places->occupON_BD($idvoit,$place);
                }

                //s'il y a modification de voiture uniquement
                else if ($idvoit != $idvoitobsolete)
                {
                    $this->places->occupOFF_BD($idvoitobsolete,$place);
                    $this->places->occupON_BD($idvoit,$place);
                }

                //s'il y a modification de place uniquement
                else if ($place != $placeobsolete)
                {
                    $this->places->occupOFF_BD($idvoit,$placeobsolete);
                    $this->places->occupON_BD($idvoit,$place);
                }

               $this->reserver->modificationreserverBD($idreserv,$idvoit,$idcli,$place,$date_voyage,$payment,$montant_avance);
                header('Location: '. URL . "reservation");
            }
            else
            {
                $message = "Montant en avancee depasse le frais !";
            //header('Location: '. URL . "reservation/interfaceajout");
            echo "<script>ShowNotifications('$message');</script>";
            }
        
        } 
        else if ($test > 0)
        {
            $message = "Place deja occupee. Veuillez-choisir une autre.";
            //header('Location: '. URL . "reservation/interfaceajout");
            echo "<script>ShowNotifications('$message');</script>";
            
        }    
    }
    public function pdf($idreserv)
    {
        //$nom=$this->clients->chargementclient()->;
        require "views/recupdf.php";
    }
    public function controller_rechercher_payment()
    {
        $idvoit = $_POST['idvoit'];
        $payment = $_POST['payment'];
        $voitures = $this->voitures->getvoiture();
        $reserver = $this->reserver->getreserver();

        //print_r($voitures->getfrais());
        $clientPayment = $this->clients->search_client_payment($idvoit, $payment);
        $clientPayment_count = $this->clients->search_client_payment_count($idvoit, $payment);
        print_r($clientPayment_count);
        if(!empty($clientPayment))
        {

        
        for($i=0; $i < count($clientPayment); $i++) 
        {
            $client_avance=$this->reserver->montant_client($clientPayment[$i]->getIdcli(),$idvoit);
            $repetition_voit=$this->reserver->repetition_voit($clientPayment[$i]->getIdcli(),$idvoit);
            
            $frais_total=$repetition_voit * $this->voitures->getfraisById($idvoit);
            $reste_payment[]=$frais_total - $client_avance;
            
        } 
         }

        $test = 1;
        require "views/reserver_afficher_view.php";

    }
}   

?>
<script>
    function showNotification(message) {
            alert(message);
            // L'utilisateur a cliqué sur "OK", exécuter une fonction callback
            onConfirmation();
      
    }

    function onConfirmation() {
        // Redirection après que l'utilisateur ait cliqué sur "OK"
        window.location.href = '<?php echo URL . "reservation/interfaceajout"; ?>';
    }
    function ShowNotifications(message) {
            alert(message);
            // L'utilisateur a cliqué sur "OK", exécuter une fonction callback
            OnConfirmations();
      
    }

    function OnConfirmations() {
        // Redirection après que l'utilisateur ait cliqué sur "OK"
        window.location.href = '<?php echo URL . "reservation"; ?>';
    }
</script>