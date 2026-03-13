<?php

namespace App\Controller;

use App\Entity\Date;
use App\Form\ModifierDateType;
use App\Repository\DateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\SupprimerDateType;

final class DateController extends AbstractController
{
    #[Route('/listedate', name: 'app_liste_date')] // /base est l’URL de la page, name est le nom de la route
    public function listedate(Request $request, DateRepository $dateRepository, EntityManagerInterface $em): Response
    {
        $date = $dateRepository->findAll();
        $form = $this->createForm(SupprimerDateType::class, null, [
            'date' => $date,
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $selectedDate = $form->get('date')->getData();
            foreach ($selectedDate as $date) {
                $em->remove($date);
            }
            $em->flush();
            $this->addFlash('notice', 'Dates supprimées avec succès');
            return $this->redirectToRoute('app_liste_date');
        }
        return $this->render('date/listedate.html.twig', [
            'date' => $date,
            'form'=>$form->createView(),
        ]);
    }
    #[Route('/modifierdate/{id}', name: 'app_modifier_date')]
    public function modifierDate(Request $request, Date $date, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ModifierDateType::class, $date);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($date);
                $em->flush();
                $this->addFlash('notice', 'Date modifiée');
                return $this->redirectToRoute('app_liste_date');
            }
        }
        return $this->render('date/modifierdate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/supprimercategorie/{id}', name: 'app_supprimer_date')]
    public function supprimerDate(Request $request, Date $date, EntityManagerInterface $em): Response {
        if ($date != null) {
            $em->remove($date);
            $em->flush();
            $this->addFlash('notice', 'Date supprimée');
        }
        return $this->redirectToRoute('app_liste_date');
    }
}
