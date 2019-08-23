<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FightTurns
 *
 * @ORM\Table(name="fight_turns", indexes={@ORM\Index(name="fight_id", columns={"fight_id", "attack1", "attack2"}), @ORM\Index(name="attack1", columns={"attack1"}), @ORM\Index(name="attack2", columns={"attack2"}), @ORM\Index(name="IDX_15531764AC6657E4", columns={"fight_id"})})
 * @ORM\Entity
 */
class FightTurn
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
     * @var integer
     *
     * @ORM\Column(name="pokemon1_hp", type="integer", nullable=false)
     */
    private $pokemon1Hp;

    /**
     * @var integer
     *
     * @ORM\Column(name="pokemon2_hp", type="integer", nullable=false)
     */
    private $pokemon2Hp;

    /**
     * @var \Attacks
     *
     * @ORM\ManyToOne(targetEntity="Attack")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="attack2", referencedColumnName="id")
     * })
     */
    private $attack2;

    /**
     * @var \Fights
     *
     * @ORM\ManyToOne(targetEntity="Fight", inversedBy="turns")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fight_id", referencedColumnName="id")
     * })
     */
    private $fight;

    /**
     * @var \Attacks
     *
     * @ORM\ManyToOne(targetEntity="Attack")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="attack1", referencedColumnName="id")
     * })
     */
    private $attack1;



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
     * Set pokemon1Hp
     *
     * @param integer $pokemon1Hp
     *
     * @return FightTurn
     */
    public function setPokemon1Hp($pokemon1Hp)
    {
        $this->pokemon1Hp = $pokemon1Hp;

        return $this;
    }

    /**
     * Get pokemon1Hp
     *
     * @return integer
     */
    public function getPokemon1Hp()
    {
        return $this->pokemon1Hp;
    }

    /**
     * Set pokemon2Hp
     *
     * @param integer $pokemon2Hp
     *
     * @return FightTurn
     */
    public function setPokemon2Hp($pokemon2Hp)
    {
        $this->pokemon2Hp = $pokemon2Hp;

        return $this;
    }

    /**
     * Get pokemon2Hp
     *
     * @return integer
     */
    public function getPokemon2Hp()
    {
        return $this->pokemon2Hp;
    }

    /**
     * Set attack2
     *
     * @param \AppBundle\Entity\Attack $attack2
     *
     * @return FightTurn
     */
    public function setAttack2(\AppBundle\Entity\Attack $attack2 = null)
    {
        $this->attack2 = $attack2;

        return $this;
    }

    /**
     * Get attack2
     *
     * @return \AppBundle\Entity\Attack
     */
    public function getAttack2()
    {
        return $this->attack2;
    }

    /**
     * Set fight
     *
     * @param \AppBundle\Entity\Fight $fight
     *
     * @return FightTurn
     */
    public function setFight(\AppBundle\Entity\Fight $fight = null)
    {
        $this->fight = $fight;

        return $this;
    }

    /**
     * Get fight
     *
     * @return \AppBundle\Entity\Fight
     */
    public function getFight()
    {
        return $this->fight;
    }

    /**
     * Set attack1
     *
     * @param \AppBundle\Entity\Attack $attack1
     *
     * @return FightTurn
     */
    public function setAttack1(\AppBundle\Entity\Attack $attack1 = null)
    {
        $this->attack1 = $attack1;

        return $this;
    }

    /**
     * Get attack1
     *
     * @return \AppBundle\Entity\Attack
     */
    public function getAttack1()
    {
        return $this->attack1;
    }
}
