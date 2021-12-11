
<div class="menu-burger">
    <div id="burger-wrap" class="burger-header">
        <div class="btn-burger">
            <i id="burger-open"class="fas fa-arrow-right"></i>     
            <i id="burger-close" class="fas fa-arrow-left"></i>
        </div>
        
        <nav class="burger-nav">
            <h3 class="burger-title">Liste des tableaux</h3>
            <ul class="menu-boards-list">

            </ul>
            <button class="btn burger-add-table">Ajouter un tableau</button>

            <div class="modify-table">
                <h4 class="burger-liste">Modifier le tableau</h4>
                <form action="" class="edit-board">
                    <label class="label-modify-table" for="title">Titre du tableau</label>
                        <input type="text" class="board-title-input" value="" name="title">
                    <label class="label-modify-table" for="color">Choisir une couleur de fond</label>
                        <input class="edit-board-colorpicker" type="color" value="#ffffff" name="color">
                    <label class="label-modify-table" for="background">Choisir une image de fond</label>
                        <ul class="modify-table-backgrounds">
                        
                        </ul>
                    <!-- <div class="modify-table-backgrounds">
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                    </div> -->

                    <button type="submit" class="btn edit-board-submit">Enregistrer</button>

                </form>
            </div>

            <div class="burger-new-table">
                <h4 class="burger-liste">Nouveau tableau</h4>
                <form action="" class="new-board">
                    <label class="label-modify-table" for="title">Titre du tableau</label>
                        <input type="text" class="new-board-title-input" value="" placeholder="" name="title">
                    <label class="label-modify-table" for="color">Choisir une couleur de fond</label>
                        <input class="new-board-colorpicker" type="color" value="#ffffff" name="color">
                    <label class="label-modify-table" for="background">Choisir une image de fond</label>
                    <ul class="new-table-backgrounds">

                    </ul>
                    <!-- <div class="edit-table-image" name="background">
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                    </div> -->
                    <button type="submit" class="btn new-board-submit">Envoyer</button>
                </form>
            </div>
        </nav>
    </div>
</div>
