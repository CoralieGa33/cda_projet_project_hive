<?php
    require 'includes/header.php';
?>  

<!-- Code ici -->

<div class="signup">

<?php 
if(isset($_COOKIE['ERROR_MESSAGE'])) {
    echo "<p style='color:red'>". $_COOKIE['ERROR_MESSAGE'] . "</p>";
}
?>
    <form method="post" action="?route=addUser">
        <div class="signup-input">
            <label for="email" class="signup-label">Email</label>
            <input type="text" name="email" placeholder="email@email.com">
        </div>
        <div class="signup-input">
            <label for="username" class="signup-label">Pseudo</label>
            <input type="text" name="username" placeholder="Pseudonyme">
        </div>
        <div class="signup-input">
            <label for="password" class="signup-label">Mot de passe</label>
            <input type="password" name="password" placeholder="Mot de passe">
        </div>
        <div class="signup-input">
            <label for="password2" class="signup-label">Confirmez le mot de passe</label>
            <input type="password" name="password2" placeholder="Mot de passe">
        </div>
        <input type="submit" name="submit" value="S'inscrire">
    </form>
    
</div>

<!-- -------- -->

<?php
    require 'includes/footer.php';
?>