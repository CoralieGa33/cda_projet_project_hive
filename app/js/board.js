let app = {
    // Penser à modifier ici l'adresse de votre API
    //baseUrl: 'http://localhost:81/Projets/cda_projet_project_hive_0512/app/?api/',
    baseUrl: 'http://localhost/cda/Projets/cda_projet_project_hive/app/?api/',
    
    maxListeOrderNb: 0,
    
    init: function() {
        console.log("initialisation ...")

        $('.add-liste').on('submit', app.handleCreateNewListe);
        $('.board-listes').on('dblclick', '.liste-header-show', app.handleDblClickListTitle);
        $('.board-listes').on('blur', '.liste-header-title-input', app.handleBlurListTitle);
        $('.board-listes').on('submit', '.liste-header-title-form', app.handleUpdateListeName);
        $('.board-listes').on('click', '.delete-liste', app.handleDeleteListe);

        // je charge mon tableau principal
        app.loadBoard();
    },

    // Appel à l'API pour récupérer toutes les infos du tableau principal de l'utilisateur connecté
    loadBoard: function() {
        $.ajax({
            url: app.baseUrl + 'boards',
            method: 'POST',
            data: {
                boardId:`${boardsList[0]['boardId']}`,
            }
        }).done(function(boardDatas) {
            let board = JSON.parse(boardDatas)
            app.generateBoard(board.boardId);

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
    // Je donne un id (récupéré par la requête) à chaque tableau afin de pouvoir en charger d'autre par la suite
    generateBoard: function(boardId) {
        let board = document.querySelector('.board');
        board.setAttribute('board-id', boardId)
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
