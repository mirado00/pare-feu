<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://www.web.com/pare-feu/styles/styles-ajouter.css">
    <link rel="stylesheet" href="http://www.web.com/pare-feu/styles/styles-com.css">
    <title>ajouter</title>
</head>
<body>
    <h2>ajouter une règle</h2>

    <form action="http://www.web.com/pare-feu/prog/ajouter.php" method="post" id="form" onsubmit="return confirmSubmission()">
        <hr>
        <div class="input-select">
        <label for="chain">chain</label>
            <select id="chain" name="chain">
                <option value="INPUT">INPUT</option>
                <option value="FORWARD">FORWARD</option>
                <option value="OUTPUT">OUTPUT</option>
            </select>
        </div>
        <div class="input-select">
            <label for="policy">policy:</label>
            <select name="policy">>
                <option value="ACCEPT">ACCEPT</option>
                <option value="DROP">DROP</option>
                <option value="REJECT">REJECT</option>
            </select>
        </div>
        <hr>
        <div class="entry">
            <label for="">interface:</label>
            <input type="text" name="interface" id="interface">
        </div>
        <div class="entry">
            <label for="prot">protocol de la règle</label>
            <select name="prot" id="prot">
               <option value="tcp">TCP</option>
               <option value="udp">UDP</option>
                <option value="icmp" class="prot">ICMP</option>
                <option value="none">NONE</option>
            </select>
        </div>
        <div class="entry">
            <div class="port" id="port">
                <label for="nbr-port">nombre de port:</label>
                <input type="text" name="nbr-port" id="nbr-port" placeholder="80">
            </div>
            <input type="checkbox" name="multiport" id="multiport" value ="multiport"> <label for="multiport">multiport</label>
        </div>
        <div class="entry">
            <label class="label">Definir une/des adresse(s) IP:</label>
            <div class="IP">
                <label for="IP">IP:</label>
                <input type="text" name="IP" id="IP" placeholder="192.168.12.45" >
            </div>            
        </div>
        <div id="IP-radio" style="display: none;">
            <label for="source">Source :</label>
            <input type="radio" id="source" name="IP-type" value="-s">

            <label for="destination">Destination :</label>
            <input type="radio" id="destination" name="IP-type" value="-d">
        </div>
        <div class="entry">
            <label class="label">Definir une/des adresse(s) MAC:</label>
            <div class="MAC">
                <label for="MAC">MAC:</label>
                <input type="text" name="MAC" id="MAC" placeholder="10:c3:7b:55:fa:a6" >
            </div>
            
        </div>
       
        <hr>
        <div class="submit">
            <button type="button" onclick="resetForm()">Annuler</button>
            <input type="submit" value="enregistrer" onclick="refreshPage()">
        </div>
    </form>
    
    <script>
        const selectElement = document.getElementById('chain');
        const radioFields = document.getElementById('IP-radio');
        // Écouteur d'événement pour détecter le changement dans la sélection
        selectElement.addEventListener('change', function() {
            if (selectElement.value === 'FORWARD') {
                radioFields.style.display = 'block'; // Affiche les champs radio
            } else {
                radioFields.style.display = 'none'; // Masque les champs radio
            }
        });

        //color Error
        const inputPorts = document.getElementById('nbr-port');
        const checkboxMultiport = document.getElementById('multiport');

        // Écouteur d'événement pour détecter les changements dans le champ de saisie
        inputPorts.addEventListener('input', () => {
            const portsValue = inputPorts.value;
            const isValid = portsValue.match(/^(\d+(,\s*\d+)*)?$/); // Vérifie si les ports sont au bon format
            if (isValid && checkboxMultiport.checked) {
                inputPorts.classList.remove('red-text'); 
             
            } else if(!checkboxMultiport.checked && portsValue.match(/^\d+$/) ){
                inputPorts.classList.remove('red-text');
            }else {
                inputPorts.classList.add('red-text');
            }
        });

        const inputIP = document.getElementById('IP');
        inputIP.addEventListener('input', ()=>{ 
            if(inputIP.value.match(/^([0-9]{1,3}\.){3}[0-9]{1,3}$/ )){
                inputIP.classList.remove('red-text');
            }
            else{
                inputIP.classList.add('red-text');
            }
        });
        ///^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/
        const inputMAC = document.getElementById('MAC');
        inputMAC.addEventListener('input', ()=>{ 
            if(inputMAC.value.match(/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/ )){
                inputMAC.classList.remove('red-text');
            }
            else{
                inputMAC.classList.add('red-text');
            }
        });
        function resetForm(){
            document.getElementById("form").reset();
        }
        function confirmSubmission() {
            return window.confirm("Voulez-vous appliquer cette règle?");
        }
        function refreshPage(){
            location.reload();
        }
    </script>
    <?php
        $chain = $_POST["chain"];
        $policy = $_POST["policy"];
        $interface = $_POST["interface"];
        $prot = $_POST["prot"];
        $nbr_port = $_POST["nbr-port"];
        $IP = $_POST["IP"];
        $MAC = $_POST["MAC"];
        $checkIP = $_POST["IP-type"];
        $multiport = $_POST["multiport"];

        $command = "sudo iptables -t filter -A ";
        $command .= $chain;
        $command .= " -j $policy"; 
        if(!empty($interface)){
            $command .= " -i $interface";
        }
        if($prot!="none"){
            $command .=" -p $prot";
            if(!empty($nbr_port) ){
                $optionMult = ($multiport == "multiport")?" -m multiport ":"";
                $s = ($multiport == "multiport")?"s":"";

                if($chain =="FORWARD"){
                    $command .= match($checkIP){
                        '-s' => "$optionMult --sport$s $nbr_port",
                        '-d' => "$optionMult --dport$s $nbr_port",
                    };
                }
                else {
                    $command .= match($chain){
                        'INPUT' => "$optionMult --sport$s $nbr_port",
                        'OUTPUT' => "$optionMult --dport$s $nbr_port",
                    };
                }
            }            
        }
        if(!empty($IP)){
            $command .= match($chain){
                'INPUT' => " -s $IP",
                'OUTPUT' => " -d $IP",
                'FORWARD' => " $checkIP $IP",
            };
        }
        if(!empty($MAC)){
            $command .= " -m mac --mac-source $MAC";
        }
        
        echo "<br>";
        echo "$command";
        $getIP = shell_exec("hostaname -I");
        system($command);
        system("sudo iptables -A INPUT -s $getIP -j ACCEPT");
        system("sudo iptables -A OUTPUT -d $getIP -j ACCEPT");
    ?>
</body>
</html >