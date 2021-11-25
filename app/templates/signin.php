<?php
    require 'includes/header.php';
?>  
<div class="signin">
    <form method="post" action="?signin">
        <h2 class="signin-title">Se connecter</h2>
        <?php if(isset($_COOKIE['ERROR_MESSAGE'])) : ?>
            <p class='signin-error'><?= $_COOKIE['ERROR_MESSAGE'] ?></p>
        <?php else : ?>
            <p class='signin-noerror'>&nbsp;</p>
        <?php endif ?>

        <div class="signup-input">
            <label for="email" class="signup-label">Email</label>
            <input type="email" name="email" placeholder="email@email.com">
        </div>
        
        <div class="signup-input">
            <label for="password" class="signup-label">Mot de passe</label>
            <input type="password" name="password" placeholder="Mot de passe">
        </div>

        <input type="submit"  class="signin-btn" name="submit" value="Se connecter">
        <a href="?signup" class="signin-link" data-link-alt="S'inscrire"><span>Vous n'avez pas de compte ?</span></a>
    </form>
</div>


<?php
    require 'includes/footer.php';
?> 



