<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\User;
use AppBundle\Entity\Fight;

class UserRepository extends EntityRepository
{
    public function getComputer()
    {
        return $this->findOneByName('Computer');
    }

    public function getUserFights( User $user )
    {
        return $this      
            ->createQueryBuilder("fight")
            ->select('f')                                        
            ->from(Fight::class, 'f')
            ->join("f.user1", 'u1') 
            ->join("f.user2", 'u2') 
            ->where('u2.id = :id')
            ->orWhere('u1.id = :id')
            ->setParameters([                                                     
                "id" => $user->getId(),          
            ])                                                     
            ->getQuery()                                                          
            ->getResult(); 
    }
}