<?php
    require 'includes/header.php';
?>  
<div class="signin">
<?php 
if(isset($_COOKIE['ERROR_MESSAGE'])) {
    echo "<p style='color:red'>". $_COOKIE['ERROR_MESSAGE'] . "</p>";
}
?>
    <form method="post" action="?signin">
        <div class="signup-input">
            <label for="email" class="signup-label">Email</label>
            <input type="email" name="email" placeholder="email@email.com">
        </div>
        
        <div class="signup-input">
            <label for="password" class="signup-label">Mot de passe</label>
            <input type="password" name="password" placeholder="Mot de passe">
        </div>

        <input type="submit" name="submit" value="Se connecter">
        <input type="button" name="signup" value="S'inscrire">
    </form>
</div>


<?php
    require 'includes/footer.php';
?> 



