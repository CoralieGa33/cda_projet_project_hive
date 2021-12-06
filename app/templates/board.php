<?php
    require 'includes/header.php';
?>

<div class="background"></div>

<div class="board">
    <div class="board-header">
        <div class="menu-burger">
           <div id="burger-wrap">
                <header class="burger-header">
                    <nav class="burger-nav">
                        <a href="#burger-wrap" id="burger-open">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="34px" height="27px" viewBox="0 0 34 27" enable-background="new 0 0 34 27" xml:space="preserve">
                                <rect fill="#FFFFFF" width="34" height="4"/>
                                <rect y="11" fill="#FFFFFF" width="34" height="4"/>
                                <rect y="23" fill="#FFFFFF" width="34" height="4"/>
                            </svg>
                        </a>
                            <a href="#" id="close">×</a>
                            <h1 class="burger-title"><a href="#">Liste des tableaux : </a></h1>
                            <a class="burger-list" href="#">Tableau de testeur1  <i class="fas table-fa-paint-brush"></i></a>
                            <a class="burger-list" href="#">Tableau 2 de testeur1</a>
                            <a class="burger-list" href="#">Tableau 3 de testeur1</a>
                            <a class="burger-list" href="#">Tableau 4 de testeur1</a>
                            <a class="burger-add-table" href="#">Ajouter un tableau</a>

                        <div class="modify-table">
                            <a class="burger-list" href="#">Modifier le tableau actif : </a>
                                <form action="">
                                    <input type="text" class="" value="Titre du tableau" placeholder="Titre du tableau" name="Titre du tableau">
                                    <input type="text" value="Choisir une couleur" placeholder="Choisir une couleur" name="Choisir une couleur">
                                    <input type="text" value="Choisir une image de fond" placeholder="Choisir une image de fond" name="Choisir une image de fond">
                                    <div class="edit-table-image">
                                            <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/55" alt=""></a>
                                            <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/55" alt=""></a>
                                            <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/55" alt=""></a>
                                            <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/55" alt=""></a>
                                            <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/55" alt=""></a>
                                            <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/55" alt=""></a>
                                            <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/55" alt=""></a>
                                            <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/55" alt=""></a>
                                    </div>
                            </form>
                        </div>

                        <div class="burger-new-table">
                            <a class="burger-list" href="#">Nouveau tableau : </a>
                                <form action="">
                                        <input type="text" class="" value="" placeholder="" name="">
                                        <input type="text" value="" placeholder="" name="">
                                        <input type="text" value="" placeholder="" name="">
                                </form>
                        </div>
                     </nav>
                </header>
            </div>
        </div>


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