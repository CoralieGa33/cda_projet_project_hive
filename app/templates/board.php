<?php
    require 'includes/header.php';
    //var_dump($boardsList);
?>

<div class="background"></div>

<?php require 'includes/burger.php';?>

<div class="board">
    <div class="board-header">
        <h2 class="board-title"></h2>

        <form class="add-liste" action="" method="POST">    
            <input type="text" class="add-liste-input" placeholder="Ajouter une liste" name="add-liste">
        </form>
    </div>

    <div class="board-listes">
        <?php
            require 'templates/liste.php';
            require 'templates/card.php';
        ?>
    </div>
</div>

<script>
    let userId = <?= $_SESSION['userId']; ?>;
    let username = "<?= $_SESSION['username']; ?>";
    let boardsList = <?= $boardsList; ?>;
</script>

<?php
    require 'includes/footer.php';
?>