<?php

namespace App\Controller\Rider;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/rider/inscription", name="rider_inscription")
     */
    public function index()
    {
        return $this->render('rider/inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }
}
