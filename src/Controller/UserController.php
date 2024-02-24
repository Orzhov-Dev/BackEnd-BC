<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher): Response
    {
        // Création d'une nouvelle instance de l'entité User
        $user = new User();

        // Création du formulaire en utilisant la classe UserType pour gérer les données de l'utilisateur
        $form = $this->createForm(UserType::class, $user);

        // Gestion de la soumission du formulaire
        $form->handleRequest($request);

        // Vérification si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des données soumises dans le formulaire
            $user = $form->getData();

            // Hachage du mot de passe de l'utilisateur avant de le stocker dans la base de données
            $password = $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($password);

            // Persistance de l'utilisateur dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();
        }

        // Rendu de la vue Twig associée avec le formulaire créé
        return $this->render('user/index.html.twig', [
            'form' => $form->createView(), // Passage du formulaire à la vue
        ]);
    }
}