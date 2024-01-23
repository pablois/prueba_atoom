<?php

namespace App\Controller\Restaurant;

use App\Factory\RestauranteFactory;
use App\Repository\RestauranteRepository;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    #[Route('/list', name: 'list_restaurants')]
    #[Route('/', name: 'list_restaurants')]

    public function index(RestauranteRepository $r): Response
    {
        $result = $r->findAll();

        return $this->render('Restaurant/index.html.twig', ['restaurants' => $result ]);
    }

    #[Route('/list', name: 'listEdit_restaurants')]
    public function listEdit(RestauranteRepository $r): Response
    {
        $result = $r->findAll();

        return $this->render('Restaurant/listEdit.html.twig',['restaurants' => $result ]);
    }

    #[Route('/new_restaurant', name: 'new_restaurant')]
    public function addRestaurant(): Response
    {
        return $this->render('Restaurant/modalNewRestaurant.html.twig');
    }


    #[Route('/restaurant/{id}', name: 'detailRestaurant')]
    public function detailRestaurant(int $id, RestauranteRepository $restaurant): Response
    {
        $rest = $restaurant->findOneById($id);

        return $this->render('Restaurant/detailRestaurant.html.twig', ['rest' => $rest]);
    }

    #[Route('/resturants/export', name: 'exportRestauarant')]
    public function exportRestaurant()
    {
        $allRestaurants = $this->restaurants->findAll();

        $myfile = fopen("namesRestaurant.txt", "w") or die("Unable to open file!");

        foreach($allRestaurants as $restaurant)
        {
            fwrite($myfile, $restaurant->name().'\n');
        }

        fclose($myfile);

        return new Response("Conversion realizada. ");
    }

}