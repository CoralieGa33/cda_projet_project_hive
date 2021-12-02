<?php

namespace Api\Repository;

use Api\Entity\Card;

class CardRepository extends ManagerRepository
{
    public function addCard(object $card)
    {
        $sql = 'INSERT INTO card (title, content, orderNb, color, liste_id, createdAt, updatedAt) VALUES (?, ?, ?, ?, ?, NOW(), NOW())';
        $this->createQuery($sql, [
            $card->getTitle(),
            $card->getContent(),
            $card->getOrderNb(),
            $card->getColor(),
            $card->getListe_id()
        ]);
    }

    public function editCard($card)
    {
        $sql = "UPDATE card SET title = ?,  content = ?, orderNb = ?, color = ?, liste_id = ?, updatedAt = ? WHERE cardId = ?";
        $this->createQuery($sql, [
            $card->getTitle(),
            $card->getContent(),
            $card->getOrderNb(),
            $card->getColor(),
            $card->getListe_id(),
            date("Y-m-d H:i:s"),
            $card->getCardId()
        ]);
    }
}