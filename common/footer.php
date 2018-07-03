<!DOCTYPE html>
<html lang="it">

<?php function auto_copyright($year = 'auto')
{ ?>
    <?php if (intval($year) == 'auto') {
    $year = date('Y');
} ?>
    <?php if (intval($year) == date('Y')) {
    echo intval($year);
} ?>
    <?php if (intval($year) < date('Y')) {
    echo intval($year) . ' - ' . date('Y');
} ?>
    <?php if (intval($year) > date('Y')) {
    echo date('Y');
} ?>
<?php } ?>


<footer id="footer" class="content-info">
    <div class="ancor">
        <div class="container">
            <p>&copy; <?php auto_copyright("2018"); ?> Sito WRC News.</p>
            <?php if (!isset($_SESSION['login_user'])) : ?>
                <a href="login.php">Login</a>
            <?php elseif ($_SERVER['REQUEST_URI'] == "/admin.php?azione=default" || $_SERVER['REQUEST_URI'] == "/admin.php?azione=modificaGare" || $_SERVER['REQUEST_URI'] == "/admin.php?azione=inserimentoNews" || $_SERVER['REQUEST_URI'] == "/admin.php?azione=inserimentoRisultati") : ?>
                <a href="logout.php">Logout</a>
            <?php else : ?>
                <a href="admin.php?azione=default">Amministratore</a
            <?php endif; ?>
        </div>
    </div>
</footer>

</html>
