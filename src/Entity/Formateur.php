<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 * @ApiResource
 * 
 */
class Formateur extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    
}
