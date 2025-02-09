<?php

namespace App\Controller;

use App\Entity\Adherents;
use App\Form\AdherentsType;
use App\Repository\AdherentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admins/adherents', name:'admins.adherents.')]
final class AdherentsController extends AbstractController
{
    #[Route( '', name:'index', methods: ['GET'])]
    public function index(AdherentsRepository $adherentsRepository): Response
    {
        return $this->render('admins/adherents/index.html.twig', [
            'adherents' => $adherentsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adherent = new Adherents();
        $form = $this->createForm(AdherentsType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($adherent);
            $entityManager->flush();

            return $this->redirectToRoute('admin.adherents.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adherents/new.html.twig', [
            'adherent' => $adherent,
            'form' => $form,
        ]);
    }

    #[Route('/{idAdh}', name: 'show', methods: ['GET'])]
    public function show(Adherents $adherent): Response
    {
        return $this->render('admins/adherents/show.html.twig', [
            'adherent' => $adherent,
        ]);
    }

    #[Route('/{idAdh}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adherents $adherent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdherentsType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admins.adherents.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admins/adherents/edit.html.twig', [
            'adherent' => $adherent,
            'form' => $form,
        ]);
    }

    #[Route('/{idAdh}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Adherents $adherent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adherent->getIdAdh(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($adherent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admins.adherents.index', [], Response::HTTP_SEE_OTHER);
    }
}
