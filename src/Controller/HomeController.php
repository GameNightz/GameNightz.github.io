<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    #[Route('/home', name: 'home2')]
    public function home(): Response
    {
        return $this->render('base.html.twig', [
            'foo' => 'bar'
        ]);
    }
}