<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutuzController extends AbstractController
{
    #[Route('/aboutuz', name: 'app_aboutuz')]
    public function index(): Response
    {
        return $this->render('aboutuz/index.html.twig', [
            'controller_name' => 'AboutuzController',
        ]);
    }
}
