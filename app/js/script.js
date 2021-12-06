//On click on the burger icon, hide it
$('#burger-open').on('click', function() {
    $('#burger-open').hide();
});

//On click on the X close, show the burger icon
$('#close').on('click', function() {
    $('#burger-open').show();
});

//On click on the burger icon, hide ModifyTable
$('#burger-open').on('click', function() {
    $('.modify-table').hide();
});

// On click brush show ModifyTable
$('.fa-paint-brush').on('click', function() {
    $('.modify-table').show();
});

//On click on the burger icon, hide NewBurgerTable
$('#burger-open').on('click', function() {
    $('.burger-new-table').hide();
});

// On click burger-add-table show NewBurgerTable
$('.burger-add-table').on('click', function() {
    $('.burger-new-table').show();
});