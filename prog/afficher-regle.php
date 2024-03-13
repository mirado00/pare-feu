<?php
    function list_rule($chain){
        $command = "sudo iptables -L ";
        $command .= $chain;
        $command .= " -n --line-number ";
        $output = shell_exec($command);
        $regex = "/^[0-9]+\s.*/m";
        
        sscanf($output, "%*s %*s %*s %[^)]", $policy);
        echo "<div class='align-column rule'><h1>$chain</h1><h1 class='policy'> $policy</h1></div>";
        echo "<table>";
        echo "<tr>";
            echo "<td class='id'>id</td><td>target</td><td>protocol</td><td>option</td><td>source</td><td>destination</td><td>info</td>";
            echo "<td>modification</td>";
        echo "</tr>";
        
        //affecter ce qui ressemble à $regex dans $output vers $lineOK
        if(preg_match_all($regex, $output, $lineOK)){
            foreach($lineOK[0] as $line) {
                sscanf($line, "%d %s %s %s %s %s %[^/n]", $id, $target, $prot, $opt, $source, $dest, $info);
                echo "<tr>";
                    echo "<td class='id'>$id</td><td>$target</td><td>$prot</td><td>$opt</td><td>$source</td><td>$dest</td><td>$info</td>";
                    echo "<td><button class='btn-mod'>mod</button><button class='btn-sup'>supp</button></td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    }
?>
