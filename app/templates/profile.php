<h2>Page de profil</h2>

<div class="profile">
<?php 
if(isset($_COOKIE['ERROR_MESSAGE'])) {
    echo "<p style='color:red'>". $_COOKIE['ERROR_MESSAGE'] . "</p>";
}


?>
    <form method="post" action="">
        <div class="profile-input">
            <label for="email" class="profile-label">Email</label>
            <input type="email" name="email" placeholder="<?= htmlspecialchars($user->getEmail()) ?>">
        </div>
        <div class="profil-input">
            <label for="username" class="profile-label">Pseudo</label>
            <input type="text" name="username" placeholder="<?= htmlspecialchars($user->getUsername()) ?>">
        </div>
        <div class="profil-input">
            <label for="password" class="profile-label">Password</label>
            <input type="text" name="password" placeholder="<?= htmlspecialchars($user->getPassword()) ?>">
        </div>
    </form>
</div>