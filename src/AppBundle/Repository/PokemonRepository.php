<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Fight;
use AppBundle\Entity\User;
use AppBundle\Entity\Pokemon;

class PokemonRepository extends EntityRepository
{
	public function getRandomPokemon()
	{
		return 
		$this      
		->createQueryBuilder("pokemon")                                          
		->orderBy("RAND()")                                                   
		->setMaxResults(1)                                                    
		->getQuery()                                                          
		->getSingleResult(); 
	}
}