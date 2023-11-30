<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LocationZController extends AbstractController
{
    #[Route('/locationz', name: 'app_location_z')]
    public function index(): Response
    {
        return $this->render('location_z/index.html.twig', [
            'controller_name' => 'LocationZController',
        ]);
    }
}
