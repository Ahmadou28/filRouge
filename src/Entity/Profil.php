<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;



/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 * @ApiResource(
 *     collectionOperations={
 *          "get_profil"={
 *              "method"="GET",
 *              "path"="/admin/profils",
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "security_message"="Vous n'avez pas acces à cette ressource"
 *                  
 *           },
 *           "creer_profil"={
 *              "method"="POST",
 *              "path"="/admin/profils",
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "security_message"="Vous n'avez pas acces à cette ressource"
 *          }
 *      },
 *          itemOperations = {
    *              "show_profil"={
    *                  "method"="GET",
    *                  "path"="/admin/profils/{id}"
    *              },
    *          "update_profil"={
    *              "method"="PUT",
    *              "path"="/admin/profils/{id}"
    *          },
    *              "archive_profil"={
    *                "method" = "DELETE",
    *                "path"="/admin/profils/{id}"
    *                 }
 *          },
 *      
 *          
 *            
 *      
 *      
 *      
 * )
 * 
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="profil")
     */
    private $users;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDelete;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getUsername(): string
    {
        return (string) $this->libelle;
    }
    public function getPassword()
    {
        // not needed for apps that do not check user passwords
    }
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProfil($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getProfil() === $this) {
                $user->setProfil(null);
            }
        }

        return $this;
    }

    public function getIsDelete(): ?bool
    {
        return $this->isDelete;
    }

    public function setIsDelete(bool $isDelete): self
    {
        $this->isDelete = $isDelete;

        return $this;
    }
}
