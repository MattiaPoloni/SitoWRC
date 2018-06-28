<!DOCTYPE html>
<html lang="it">

<?php function auto_copyright($year = 'auto'){ ?>
   <?php if(intval($year) == 'auto'){ $year = date('Y'); } ?>
   <?php if(intval($year) == date('Y')){ echo intval($year); } ?>
   <?php if(intval($year) < date('Y')){ echo intval($year) . ' - ' . date('Y'); } ?>
   <?php if(intval($year) > date('Y')){ echo date('Y'); } ?>
<?php } ?>

<?php
//init $gare, $cosa --> @todo rimovere quando sarà fatto foreach.
$gare = array();
$cose = array();
?>

<footer id="footer" class="content-info">
    <div class="container">
        <div class="row wrap-menus-footer">
            <div class="col33">
                <div id="footer-menu" class="menu-footer-menu-container">
                    <ul id="menu-footer-menu" class="nav">
                        <li id="menu-item-1"
                            class="menu-item"><a
                                    href="">Gare</a></li>
                        <li id="menu-item-2"
                            class="menu-item"><a
                                    href="/cookie-policy/">Cookie Policy</a></li>
                        <li id="menu-item-3"
                            class="menu-item"><a
                                    href="/privacy-policy/">Privacy Policy</a>
                        </li>
                        <li id="menu-item-4"
                            class="menu-item"><a
                                    href="/contatti/">Contatti</a></li>
                    </ul>
                </div>
            </div>
            <div class="col33 ft-menu">
                <h4>Cose da mettere e decidere. </h4>
                <?php foreach ($cose

                as $cosa) : ?>
                <ul>
                    <li>
                        <a href=""
                           title="">
                            Cose scritte con php che bisogna tirar fuori.</a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col33 ft-menu">
                <h4>Gare recenti</h4>
                <?php foreach ($gare

                as $gara) : ?>
                <ul>
                    <li>
                        <a href=""
                           title="">
                            Cose scritte con php che bisogna tirar fuori.</a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="ancor">
        <div class="container">
            <p>&copy; <?php auto_copyright("2018"); ?> Sito Buzo.</p>
        </div>
    </div>
</footer>


</html>