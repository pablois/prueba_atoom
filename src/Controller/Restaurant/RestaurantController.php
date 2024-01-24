<?php

namespace App\Controller\Restaurant;

use App\Entity\Restaurante;
use App\Repository\RestauranteRepository;
use Doctrine\ORM\EntityManagerInterface;
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


    #[Route('/editRestaurant/{id}', name: 'editRestaurant')]
    public function editRestaurant(int $id, RestauranteRepository $restaurant): Response
    {
        $rest = $restaurant->findOneById($id);

        return $this->render('Restaurant/editRestaurant.html.twig', ['rest' => $rest]);
    }

    #[Route('/updateRestaurant', name: 'updateRestaurant')]
    public function updateRestaurant(Request $request, RestauranteRepository $restaurant): Response
    {

        var_dump("se esta llamando");
        $nombre = $request->request->get('nombre');
        $id = $request->request->get('id');
        $website = $request->request->get('website');
        $body = $request->request->get('descripcion');
        $ranking = $request->request->get('ranking');

        $restaurant->update( $id,  $nombre,   $website,  $body,  $ranking);

        return new Response("Actualizado correctamente");
    }

    #[Route('/deleteRestaurant', name: 'deleteRestaurant')]
    public function deleteRestaurant(Request $request, RestauranteRepository $restaurant): Response
    {
        $id = $request->request->get('id');
        $restaurant->delete($id);

        return new Response ( "Registro borrado");
    }


    #[Route('/addNewRestaurant', name: 'addNewRestaurant')]
    public function addNewRestaurant(Request $request, EntityManagerInterface $entityManager): Response
    {
        $nombre = $request->request->get('nombre');
        $website = $request->request->get('website');
        $body = $request->request->get('descripcion');
        $ranking = $request->request->get('ranking');

        // Aunque en los otros casos de manipulacion de BD, hemos usado la clase QueryBuilder, para
        // insertar registros, es mas eficiente usar la clase EntityManager.
        $rest = new Restaurante();
        $rest->setNombre($nombre);
        $rest->setWebsite($website);
        $rest->setBody($body);
        $rest->setRanking($ranking);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($rest);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response("Insertado correctamente");
    }

    #[Route('/contactForm', name: 'contactForm')]
    public function contactForm()
    {
        return $this->render('Restaurant/contactForm.html.twig');
    }

    #[Route('/restaurant/{id}', name: 'detailRestaurant')]
    public function detailRestaurant(int $id, RestauranteRepository $restaurant): Response
    {
        $rest = $restaurant->findOneById($id);

        return $this->render('Restaurant/detailRestaurant.html.twig', ['rest' => $rest]);
    }

    #[Route('/resturants/export', name: 'exportRestauarant')]
    public function exportRestaurant(RestauranteRepository $restaurant): Response
    {
        $allRestaurants = $restaurant->findAll();

        $myfile = fopen("namesRestaurantURL.txt", "w") or die("Unable to open file!");

        foreach($allRestaurants as $r)
        {
            fwrite($myfile, $r->getNombre()."\r\n");
        }

        fwrite($myfile, 'Archivo generado por URL.'. "\r\n");
        fclose($myfile);

        return new Response("Exportacion realizada correctamente. ");
    }

}