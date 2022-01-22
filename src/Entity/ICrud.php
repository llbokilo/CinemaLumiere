<?php

namespace App\Entity;

interface ICrud{
    public function ajouter($pData);
    public function liste();
    public function lire($pId);
    public function sauvegarder();
    public function supprimer($pId);
}