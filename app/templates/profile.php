<div class="profile">
    <form method="post" action="">
        <h2 class="signin-title">Page de profil</h2>
        <?php if(isset($_COOKIE['ERROR_MESSAGE'])) : ?>
            <p class='profile-error'><?= $_COOKIE['ERROR_MESSAGE'] ?></p>
        <?php else : ?>
            <p class='profil-noerror'>&nbsp;</p>
        <?php endif ?>

        <div class="profile-input">
            <label for="email" class="profile-label">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>">
        </div>
        <div class="profile-input">
            <label for="username" class="profile-label">Pseudo</label>
            <input type="text" name="username" value="<?= htmlspecialchars($user->getUsername()) ?>">
        </div>
        <div class="profile-input">
            <label for="password" class="profile-label">Entrez votre mot de passe pour confirmer</label>
            <input type="password" name="password">
        </div>
        <input type="submit"  class="profile-btn" name="submit" value="Modifier">
        <a href="?editpass" class="profile-link" data-link-alt="C'est par là !"><span>Pour modifier votre mot de passe</span></a>
    </form>
</div>

