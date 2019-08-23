<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\User;
use AppBundle\Entity\Fight;

class UserController extends Controller
{

    /**
     * @Route("/user/{id}", name="show_user")
     */
    public function showAction(Request $request, User $user)
    {
        // avant test fonctionnel

        // $fights =  $this->getDoctrine()->getManager()     
        //     ->createQueryBuilder("fight")
        //     ->select('f')                                        
        //     ->from(Fight::class, 'f')
        //     ->join("f.user1", 'u1') 
        //     ->join("f.user2", 'u2') 
        //     ->where('u1.id = :id')
        //     ->setParameters([                                                     
        //         "id" => $user->getId(),          
        //     ])                                                     
        //     ->getQuery()                                                          
        //     ->getResult();


        //  Apres les test fonctionnels
        $fights =  $this->getDoctrine()->getManager()
            ->createQueryBuilder("fight")
            ->select('f')
            ->from(Fight::class, 'f')
            ->join("f.user1", 'u1')
            ->join("f.user2", 'u2')
            ->where('u1.id = :id')
            ->orWhere('u2.id = :id')
            ->setParameters([
                "id" => $user->getId(),
            ])
            ->getQuery()
            ->getResult();

        return $this->render('user/show.html.twig' , [ 'user'  => $user , 'fights' => $fights ] );
    }





}
