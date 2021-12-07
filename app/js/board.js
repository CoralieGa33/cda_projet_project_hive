let app = {
    //baseUrl: 'http://localhost:81/Projets/cda_projet_project_hive_0512/app/?api/',
    baseUrl: 'http://localhost/cda/Projets/cda_projet_project_hive/app/?api/',
    
    init: function() {
        console.log("initialisation ...")
        //console.log(userId);
        //console.log(boardsList[0]['owner_id']);

        $('.board-listes').on('dblclick', '.liste-header-show', app.handleDblClickListTitle);
        $('.board-listes').on('blur', '.liste-header-title-input', app.handleBlurListTitle);

        $('.board-listes').on('submit', '.liste-header-title-form', app.handleUpdateListeName);
        $('.add-liste').on('submit', app.createNewListe);

        app.loadBoard();
    },
    maxListeOrderNb: 0,
    loadBoard: function() {
        $.ajax({
            url: app.baseUrl + 'boards',
            method: 'POST',
            data: {
                boardId:`${boardsList[0]['boardId']}`,
            }
        }).done(function(boardDatas) {
            //console.log(boardDatas)
            let board = JSON.parse(boardDatas)
            app.generateBoard(board.boardId);
            //console.log(board.listes)
            let listeCollection = board.listes;
            //console.log(listeCollection)
            app.maxListeOrderNb = app.getMaxListOrderNb(listeCollection);
            //console.log(app.maxListeOrderNb);
            listeCollection.map(liste => {
                //console.log(liste)
                // remplir une liste en js et l'afficher dans le dom
                let newListeElement = app.generateListeElement(liste);
                app.addListeElement(newListeElement);
                
                let cardCollection = liste.cards;
                //console.log(cardCollection);
                cardCollection.map(card => {
                    // remplir une carte en js et l'afficher dans le dom de la liste
                    let newCardElement = app.generateCardElement(card);
                    app.addCardElement(newCardElement);
                })
                
            })
            app.setDragListes();
        }).fail(function(e) {
            console.error(e);
        });
    },
    generateBoard: function(boardId) {
        let board = document.querySelector('.board');
        board.setAttribute('board-id', boardId)
    },
    
    generateListeElement: function(liste) {
        let newListe = document.querySelector('.template-liste').cloneNode(true)
        //console.log(newListe)
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
    
    addListeElement: function(newListeElement) {
        let listeContainer = $('.board-listes');
        listeContainer.append(newListeElement);
    },

    generateCardElement: function(card) {
        let newCard = document.querySelector('.template-card').cloneNode(true)
        //console.log(newcard)
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

    addCardElement: function(newCardElement) {
        let cardContainer = $('.liste-cards-'+newCardElement.getAttribute('liste-id'));
        //console.log(cardContainer)
        cardContainer.append(newCardElement);
    },

    handleDblClickListTitle: function(event) {
        let listTitle = $(event.currentTarget);
        listTitle.addClass('is-hidden');
        let listTitleForm = listTitle.next('form');
        listTitleForm.removeClass('is-hidden');
        listTitleForm[0].querySelector('.liste-header-title-input').focus();
    },

    handleBlurListTitle: function(event) {
        let listTitleForm = $(event.currentTarget).parent();
        //console.log(listTitleForm)
        listTitleForm.addClass('is-hidden');
        let listTitle = listTitleForm.prev('.liste-header-show');
        $(event.currentTarget)[0].value = listTitle.contents()[1].textContent;
        listTitle.removeClass('is-hidden');
    },

    createNewListe: function(event) {
        event.preventDefault();
        let newListeName = $('.add-liste-input').eq(0).val();
        let boardId = $('.board').attr('board-id');
        //console.log(boardId);
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
            //console.log(liste)
            let newListeElement = app.generateListeElement(liste);
            $('.add-liste-input').eq(0).val("");
            $('.add-liste-input').blur();
            app.addListeElement(newListeElement);
            app.maxListeOrderNb ++
        }).fail(function(e) {
            console.error(e);
        });
    },

    handleUpdateListeName: function(event) {
        event.preventDefault();
        let liste = $(event.currentTarget).parent().parent();
        app.updateListe(liste);
        $('.liste-header-title-input').blur();
    },

    getMaxListOrderNb: function(listeCollection) {
        let allListes = [... listeCollection];
        orderedListes = allListes.sort((a, b) => b.orderNb - a.orderNb);
        maxOrderNb = orderedListes[0].orderNb;
        return(maxOrderNb);
    },

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
                let listeId = $(this).attr("liste-id");//à changer avec liste_id
                //console.log(listeId);
                //console.log(posLeft, posTop); //permet de vérifier que le offset fonctionne bien
                app.updateListe($(this));
            }
        });
    },

    updateListe: function(liste) {
        let listeTitle = liste.find('.liste-header-title-input').val();
        //console.log(listeTitle);
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
            //console.log(updatedListe)
            let listeToUpdateId = updatedListe.listeId;
            let listeToUpdate = $('.liste[liste-id='+ listeToUpdateId +']');
            //console.log(listeToUpdate)
            listeToUpdate.attr('order-nb', updatedListe.orderNb)
            listeToUpdate.find('h3').text(updatedListe.title);
            listeToUpdate.find('input[name=liste-title]').val( updatedListe.title);
        }).fail(function(e) {
            console.error(e);
        });
    }
};

document.addEventListener('DOMContentLoaded', app.init);
