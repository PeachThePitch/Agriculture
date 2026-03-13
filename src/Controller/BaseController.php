<?php
namespace App\Controller;

use App\Entity\Parcelle;
use App\Entity\Unite;
use App\Form\ParcelleType;
use App\Form\SupprimerParcelleType;
use App\Form\UniteType;
use App\Repository\ParcelleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')] // /base est l’URL de la page, name est le nom de la route
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
        ]);
    }

    #[Route('/unite', name: 'app_unite')]
    public function unite(Request $request, EntityManagerInterface $em): Response
    {
        $unite = new Unite();
        $form = $this->createForm(UniteType::class, $unite);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($unite);
                $em->flush();
                $this->addFlash('notice', 'Message envoyé');
                return $this->redirectToRoute('app_unite');
            }
        }
        return $this->render('base/unite.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/parcelle', name: 'app_parcelle')]
    public function parcelle(Request $request, EntityManagerInterface $em): Response
    {
        $parcelle = new Parcelle();
        $form = $this->createForm(ParcelleType::class, $parcelle);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($parcelle);
                $em->flush();
                $this->addFlash('notice', 'Formulaire envoyé');
                return $this->redirectToRoute('app_parcelle');
            }
        }
        return $this->render('base/parcelle.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/liste-parcelle', name: 'app_liste-parcelle')]
    public function listeContacts(Request $request, ParcelleRepository $parcelleRepository): Response
    {
        $parcelles = $parcelleRepository->findAll();
        $form = $this->createForm(SupprimerParcelleType::class, null, [
            'parcelles' => $parcelles,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $selectedParcelles = $form->get('parcelles')->getData();
            foreach ($selectedParcelles as $parcelles) {
                $em->remove($parcelle);
            }
            $em->flush();

            $this->addFlash('notice', 'Parcelles supprimées avec succès');
            return $this->redirectToRoute('app_liste_parcelle');
        }

        return $this->render('base/liste-parcelle.html.twig', [
            'parcelles' => $parcelles,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modifier-parcelle/{id}', name: 'app_modifier_parcelle')]
    public function modifierParcelle(Request $request, Parcelle $parcelle, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ModifierParcelleType::class, $parcelle);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($parcelle);
                $em->flush();
                $this->addFlash('notice', 'Parcelle modifiée');
                return $this->redirectToRoute('app_liste-parcelle');
            }
        }

        return $this->render('base/modifier-parcelle.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    #[Route('/supprimer-parcelle/{id}', name: 'app_supprimer_parcelle')]
    public function supprimerParcelle(Request $request, Parcelle
         $parcelle, EntityManagerInterface $em): Response {
        if ($parcelle != null) {
            $em->remove($parcelle);
            $em->flush();
            $this->addFlash('notice', 'Parcelle supprimée');
        }
        return $this->redirectToRoute('app_liste-parcelle');
    }

}
