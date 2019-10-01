<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Description", mappedBy="user", cascade={"persist", "remove"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Objectif", mappedBy="user")
     */
    private $objectifs;


    public function __construct()
    {
        parent::__construct();
        $this->objectifs = new ArrayCollection();
        // your own logic
    }

    public function getDescription(): ?Description
    {
        return $this->description;
    }

    public function setDescription(Description $description): self
    {
        $this->description = $description;

        // set the owning side of the relation if necessary
        if ($this !== $description->getUser()) {
            $description->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Objectif[]
     */
    public function getObjectifs(): Collection
    {
        return $this->objectifs;
    }

    public function addObjectif(Objectif $objectif): self
    {
        if (!$this->objectifs->contains($objectif)) {
            $this->objectifs[] = $objectif;
            $objectif->setUser($this);
        }

        return $this;
    }

    public function removeObjectif(Objectif $objectif): self
    {
        if ($this->objectifs->contains($objectif)) {
            $this->objectifs->removeElement($objectif);
            // set the owning side to null (unless already changed)
            if ($objectif->getUser() === $this) {
                $objectif->setUser(null);
            }
        }

        return $this;
    }

}