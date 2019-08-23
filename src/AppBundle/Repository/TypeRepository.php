<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Fight;
use AppBundle\Entity\User;
use AppBundle\Entity\Pokemon;
use AppBundle\Entity\Affinity;

class TypeRepository extends EntityRepository
{
	public function getMultiplier( $attackType , $defenseTypes )
	{
		$multiplier = 1;

		//  Avant les test fonctionnel

		// $affinity = $this      
		// ->createQueryBuilder("affinity")  
		// ->select('a')                                        
		// ->from(Affinity::class, 'a')
		// ->join("a.firstType", "t1") 
		// ->join("a.secondType", "t2")   
		// ->where('t1.id = :id1')                                                
		// ->Andwhere('t2.id = :id2')
		// ->setParameters([                                                     
		// 	"id1" => $attackType->getId(),  
		// 	"id2" => $defenseTypes->first()->getId(),             
		// 	])                                                     
		// ->getQuery()                                                          
		// ->getSingleResult(); 

		//$multiplier *= $affinity->getMultiplier();



		// Correction aprés les test fonctionnels
		foreach ($defenseTypes as $defenseType) {

			$affinity = $this
				->createQueryBuilder("affinity")
				->select('a')
				->from(Affinity::class, 'a')
				->join("a.firstType", "t1")
				->join("a.secondType", "t2")
				->where('t1.id = :id1')
				->Andwhere('t2.id = :id2')
				->setParameters([
					"id1" => $attackType->getId(),
					"id2" => $defenseType->getId(),
				])
				->getQuery()
				->getSingleResult();

			$multiplier *= $affinity->getMultiplier();
		}

	

		return $multiplier;
	}
}