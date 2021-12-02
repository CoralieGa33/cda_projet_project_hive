<?php

namespace Api\Repository;

use Api\Entity\Liste;
use Api\Repository\ManagerRepository;


class ListeRepository extends ManagerRepository
{
    public function addListe(object $liste)
    {
        $sql = 'INSERT INTO liste (title, orderNb, board_id, posLeft, posTop, createdAt, updatedAt) VALUES (?, ?, ?, ?, ?,NOW(), NOW())';
        $this->createQuery($sql, [
            $liste->getTitle(),
            $liste->getOrderNb(),
            $liste->getBoard_id(), //peut-être à revoir
            $liste->getposLeft(),
            $liste->getposTop()
        ]);
    }

    public function editListe($liste)
    {
        $sql = "UPDATE liste SET title = ?,  orderNb = ?,  posLeft = ?, posTop = ?, updatedAt = ? WHERE listeId = ?";
        $this->createQuery($sql, [
            $liste->getTitle(),
            $liste->getOrderNb(),
            $liste->getPosLeft(),
            $liste->getPOsTop(),
            date("Y-m-d H:i:s"),
            $liste->getListeId()
        ]);
    }
}