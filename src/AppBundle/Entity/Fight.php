<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fights
 *
 * @ORM\Table(name="fights", indexes={@ORM\Index(name="user1", columns={"user1", "pokemon1", "user2", "pokemon2"}), @ORM\Index(name="pokemon1", columns={"pokemon1"}), @ORM\Index(name="user2", columns={"user2"}), @ORM\Index(name="pokemon2", columns={"pokemon2"}), @ORM\Index(name="IDX_9927918E8C518555", columns={"user1"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FightRepository")
 */
class Fight
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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="winner", referencedColumnName="id")
     * })
     */
    private $winner;

    /**
     * @var \Pokemon
     *
     * @ORM\ManyToOne(targetEntity="Pokemon")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pokemon2", referencedColumnName="id")
     * })
     */
    private $pokemon2;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user1", referencedColumnName="id")
     * })
     */
    private $user1;

    /**
     * @var \Pokemon
     *
     * @ORM\ManyToOne(targetEntity="Pokemon")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pokemon1", referencedColumnName="id")
     * })
     */
    private $pokemon1;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user2", referencedColumnName="id")
     * })
     */
    private $user2;

    /**
     * @var \Teams
     *
     * @ORM\OneToMany(targetEntity="FightTurn", mappedBy="fight")
     */
    private $turns;



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
     * Set winner
     *
     * @param integer $winner
     *
     * @return Fight
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return integer
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set pokemon2
     *
     * @param \AppBundle\Entity\Pokemon $pokemon2
     *
     * @return Fight
     */
    public function setPokemon2(\AppBundle\Entity\Pokemon $pokemon2 = null)
    {
        $this->pokemon2 = $pokemon2;

        return $this;
    }

    /**
     * Get pokemon2
     *
     * @return \AppBundle\Entity\Pokemon
     */
    public function getPokemon2()
    {
        return $this->pokemon2;
    }

    /**
     * Set user1
     *
     * @param \AppBundle\Entity\User $user1
     *
     * @return Fight
     */
    public function setUser1(\AppBundle\Entity\User $user1 = null)
    {
        $this->user1 = $user1;

        return $this;
    }

    /**
     * Get user1
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser1()
    {
        return $this->user1;
    }

    /**
     * Set pokemon1
     *
     * @param \AppBundle\Entity\Pokemon $pokemon1
     *
     * @return Fight
     */
    public function setPokemon1(\AppBundle\Entity\Pokemon $pokemon1 = null)
    {
        $this->pokemon1 = $pokemon1;

        return $this;
    }

    /**
     * Get pokemon1
     *
     * @return \AppBundle\Entity\Pokemon
     */
    public function getPokemon1()
    {
        return $this->pokemon1;
    }

    /**
     * Set user2
     *
     * @param \AppBundle\Entity\User $user2
     *
     * @return Fight
     */
    public function setUser2(\AppBundle\Entity\User $user2 = null)
    {
        $this->user2 = $user2;

        return $this;
    }

    /**
     * Get user2
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser2()
    {
        return $this->user2;
    }

    public function isOver()
    {
        return $this->winner != null;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->turns = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add turn
     *
     * @param \AppBundle\Entity\FightTurn $turn
     *
     * @return Fight
     */
    public function addTurn(\AppBundle\Entity\FightTurn $turn)
    {
        $this->turns[] = $turn;

        return $this;
    }

    /**
     * Remove turn
     *
     * @param \AppBundle\Entity\FightTurn $turn
     */
    public function removeTurn(\AppBundle\Entity\FightTurn $turn)
    {
        $this->turns->removeElement($turn);
    }

    /**
     * Get turns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTurns()
    {
        return $this->turns;
    }

    // Custom function

    public function getFastestPokemon()
    {
        if( $this->getPokemon1()->getSpeed() > $this->getPokemon2()->getSpeed())
            return $this->getPokemon1();

        return $this->getPokemon2();    
    }

    public function getSlowestPokemon()
    {
        if( $this->getPokemon1()->getSpeed() > $this->getPokemon2()->getSpeed())
            return $this->getPokemon2();

        return $this->getPokemon1();
    }
}
