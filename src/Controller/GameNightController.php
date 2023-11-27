<?php

namespace App\Controller;

use App\Entity\{GameNight, Game, User};
use App\Form\GameNightType;
use App\Repository\GameNightRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gameNight')]
class GameNightController extends AbstractController
{
    #[Route('/', name: 'app_game_night_index', methods: ['GET'])]
    public function index(GameNightRepository $gameNightRepository): Response
    {
        return $this->render('game_night/index.html.twig', [
            'game_nights' => $gameNightRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_game_night_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $gameNight = new GameNight();
        
        $form = $this->createForm(GameNightType::class, $gameNight);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($gameNight);
            $entityManager->flush();

            return $this->redirectToRoute('app_game_night_index', [], Response::HTTP_SEE_OTHER);
        }
        

        return $this->render('game_night/new.html.twig', [
            'game_night' => $gameNight,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_game_night_show', methods: ['GET'])]
    public function show(GameNight $gameNight): Response
    {
        return $this->render('game_night/show.html.twig', [
            'game_night' => $gameNight,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_game_night_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GameNight $gameNight, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GameNightType::class, $gameNight);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_game_night_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('game_night/edit.html.twig', [
            'game_night' => $gameNight,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_game_night_delete', methods: ['POST'])]
    public function delete(Request $request, GameNight $gameNight, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gameNight->getId(), $request->request->get('_token'))) {
            $entityManager->remove($gameNight);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_game_night_index', [], Response::HTTP_SEE_OTHER);
    }
}
