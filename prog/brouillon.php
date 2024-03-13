<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <style>
        /* Style pour la fenêtre modale */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: white;
            width: 300px;
            padding: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <button onclick="openModal('IP')">Ajouter IP</button>
    <button onclick="openModal('MAC')">Ajouter MAC</button>
    <button onclick="openModal('protocole')">Ajouter protocole</button>

    <!-- Fenêtre modale pour l'ajout d'IP -->
    <div id="ipModal" class="modal">
        <div class="modal-content">
            <label for="ipCount">Nombre d'adresses IP :</label>
            <input type="number" id="ipCount">
            <button onclick="addIP()">Ajouter</button>
            
         <form id="myForm" action="brouillon.php" method="post">
            <!-- ... autres champs ... -->
            <div class="ipContainer" id="ipContainer">

         </div>
            <input type="hidden" id="ipAddresses" name="ipAddresses">
            <button type="submit">Envoyer</button>
        </form>
        
    </div>

    <script>
        //tableau pour stocker les valeurs d'entrer
        const ipAddresses = [];
        // Ouvre la fenêtre modale corresponipdante
        function openModal(type) {
            const modal = document.getElementById('ipModal');
            modal.style.display = 'block';
        }

        // Ajoute n adresses IP
        function addIP() {
            const ipCount = parseInt(document.getElementById('ipCount').value);
            const ipContainer = document.getElementById('ipContainer');
            ipContainer.innerHTML = ''; // Efface les entrées précédentes

            for (let i = 0; i < ipCount; i++) {
                const input = document.createElement('input');
                input.type = 'text';
                input.setAttribute('id', 'input-IP');
                input.setAttribute('name', 'input-IP');
                input.placeholder = 'Adresse IP ' + (i + 1);
                ipContainer.appendChild(input);
                ipAddresses.push(input);
            }
            // function getIpAddress(){
            //     const formattedIPs = ipAddresses.map(input => input.value);
            //     document.getElementById('ipAddresses').value = JSON.stringify(formattedIPs);
            //     console.log('Adresse IP enrgistrées:',formattedIPs);
            // }
            
        }

    </script>
    <?php
        if (isset($_POST['input-IP'])) {
            
            $ipAddresses = $_POST['input-IP'];
            echo "$ipAddresses";
        }
    ?>
</body>
</html>
