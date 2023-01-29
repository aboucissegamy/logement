<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/connexion', name: 'app_login')]// /connexion pour definir la route du login  
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) { // nous permettre de savoir si un user(utilisateure) est connecté
        //     return $this->redirectToRoute('target_path'); // si l'utlisateur est connecté redirige le sur ce chemin
        // }

        // get the login error if there is one(pour gerer le message d'erreur)
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername(); //recuperer le dernier nom qui a été rentré par le user.

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/deconnexion', name: 'app_logout')] // la route pour se deconnecter.
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
