<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attacks
 *
 * @ORM\Table(name="attacks", indexes={@ORM\Index(name="type_id", columns={"type_id"})})
 * @ORM\Entity
 */
class Attack
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
     * @var integer
     *
     * @ORM\Column(name="power", type="integer", nullable=false)
     */
    private $power;

    /**
     * @var \Types
     *
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Pokemon", mappedBy="attacks")
     */
    private $pokemons;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    private $description;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pokemon = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Attack
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
     * Set power
     *
     * @param integer $power
     *
     * @return Attack
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return integer
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\Type $type
     *
     * @return Attack
     */
    public function setType(\AppBundle\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add pokemon
     *
     * @param \AppBundle\Entity\Pokemon $pokemon
     *
     * @return Attack
     */
    public function addPokemon(\AppBundle\Entity\Pokemon $pokemon)
    {
        $this->pokemon[] = $pokemon;

        return $this;
    }

    /**
     * Remove pokemon
     *
     * @param \AppBundle\Entity\Pokemon $pokemon
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

    /**
     * Get pokemons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPokemons()
    {
        return $this->pokemons;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Attack
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
