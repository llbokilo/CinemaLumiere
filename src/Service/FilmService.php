<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Film;
use App\Entity\ICrud;

class FilmService implements ICrud{
    private $entityManager;
    function __construct(EntityManagerInterface $em){
        $this->entityManager = $em;
    }
    public function ajouter($pData)
    {
        // la fonction static permet d'éviter de devoir instantier le film avec le
        // constructeur par défaut
        $film = Film::creer(
            $pData->getTitre(),
            $pData->getResume(),
            $pData->getAnneeProduction(),
            $pData->getRealisateur(),
            $pData->getListeActeurs(),
            $pData->getImageUrl()
        );
        $this->entityManager->persist($film);
        $this->entityManager->flush();
    }
    function supprimer($pId){
        
    }
    function liste(){
        return $this->entityManager->getRepository(Film::class)->findAll();
    }
    function lire($pId){
        return $this->entityManager->getRepository(Film::class)->find($pId);
    }
    function sauvegarder(){
        
    }
}
