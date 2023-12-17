<?php

namespace App\Controller;

use App\Entity\Projec;
use App\Form\ProjecType;
use App\Repository\ProjecRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/projec')]
class ProjecController extends AbstractController
{
    #[Route('/', name: 'app_projec_index', methods: ['GET'])]
    public function index(ProjecRepository $projecRepository): Response
    {
        return $this->render('projec/index.html.twig', [
            'projecs' => $projecRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_projec_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProjecRepository $projecRepository): Response
    {
        $projec = new Projec();
        $form = $this->createForm(ProjecType::class, $projec);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projecRepository->save($projec, true);

            return $this->redirectToRoute('app_projec_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('projec/new.html.twig', [
            'projec' => $projec,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_projec_show', methods: ['GET'])]
    public function show(Projec $projec): Response
    {
        return $this->render('projec/show.html.twig', [
            'projec' => $projec,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_projec_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Projec $projec, ProjecRepository $projecRepository): Response
    {
        $form = $this->createForm(ProjecType::class, $projec);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projecRepository->save($projec, true);

            return $this->redirectToRoute('app_projec_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('projec/edit.html.twig', [
            'projec' => $projec,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_projec_delete', methods: ['POST'])]
    public function delete(Request $request, Projec $projec, ProjecRepository $projecRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projec->getId(), $request->request->get('_token'))) {
            $projecRepository->remove($projec, true);
        }

        return $this->redirectToRoute('app_projec_index', [], Response::HTTP_SEE_OTHER);
    }
}