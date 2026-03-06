<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UniteRepository;

final class UniteController extends AbstractController
{
    #[Route('/liste-unite', name: 'app_liste_unite')]
    public function listeUnites(UniteRepository $uniteRepository): Response
    {
        $unites = $uniteRepository->findAll();
        return $this->render('unite/liste_unite.html.twig', [
            'unites' => $unites
        ]);
    }
}
