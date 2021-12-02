<?php

namespace Api\Repository;

use Api\Entity\Board;

class BoardRepository extends ManagerRepository
{
    public function addBoard(object $board)
    {
        $sql = 'INSERT INTO board (title, color, background_id, owner_id) VALUES (?, ?, ?, ?)';
        $this->createQuery($sql, [
            $board->getTitle(),
            $board->getColor(),
            $board->getBackground_id(),
            $board->getOwner_id()
        ]);
    }

    public function editBoard($board)
    {
        $sql = "UPDATE customer SET title, = ?,  color, = ?, background_id = ?, owner_id =? WHERE boardId = ?";
        $this->createQuery($sql, [
            $board->getTitle(),
            $board->getColor(),
            $board->getBackground_id(),
            $board->getBoard_id()
        ]);
    }
}