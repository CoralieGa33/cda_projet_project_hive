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
function openNav() {
    document.getElementByClass(".burger-header").style.width = "310px";
  }
  
  /* Set the width of the side navigation to 0 */
  function closeNav() {
    document.getElementByClass(".burger-header").style.width = "50px";
  }

  $('#burger-open').on('click', function() {
    console.log("opening")
    document.querySelector(".burger-header").style.width = "310px";
    document.querySelector("#burger-open").style.display = "none";
    document.querySelector("#burger-close").style.display = "block";
    document.querySelector(".burger-nav").style.display = "block";
  });

  $('#burger-close').on('click', function() {
    console.log("closing")
    document.querySelector(".burger-header").style.width = "50px";
    document.querySelector("#burger-close").style.display = "none";
    document.querySelector("#burger-open").style.display = "block";
    document.querySelector(".burger-nav").style.display = "none";
});


// Au click sur Brush, show Modifier le tableau
$('.fa-paint-brush').on('click', function() {
    document.querySelector(".modify-table").style.display = "block";
}); 

// Au click sur "Ajouter un tableau", show Nouveau tableau
$('.burger-add-table').on('click', function() {
    document.querySelector(".burger-new-table").style.display = "block";
});