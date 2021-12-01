<?php
    require 'includes/header.php';
?>

<div class="background">

</div>


<div class="board">
    <div class="board-header">
    
        <div class="menu-burger">
            <i class="fas fa-bars"></i> 
        </div>

        <div class="board-liste hidden">
            <h5 class="board-liste-title">Liste des tableaux</h5>
            <ul>
                <li>Lorem</li>
                <li>Lorem</li>
                <li>Lorem</li>
            </ul>
        </div>

        <h2 class="board-title">Tableau 1234</h2>

        <div class="add-liste">    
             <a class="add-liste-icon"href=""><i class="fas fa-plus"></i> Ajouter une liste</a>
        </div>  
    </div>

    <div class="new-liste">
        <a class="new-liste-icon" href="">New list <i class="fas fa-plus-circle"></i></a>
    </div>

    <?php 
        require 'templates/liste.php';
        require 'templates/liste.php';
        require 'templates/liste.php';
    ?>
</div>

<?php
    require 'includes/footer.php';
?>