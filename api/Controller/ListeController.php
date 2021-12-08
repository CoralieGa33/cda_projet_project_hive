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
        if ($post) {
            $liste = new Liste();
            $liste
            ->setTitle($post["title"])
            ->setOrderNb($post["orderNb"])
            ->setBoard_id($post["boardId"]);
            //->setPosLeft($post["posLeft"]) pas la peine, positionnée à un endroit précis par défaut à la création
            //->setPosTop($post["posTop"]);  idem
            
            $this->listeRepository->addListe($liste);
            $lastListe = $this->listeRepository->getLastListe();
            echo json_encode($lastListe); 
        }
    }

    public function editListe($post){
        if(!in_array('', $post)) {
            $liste = $this->listeRepository->findOne($post['listeId']);
        
            $liste
                ->setTitle($post["title"])
                ->setOrderNb($post['orderNb'])
                ->setPosLeft($post["posLeft"])
                ->setPosTop($post["posTop"]);
        
            $this->listeRepository->editListe($liste);
            $updatedListe = $this->listeRepository->findOne($post['listeId']);
            echo json_encode($updatedListe); 
        }
    }
        
    public function deleteListe($id)
    {
        echo json_encode($this->listeRepository->delete($id));
    }
}