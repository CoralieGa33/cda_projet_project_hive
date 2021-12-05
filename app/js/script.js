//Pour le déplacement des div .liste avec jquery draggable

$(".liste").draggable({  
    cursor: "move", // pour modifier le curseur de déplacement
    //containment: "#cible"// limite le déplacement à une zone
    
    //pour l'enregistrement des positions après le déplacement
   
    stop: function(event, ui){
        let $posLeft = $(this).offset().left;
        let $posTop = $(this).offset().top;
        console.log($posLeft, $posTop); //permet de vérifier que le offset fonctionne bien
    }
});




