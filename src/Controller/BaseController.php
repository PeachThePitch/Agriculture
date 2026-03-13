<?php
namespace App\Controller;

<<<<<<< HEAD
use App\Form\DateeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Date;
use Doctrine\ORM\EntityManagerInterface;
=======
use App\Entity\Unite;
use App\Form\UniteType;
use App\Entity\Parcelle;
use App\Form\ParcelleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ParcelleRepository;

>>>>>>> 998c7452c3c4aaceba15821ffb08f57734f795d0

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')] // /base est l’URL de la page, name est le nom de la route
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
        ]);
<<<<<<< HEAD
    }
    #[Route('/ajoutdate', name: 'app_ajout_date')] // /base est l’URL de la page, name est le nom de la route
    public function ajoutdate(Request $request, EntityManagerInterface $em): Response
    {
        $date= new Date();
        $form = $this->createForm(DateeType::class, $date);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em->persist($date);
                $em->flush();
            $this->addFlash('notice','Date envoyé');
            return $this->redirectToRoute('app_ajout_date');
            }
            }
        return $this->render('base/ajoutdate.html.twig', [
            'form' => $form->createView(),
        ]);
=======
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
            'form' => $form->createView()
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
>>>>>>> 998c7452c3c4aaceba15821ffb08f57734f795d0
    }
}
