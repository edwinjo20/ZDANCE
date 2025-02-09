<?php

namespace App\Controller;

use App\Entity\Salles;
use App\Form\SallesType;
use App\Repository\SallesRepository;
use App\Service\EntityFormatterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/salles', name: 'salles.')]
final class SallesController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(SallesRepository $sallesRepository): Response
    {
        $salles = $sallesRepository->findAll();
        return $this->render('salles/index.html.twig', [
            'salles' => $salles,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $salle = new Salles();
        $form = $this->createForm(SallesType::class, $salle, [
            'validation_groups' => ['Default'],
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile|null $file */
            $file = $form->get('photoSalle')->getData();
            if ($file) {
                $fileName = uniqid() . '.' . $file->guessExtension();
                $destination = $this->getParameter('kernel.project_dir') . '/public/uploads/salles';

                $file->move($destination, $fileName);
                $salle->setPhotoSalle($fileName);
            }

            $entityManager->persist($salle);
            $entityManager->flush();

            $this->addFlash('success', 'Salle enregistrée avec succès.');
            return $this->redirectToRoute('salles.index');
        }

        return $this->render('salles/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Salles $salle, EntityFormatterService $formatterService): Response
    {
        return $this->render('salles/show.html.twig', [
            'salle' => $salle,
            'imagePath' => $formatterService->getImagePath($salle->getPhotoSalle(), 'uploads/salles/'),
            'nomSalle' => $formatterService->formatName($salle->getNomSalle()),
            'quota' => $formatterService->formatQuota($salle->getQuotaSalle()),
        ]);
    }
}
