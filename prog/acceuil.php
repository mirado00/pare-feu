<?php
    include 'afficher-regle.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://www.web.com/pare-feu/styles/styles.css">
    <link rel="stylesheet" href="http://www.web.com/pare-feu/styles/styles-com.css">
    <title>pare-feu</title>
</head>
<body>
    <div class="head  align-column">
        <div class="apk-title align-column">
            <a href="http://www.web.com/pare-feu/prog/acceuil.php" class="logo">
                <img src="http://www.web.com/pare-feu/icons/firewall-config.svg" alt="pare-feu" srcset="">
            </a>
            <h1 class="title">PARE-FEU</h1>
        </div>
                
        <a href="#" class="btn-grad  align-column">Déconnexion</a>
    </div>
    <div>
        <div class="head-body align-column">
            <a href="http://www.web.com/pare-feu/prog/acceuil.php">règle</a>
            <a href="http://www.web.com/pare-feu/prog/ajouter.php">ajouter</a>
            <a href="http://www.web.com/pare-feu/prog/modification.php">modification</a>
            <a href="http://www.web.com/pare-feu/prog/autre.php">autre</a>
        </div>
        <hr>
        <div class="body">
            <div class="contents">
                <?php
                    list_rule("INPUT");
                    list_rule("FORWARD");
                    list_rule("OUTPUT");
               ?>
            </div>
        </div>
    <div class="body">

    </div>
    <div class="footer">
        
    </div>
</body>
</html> 
