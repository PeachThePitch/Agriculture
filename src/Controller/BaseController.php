<?php
namespace App\Controller;

use App\Entity\Parcelle;
use App\Form\ParcelleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ParcelleRepository;


class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')] // /base est l’URL de la page, name est le nom de la route
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
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
    public function listeContacts(ParcelleRepository $parcelleRepository): Response
    {
        $parcelles = $parcelleRepository->findAll();
        return $this->render('base/liste-parcelle.html.twig', [
            'parcelles' => $parcelles


        ]);
    }
}
