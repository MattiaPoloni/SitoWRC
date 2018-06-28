<!DOCTYPE html>
<html lang="it">
<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/slide.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <title>HomePage</title>
    <meta name="description" content="Descrizione sommaria.">
</head>
<body>
    <?php include('common/header.html');
        include('common/menu.html'); ?>
    <form action="admin.php" method="post">
        <fieldset>
            <legend>Login</legend>
            <label for="user">Username:</label>
            <input name="user" id="user" maxlenght="20" />
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" maxlenght="20" />
          <input type="submit" value="Login">
        </fieldset>
    </form>
</body>
<?php include('common/footer.php') ?>
</html>