<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Fight;
use AppBundle\Entity\User;
use AppBundle\Entity\Pokemon;

class FightRepository extends EntityRepository
{
	public function createRandomComputerFight(User $user, Pokemon $pokemon)
	{
		$user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneById($user->getId());

		$computer = $this->getEntityManager()->getRepository('AppBundle:User')->getComputer();

		$computerPokemon = $this->getEntityManager()
			->getRepository('AppBundle:Pokemon')
			->getRandomPokemon();

		$fight = $this->createFight( $user, $computer, $pokemon, $computerPokemon);

		return $fight;
	}

	public function createComputerFight(User $user, Pokemon $pokemon , Pokemon $pokemon2)
	{
		$user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneById($user->getId());

		$computer = $this->getEntityManager()->getRepository('AppBundle:User')->getComputer();

		$fight = $this->createFight( $user, $computer, $pokemon, $pokemon2);

		return $fight;
	}

	public function getLastFightTurn(Fight $fight)
	{
		return $this->getEntityManager()->getRepository('AppBundle:FightTurn')->findOneBy(
			 	array('fight'=>$fight),
			 	array('id' => 'DESC')
			 
		);
	}

	private function createFight( $user1 , $user2, $pokemon, $pokemon2)
	{
		$fight = new Fight();
		$fight->setUser1($user1 );
		$fight->setUser2($user2 );
		$fight->setPokemon1($pokemon);
		$fight->setPokemon2($pokemon2);

		$em = $this->getEntityManager();
		$em->persist($fight);
		$em->flush();

		return $fight;
	}
}