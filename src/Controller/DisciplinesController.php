<?php

namespace App\Controller;

use App\Entity\Disciplines;
use App\Form\DisciplinesType;
use App\Repository\DisciplinesRepository;
use App\Service\EntityFormatterService;
use App\Service\StatusToggleService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/disciplines', name: 'disciplines.')]
final class DisciplinesController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(DisciplinesRepository $disciplinesRepository): Response
    {
        $disciplines = $disciplinesRepository->findAll();
        $nombreDisciplines = count($disciplines);

        return $this->render('disciplines/index.html.twig', [
            'disciplines' => $disciplines,
            'nombreDisciplines' => $nombreDisciplines,
            'secteur' => 'Disciplines',
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $discipline = new Disciplines();
        $form = $this->createForm(DisciplinesType::class, $discipline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile|null $file */
            $file = $form->get('photoDiscipline')->getData();
            if ($file) {
                $fileName = uniqid().'.'.$file->guessExtension();
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/disciplines';
                $file->move($destination, $fileName);
                $discipline->setPhotoDiscipline($fileName);
            }

            $entityManager->persist($discipline);
            $entityManager->flush();

            $this->addFlash('success', 'Discipline ajoutée avec succès !');
            return $this->redirectToRoute('disciplines.index');
        }

        return $this->render('disciplines/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id, DisciplinesRepository $disciplinesRepository, EntityFormatterService $formatterService): Response
    {
        $discipline = $disciplinesRepository->find($id);
        if (!$discipline) {
            throw $this->createNotFoundException('Cette discipline n\'existe pas.');
        }

        return $this->render('disciplines/show.html.twig', [
            'discipline' => $discipline,
            'imagePath' => $formatterService->getImagePath($discipline->getPhotoDiscipline(), 'uploads/disciplines/'),
            'videoUrl' => $formatterService->getVideoUrl($discipline->getVideoDiscipline()),
            'nomDiscipline' => $formatterService->formatName($discipline->getNomDiscipline()),
            'descriptionDiscipline' => $formatterService->formatDescription($discipline->getDescriptionDiscipline()),
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, Disciplines $discipline): Response
    {
        $anciennePhoto = $discipline->getPhotoDiscipline();
        $form = $this->createForm(DisciplinesType::class, $discipline, ['is_edit' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile|null $file */
            $file = $form->get('photoDiscipline')->getData();
            if ($file) {
                $fileName = uniqid().'.'.$file->guessExtension();
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads/disciplines';

                // Supprimer l'ancienne photo si elle existe
                if ($anciennePhoto) {
                    $oldFilePath = $destination.'/'.$anciennePhoto;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                try {
                    $file->move($destination, $fileName);
                    $discipline->setPhotoDiscipline($fileName);
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Erreur lors de l’upload de l’image.');
                    return $this->redirectToRoute('disciplines.edit', ['id' => $discipline->getId()]);
                }
            }

            $entityManager->flush();
            $this->addFlash('success', 'Discipline mise à jour avec succès !');
            return $this->redirectToRoute('disciplines.index');
        }

        return $this->render('disciplines/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/toggle', name: 'toggle_statut', methods: ['GET'])]
    public function toggleStatus(StatusToggleService $statusToggleService, Disciplines $discipline): Response
    {
        $statusToggleService->toggleStatus($discipline, 'Active');
        $this->addFlash('success', 'Statut mis à jour avec succès.');
        return $this->redirectToRoute('disciplines.index');
    }
}
