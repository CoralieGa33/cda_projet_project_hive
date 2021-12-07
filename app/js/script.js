//Pour le déplacement des div .liste avec jquery draggable
/*
$(".liste").draggable({  
    cursor: "move", // pour modifier le curseur de déplacement
    //containment: "#cible"// limite le déplacement à une zone
    
    //Pour l'enregistrement des positions après le déplacement
    
    stop: function(event, ui){
        let posLeft = $(this).position().left;//voir si je change offset par position
        let posTop = $(this).position().top;//offset modifié par position car parent ajouté par Coralie
        let id = $(this).attr("listId");//à changer avec liste_id
        console.log(listeId);
        console.log(posLeft, posTop); //permet de vérifier que le offset fonctionne bien
        
    }
}); 
*/

//Pour la réorganisation de l'ordre des cards avec sortable

$(".liste-cards").sortable({
    items: 'li',
    cursor:"move",
    axis: "y",
    
    //pour l'enregistrement du nouvel ordre des cartes avec l'index
    stop: function(event, ui) {
        index = ui.item.index()+1;
        console.log(index);
        let id = $(this).attr("id"); 
        console.log(id); //ne fonctionne pas car pas encore d'id pour les cartes
    }
});

//activer l'ajout de cartes
//Faire apparaître le template quand on appuie sur l'ajout de cartes








