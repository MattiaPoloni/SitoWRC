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


<div id="footer" class="content-info">
    <div class="ancor">
        <div class="container">
            <p>&copy; <?php auto_copyright("2018"); ?> Sito WRC News.</p>
            <?php if (!isset($_SESSION['login_user'])) : ?>
                <a href="login.php" tabindex="11">Login</a>
            <?php elseif (strpos($_SERVER['REQUEST_URI'], "admin.php?azione=default") !== false || strpos($_SERVER['REQUEST_URI'],"admin.php?azione=modificaGare") !== false || strpos($_SERVER['REQUEST_URI'],"admin.php?azione=inserimentoNews") !== false || strpos($_SERVER['REQUEST_URI'], "admin.php?azione=inserimentoRisultati")  !== false) : ?>
                <a href="logout.php" tabindex="11">Logout</a>
            <?php else : ?>
                <a href="admin.php?azione=default" tabindex="11">Amministratore</a>
            <?php endif; ?>
        </div>
    </div>
</div>