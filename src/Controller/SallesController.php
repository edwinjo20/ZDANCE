<?php

namespace App\Controller;

use App\Entity\Salles;
use App\Form\SallesType;
use App\Service\EntityFormatterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admins/salles', name: 'salles.')]
final class SallesController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(): Response
    {
        return $this->render('salles/index.html.twig', [
            'controller_name' => 'SallesController',
        ]);
    }

    #[Route('/new', name: 'new',methods:['POST','GET'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $salles = new Salles();
        $form = $this->createForm(SallesType::class, $salles,[
            'validation_groups' => ['Default'], // N’applique pas "Strict" avant soumission
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) { 
                $entityManager->persist($salles);
                $entityManager->flush();


            /** @var UploadedFile $file */
            $file = $form->get('photoSalle')->getData();
            if ($file) {
                $fileName = $salles->getId() . '.' . $file->guessExtension();
                $destination = $this->getParameter('kernel.project_dir') . '/public/salles/images';
                $file->move($destination, $fileName);

                $salles->setPhotoSalle($fileName);
                $entityManager->flush();
            }
                $this->addFlash(type:'success',message:'Enregistrer');
                return $this->redirectToRoute('salles.index');
        }
        return $this->render('salles/new.html.twig', [
            'form' => $form->createView(),
       
        ]);
    }

    #[Route('/{id}/show', name: 'disciplines.show')]
    public function show(Salles $discipline, EntityFormatterService $formatterService): Response
    {
        return $this->render('disciplines/show.html.twig', [
            'discipline' => $discipline,
            'imagePath' => $formatterService->getImagePath($discipline->getPhotoSalle(), 'uploads/salles/'),
            'nomSalle' => $formatterService->formatName($discipline->getNomSalle()),
            'quota' => $formatterService->formatQuota($discipline->getQuotaSalle())
        ]);
    }
}
