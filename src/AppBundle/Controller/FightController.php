<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Pokemon;
use AppBundle\Entity\Type;
use AppBundle\Entity\Fight;
use AppBundle\Services\FightService;

class FightController extends Controller
{
    /**
     * @Route("/create_fight", name="create_fight")
     */
    public function createFightAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $fight = new Fight();
        $form = $this->createForm('AppBundle\Form\FightType', $fight);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $pokemon = $form->get('pokemon1')->getData();
            $pokemon2 = $form->get('pokemon2')->getData();

            if($pokemon2 == null )
            {
                $fight = $em->getRepository('AppBundle:Fight')->createRandomComputerFight( 
                    $request->getSession()->get('user') , $pokemon
                );
            }
            else
            {
                $fight = $em->getRepository('AppBundle:Fight')->createComputerFight( 
                    $request->getSession()->get('user') , $pokemon , $pokemon2
                );
            }

            
            
            return $this->redirectToRoute('fight', array('id' => $fight->getId()));
        }


        $pokemons = $em->getRepository('AppBundle:Pokemon')->findAll();

        return $this->render('fight/index.html.twig' , 
        [ 
            'pokemons'  => $pokemons, 
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/play_turn/{id}", name="play")
     */
    public function playTurn( Request $request, FightService $service, Fight $fight )
    {
        $em = $this->getDoctrine()->getManager();
        $attackId = $request->request->get('attack_id');
        $user = $request->getSession()->get('user');

        $attack = $em->getRepository('AppBundle:Attack')->findOneById($attackId);

        // computer attack

        $attack2 = $fight->getPokemon2()->getRandomAttack();

        $service->calculateTurnDamage($fight, $attack , $attack2 );
        return $this->redirectToRoute('fight', array('id' => $fight->getId()));
    }

    /**
     * @Route("/show_fight/{id}", name="fight")
     */
    public function showAction(Request $request, Fight $fight)
    {
        $user = $request->getSession()->get('user');

        return $this->render('fight/show.html.twig' , [ 'fight'  => $fight ] );
    }





}
