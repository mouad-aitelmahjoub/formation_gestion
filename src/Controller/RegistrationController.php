<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
	/**
	 * @Route("/register", name="app_register")
	 */
	public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
	{
		$user = new User();
		$form = $this->createForm(RegistrationFormType::class, $user);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			// encode the plain password
			$user->setPassword(
				$passwordEncoder->encodePassword(
					$user,
					$form->get('plainPassword')->getData()
					)
				);
				
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($user);
				$entityManager->flush();
				// do anything else you need here, like send an email
				
				return $this->redirectToRoute('app_users_index');
			}
			
		return $this->render('registration/register.html.twig', [
		'registrationForm' => $form->createView(),
		]);
	}

	/**
	 * @Route("/users", name="app_users_index")
	 */
	public function index(UserRepository $userRepo)
	{
		$users = $userRepo->findAll();
		return $this->render('registration/index.html.twig',[
			'users' => $users,
		]);
	}

	/**
	 * @Route("/users/edit/{id}", name="app_users_edit")
	 */
	public function edit(User $user, Request $request, EntityManagerInterface $em)
	{
		$form = $this->createForm(RegistrationFormType::class, $user);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
			$em->flush();
			$this->addFlash('info', 'Modification Enregistrer! &#128516;');
			return $this->redirectToRoute('app_users_index');
		}

		return $this->render('registration/edit.html.twig',[
			'editForm' => $form->createView(),
		]);
	}
	/**
	 * @Route("/users/delete/{id}", name="app_users_delete", methods="POST")
	 */
	public function delete(User $user, EntityManagerInterface $em)
	{
		$em->remove($user);
		$em->flush();

		$this->addFlash('danger', 'Utilisateur supprimer! &#128521;');
		
		return $this->redirectToRoute('app_users_index');
	}
}
