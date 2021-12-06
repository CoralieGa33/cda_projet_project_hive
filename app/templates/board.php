<?php
    require 'includes/header.php';
?>

<div class="background"></div>

<div class="board">
<?php require 'includes/burger.php';?>
    <div class="board-header">
        
        <h2 class="board-title">Tableau 1234</h2>

        <form class="add-liste" action="" method="POST">    
            <i class="fas fa-plus add-liste-icon"></i><input type="text" class="add-liste-input" placeholder="Ajouter une liste" name="add-liste">
        </form>   
       
        
    <!-- FAKE NEW LIST -->
    <div class="liste"  id="liste-3">
        <div class="liste-header">
        <form action="" method="post" class="liste-header-title"><input type="text" class="liste-header-title-input" value="New liste"></form>
            <button class="btn-icon add-card"><span class="tooltip addcard-tooltip">Ajouter une carte</span><i class="fas fa-plus-circle"></i></button>
        </div>
        <ul class="liste-cards">
        </ul>
        <div class="liste-footer">
            <button class="btn-icon delete-liste"><span class="tooltip trash-tooltip">Supprimer la liste</span><i class="fas fa-trash-alt"></i></button>
        </div>
    </div>
    <!--  -->

    <!-- FAKE LISTES -->
    <div class="liste" id="liste-1">
        <div class="liste-header">
            <form action="" method="post" class="liste-header-title"><input type="text" class="liste-header-title-input" value="Titre liste"></form>
            <button class="btn-icon add-card"><span class="tooltip addcard-tooltip">Ajouter une carte</span><i class="fas fa-plus-circle"></i></button>
        </div>
        <ul class="liste-cards">
            <?php 
                require 'templates/card.php';
                require 'templates/card.php';
                require 'templates/card.php';
            ?>
        </ul>
        <div class="liste-footer">
            <button class="btn-icon delete-liste"><span class="tooltip trash-tooltip">Supprimer la liste</span><i class="fas fa-trash-alt"></i></button>
        </div>
    </div>

    <div class="liste" id="liste-2">
        <div class="liste-header">
            <form action="" method="post" class="liste-header-title"><input type="text" class="liste-header-title-input" value="Titre liste"></form>
            <button class="btn-icon add-card"><span class="tooltip addcard-tooltip">Ajouter une carte</span><i class="fas fa-plus-circle"></i></button>
        </div>
        <ul class="liste-cards">
            <?php 
                require 'templates/card.php';
                require 'templates/card.php';
                require 'templates/card.php';
            ?>
        </ul>
        <div class="liste-footer">
            <button class="btn-icon delete-liste"><span class="tooltip trash-tooltip">Supprimer la liste</span><i class="fas fa-trash-alt"></i></button>
        </div>
    </div>
    <!--  -->
</div>

<?php
    require 'includes/footer.php';
?>