<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Style pour le texte en rouge */
        .red-text {
            color: red;
        }
        .green-text{
            color:green;
        }
    </style>
</head>
<body>
    <form>
        <label for="ports">Entrez les ports (séparés par des virgules) :</label>
        <input type="text" id="ports" name="ports">
        <label for="multiport">Multiport :</label>
        <input type="checkbox" id="multiport" name="multiport">
    </form>

    <script>
        const inputPorts = document.getElementById('ports');
        const checkboxMultiport = document.getElementById('multiport');

        // Écouteur d'événement pour détecter les changements dans le champ de saisie
        inputPorts.addEventListener('input', () => {
            const portsValue = inputPorts.value;
            const isValid = portsValue.match(/^(\d+(,\s*\d+)*)?$/); // Vérifie si les ports sont au bon format

            if (isValid && checkboxMultiport.checked) {
                inputPorts.classList.remove('red-text'); // Applique la couleur rouge
             

            } else if(!checkboxMultiport.checked){
                inputPorts.classList.remove('red-text');
            }else {
                inputPorts.classList.add('red-text');
            }

        });
    </script>
</body>
</html>
