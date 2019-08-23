<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Types
 *
 * @ORM\Table(name="affinities")
 * @ORM\Entity
 */
class Affinity
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
     * @ORM\Column(name="multiplier", type="decimal", precision=2, scale=1)
     */
    private $multiplier;


    /**
     * @var \Types
     *
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="affinities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type1_id", referencedColumnName="id" )
     * })
     */
    private $firstType;

    /**
     * @var \Types
     *
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type2_id", referencedColumnName="id")
     * })
     */
    private $secondType;
   

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
     * Set multiplier
     *
     * @param integer $multiplier
     *
     * @return Affinity
     */
    public function setMultiplier($multiplier)
    {
        $this->multiplier = $multiplier;

        return $this;
    }

    /**
     * Get multiplier
     *
     * @return integer
     */
    public function getMultiplier()
    {
        return $this->multiplier;
    }

    /**
     * Set firstType
     *
     * @param \AppBundle\Entity\Type $firstType
     *
     * @return Affinity
     */
    public function setFirstType(\AppBundle\Entity\Type $firstType = null)
    {
        $this->firstType = $firstType;

        return $this;
    }

    /**
     * Get firstType
     *
     * @return \AppBundle\Entity\Type
     */
    public function getFirstType()
    {
        return $this->firstType;
    }

    /**
     * Set secondType
     *
     * @param \AppBundle\Entity\Type $secondType
     *
     * @return Affinity
     */
    public function setSecondType(\AppBundle\Entity\Type $secondType = null)
    {
        $this->secondType = $secondType;

        return $this;
    }

    /**
     * Get secondType
     *
     * @return \AppBundle\Entity\Type
     */
    public function getSecondType()
    {
        return $this->secondType;
    }
}
