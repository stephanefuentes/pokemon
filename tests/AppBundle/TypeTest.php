<?php

namespace AppBundle\Tests;

use AppBundle\Services\FightService;
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Pokemon;
use AppBundle\Entity\Fight;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TypeTest extends WebTestCase
{
    private $em;
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


    }


    public function testElectrique()
    {
        $this->assertTrue( $this->getMultiplier('Roucoups', 'Fatal-Foudre') == 2 );
        $this->assertTrue( $this->getMultiplier('Pikachu', 'Fatal-Foudre') == 0.5 );
        $this->assertTrue( $this->getMultiplier('Ronflex', 'Fatal-Foudre') == 1 );
        $this->assertTrue( $this->getMultiplier('Axoloto', 'Fatal-Foudre') == 0 );
        $this->assertTrue( $this->getMultiplier('Onix', 'Fatal-Foudre') == 0 );
    }


    public function testEau()
    {
        $this->assertTrue( $this->getMultiplier('Onix', 'Surf') == 4 );
        $this->assertTrue( $this->getMultiplier('Flagadoss', 'Surf') == 0.5 );
        $this->assertTrue( $this->getMultiplier('Ronflex', 'Surf') == 1 );
        $this->assertTrue( $this->getMultiplier('Axoloto', 'Surf') == 1 );
        $this->assertTrue( $this->getMultiplier('Demolosse', 'Surf') == 2 );
    }

    public function testPoison()
    {
        $this->assertTrue( $this->getMultiplier('Demolosse', 'Bomb-Beurk') == 1 );
        $this->assertTrue( $this->getMultiplier('Smogogo', 'Bomb-Beurk') == 0.5 );
        $this->assertTrue( $this->getMultiplier('Marill', 'Bomb-Beurk') == 2 );
        $this->assertTrue( $this->getMultiplier('Flagadoss', 'Bomb-Beurk') == 1 );
        $this->assertTrue( $this->getMultiplier('Magneton', 'Bomb-Beurk') == 0 );
    }

    public function testFeu()
    {
        $this->assertTrue( $this->getMultiplier('Demolosse', 'Lance-Flammes') == 0.5 );
        $this->assertTrue( $this->getMultiplier('Smogogo', 'Lance-Flammes') == 1 );
        $this->assertTrue( $this->getMultiplier('Phyllali', 'Lance-Flammes' ) == 2 );
        $this->assertTrue( $this->getMultiplier('Magneton', 'Lance-Flammes') == 2);
        $this->assertTrue( $this->getMultiplier('Onix', 'Lance-Flammes' ) == 0.5 );
    }



    private function getMultiplier( $pokemonName , $attackName )
    {
        $attack = $this->em->getRepository('AppBundle:Attack')->findOneByName($attackName );
        $pokemon = $this->em->getRepository('AppBundle:Pokemon')->findOneByName($pokemonName);

        return $this->em->getRepository('AppBundle:Type')->getMultiplier($attack->getType() , $pokemon->getTypes() );
    }


    protected function tearDown()
    {
    }

}
