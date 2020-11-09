<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use App\Repository\UserRepository;
use App\Repository\StagiaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
	/**
	 * @Route("/stagiaires/index", name="app_stagiaires_index")
	 */
	public function index(Request $request, StagiaireRepository $stagiaireRepository, UserRepository $userRepository)
	{   
		$currentUser = $this->getUser();
		$isAdmin = $currentUser->getRoles() == ['ROLE_ADMIN'] ? true : false;
		
		if ($isAdmin) {
			$userID = 0;
		}
		else{
			$userID = $currentUser->getID();
			$agentsNamesadnIDs = [$currentUser->getName() => $userID];
		}

		//Setting The Default Data
		$query = array('start' => new \DateTime('00:00') , 'end'=> new \DateTime('23:59'),'agent'=>$userID);
		
		
		//Creating The Search Form
		$form = $this->createFormBuilder($query)
					->add('start',DateType::class,['widget' => 'single_text','label'=>'A partir de:'])
					->add('end',DateType::class,['widget' => 'single_text','label'=>'Jusqu\'a:'])
					->getForm();
					if ($isAdmin){

						//get all the agents from the DB
						$agents = $userRepository->findByRole('ROLE_AGENT');

						//an Array of agents names & Ids
						$agentsNamesadnIDs = [
							'Tous les agents' => 0,
						];
						foreach ($agents as $agent ) {
							$agentsNamesadnIDs = $agentsNamesadnIDs + [$agent->getName() => $agent->getId()];
						}

						$form->add('agent',ChoiceType::class,['choices'=>$agentsNamesadnIDs, 'label'=>'Agent:']);
					}
		$form->handleRequest($request);
		
		//Handling Form Submission
		if($form->isSubmitted() && $form->isValid())
		{
			//Getting The Data Submitted By The Form
			$query = $form->getData();
			//dd($query);
		}
		$stagiaires = $stagiaireRepository->findAllByStartandEndandId($query['start'],$query['end'],$query['agent']);
		$NamesAndIds = array_flip($agentsNamesadnIDs);

		return $this->render('stagiaire/index.html.twig',[
			'stagiaires' => $stagiaires,
			"searchForm"=>$form->createView(),
			"query" => $query,
			"agentsNamesadnIDs"=>$NamesAndIds,
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
			$stagiaire->setUser($this->getUser());
			$em->persist($stagiaire);
			$em->flush();
			$this->addFlash('success', 'Stagiaire Enregistrer! &#128516;');
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
		$currentUser = $this->getUser();
		if ($currentUser != $stagiaire->getUser() AND $currentUser->getRoles() != ['ROLE_ADMIN']  ) {
			$this->addFlash('danger', 'Vous ne pouvez pas accéder à ce stagiaire! &#128553;');
			return $this->redirectToRoute('app_stagiaires_index');
		}
		return $this->render('stagiaire/show.html.twig', compact('stagiaire'));
	}

	/**
	 * @Route("/stagiaires/edit/{id}", name="app_stagiaires_edit")
	 */
	public function edit(Stagiaire $stagiaire, Request $request, EntityManagerInterface $em)
	{
		//$this->denyAccessUnlessGranted('ROLE_ADMIN');

		$form = $this->createForm(StagiaireType::class, $stagiaire);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
			$em->flush();
			$this->addFlash('info', 'Modification Enregistrer! &#128516;');
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
		//$this->denyAccessUnlessGranted('ROLE_ADMIN');

		$em->remove($stagiaire);
		$em->flush();

		$this->addFlash('danger', 'Stagiaire supprimer! &#128521;');
		
		return $this->redirectToRoute('app_stagiaires_index');
	}
}
