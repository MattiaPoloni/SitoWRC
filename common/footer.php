<!DOCTYPE html>
<html lang="it">

<?php function auto_copyright($year = 'auto'){ ?>
   <?php if(intval($year) == 'auto'){ $year = date('Y'); } ?>
   <?php if(intval($year) == date('Y')){ echo intval($year); } ?>
   <?php if(intval($year) < date('Y')){ echo intval($year) . ' - ' . date('Y'); } ?>
   <?php if(intval($year) > date('Y')){ echo date('Y'); } ?>
<?php } ?>


<footer id="footer" class="content-info">
    <div class="ancor">
        <div class="container">
            <p>&copy; <?php auto_copyright("2018"); ?> Sito WRC News.</p>
            <?php if (!isset($_SESSION['login_user'])) : ?>
                <a href="../login.php">Login</a>
            <?php else : ?>
            <a href="../admin.php?azione=deault">Amministratore</a>
            <?php endif; ?>
        </div>
    </div>
</footer>

</html>