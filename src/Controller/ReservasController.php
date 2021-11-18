<?php

namespace App\Controller;

use App\Entity\Reservas;
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
        $reservas = new Reservas();
        $reservasArray = $reservas->actualizarReservas();
        $reservasJson = json_encode($reservasArray);
        file_put_contents('reservas.json', $reservasJson);
        return $this->render('reservas/index.html.twig', [
            'reservas' => $reservasArray,
            'json' => $reservasJson,
        ]);
    }
}
