<?php

namespace App\Controller;

use App\Repository\UniteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Unite;
use App\Form\UniteType;

final class UniteController extends AbstractController
{
    #[Route('/liste-unite', name: 'app_liste_unite')]
    public function listeUnites(UniteRepository $uniteRepository): Response
    {
        $unites = $uniteRepository->findAll();
        return $this->render('unite/liste_unite.html.twig', [
            'unites' => $unites,
        ]);
    }

    #[Route('/modifier-unite/{id}', name: 'app_modifier_unite')]
    public function modifierUnite(): Response
    {
        return $this->render('unite/modifier-unite.html.twig', [
        ]);
    }
}
