<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class impressumController extends AbstractController
{
    #[Route('/', name: 'index')]
    #[Route('/index', name: 'index2')]
    public function home(): Response
    {
        return $this->render('index.html.twig', [
            'foo' => 'bar'
        ]);
    }
}