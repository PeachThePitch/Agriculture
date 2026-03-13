<?php

namespace App\Controller;

use App\Repository\UniteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Unite;
use App\Form\UniteType;
use App\Form\ModifierUniteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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
    public function modifierUnite(Request $request,Unite $unite,EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ModifierUniteType::class, $unite);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
            $em->persist($unite);
            $em->flush();
            $this->addFlash('notice','Unité modifiée');
            return $this->redirectToRoute('app_liste_unite');
            }
            }
        return $this->render('unite/modifier-unite.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
