<?php

namespace App\Controller;

use App\Entity\EtatsDesLieux;
use App\Form\EtatsDesLieuxType;
use App\Repository\EtatsDesLieuxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etats/des/lieux')]
class EtatsDesLieuxController extends AbstractController
{
    #[Route('/', name: 'app_etats_des_lieux_index', methods: ['GET'])]
    public function index(EtatsDesLieuxRepository $etatsDesLieuxRepository): Response
    {
        return $this->render('etats_des_lieux/index.html.twig', [
            'etats_des_lieuxes' => $etatsDesLieuxRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_etats_des_lieux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EtatsDesLieuxRepository $etatsDesLieuxRepository): Response
    {
        $etatsDesLieux = new EtatsDesLieux();
        $form = $this->createForm(EtatsDesLieuxType::class, $etatsDesLieux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etatsDesLieuxRepository->save($etatsDesLieux, true);

            return $this->redirectToRoute('app_etats_des_lieux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etats_des_lieux/new.html.twig', [
            'etats_des_lieux' => $etatsDesLieux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etats_des_lieux_show', methods: ['GET'])]
    public function show(EtatsDesLieux $etatsDesLieux): Response
    {
        return $this->render('etats_des_lieux/show.html.twig', [
            'etats_des_lieux' => $etatsDesLieux,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_etats_des_lieux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EtatsDesLieux $etatsDesLieux, EtatsDesLieuxRepository $etatsDesLieuxRepository): Response
    {
        $form = $this->createForm(EtatsDesLieuxType::class, $etatsDesLieux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etatsDesLieuxRepository->save($etatsDesLieux, true);

            return $this->redirectToRoute('app_etats_des_lieux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etats_des_lieux/edit.html.twig', [
            'etats_des_lieux' => $etatsDesLieux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etats_des_lieux_delete', methods: ['POST'])]
    public function delete(Request $request, EtatsDesLieux $etatsDesLieux, EtatsDesLieuxRepository $etatsDesLieuxRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etatsDesLieux->getId(), $request->request->get('_token'))) {
            $etatsDesLieuxRepository->remove($etatsDesLieux, true);
        }

        return $this->redirectToRoute('app_etats_des_lieux_index', [], Response::HTTP_SEE_OTHER);
    }
}
