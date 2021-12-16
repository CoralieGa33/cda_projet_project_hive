//=====================================================
//======================= Chloé =======================
//=====================================================
// //On click on the burger icon, hide it
// $('#burger-open').on('click', function() {
//     $('#burger-open').hide();
//     //On click on the burger icon, hide ModifyTable
//     $('.modify-table').hide();
//     //On click on the burger icon, hide NewBurgerTable
//     $('.burger-new-table').hide();
// });

// //On click on the X close, show the burger icon
// $('#close').on('click', function() {
//     $('#burger-open').show();
//     $('#burger-open').shide();
// });

// // On click brush show ModifyTable
// $('.fa-paint-brush').on('click', function() {
//    $('.modify-table').hide();
//    $('.modify-table').show();
// });

// // On click burger-add-table show NewBurgerTable
// $('.burger-add-table').on('click', function() {
//     $('.burger-new-table').show();
//     $('.burger-new-table').hide();
// });

// Menu
/* Set the width of the side navigation to 310px */
// function openNav() {
//     document.getElementByClass(".burger-header").style.width = "19rem";
// }

/* Set the width of the side navigation to 0 */
// function closeNav() {
//     document.getElementByClass(".burger-header").style.width = "2rem";
// }

// $('#burger-open').on('click', function() {
//     //console.log("opening")
//     document.querySelector(".burger-header").style.width = "19rem";
//     document.querySelector("#burger-open").style.display = "none";
//     document.querySelector("#burger-close").style.display = "block";
//     document.querySelector(".burger-nav").style.display = "block";
// });

// $('#burger-close').on('click', function() {
//     //console.log("closing")
//     document.querySelector(".burger-header").style.width = "2rem";
//     document.querySelector("#burger-close").style.display = "none";
//     document.querySelector("#burger-open").style.display = "block";
//     document.querySelector(".burger-nav").style.display = "none";
//     document.querySelector(".modify-table").style.display = "none";
//     document.querySelector('.edit-board').reset();
//     document.querySelector(".burger-new-table").style.display = "none";
//     document.querySelector('.new-board').reset();
//     $('.selected-bg').removeClass('selected-bg');
//     document.querySelector('.menu-boards-list').style.height = "auto";
// });


// Au click sur Brush, show Modifier le tableau
// -> moved to board.js
// $('.menu-boards-list').on('click', '.fa-paint-brush', function() {
//     document.querySelector(".modify-table").style.display = "block";
//     document.querySelector(".burger-new-table").style.display = "none";
//     document.querySelector('.menu-boards-list').style.height = "13rem";
//     document.querySelector('.menu-boards-list').style.overflow = "auto";
// }); 

// Au click sur "Ajouter un tableau", show Nouveau tableau
// $('.burger-add-table').on('click', function() {
//     document.querySelector(".burger-new-table").style.display = "block";
//     document.querySelector(".modify-table").style.display = "none";
//     document.querySelector('.menu-boards-list').style.height = "13rem";
//     document.querySelector('.menu-boards-list').style.overflow = "auto";
// });

//========================================================
//======================= Sabrina ========================
//========================================================

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

// $(".liste-cards").sortable({
//     items: 'li',
//     cursor:"move",
//     axis: "y",
    
//     //pour l'enregistrement du nouvel ordre des cartes avec l'index
//     stop: function(event, ui) {
//         index = ui.item.index()+1;
//         console.log(index);
//         let id = $(this).attr("id"); 
//         console.log(id); //ne fonctionne pas car pas encore d'id pour les cartes
//     }
// });

//activer l'ajout de cartes
//Faire apparaître le template quand on appuie sur l'ajout de cartes

