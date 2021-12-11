<?php

namespace Api\Controller;

use Api\Entity\Board;
use Api\Repository\BoardRepository;
use Api\Controller\AbstractController;


class BoardController extends AbstractController
{
    private $boardRepository;

    public function __construct()
    {
        $this->boardRepository = new BoardRepository();
    }   

    public function getBoardInfos($id)
    {
        $board = $this->boardRepository->findOne($id);

        echo json_encode($board);
    }

    public function newBoard($post, $owner_id) //enregistre un tableau dans la bdd
    {
        if ($post) {
            $board = new Board();
            $board
                ->setTitle($post["title"])
                ->setColor($post["color"] ?: NULL)
                ->setBackground_id($post["background_id"] ?: NULL)
                ->setOwner_id($owner_id);

            $this->boardRepository->addBoard($board);
            $lastBoard = $this->boardRepository->getLastBoard();
            echo json_encode($lastBoard); 
        }
    }

    public function editBoard($board)
    {
        if (isset($post['edit'])) {
            $board
                ->setTitle($post["title"])
                ->setColor($post["color"])
                ->setBackground_id($post["background_id"]);
    
            $this->boardRepository->editBoard($board);
        }
    }

    public function deleteBoard($id)
    {
        $this->boardRepository->delete($id);
    }

}

