<?php
namespace App\Controller;

use App\Form\DateeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Date;
use Doctrine\ORM\EntityManagerInterface;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')] // /base est l’URL de la page, name est le nom de la route
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
        ]);
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
    }
}
