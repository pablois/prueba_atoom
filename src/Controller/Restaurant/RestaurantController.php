<?php

namespace App\Controller\Restaurant;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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

}