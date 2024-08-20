<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reservation cooperative</title>
</head>
<body>
    <h1>fandehany</h1>
</body>
</html>-->
<?php
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
require_once "controllers/client_controller.php";
require_once "controllers/voiture_controller.php";
require_once "controllers/place_controller.php";
require_once "controllers/reserver_controller.php";

$clients = new client_controller();
$voitures = new voiture_controller();
$places = new place_controller();
$reserver = new reserver_controller();

try{
    if(empty($_GET['page']))
    {
        require "views/accueil_view.php";
    } 
    else{
        $url = explode("/", filter_var($_GET['page']),FILTER_SANITIZE_URL);
    
        if($url[0]=="accueil")
        {
            require "views/accueil_view.php";
        }
        elseif($url[0]=="client")
        {
            if(empty($url[1]))
            {
                $clients->controller_vue_client();
            } 
            else if($url[1] === "interfaceajout") 
            {
                $clients->controller_page_ajoutclient();
            }
            else if($url[1] === "ajouterbdd") 
            {
                $clients->controller_ajoutclient();
            }
            else if($url[1] === "interfacemodif") 
            {
                $clients->controller_page_modification_client($url[2]);
            } 
            else if($url[1] === "modifBdd") 
            {
                $clients->controller_modification_client();
            }
            else if($url[1] === "suppr") 
            {
                $clients->controller_suppression_client($url[2]);
            } 
            else if($url[1] === "rechercher") 
            {
                $clients->controller_rechercher_client();
            }
            else
            {
                throw new Exception("La page n'existe pas");
            }
        }
        elseif($url[0]=="voiture")
        {
            if(empty($url[1]))
            {
                $voitures->controller_vue_voiture();
            } 
            else if($url[1] === "interfaceajout") 
            {
                $voitures->controller_page_ajoutvoiture();
            }
            else if($url[1] === "ajouterbdd") 
            {
                $voitures->controller_ajoutvoiture();
            }
            else if($url[1] === "interfacemodif") 
            {
                $voitures->controller_page_modification_voitures($url[2]);
            } 
            else if($url[1] === "modifBdd") 
            {
                $voitures->controller_modification_voiture();
            }
            else if($url[1] === "suppr") 
            {
                $voitures->controller_suppression_voiture($url[2]);
            } 
            else if($url[1] === "rechercher") 
            {
                $voitures->controller_rechercher_voiture();
            }
           
            else 
            {
                throw new Exception("La page n'existe pas");
            }
        }
        elseif($url[0]=="reservation")
        {
            if(empty($url[1]))
            {
                $reserver->controller_vue_reserver();
            }
            else if($url[1] === "interfaceajout") 
            {
                $reserver->controller_page_ajoutreserver($url[2],$url[3]);
            }
            else if($url[1] === "ajouterbdd") 
            {
                $reserver->controller_ajoutreserver();
            }
            else if($url[1] === "interfacemodif") 
            {
                $reserver->controller_page_modification_reserver($url[2]);
            } 
            else if($url[1] === "modifBdd") 
            {
                $reserver->controller_modification_reserver();
            }
            else if($url[1] === "suppr") 
            {
                $reserver->controller_suppression_reserver($url[2]);
            }    
            else if($url[1] === "impression") 
            {
                $reserver->pdf($url[2]);
            } 
            else if($url[1] === "rechercher") 
            {
                $reserver->controller_rechercher_reserver();
            }
            /*else if($url[1] === "backaffiche") 
            {
                $reserver->controller_page_retour_affichage_reserver();
            }*/
            else if($url[1] === "Clientsearch") 
            {
                $reserver->controller_rechercher_payment();
            }
            else
            {
                throw new Exception("La page n'existe pas");
            }
        }
        elseif($url[0]=="place")
        {
            if(empty($url[1]))
            {
                $places->controller_vue_place();
            }
            else if($url[1] === "rechercher") 
            {
                $places->controller_rechercher_place();
            }
            else
            {
                throw new Exception("La page n'existe pas");
            }
            
        }
    }        
}
catch(Exception $e)
{
    echo $e->getMessage();
}
/*gfjytdfhhhhhhhhhhhhhhhhhhhhhhhhdddddddddddddddddddddddddfffffffffffffffff*/
?>
