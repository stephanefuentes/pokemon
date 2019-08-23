<?php

namespace AppBundle\Tests;

use AppBundle\Services\FightService;
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Pokemon;
use AppBundle\Entity\Fight;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FightListTest extends WebTestCase
{
    private $em;
    private $user1;
    private $user2; 
    private $fight;
    private $fightService;
    private $client;


    protected function setUp()
    {
        $kernel = static::createKernel();
        $kernel->boot();
         
        $container = $kernel->getContainer();

        $this->em = $container
            ->get('doctrine')
            ->getManager();

        $this->fightService = $container->get('AppBundle\Services\FightService');

        $this->client = static::createClient();

        // create dummy users

        $this->user1 = new User();
        $this->user1->setName('test1');
        $this->user2 = new User();
        $this->user2->setName('test2');

        $this->em->persist($this->user1);
        $this->em->persist($this->user2);

        $this->em->flush();
    }

    // Chaque affiche de combat contient une balise h4. Il suffit de les compter sur la page pour verifier si le bon nombre est affiché

    public function testSingleFight()
    {
        $crawler = $this->client->request('GET', '/user/'.$this->user1->getId());

        $this->assertTrue(
            $crawler->filter('h4')->count() == 0
        );
        
        $fight = $this->runRandomFight();

        $crawler = $this->client->request('GET', '/user/'.$this->user1->getId());

        $this->assertTrue(
            $crawler->filter('h4')->count() == 1
        );

        // test de l'affiche du gagnant

        if($fight->getWinner()->getId() == $this->user1->getId() ) 
        {
            $this->assertTrue(
                $crawler->filter('h4:contains("'.$this->user1->getName().'")')->count() == 1
            );
        }
        else
        {
            $this->assertTrue(
                $crawler->filter('h4:contains("'.$this->user2->getName().'")')->count() == 1
            );
        }
    }

    public function testTwoFights()
    {
        $crawler = $this->client->request('GET', '/user/'.$this->user1->getId());

        $this->assertTrue(
            $crawler->filter('h4')->count() == 0
        );

        $crawler = $this->client->request('GET', '/user/'.$this->user2->getId());

        $this->assertTrue(
            $crawler->filter('h4')->count() == 0
        );

        
        $this->runRandomFight();

        $crawler = $this->client->request('GET', '/user/'.$this->user1->getId());

        $this->assertTrue(
            $crawler->filter('h4')->count() == 1
        );

        

        $this->runRandomFight();

        $crawler = $this->client->request('GET', '/user/'.$this->user1->getId());

        $this->assertTrue(
            $crawler->filter('h4')->count() == 2
        );

        $crawler = $this->client->request('GET', '/user/'.$this->user2->getId());

        var_dump($crawler->filter('h4')->count());

        $this->assertTrue(
            
            $crawler->filter('h4')->count() == 2
        );
        echo 'lol'.$this->user2->getId().' '. $crawler->filter('h4')->count();
    }

    private function runRandomFight()
    {

        $p1 = $this->em->getRepository('AppBundle:Pokemon')->getRandomPokemon();
        $p2 = $this->em->getRepository('AppBundle:Pokemon')->getRandomPokemon();

        $this->assertTrue( $p1 != null &&  $p2 != null );

        $fight = $this->createFight($p1, $p2);

        

        while($fight->getWinner() == null )
        {
            $attack = $p1->getRandomAttack();
            $attack2 = $p2->getRandomAttack();
            $this->assertTrue( $attack != null &&  $attack2 != null );
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
        $this->em->flush();
        
        return $fight;
    }


  

    protected function tearDown()
    {
        $fights = $this->em->getRepository('AppBundle:User')->getUserFights($this->user1);
        foreach($fights as $fight)
            $this->em->remove($fight);

        $this->em->remove($this->user1);
        $this->em->remove($this->user2);
        $this->em->flush();
        
    }

}
