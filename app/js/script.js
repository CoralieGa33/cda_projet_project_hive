//Pour le déplacement des div .liste avec jquery draggable

$(".liste").draggable({  
    cursor: "move", // pour modifier le curseur de déplacement
    //containment: "#cible"// limite le déplacement à une zone
    
    //pour l'enregistrement des positions après le déplacement
   
    stop: function(event, ui){
        let posLeft = $(this).offset().left;//voir si je change offset par position
        let id = $(this).attr("id");//à changer avec liste_id
        console.log(id);
        console.log(posLeft, posTop); //permet de vérifier que le offset fonctionne bien
        //$.post('ajax.php', id, posLeft,posTop);

    }
}); 


//Pour la réorganisation de l'ordre des cards avec sortable
/*
$(".card").sortable({
    cursor:"move",
    //containement: "liste_id",
});
*/




