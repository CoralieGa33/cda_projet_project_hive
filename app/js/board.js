let app = {
    // Penser à modifier ici l'adresse de votre API
    //baseUrl: 'http://localhost:81/Projets/cda_projet_project_hive/app/?api/',
    baseUrl: 'http://localhost/cda/Projets/cda_projet_project_hive_0912/app/?api/',
    
    maxListeOrderNb: 0,
    loadedBoard: 0,
    
    init: function() {
        console.log("initialisation ...")

        $('.add-liste').on('submit', app.handleCreateNewListe);
        $('.board-listes').on('dblclick', '.liste-header-show', app.handleDblClickListTitle);
        $('.board-listes').on('blur', '.liste-header-title-input', app.handleBlurListTitle);
        $('.board-listes').on('submit', '.liste-header-title-form', app.handleUpdateListeName);
        $('.board-listes').on('click', '.delete-liste', app.handleDeleteListe);
        $('.menu-boards-list').on('click', '.boards-list-item', app.handleSelectBoard);
        // l'élément n'existe pas lors de l'init, donc pas possible de lui déposer un écouteur directement
        // => je pose l'écouteur sur le container, qui lui écoutera son enfant (donné en second paramètre)

        // je charge mon tableau principal
        app.loadBoard();
        app.loadBoardMenu();
    },

    // Appel à l'API pour récupérer toutes les infos du tableau principal de l'utilisateur connecté
    loadBoard: function(id = null) {
        let selectedBoardId = boardsList[0]['boardId'];
        if(id) {
            selectedBoardId = id;
        }
        console.log('Loaded board id : ', selectedBoardId);
        $.ajax({
            url: app.baseUrl + 'boards',
            method: 'POST',
            data: {
                boardId: selectedBoardId,
            }
        }).done(function(boardDatas) {
            let board = JSON.parse(boardDatas)
            app.generateBoard(board.boardId, board.title);

            // Je place dans une variable toutes les listes reçues du tableau
            let listeCollection = board.listes;
            
            // Je stocke ici le plus grand des orderNb retourné parmi les listes
            app.maxListeOrderNb = app.getMaxListOrderNb(listeCollection);

            // Je boucle sur la collection de listes
            listeCollection.map(liste => {
                // remplir une liste en js et l'afficher dans le dom
                let newListeElement = app.generateListeElement(liste);
                app.addListeElement(newListeElement);
                
                // Je place dans une variable toutes les cartes reçues de la liste
                let cardCollection = liste.cards;
                
                // Je boucle sur la collection de cartes
                cardCollection.map(card => {
                    // remplir une carte en js et l'afficher dans le dom de la liste
                    let newCardElement = app.generateCardElement(card);
                    app.addCardElement(newCardElement);
                })
                
            })
            // J'ajoute à chaque liste la capacité d'être déplacée une fois que TOUTES mes listes sont chargées
            app.setDragListes();
        }).fail(function(e) {
            console.error(e);
        });
    },

    // Je charge la liste des tableaux de l'utilisateur dans le menu "burger"
    loadBoardMenu: function() {
        let boardsListNode = document.querySelector('.menu-boards-list');
        // Je boucle sur la liste des tableaux pour créer les éléments
        boardsList.map(board => {
            let newBoard = document.createElement('li');
            newBoard.classList.add('boards-list-item');
            newBoard.id = "board-" + board.boardId;
            newBoard.setAttribute("board-id", board.boardId);
            newBoard.textContent = board.title;
            boardsListNode.appendChild(newBoard);
        })
        boardsListNode.firstElementChild.classList.add('selected-board'); // A la connexion sur le 1er
        boardsListNode.querySelector('.selected-board').insertAdjacentHTML('afterbegin', '<i class="fas fa-paint-brush"></i>'); 
    },

    // Je donne un id (récupéré par la requête) à chaque tableau afin de pouvoir en charger d'autre par la suite
    generateBoard: function(boardId, boardTitle) {
        let board = document.querySelector('.board');
        board.setAttribute('board-id', boardId);
        board.querySelector('.board-title').textContent = boardTitle;
    },

    // Pour changer de tableau après le clic sur son nom
    handleSelectBoard: function(event) {
        let selectedItem = $(event.currentTarget);

        // je récupère l'id du tableau selectionné pour la future requête
        let selectedItemId = selectedItem.attr('board-id');
        app.selectedBoardId = selectedItemId;
        
        // J'intervertis la place du "pinceau", et la classe
        $('.selected-board').find('.fas').remove();
        $('.selected-board').removeClass('selected-board');
        selectedItem.addClass('selected-board');
        selectedItem.prepend('<i class="fas fa-paint-brush"></i>');
        
        // Je vide le DOM du tableau actuel (sauf le premier élément -> template)
        $('.board-listes').children().not(':first').remove();

        // Je charge le nouveau tableau
        app.loadBoard(app.selectedBoardId);
        
        // Je ferme le menu
        document.querySelector(".burger-header").style.width = "2rem";
        document.querySelector("#burger-close").style.display = "none";
        document.querySelector("#burger-open").style.display = "block";
        document.querySelector(".burger-nav").style.display = "none";
    },
    
    // permet  de générer une nouvelle liste avec ses détails
    // elle reste "virtuelle" tant qu'elle n'est pas ajoutée au DOM
    generateListeElement: function(liste) {
        let newListe = document.querySelector('.template-liste').cloneNode(true)
        newListe.id = "liste-"+liste.listeId;
        newListe.classList.remove("template-liste")
        newListe.setAttribute('liste-id', liste.listeId)
        newListe.setAttribute('order-nb', liste.orderNb)
        newListe.querySelector('h3').textContent = liste.title;
        newListe.querySelector('input[name=liste-title]').value = liste.title;
        newListe.querySelector('.liste-cards').classList.add('liste-cards-'+liste.listeId)
        newListe.style.left = liste.posLeft+'px';
        newListe.style.top = liste.posTop+'px';
        newListe.style.zIndex = liste.orderNb;
        newListe.classList.remove('is-hidden');
        return newListe;
    },
    
    // Ajoute la liste générée au DOM
    addListeElement: function(newListeElement) {
        let listeContainer = $('.board-listes');
        listeContainer.append(newListeElement);
        app.setDragListes();
    },

    // permet  de générer une nouvelle carte  avec ses détails
    // elle reste "virtuelle" tant qu'elle n'est pas ajoutée au DOM
    generateCardElement: function(card) {
        let newCard = document.querySelector('.template-card').cloneNode(true)
        newCard.id = "card-"+card.cardId;
        newCard.classList.remove("template-card");
        newCard.querySelector('h4').textContent = card.title;
        newCard.querySelector('.card-content-description').textContent = card.content;
        newCard.querySelector('input[name=edit-card-title]').value = card.title;
        newCard.querySelector('textarea[name=edit-card-content]').value = card.content;
        newCard.setAttribute('liste-id', card.liste_id);
        newCard.classList.remove('is-hidden');
        return newCard;
    },

    // Ajoute la carte générée au DOM
    addCardElement: function(newCardElement) {
        let cardContainer = $('.liste-cards-'+newCardElement.getAttribute('liste-id'));
        cardContainer.append(newCardElement);
    },

    // Fait apparaitre le formulaire de modification du titre de la liste
    handleDblClickListTitle: function(event) {
        let listTitle = $(event.currentTarget);
        listTitle.addClass('is-hidden');
        let listTitleForm = listTitle.next('form');
        listTitleForm.removeClass('is-hidden');
        listTitleForm[0].querySelector('.liste-header-title-input').focus();
    },

    // Réinitialise le titre et la valeur du form si le changement n'est pas validé
    handleBlurListTitle: function(event) {
        let listTitleForm = $(event.currentTarget).parent();
        listTitleForm.addClass('is-hidden');
        let listTitle = listTitleForm.prev('.liste-header-show');
        $(event.currentTarget)[0].value = listTitle.contents()[1].textContent;
        listTitle.removeClass('is-hidden');
    },

    // Requête d'ajout d'une nouvelle liste
    handleCreateNewListe: function(event) {
        event.preventDefault();
        let newListeName = $('.add-liste-input').eq(0).val();
        let boardId = $('.board').attr('board-id');
        $.ajax({
            url: app.baseUrl + 'liste/add',
            method: 'POST',
            dataType: 'json',
            data: {
                title: newListeName,
                orderNb: parseInt(app.maxListeOrderNb)+1,
                boardId: boardId,
            }
        }).done(function(liste) {
            // Si c'est ok, je génère la nouvelle liste et je l'ajoute au DOM
            // ça évite de recharger la page et de faire une nouvelle requête
            let newListeElement = app.generateListeElement(liste);
            $('.add-liste-input').eq(0).val("");
            $('.add-liste-input').blur();
            app.addListeElement(newListeElement);
            app.maxListeOrderNb ++
        }).fail(function(e) {
            console.error(e);
        });
    },

    // Requête pour mettre à jour une liste donnée
    updateListe: function(liste) {
        let listeTitle = liste.find('.liste-header-title-input').val();
        $.ajax({
            url: app.baseUrl + 'liste/update',
            method: 'POST',
            data: {
                listeId: liste.attr('liste-id'),
                title: listeTitle,
                orderNb: liste.attr('order-nb'),
                posLeft: liste.position().left,
                posTop: liste.position().top,
            }
        }).done(function(updatedListe) {
            updatedListe = JSON.parse(updatedListe);
            // Si c'est ok je mets à jour les détails la liste ciblée dans le DOM
            let listeToUpdateId = updatedListe.listeId;
            let listeToUpdate = $('.liste[liste-id='+ listeToUpdateId +']');
            listeToUpdate.attr('order-nb', updatedListe.orderNb)
            listeToUpdate.find('h3').text(updatedListe.title);
            listeToUpdate.find('input[name=liste-title]').val( updatedListe.title);
        }).fail(function(e) {
            console.error(e);
        });
    },

    // Sélectionne et envoie la liste complète visée par l'action pour la requête
    handleUpdateListeName: function(event) {
        event.preventDefault();
        let liste = $(event.currentTarget).parent().parent();
        app.updateListe(liste);
        $('.liste-header-title-input').blur();
    },

    // Trouve le orderNb le plus grand parmi les listes
    // (Servira aussi plus tard pour gérer la superposition des listes)
    getMaxListOrderNb: function(listeCollection) {
        let allListes = [... listeCollection];
        orderedListes = allListes.sort((a, b) => b.orderNb - a.orderNb);
        if(orderedListes[0]) {
            maxOrderNb = orderedListes[0].orderNb;
        } else {
            maxOrderNb = 0;
        }
        
        return(maxOrderNb);
    },

    // Réattribue un nouvel orderNb suite à un déplacement pour gérer les superpositions
    updateOrderListe: function(liste) {
        // attribue le orderNb maximum à la liste déplacée
        liste.attr('order-nb', app.maxListeOrderNb);
        app.updateListe(liste); // pour mettre à jour la bdd
        liste.css('zIndex', liste.attr('order-nb')); // pour mettre à jour le dom

        // pour sélectionner toutes les listes qui étaient après celle déplacée
        let afterListes = liste.nextAll();

        afterListes.each(function () {
            // pour chaque liste suivante, je descends le orderNb et le zIndex de 1
            $(this).attr('order-nb', $(this).attr("order-nb")-1);
            app.updateListe($(this));
            $(this).css('zIndex', $(this).attr('order-nb'));
        });
    },

    handleDeleteListe: function(event) {
        let listeToDelete = $(event.currentTarget).parent().parent();
        let listeToDeleteId = listeToDelete.attr("liste-id");
        $.ajax({
            url: app.baseUrl + 'liste/delete',
            method: 'POST',
            dataType: 'json',
            data: {
                listeId: listeToDeleteId,
            }
        }).done(function(response) {
            listeToDelete.remove();
        }).fail(function(e) {
            console.error(e);
            listeToDelete.remove();
        });
    },

    // Pour rendre une liste déplaçable dans le tableau
    setDragListes: function() {
        //Pour le déplacement des div .liste avec jquery draggable
        $(".liste").draggable({  
            cursor: "move", // pour modifier le curseur de déplacement
            //containment: "#cible"// limite le déplacement à une zone
            containment: ".board-listes",
            //Pour l'enregistrement des positions après le déplacement
            
            stop: function(event, ui){
                let posLeft = $(this).position().left;//voir si je change offset par position
                let posTop = $(this).position().top;//offset modifié par position car parent ajouté par Coralie
                let listeId = $(this).attr("liste-id");//à changer avec liste-id
                //console.log(listeId);
                //console.log(posLeft, posTop); //permet de vérifier que le offset fonctionne bien
                app.updateOrderListe($(this));
            }
        });
    },

};

document.addEventListener('DOMContentLoaded', app.init);
