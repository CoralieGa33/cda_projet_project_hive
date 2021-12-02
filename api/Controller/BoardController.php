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
            $this->rende
        }
    
}