<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    // (slash pour dire que c'est la page d'accueil)
    #[Route('/', name: 'app_main')]// on appelle cela les attributs en php et url de la page on veut afficherq
    public function index(): Response
    {
        return $this->render('main/index.html.twig', // render est le "rendu" d'une page
        [
            
        ]);
    }
}
