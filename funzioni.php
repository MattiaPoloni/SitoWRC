<?php
    function trovaLogo($nome) {
        if(strpos($nome, 'Toyota') !== false)
        $immagine = "<td><img class='logoAuto' src='media/toyota.png' alt='Logo Toyota'></td>";
        if(strpos($nome, 'Ford') !== false)
        $immagine = "<td><img class='logoAuto' src='media/ford.png' alt='Logo Ford'></td>";
        if(strpos($nome, 'Citroen') !== false)
        $immagine = "<td><img class='logoAuto' src='media/citroen.png' alt='Logo Citroen'></td>";
        if(strpos($nome, 'Hyundai') !== false)
        $immagine = "<td><img class='logoAuto' src='media/hyundai.png' alt='Logo Hyundai'></td>";
        return $immagine;
    }
?>