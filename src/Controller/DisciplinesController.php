<?php

namespace App\Controller;

use App\Entity\Disciplines;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/disciplines', name: 'disciplines.')]
class DisciplinesController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupérer les disciplines actives depuis la base de données
        $disciplines = $entityManager->getRepository(Disciplines::class)->findBy(['isActive' => true]);

        return $this->render('disciplines/index.html.twig', [
            'disciplines' => $disciplines
        ]);
    }
}