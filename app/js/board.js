let app = {
    baseUrl: 'http://localhost:81/Projets/cda_projet_project_hive_0512/app/?api/',
    
    init: function() {
        console.log("initialisation ...")
        //console.log(userId);
        //console.log(boardsList[0]['owner_id']);

        $('.board-listes').on('dblclick', '.liste-header-show', app.handleDblClickListTitle);
        $('.board-listes').on('blur', '.liste-header-title-input', app.handleBlurListTitle);

        $('.add-liste').on('submit', app.createNewListe);

        app.loadBoard();
    },

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
            //console.log(board.listes)
            let listeCollection = board.listes;
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
        }).fail(function(e) {
            console.error(e);
        });
    },
    
    generateListeElement: function(liste) {
        let newListe = document.querySelector('.template-liste').cloneNode(true)
        //console.log(newListe)
        newListe.id = "liste-"+liste.listeId;
        newListe.classList.remove("template-liste")
        newListe.setAttribute('liste-id', liste.listeId)
        newListe.querySelector('h3').textContent = liste.title;
        newListe.querySelector('input[name=liste-title]').value = liste.title;
        newListe.querySelector('.liste-cards').classList.add('liste-cards-'+liste.listeId)
        newListe.style.left = liste.posLeft+'px';
        newListe.style.top = liste.posTop+'px';
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
        console.log(newListeName);
        $.ajax({
            url: app.baseUrl + 'liste/add',
            method: 'POST',
            data: {
                title: newListeName,
                dataType: 'json',
                orderNb: 10,
                boardId: 0,
            }
        }).done(function(res) {
            console.log(res)
            console.log("requete ok");
        })
    }
};

document.addEventListener('DOMContentLoaded', app.init);
