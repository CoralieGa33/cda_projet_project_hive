<?php
    require 'includes/header.php';
    //var_dump($boardsList);
?>

<div class="background"></div>

<div class="board">
    <div class="board-header">
        <div class="menu-burger">
            <i class="fas fa-bars"></i> 
        </div>

        <h2 class="board-title">Tableau 1234</h2>

        <form class="add-liste" action="" method="POST">    
            <i class="fas fa-plus add-liste-icon"></i><input type="text" class="add-liste-input" placeholder="Ajouter une liste" name="add-liste">
        </form>  
    </div>

    <div class="board-listes">
        <?php
            require 'templates/liste.php';
        ?>
    </div>
</div>

<script>
    let userId = <?= $_SESSION['userId']; ?>;
    let username = "<?= $_SESSION['username']; ?>";
    let boardsList = <?= $boardsList; ?>;
</script>
<script defer src="js/board.js"></script>

<?php
    require 'includes/footer.php';
    ?>