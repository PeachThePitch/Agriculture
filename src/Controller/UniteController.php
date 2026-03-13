<?php

namespace App\Controller;

use App\Entity\Unite;
use App\Form\ModifierUniteType;
use App\Form\SupprimerUniteType;
use App\Repository\UniteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UniteController extends AbstractController
{
    #[Route('/liste-unite', name: 'app_liste_unite', methods: ['GET', 'POST'])]
    public function listeUnites(Request $request, UniteRepository $uniteRepository, EntityManagerInterface $em): Response {
        $unites = $uniteRepository->findAll();
        $form = $this->createForm(SupprimerUniteType::class, null, [
            'unites' => $unites
            ]);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
            $selectedUnite = $form->get('unites')->getData();
            foreach ($selectedUnite as $unites) {
            $em->remove($unites);
            }
            $em->flush();
            $this->addFlash('notice', 'Unités supprimées avec succès');
            return $this->redirectToRoute('app_liste_unite');
            }
        return $this->render('unite/liste_unite.html.twig', [
            'unites' => $unites,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modifier-unite/{id}', name: 'app_modifier_unite')]
    public function modifierUnite(Request $request, Unite $unite, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ModifierUniteType::class, $unite);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($unite);
                $em->flush();
                $this->addFlash('notice', 'Unité modifiée');
                return $this->redirectToRoute('app_liste_unite');
            }
        }
        return $this->render('unite/modifier-unite.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/supprimer-unite/{id}', name: 'app_supprimer_unite')]
    public function supprimerUnite(Request $request, Unite
         $unite, EntityManagerInterface $em): Response {
        if ($unite != null) {
            $em->remove($unite);
            $em->flush();
            $this->addFlash('notice', 'Unité supprimée');
        }
        return $this->redirectToRoute('app_liste_unite');
    }
}
