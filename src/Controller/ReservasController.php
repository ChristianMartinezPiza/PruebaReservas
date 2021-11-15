<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservasController extends AbstractController
{
    /**
     * @Route("/reservas", name="reservas")
     */
    public function index(): Response
    {
        return $this->render('reservas/index.html.twig', [
            'controller_name' => 'ReservasController',
        ]);
    }
}
