
<li class="card" id="card-$id">
    <div class="show-card">
        <div class="card-header">
            <h3 class="card-header-title">Nom de la carte</h3>
            <button class="btn-icon delete-card"><span class="tooltip deletecard-tooltip">Supprimer la carte</span><i class="fas fa-times"></i></button>
        </div>
        <p class="card-content">Lorem ipsum dolor sit.</p>
        <div class="card-footer">
            <button class="btn-icon modify-card"><span class="tooltip editcard-tooltip">Modifier  la carte</span><i class="fas fa-paint-brush"></i></button>
        </div>
    </div>
    <form action="" class="edit-card-form is-hidden">
        <input type="text" class="card-header-title" value="Titre de la carte" placeholder="Titre de la carte" name="edit-card-title">
        <textarea class="card-header-content" rows="5" value="Description de la carte" placeholder="Description de la carte" name="edit-card-content"></textarea>
        <div class="edit-color">
            <input type="color" class="card-header-color" name="edit-card-color" value="#FBFBF9">
            <label for="edit-card-color">Choisir une couleur</label>
        </div>
        <button type="submit" class="sm-btn">Enregistrer</button>
    </form>
</li>

