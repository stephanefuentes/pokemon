<?php

namespace AppBundle\Tests;

use AppBundle\Services\FightService;
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Pokemon;
use AppBundle\Entity\Fight;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FightTest extends WebTestCase
{
    private $em;
    private $user1;
    private $user2; 
    private $fight;
    private $fightService;


    protected function setUp()
    {
        $kernel = static::createKernel();
        $kernel->boot();
         
        $container = $kernel->getContainer();

        $this->em = $container
            ->get('doctrine')
            ->getManager();

        $this->fightService = $container->get('AppBundle\Services\FightService');

        // create dummy users

        $this->user1 = new User();
        $this->user1->setName('test1');
        $this->user2 = new User();
        $this->user2->setName('test2');

        $this->em->persist($this->user1);
        $this->em->persist($this->user2);

        $this->em->flush();
    }


    public function testRoucoupsPikachu()
    {
        
        $this->fight = $this->runFight('Pikachu', 'Roucoups' , 'Fatal-Foudre' , 'Vent Violent');

        $this->assertTrue( $this->fight->getWinner() == $this->user1 );
    }


    public function testPikachuAxoloto()
    {
        
        $this->fight = $this->runFight('Pikachu', 'Axoloto' , 'Fatal-Foudre' , 'Séisme');

        $this->assertTrue( $this->fight->getWinner() == $this->user2 );
    }

    public function testFlagadossScarhino()
    {
        
        $this->fight = $this->runFight('Flagadoss', 'Scarhino' , 'Psyko' , 'Mégacorne');
        var_dump($this->fight->getWinner()->getName());
        $this->assertTrue( $this->fight->getWinner() == $this->user2 );
    }

    public function testRonflexOnix()
    {
        
        $this->fight = $this->runFight('Ronflex', 'Onix' , 'Damoclès' , 'Damoclès');

        $this->assertTrue( $this->fight->getWinner() == $this->user2 );
    }

    private function runFight( $pokemonName, $pokemonName2 , $attackName1, $attackName2 )
    {

        $p1 = $this->em->getRepository('AppBundle:Pokemon')->findOneByName($pokemonName);
        $p2 = $this->em->getRepository('AppBundle:Pokemon')->findOneByName($pokemonName2);


        $this->assertTrue($p1 != null &&  $p2 != null);

        if($p1->getSpeed() > $p2->getSpeed())
        {
            $fight = $this->createFight($p1, $p2);
        }
        else{
            $fight = $this->createFight($p2, $p1);
        }
        

       // $fight = $this->createFight($p1, $p2);

        $attack = $this->em->getRepository('AppBundle:Attack')->findOneByName($attackName1);
        $attack2 = $this->em->getRepository('AppBundle:Attack')->findOneByName($attackName2);

        $this->assertTrue( $attack != null &&  $attack2 != null );

        while($fight->getWinner() == null )
        {
            $this->fightService->calculateTurnDamage( $fight, $attack, $attack2 );
        }

        return $fight;

    }

    private function createFight( $pokemon1 , $pokemon2 )
    {
        $fight = new Fight();
        $fight->setPokemon1($pokemon1);
        $fight->setPokemon2($pokemon2);
        $fight->setUser1($this->user1);
        $fight->setUser2($this->user2);

        $this->em->persist($fight);
        
        $this->fight = $fight;
        return $fight;
    }


  

    protected function tearDown()
    {
        $this->em->remove($this->fight);
        $this->em->remove($this->user1);
        $this->em->remove($this->user2);
        $this->em->flush();
        
    }

}
