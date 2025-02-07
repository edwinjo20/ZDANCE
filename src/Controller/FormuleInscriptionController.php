<?php

namespace App\Controller;

use App\Entity\FormuleInscription\Admins;
use App\Form\FormuleInsrciptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admins/formule', name: 'formule.')]
final class FormuleInscriptionController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(): Response
    {
        
        return $this->render('formule_inscription/index.html.twig', [
            'controller_name' => 'FormuleInscriptionController',
        ]);
    }
    #[Route('/new', name: 'new', methods:['POST','GET'])]
    public function new(Request $request,EntityManagerInterface $entityManager): Response
    {

        $formule = new FormuleInscription();
        $form = $this->createForm(FormuleInsrciptionType::class, $formule);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $entityManager->persist($formule);
            $entityManager->flush();
            return $this->redirectToRoute('formule.index');
        }
        return $this->render('formule_inscription/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
