<?php

namespace App\Controller;

use App\Entity\Profs;
use App\Form\ProfsType;
use App\Repository\ProfsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admins/profs', name:'profs.')]

final class ProfsController extends AbstractController
{
    #[Route(name: '', methods: ['GET'])]
    public function index(ProfsRepository $profsRepository): Response
    {
        return $this->render('profs/index.html.twig', [
            'profs' => $profsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prof = new Profs();
        $form = $this->createForm(ProfsType::class, $prof);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($prof);
            $entityManager->flush();

            return $this->redirectToRoute('app_profs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profs/new.html.twig', [
            'prof' => $prof,
            'form' => $form,
        ]);
    }

    #[Route('/{idProf}', name: 'show', methods: ['GET'])]
    public function show(Profs $prof): Response
    {
        return $this->render('profs/show.html.twig', [
            'prof' => $prof,
        ]);
    }

    #[Route('/{idProf}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Profs $prof, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProfsType::class, $prof);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('profs.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profs/edit.html.twig', [
            'prof' => $prof,
            'form' => $form,
        ]);
    }

    #[Route('/{idProf}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Profs $prof, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prof->getIdProf(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($prof);
            $entityManager->flush();
        }

        return $this->redirectToRoute('profs.index', [], Response::HTTP_SEE_OTHER);
    }
}
