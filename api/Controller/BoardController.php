<?php

namespace Api\Controller;

use Api\Entity\Board;
use Api\Repository\BordRepository;
use Api\Controller\AbstractController;


class BoardController extends AbstractController
{
    private $boardRepository;

    public function __construct()
    {
        $this->boardRepository = new BoardRepository();
    }   


}