<?php
function trovaLogo($nome) {
    if(strpos($nome, 'Toyota') !== false)
        $immagine = "<td><img class='logoAuto' src='media/toyota.png' alt='Logo Toyota' /></td>";
    if(strpos($nome, 'Ford') !== false)
        $immagine = "<td><img class='logoAuto' src='media/ford.png' alt='Logo Ford' /></td>";
    if(strpos($nome, 'Citroen') !== false)
        $immagine = "<td><img class='logoAuto' src='media/citroen.png' alt='Logo Citroen' /></td>";
    if(strpos($nome, 'Hyundai') !== false)
        $immagine = "<td><img class='logoAuto' src='media/hyundai.png' alt='Logo Hyundai' /></td>";
    return $immagine;
}

function punti($posizione) {
    switch($posizione) {
        case 1:
            return 25;
            break;
        case 2:
            return 18;
            break;
        case 3:
            return 15;
            break;
        case 4:
            return 12;
            break;
        case 5:
            return 10;
            break;
        case 6:
            return 8;
            break;
        case 7:
            return 6;
            break;
        case 8:
            return 4;
            break;
        case 9:
            return 2;
            break;
        case 10:
            return 1;
            break;
    }
    return 0;
}
?>