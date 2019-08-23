<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Types
 *
 * @ORM\Table(name="types")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeRepository")
 */
class Type
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=false)
     */
    private $image;

    /**
     * var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Affinity", mappedBy="firstType")
     */
    private $affinities;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Pokemon", mappedBy="types")
     */
    private $pokemons;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pokemon = new \Doctrine\Common\Collections\ArrayCollection();
        $this->affinities = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Type
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Type
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add affinity
     *
     * @param \AppBundle\Entity\Affinity $affinity
     *
     * @return Type
     */
    public function addAffinity(\AppBundle\Entity\Affinity $affinity)
    {
        $this->affinities[] = $affinity;

        return $this;
    }

    /**
     * Remove affinity
     *
     * @param \AppBundle\Entity\Affinity $affinity
     */
    public function removeAffinity(\AppBundle\Entity\Affinity $affinity)
    {
        $this->affinities->removeElement($affinity);
    }

    public function resetAffinity()
    {
        $this->affinities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get affinities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAffinities()
    {
        return $this->affinities;
    }

    /**
     * Add pokemon
     *
     * @param \AppBundle\Entity\Pokemons $pokemon
     *
     * @return Type
     */
    public function addPokemon(\AppBundle\Entity\Pokemon $pokemon)
    {
        $this->pokemon[] = $pokemon;

        return $this;
    }

    /**
     * Remove pokemon
     *
     * @param \AppBundle\Entity\Pokemons $pokemon
     */
    public function removePokemon(\AppBundle\Entity\Pokemon $pokemon)
    {
        $this->pokemon->removeElement($pokemon);
    }

    /**
     * Get pokemon
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPokemon()
    {
        return $this->pokemon;
    }
}
