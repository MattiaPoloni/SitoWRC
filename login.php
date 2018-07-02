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
<html>

<head>
    <link rel="stylesheet" href="/css/login.css">

    <title>Pagina Login</title>

</head>

<body>

<main class="main">
    <h4>Login</h4>

    <form action="" method="post" class="formLogin">
        <label>Nome :</label><input type="text" name="username" class="box"/><br/><br/>
        <label>Password :</label><input type="password" name="password" class="box"/><br/><br/>
        <input type="submit" value=" Submit "/><br/>
    </form>

    <?php if($flag === true) : ?>
        <p>Nome o Password invalidi.</p>
    <?php endif; ?>
</main>

</body>
</html>