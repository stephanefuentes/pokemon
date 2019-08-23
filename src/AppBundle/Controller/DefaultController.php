<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Pokemon;
use AppBundle\Entity\Type;
use AppBundle\Entity\Affinity;
use AppBundle\Entity\User;
use AppBundle\Entity\Attack;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $pokemons = $em->getRepository('AppBundle:Pokemon')->findAll();

        return $this->render('default/index.html.twig' , [ 'pokemons'  => $pokemons ] );
    }

    /**
     * @Route("/types", name="types")
     */
    public function typesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $types = $em->getRepository('AppBundle:Type')->findAll();

        return $this->render('default/types.html.twig' , [ 'types'  => $types ] );
    }

    /**
     * @Route("/create_fight", name="create_fight")
     */
    public function createFightAction($request)
    {
        $em = $this->getDoctrine()->getManager();

        $pokemons = $em->getRepository('AppBundle:Pokemon')->findAll();

        return $this->render('default/index.html.twig' , [ 'pokemons'  => $pokemons ] );
    }

    /**
     * @Route("/login", name="login")
     */
    public function logAction(Request $request)
    {
        if( $request->request->get('name') )
        {
            $name = $request->request->get('name');
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('AppBundle:User')->findOneByName($name);

            if( empty ($user) )
            {
                $user = new User();
                $user->setName($name);
                $em->persist($user);
                $em->flush();
            }

            $request->getSession()->set('user' , $user);
        }

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
        $request->getSession()->clear();
        return $this->redirectToRoute('home');
    }

}
