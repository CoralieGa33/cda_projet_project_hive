
<div class="menu-burger">
    <div id="burger-wrap" class="burger-header">
        <div class="btn-burger">
            <i id="burger-open"class="fas fa-arrow-right"></i>
        
            <i id="burger-close" class="fas fa-arrow-left"></i>
        </div>
        
        <nav class="burger-nav">
            <h3 class="burger-title">Liste des tableaux</h3>
            <ul>
                <li class="table-brush burger-list">Tableau de testeur1 <i class="fas fa-paint-brush"></i></li>
                <li class="burger-list board-2" >Tableau 2 de testeur1</li>
                <li class="burger-list board-3" >Tableau 3 de testeur1</li>
                <li class="burger-list board-4" >Tableau 4 de testeur1</li>
            </ul>
            <button class="btn burger-add-table">Ajouter un tableau</button>

            <div class="modify-table">
                <h4 class="burger-liste">Modifier le tableau</h4>
                <form action="" class="edit-board">
                    <label class="label-modify-table" for="title">Titre du tableau</label>
                        <input type="text" class="board-title" value="" name="title">
                    <label class="label-modify-table" for="color">Choisir une couleur</label>
                        <input class="colorpicker" type="color" value="#ffffff" name="color">
                    <label class="label-modify-table" for="background">Choisir une image de fond</label>
                        
                    <div class="edit-table-image" name="background">
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                    </div>

                    <button type="submit" class="btn edit-board-submit">Enregistrer</button>

                </form>
            </div>

            <div class="burger-new-table">
                <h4 class="burger-liste">Nouveau tableau</h4>
                <form action="" class="new-board">
                    <label class="label-modify-table" for="title">Titre du tableau</label>
                        <input type="text" class="board-title" value="" placeholder="" name="title">
                    <label class="label-modify-table" for="color">Choisir une couleur</label>
                        <input class="colorpicker" type="color" value="#ffffff"name="color">
                    <label class="label-modify-table" for="background">Choisir une image de fond</label>
                    <div class="edit-table-image" name="background">
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                        <a class="table-thumbs" href="https://placeholder.com"><img src="https://via.placeholder.com/75" alt=""></a>
                    </div>
                    <button type="submit" class="btn new-board-submit">Envoyer</button>
                </form>
            </div>
        </nav>
    </div>
</div>
