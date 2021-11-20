<?php

namespace App\Controller;

use App\Entity\Reservas;
use App\Form\BusquedaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservasController extends AbstractController
{
    /**
     * @Route("/reservas", name="reservas")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(BusquedaType::class);
        $form->handleRequest($request);
        $reservas = new Reservas();
        $reservasArray = $reservas->actualizarReservas();
        $arrayFiltrado = $reservasArray;
        if ($form->isSubmitted() && $form->isValid()){
            $arrayFiltrado = [];
            for($columna = 0; $columna<count($reservasArray); $columna++){
                if (str_contains(strtolower($reservasArray[$columna]->getHotel()), strtolower($form["busqueda"]->getData()))
                    ||str_contains(strtolower($reservasArray[$columna]->getLocalizador()), strtolower($form["busqueda"]->getData()))
                    ||str_contains(strtolower($reservasArray[$columna]->getHuesped()), strtolower($form["busqueda"]->getData()))
                    ||str_contains(strtolower($reservasArray[$columna]->getEntrada()), strtolower($form["busqueda"]->getData()))
                    ||str_contains(strtolower($reservasArray[$columna]->getSalida()), strtolower($form["busqueda"]->getData()))
                    ||str_contains(strtolower($reservasArray[$columna]->getPrecio()), strtolower($form["busqueda"]->getData()))
                    ||str_contains(strtolower($reservasArray[$columna]->getAcciones()), strtolower($form["busqueda"]->getData()))){
                    array_push($arrayFiltrado, $reservasArray[$columna]);
                }
            }
            $reservasJson = json_encode($arrayFiltrado);
            file_put_contents('reservas.json', $reservasJson);
            return $this->render('reservas/index.html.twig', [
                'busqueda'=>$form->createView(),
                'reservas' => $reservasArray,
                'json' => $reservasJson,
                'filtrado' => $arrayFiltrado,
            ]);
        }
        $reservasJson = json_encode($arrayFiltrado);
        file_put_contents('reservas.json', $reservasJson);
        return $this->render('reservas/index.html.twig', [
            'busqueda'=>$form->createView(),
            'reservas' => $reservasArray,
            'json' => $reservasJson,
            'filtrado' => $arrayFiltrado,
        ]);
    }
}
