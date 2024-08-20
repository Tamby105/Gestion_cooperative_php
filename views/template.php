<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COOPERATIVE</title>
    <link rel="stylesheet" href="public/styles/bootstrap.min.css">
    <link rel="stylesheet" href="../public/styles/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/styles/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/styles/bootstrap.min.css">

    <link rel="stylesheet" href="public/styles/design.css">
    <link rel="stylesheet" href="../public/styles/design.css">
    <link rel="stylesheet" href="../../public/styles/design.css">
    <link rel="stylesheet" href="../../../public/styles/design.css">


    <link rel="stylesheet" href="public/styles/fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="../public/styles/fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="../../public/styles/fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="../../../public/styles/fontawesome-free-6.5.1-web/css/all.css">


</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark-custom fixed-left" style="background-color: #070F2B; color: #ffffff;">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav flex-column white-text">
                <li class="nav-item">
                    <a class="nav-link accueil" href="<?= URL ?>accueil"><i class="material-icons">home</i>Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pesonne_client" href="<?= URL ?>client"><i class="material-icons">person</i> Client</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link voiture" href="<?= URL ?>voiture"><i class="material-icons">directions_bus</i>Voiture</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link reservation" href="<?= URL ?>reservation"><i class="material-icons">event</i>Reservation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link place" href="<?= URL ?>place"><i class="material-icons">event_seat</i>Place</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



    <div class="container contenu">
        <h1 class="my-custom-element "><?= $titre ?></h1>
        <p class="content"><?= $content ?></p>
    </div>
    
    <script src="public/styles/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="public/styles/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="public/styles/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">

</body>
</html>