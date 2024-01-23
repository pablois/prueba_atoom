<?php

namespace App\Controller\Restaurant;

use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    #[Route('/list', name: 'list_restaurants')]
    #[Route('/', name: 'list_restaurants')]

    public function index(): Response
    {
        return $this->render('Restaurant/index.html.twig');
    }

    #[Route('/list', name: 'listEdit_restaurants')]
    public function listEdit(): Response
    {
        return $this->render('Restaurant/listEdit.html.twig');
    }

    #[Route('/new_restaurant', name: 'new_restaurant')]
    public function addRestaurant(): Response
    {
        return $this->render('Restaurant/modalNewRestaurant.html.twig');
    }


    #[Route('/restaurant/{id}', name: 'detailRestaurant')]
    public function detailRestaurant(int $id, RestaurantRepository $restaurant): Response
    {
        // Aunque no hay conexion en la BD, dejamos esta llamada para obtener el restaurante que buscamos segun el id inyectado.
        // $rest = $restaurant->findOnById($id);
        // Modificamos esta variable para que podamos tener acceso a los datos en el detalle de los datos del restaurante.
        $rest['name']  = "Nombre de prueba.";
        $rest['website']  = "www.ejemplo.com";
        $rest['body']  = "Nombre de prueba.";
        $rest['rank']  = "8";

        return $this->render('Restaurant/detailRestaurant.html.twig', ['id'=> $id, 'rest' => $rest]);
    }

}