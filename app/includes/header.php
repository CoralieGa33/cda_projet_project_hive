<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/445a650e5b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Project Hive</title>
</head>
<body>
    
<div class="container">
    <header class="header">
        <div class="header-logo">
            <a href="?"><img src="images/logo.jpg" alt="Logo Project Hive"></a>
        </div>
        <div class="header-navigation">
                <?php
                    if (!empty($_SESSION)) {
                    ?>
                        <a href="?profile" class="header-user"><i class="fas fa-user-circle"></i></a>
                        <a href="?logout" class="btn header-logout">Se déconnecter</a>
                    <?php
                    } else {
                        ?>
                        <a href="?signup" class="btn header-signup">S'inscrire</a>
                        <a href="?signin" type="button" class="btn header-signin">Se connecter</a>
                    <?php
                    }
                ?>
            </div>
    </header>

