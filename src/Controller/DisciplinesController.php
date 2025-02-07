<?php

namespace App\Controller;

use App\Entity\Disciplines;
use App\Form\DisciplinesType;
use App\Repository\DisciplinesRepository;
use App\Service\EntityFormatterService;
use App\Service\StatusToggleService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/disciplines', name: 'disciplines.')]

final class DisciplinesController extends AbstractController
{
    #[Route('', name: 'index')]

    public function index(DisciplinesRepository $disciplinesRepository): Response
    {
       $disciplines = $disciplinesRepository->findAll();
       $nombreDisciplines = $disciplinesRepository->count();
        return $this->render('disciplines/index.html.twig', [
            'disciplines' => $disciplines,
            'nombreDisciplines' => $nombreDisciplines,
            'secteur' => 'Disciplines'
        ]);
    }

    #[Route('/new', name: 'new')]

   
        public function new(Request $request, EntityManagerInterface $entityManager): Response
        {
            $disciplines = new Disciplines();
            $form = $this->createForm(DisciplinesType::class, $disciplines);
            $form->handleRequest($request);
    
    
            if ($form->isSubmitted() && $form->isValid()) {

                     /** @var UploadedFile $file */
            $file = $form->get('photoDiscipline')->getData();
            if ($file) {
                $fileName = $disciplines->getId($disciplines->getNomDiscipline()) . '.' . $file->guessExtension();
                $destination = $this->getParameter('kernel.project_dir') . '/public/disciplines/images';
                $file->move($destination, $fileName);

                $disciplines->setPhotoDiscipline($fileName);
                $entityManager->flush();
            }

                $entityManager->persist($disciplines);
                $entityManager->flush();
    


    
                $this->addFlash('success', 'disciplines ajoutée avec succès !');
                return $this->redirectToRoute('disciplines.index');
            }
    
            return $this->render('disciplines/new.html.twig', [
                'form' => $form->createView(),
 
            ]);
    }

    #[Route('/{id}', name: 'show',methods: ['GET','POST' ])]

    public function gshow(DisciplinesRepository $disciplinesRepository, int $id): Response
    {
       $discipline = $disciplinesRepository->find($id);
        return $this->render('disciplines/show.html.twig', [
            'discipline' => $discipline,
        ]);
    }

    #[Route('/{id}/show', name: 'disciplines.show')]
    public function show(Disciplines $discipline, EntityFormatterService $formatterService): Response
    {
        return $this->render('disciplines/show.html.twig', [
            'disciline' => $discipline,
            'imagePath' => $formatterService->getImagePath($discipline->getPhotoDiscipline(), 'uploads/disciplines/'),
            'videoUrl' => $formatterService->getVideoUrl($discipline->getVideoDiscipline()),
            'nomDiscipline' => $formatterService->formatName($discipline->getNomDiscipline()),
            'descriptionDiscipline' => $formatterService->formatDescription($discipline->getDescriptionDiscipline())
        ]);
    }

    #[Route('/{id}/edit', name: 'edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, Disciplines $disciplines): Response
    {
        // Stocker l'ancienne photo pour la supprimer après
        $anciennePhoto = $disciplines->getPhotoDiscipline();
    
        $form = $this->createForm(DisciplinesType::class, $disciplines, ['is_edit' => true]);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile|null $file */
            $file = $form->get('photoDiscipline')->getData();
    
            if ($file) {
                // Nom du fichier basé sur l'ID et le nom de la discipline
                $fileName = $disciplines->getId() . '_' . str_replace(' ', '_', strtolower($disciplines->getNomDiscipline())) . '.' . $file->guessExtension();
    
                // Destination du fichier
                $destination = $this->getParameter('kernel.project_dir') . '/public/disciplines/images';
    
                // Supprimer l'ancienne photo si elle existe
                if ($anciennePhoto) {
                    $oldFilePath = $destination . '/' . $anciennePhoto;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
    
                try {
                    // Déplacer la nouvelle image
                    $file->move($destination, $fileName);
                    $disciplines->setPhotoDiscipline($fileName);
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Erreur lors de l’upload de l’image.');
                    return $this->redirectToRoute('disciplines.edit', ['id' => $disciplines->getId()]);
                }
            }
    
            // Sauvegarde en base de données
            $entityManager->flush();
    
            $this->addFlash('success', 'Discipline mise à jour avec succès !');
            return $this->redirectToRoute('disciplines.index');
        }
    
        return $this->render('disciplines/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    

    #[Route('/{id}/toggle', name: 'toggle_statut', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function toggleStatus(StatusToggleService $statusToggleService, Disciplines $disciplines): Response
    {
        $statusToggleService->toggleStatus($disciplines, 'Active');
        $this->addFlash('success', 'Statut mis à jour avec succès.');
        return $this->redirectToRoute('disciplines.index');
    }
}
