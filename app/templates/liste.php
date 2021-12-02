
    <div class="liste" id="liste-$id">
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
