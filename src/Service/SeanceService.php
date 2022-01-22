<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Seance;
use App\Entity\ICrud;

class SeanceService implements ICrud
{
    private $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }
    public function ajouter($pData)
    {

        $seance = Seance::creer(
            $pData->getDateDebut(),
            $pData->getDuree(),
            $pData->getNumeroSalle(),
            $pData->getFilm()
        );
        $this->entityManager->persist($seance);
        $this->entityManager->flush();
    }
    public function liste()
    {
        return $this->entityManager->getRepository(Seance::class)->findAll();
    }
    public function sauvegarder()
    {
    }
    public function lire($pId)
    {
        return $this->entityManager->getRepository(Seance::class)->find($pId);
    }
    public function supprimer($pId)
    {
    }
}
