<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
    /**
     * @Route("/", name="app_stagiaires_index")
     */
    public function index(StagiaireRepository $stagiaireRepository)
    {
        $stagiaires = $stagiaireRepository->findAll();
        return $this->render('stagiaire/index.html.twig',[
            'stagiaires' => $stagiaires,
        ]);
    }
    /**
     * @Route("/stagiaires/create", name="app_stagiaires_create")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {   
        $stagiaire = new Stagiaire();

        $form = $this->createForm(StagiaireType::class, $stagiaire);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($stagiaire);
            $em->flush();
            return $this->redirectToRoute('app_stagiaires_index');
        }

        return $this->render('stagiaire/create.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}
