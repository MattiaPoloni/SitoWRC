<?php
include("connessione.php");
$flag = false;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") :
    // username and password sent from form
    $myusername = mysqli_real_escape_string($connessione, $_POST['username']);
    $mypassword = mysqli_real_escape_string($connessione, $_POST['password']);

    $sql = "SELECT id FROM Amministratore WHERE user = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($connessione, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);


    //Se fa il match allora count è 1
    if ($count == 1) :
        $_SESSION['login_user'] = $myusername;
        header("location: admin.php?azione=default");
    else :
        $flag = true;
    endif;
endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="it">
<html>

<head>
    <link rel="stylesheet" href="css/login.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Login"/>
</head>

<body>

<main class="main">
    <h4>Login</h4>

    <form action="" method="post" class="formLogin">
        <label>Nome :</label><input type="text" name="username" class="box"/><br/><br/>
        <label>Password :</label><input type="password" name="password" class="box"/><br/><br/>
        <input type="submit" value=" Submit "/><br/>
    </form>

    <?php if ($flag === true) : ?>
        <p>Nome o Password invalidi.</p>
    <?php endif; ?>

    <p>Non sei un amministratore?<br/> Torna all'<a href="index.php">HOME</a> per poter leggere le più interessanti news.</p>
</main>

</body>
</html>
