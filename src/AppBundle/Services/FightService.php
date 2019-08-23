<?php

namespace AppBundle\Services;
use AppBundle\Entity\Attack;
use AppBundle\Entity\Fight;
use AppBundle\Entity\Pokemon;
use AppBundle\Entity\FightTurn;
use Doctrine\ORM\EntityManagerInterface;

class FightService
{

	private $em;
 
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function calculateTurnDamage( Fight $fight, Attack $attack1, Attack $attack2 )
    {
        $lastTurn = $this->em->getRepository('AppBundle:Fight')->getLastFightTurn($fight);

        if($lastTurn == null)
        {
        	$pokemon1HP = $fight->getPokemon1()->getHp();
        	$pokemon2HP = $fight->getPokemon2()->getHp();
        }
        else
        {
        	$pokemon1HP = $lastTurn->getPokemon1Hp();
        	$pokemon2HP = $lastTurn->getPokemon2Hp();
        }

        $pokemon1 = $fight->getPokemon1();
        $pokemon2 = $fight->getPokemon2();

        // first Pokemon

        $damage = $this->getAttackDamage( $pokemon1, $pokemon2, $attack1 ) ;
        $pokemon2HP = max( $pokemon2HP - $damage , 0);

        // second Pokemon

        $damage = $this->getAttackDamage( $pokemon2, $pokemon1, $attack2 ) ;
        $pokemon1HP = max( $pokemon1HP - $damage , 0);


        $turn = new FightTurn();
        $turn->setFight($fight);
        $turn->setPokemon1HP($pokemon1HP);
        $turn->setPokemon2HP($pokemon2HP);
        $turn->setAttack1($attack1);
        $turn->setAttack2($attack2);

        $this->em->persist($turn);

        // decide winner

        if($pokemon1HP == 0 )
        {
        	$fight->setWinner($fight->getUser2());
        	$this->em->persist($fight);
        }
        	

        if($pokemon2HP == 0 )
        {
        	$fight->setWinner($fight->getUser1());
        	$this->em->persist($fight);
        }
        	
        $this->em->flush();
    }

    public function getAttackDamage( Pokemon $attacker, Pokemon $target, Attack $attack )
    {
        $multiplier = $this->em->getRepository('AppBundle:Type')->getMultiplier($attack->getType() , $target->getTypes() );

        $damage = $this->calculateDamage($attack->getPower() , $multiplier, $attacker->getPower(), $target->getDefense());
        $damage = round($damage);

        return $damage;
    }

    private function calculateDamage(  $power, $multiplier, $attack , $defense )
    {
    	return $power * ($attack / $defense) / 3.5 * $multiplier; 
    }
}