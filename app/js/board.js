let app = {
    baseUrl: 'http://localhost/cda/Projets/cda_projet_project_hive/app/?api/',
    
    init: function() {
        console.log("initialisation ...")
        //console.log(userId);
        //console.log(boardsList[0]['owner_id']);
        app.loadBoard();

    },
    loadBoard: function() {
        $.ajax({
            url: app.baseUrl + 'test',
            method: 'POST',
            data: {
                boardId:`${boardsList[0]['boardId']}`,
            }
        }).done(function(board) {
            console.log(board)
        }).fail(function(e) {
            console.error(e);
        });

    },
};

document.addEventListener('DOMContentLoaded', app.init);
