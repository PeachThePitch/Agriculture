<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\DateRepository;

final class DateController extends AbstractController
{
    #[Route('/listedate', name: 'app_liste_date')] // /base est l’URL de la page, name est le nom de la route
    public function listedate(DateRepository $dateRepository): Response
    {
        $date= $dateRepository->findAll();
        return $this->render('base/listedate.html.twig', [
            'date'=>$date
        ]);
    }
}
