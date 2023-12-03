<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserZController extends AbstractController
{
    #[Route('/userz', name: 'app_user_z_index', methods: ['GET'])]
    public function index(UserRepository $userRepository,): Response
    {
        return $this->render('user_z/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
}
