<?php

namespace Api\Controller;

use Api\Entity\Liste;
use Api\Repository\ListeRepository;
use Api\Controller\AbstractController;

class ListeController extends AbstractController
{
    private $listeRepository;

    public function __construct()
    {
        $this->listeRepository = new listeRepository();
    }   


    public function getListe($id)
    {
        $liste = $this->listeRepository->findOne($id);
        echo json_encode($liste);  
    }

    public function newListe($post)
    {
        if (isset($post['submit'])) {
            $liste = new Liste();
            $liste
                ->setTitle($post["title"])
                ->setOrderNb($post["orderNb"])
                ->setBoard_id($post["boardId"]);
                //->setPosLeft($post["posLeft"]) pas la peine, positionnée à un endroit précis par défaut à la création
                //->setPosTop($post["posTop"]);  idem

            $this->listeRepository->addListe($liste);
        }
    }

    public function editListe($liste){
        if (isset($post['edit']))
        {
            $liste
                ->setTitle($post["title"])
                ->setOrderNb($post['orderNb'])
                ->setPosLeft($post["posLeft"])
                ->setPosTop($post["posTop"]);
        
            $this->listeRepository->editListe($liste);
        }
    }
        
    public function deleteListe($id)
    {
        $this->listeRepository->delete($id);   
    }
}