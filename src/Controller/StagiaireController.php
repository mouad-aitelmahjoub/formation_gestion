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
            $this->addFlash('success', 'Stagiaire Enregistrer!');
            return $this->redirectToRoute('app_stagiaires_index');
        }

        return $this->render('stagiaire/create.html.twig',[
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/stagiaires/{id<[0-9]+>}", name="app_stagiaires_show")
     */
    public function show(Stagiaire $stagiaire)
    {
        return $this->render('stagiaire/show.html.twig', compact('stagiaire'));
    }

    /**
     * @Route("/stagiaires/edit/{id}", name="app_stagiaires_edit")
     */
    public function edit(Stagiaire $stagiaire, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(StagiaireType::class, $stagiaire);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $this->addFlash('info', 'Modification Enregistrer!');
            return $this->redirectToRoute('app_stagiaires_index');
        }

        return $this->render('stagiaire/edit.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/stagiaires/delete/{id}", name="app_stagiaires_delete", methods="POST")
     */
    public function delete(Stagiaire $stagiaire, EntityManagerInterface $em)
    {
        $em->remove($stagiaire);
        $em->flush();

        $this->addFlash('danger', 'Stagiaire supprimer! ');
        
        return $this->redirectToRoute('app_stagiaires_index');
    }
}
