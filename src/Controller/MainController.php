<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     *
     * Require IS_AUTHENTICATED_FULLY for only this controller method.
     *
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(Request $request)
    {
        //1) get the current user's role

        //2) switch case
            //a) case role=cavalier
            //b) case role=enseignant
            //c) case role=administration
/*        $user = $this->getUser();
        $user->setRoles(['ROLE_SUPERADMIN']);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();*/

//        dd($this->getUser()->getRoles()[0]);
        switch($this->getUser()->getRoles()[0]){
            case 'ROLE_SUPERADMIN':
                return $this->render('administration/accueil.html.twig', [

                ]);
                break;
            default:
                return $this->render('main/index.html.twig', []);
                break;
        }
//            dd($request->attributes->get('_route'));

    }
}
