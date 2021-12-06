//On click on the burger icon, hide it
$('#burger-open').on('click', function() {
    $('#burger-open').hide();
    //On click on the burger icon, hide ModifyTable
    $('.modify-table').hide();
    //On click on the burger icon, hide NewBurgerTable
    $('.burger-new-table').hide();
});

//On click on the X close, show the burger icon
$('#close').on('click', function() {
    $('#burger-open').show();
});

// On click brush show ModifyTable
$('.fa-paint-brush').on('click', function() {
    $('.modify-table').show();
});

// On click burger-add-table show NewBurgerTable
$('.burger-add-table').on('click', function() {
    $('.burger-new-table').show();
});