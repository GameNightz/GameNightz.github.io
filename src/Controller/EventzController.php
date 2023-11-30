<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventzController extends AbstractController
{
    #[Route('/eventz', name: 'app_eventz')]
    public function index(): Response
    {
        return $this->render('eventz/index.html.twig', [
            'controller_name' => 'EventzController',
        ]);
    }
}
