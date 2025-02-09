<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('admins/cours', name: 'cours.')]

final class CoursController extends AbstractController
{
    #[Route('/cours', name: 'index')]
    public function index(): Response
    {
        return $this->render('cours/index.html.twig', [
            'controller_name' => 'CoursController',
        ]);
    }
    #[Route('/new', name: 'new',methods:['POST','GET'])]
    public function new(Request $request,EntityManagerInterface $entityManager): Response
    {
        $cours = new Cours();
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            try {
            $entityManager->persist($cours);
            $entityManager->flush();
            $this->addFlash('success', 'Discipline modifiée avec succès.');
            return $this->redirectToRoute('cours.index');

        } catch (\Exception $e) {
            $this->addFlash('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
        
        return $this->render('cours/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/', name: 'new',methods:['POST','GET'])]
    public function edit(Request $request,EntityManagerInterface $entityManager): Response
    {
        $cours = new Cours();
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            try {
            $entityManager->persist($cours);
            $entityManager->flush();
            $this->addFlash('success', 'Discipline modifiée avec succès.');
            return $this->redirectToRoute('cours.index');

        } catch (\Exception $e) {
            $this->addFlash('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
        
        return $this->render('cours/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    
}
