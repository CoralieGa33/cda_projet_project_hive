<?php

namespace Api\Repository;

use Api\Entity\Board;

class BoardRepository extends ManagerRepository
{
    public function addBoard(object $board)
    {
        $sql = 'INSERT INTO board (title, color, background_id, owner_id, createdAt, updatedAt) VALUES (?, ?, ?, ?, NOW(), NOW())';
        $this->createQuery($sql, [
            $board->getTitle(),
            $board->getColor(),
            $board->getBackground_id(),
            $board->getOwner_id()
        ]);
    }

    public function editBoard($board)
    {
        $sql = "UPDATE board SET title = ?,  color = ?, background_id = ?, updatedAt = ? WHERE boardId = ?";
        $this->createQuery($sql, [
            $board->getTitle(),
            $board->getColor(),
            $board->getBackground_id(),
            date("Y-m-d H:i:s"),
            $board->getBoardId()
        ]);
    }
}