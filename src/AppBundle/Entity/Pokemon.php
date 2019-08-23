<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pokemons
 *
 * @ORM\Table(name="pokemons")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PokemonRepository")
 */
class Pokemon
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
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="hp", type="integer", nullable=false)
     */
    private $hp;

    /**
     * @var integer
     *
     * @ORM\Column(name="power", type="integer", nullable=false)
     */
    private $power;

    /**
     * @var integer
     *
     * @ORM\Column(name="defense", type="integer", nullable=false)
     */
    private $defense;

    /**
     * @var integer
     *
     * @ORM\Column(name="speed", type="integer", nullable=false)
     */
    private $speed;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Attack", inversedBy="pokemons")
     * @ORM\JoinTable(name="pokemon_attack",
     *   joinColumns={
     *     @ORM\JoinColumn(name="pokemon_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="attack_id", referencedColumnName="id")
     *   }
     * )
     */
    private $attacks;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Type", inversedBy="pokemons")
     * @ORM\JoinTable(name="pokemon_type",
     *   joinColumns={
     *     @ORM\JoinColumn(name="pokemon_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     *   }
     * )
     */
    private $types;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attack = new \Doctrine\Common\Collections\ArrayCollection();
        $this->types = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Pokemon
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
     * @return Pokemon
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
     * Set hp
     *
     * @param integer $hp
     *
     * @return Pokemon
     */
    public function setHp($hp)
    {
        $this->hp = $hp;

        return $this;
    }

    /**
     * Get hp
     *
     * @return integer
     */
    public function getHp()
    {
        return $this->hp;
    }

    /**
     * Set power
     *
     * @param integer $power
     *
     * @return Pokemon
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
     * Set defense
     *
     * @param integer $defense
     *
     * @return Pokemon
     */
    public function setDefense($defense)
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * Get defense
     *
     * @return integer
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * Set speed
     *
     * @param integer $speed
     *
     * @return Pokemon
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return integer
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Add type
     *
     * @param \AppBundle\Entity\Type $type
     *
     * @return Pokemon
     */
    public function addType(\AppBundle\Entity\Type $type)
    {
        $this->types[] = $type;

        return $this;
    }

    /**
     * Remove type
     *
     * @param \AppBundle\Entity\Type $type
     */
    public function removeType(\AppBundle\Entity\Type $type)
    {
        $this->types->removeElement($type);
    }

    /**
     * Get type
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Add attack
     *
     * @param \AppBundle\Entity\Attack $attack
     *
     * @return Pokemon
     */
    public function addAttack(\AppBundle\Entity\Attack $attack)
    {
        $this->attacks[] = $attack;

        return $this;
    }

    /**
     * Remove attack
     *
     * @param \AppBundle\Entity\Attack $attack
     */
    public function removeAttack(\AppBundle\Entity\Attack $attack)
    {
        $this->attacks->removeElement($attack);
    }

    /**
     * Get attacks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttacks()
    {
        return $this->attacks;
    }


    public function getRandomAttack()
    {
        $attacks = $this->getAttacks();
        return $attacks[ rand(0, count($attacks) -1 )];
    }


}
