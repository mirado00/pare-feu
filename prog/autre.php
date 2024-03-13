<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'ajout</title>
</head>
<body>
    <h1>Formulaire d'ajout</h1>

    <!-- Formulaire -->
    <form action="http://www.web.com/pare-feu/prog/autre.php" method="post">
        <label for="ip">Adresse IP :</label>
        <input type="text" id="ip" name="ip">
        <button type="button" onclick="ajouterElement('ip')">Ajouter</button>
        <br>

        <label for="mac">Adresse MAC :</label>
        <input type="text" id="mac" name="mac">
        <button type="button" onclick="ajouterElement('mac')">Ajouter</button>
        <br>

        <label for="protocol">Protocole :</label>
        <input type="text" id="protocol" name="protocol">
        <button type="button" onclick="ajouterElement('protocol')">Ajouter</button>
        <br>
        <input type="submit" value="enregistrer">
    </form>

    <!-- Div pour afficher les valeurs -->
    <div id="result"></div>

    <script>
        // Tableau pour stocker les valeurs
        const valeurs = {
            ip: [],
            mac: [],
            protocol: []
        };

        // Fonction pour ajouter une valeur au tableau
        function ajouterElement(champ) {
            const valeur = document.getElementById(champ).value;
            valeurs[champ].push(valeur);
            afficherValeurs();
        }

        // Fonction pour afficher les valeurs dans la div
        function afficherValeurs() {
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = '';

            for (const champ in valeurs) {
                if (valeurs[champ].length > 0) {
                    resultDiv.innerHTML += `<p>${champ}: ${valeurs[champ].join(', ')}</p>`;
                }
            }
        }
    </script>
        <?php
        // Récupération des valeurs
        $ip = $_POST['ip'];
        $mac = $_POST['mac'];
        $protocol = $_POST['protocol'];

        // Manipulation des valeurs (vous pouvez faire ce que vous voulez ici)
        // Par exemple, afficher les valeurs :
        echo "Adresse IP : " . $ip . "<br>";
        echo "Adresse MAC : " . $mac . "<br>";
        echo "Protocole : " . $protocol;
    ?>
</body>
</html>
