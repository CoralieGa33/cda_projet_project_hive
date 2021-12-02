<?php

namespace Api\Repository;

use Api\Entity\Board;
use Api\Repository\ManagerRepository;


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
        $sql = "UPDATE board SET title = ?,  color = ?, background_id = ? WHERE boardId = ?";
        $this->createQuery($sql, [
            $board->getTitle(),
            $board->getColor(),
            $board->getBackground_id (),
            $board->getBoardId()
        ]);
    }
}

