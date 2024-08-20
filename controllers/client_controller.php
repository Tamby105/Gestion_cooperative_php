<?php 
require_once "models/client_model.php";
require_once "models/reserver_model.php";
require_once "models/place_model.php";



class client_controller
{
    private $clients;
    private $reserver;
    private $places;


    public function __construct()
    {
        $this->clients = new client_model("fictif", "fictif", "fictif");
        $this->clients->chargementclient();//recuperation des donnees dans la base
        $this->reserver = new reserver_model("fictif", "fictif", "fictif", 12, "2024-02-12 20:14:00", "2024-02-12", "fictif", 10000);
        $this->places = new place_model("fictif", 01, "non");
        $this->reserver = new reserver_model("fictif", "fictif", "fictif", 12, "2024-02-12 20:14:00", "2024-02-12", "fictif", 10000);

    }

    public function controller_vue_client()
    {
        $clients = $this->clients->getclient();
        require "views/client_afficher_view.php"; //mtifitra makany @vue
    }

    public function controller_rechercher_client()
    {
        $clients =  $this->clients->recherche_client($_POST['search']);
        require "views/client_afficher_view.php";
    }

    public function controller_page_ajoutclient()
    {
        require "views/client_ajout_view.php";
    }

    public function controller_ajoutclient()
    {
        $test = $this->clients-> integrite_client($_POST['numtel'],$_POST['idcli']);

        if ($test == 0)
        {
            $this->clients->ajoutclientBd($_POST['idcli'],$_POST['nom'],$_POST['numtel']);
            header('Location: '. URL . "client");
        }
        else if ($test > 0)
        {
            $message = "Ce numero telephone existe deja . Veuillez-entrer un nouveau.";
            echo "<script>showNotificationss('$message');</script>";
            
        }
       
    }

    public function controller_suppression_client($idcli)
    {
        $this->places->occupOFF_BD_cli($idcli);

        $this->clients->suppressionclient($idcli);
        $this->reserver->suppressionreserverViaClient($idcli);
        header('Location: '. URL . "client");
    }

    public function controller_page_modification_client($idcli)//donne une interface de modification
    {
        $clients = $this->clients->getclientById($idcli);
        require "views/client_modifier_view.php";
    }

    public function controller_page_retour_modification_client()//actualisation interface de liste
    {
        $clients = $this->clients->getclient();
        require "views/client_afficher_view.php";
    }

    public function controller_modification_client()//modificaation bases de donnees
    {
        $test = $this->clients-> integrite_client($_POST['numtel'],$_POST['idcli'],$_POST['nom']);
        print_r($test);
        if ($test == 0)
        {
            $this->clients->modificationclientBD($_POST['idcli'],$_POST['nom'],$_POST['numtel']);
            header('Location: '. URL . "client");
        }
        else if ($test > 0)
        {

            $message = "Ce numero telephone existe deja . Veuillez-entrer un nouveau.";
            echo "<script>showNotifications('$message');</script>";
            
        }

    }

}   

?>
<script>
    function showNotificationss(message) {
            alert(message);
            // L'utilisateur a cliqué sur "OK", exécuter une fonction callback
            onConfirmationss();
      
    }

    function onConfirmationss() {
        // Redirection après que l'utilisateur ait cliqué sur "OK"
        window.location.href = '<?php echo URL . "client/interfaceajout"; ?>';
    }
    function showNotifications(message) {
            alert(message);
            // L'utilisateur a cliqué sur "OK", exécuter une fonction callback
            onConfirmations();
      
    }

    function onConfirmations() {
        // Redirection après que l'utilisateur ait cliqué sur "OK"
        window.location.href = '<?php echo URL . "client"; ?>';
    }
</script>