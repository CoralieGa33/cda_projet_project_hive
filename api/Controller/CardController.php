<?php

namespace Api\Controller;

use Api\Entity\Card;
use Api\Repository\CardRepository;
use Api\Controller\AbstractController;

class CardController extends AbstractController
{
    private $cardRepository;

    public function __construct()
    {
        $this->cardRepository = new CardRepository();
    }   

    public function getCard($id)
    {
        $card = $this->cardRepository->findOne($id);

        echo json_encode($card);
    }

    public function newCard($post) //enregistre une card dans la bdd
    {
        if (isset($post['submit'])) {
            $card = new Card();
            $card
                ->setTitle($post["title"])
                ->setContent($post["content"])
                ->setOrderNb($post["orderNb"])
                ->setColor($post["color"])
                ->setListe_id($post["liste_id"]);

            $this->cardRepository->addCard($card);
        }
    }

    public function editCard($card)
    {
        if (isset($post['edit'])) {
            $card
                ->setTitle($post["title"])
                ->setContent($post["content"])
                ->setOrderNb($post["orderNb"])
                ->setColor($post["color"])
                ->setListe_id($post["liste_id"]);

            $this->cardRepository->editCard($card);
            $updatedCard = $this->CardRepository->findOne($post['cartId']);
            echo json_encode($updatedCard); 
        }
    }

    public function deleteCard($id)
    {
        echo json_encode($this->cardRepository->delete($id));
    }
}

