<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GameNightRepository;
use App\Form\GameNightType;
use App\Entity\GameNight;
#[Route('/eventz')]
class EventzController extends AbstractController
{
    #[Route('/', name: 'app_eventz')]
    public function index(GameNightRepository $gameNightRepository): Response
    {
        return $this->render('eventz/index.html.twig', [
            'game_nights' => $gameNightRepository->findAll(),
        ]);

    }
    #[Route('/{id}', name: 'app_game_night_show', methods: ['GET'])]
    public function show(GameNight $gameNight): Response
    {
        return $this->render('eventz/show.html.twig', [
            'game_night' => $gameNight,
        ]);
    }
}
