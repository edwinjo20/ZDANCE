<?php

namespace App\Controller;

use App\Entity\Admins;
use App\Entity\Users;
use App\Entity\Cours;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admins', name: 'admins.')]
final class AdminController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher): Response
    {
        // Création d'un utilisateur admin pour test
        $user = new Users(); 
        $user->setUserName('kevin')
             ->setRoles(['ROLE_ADMIN']) // Définir le rôle admin
             ->setIsActive(true);

        // Hachage du mot de passe
        $hashedPassword = $hasher->hashPassword($user, 'aaaa');
        $user->setPassword($hashedPassword);

        // Création de l'entité Admin
        $admin = new Admins();
        $admin->setNomAdm($user->getUserName())
              ->setPrenomAdm($user->getUserName())
              ->setIndexAdm('kevin');

        // Sauvegarde en base de données
        $entityManager->persist($user);
        $entityManager->flush();

        // Récupération des statistiques pour les Professeurs et Adhérents
        $profCount = $entityManager->getRepository(Users::class)->createQueryBuilder('u')
            ->select('COUNT(u.idUser)')
            ->where('JSON_CONTAINS(u.roles, :role) = 1')
            ->setParameter('role', '"ROLE_PROF"')
            ->getQuery()
            ->getSingleScalarResult();

        $adherantCount = $entityManager->getRepository(Users::class)->createQueryBuilder('u')
            ->select('COUNT(u.idUser)')
            ->where('JSON_CONTAINS(u.roles, :role) = 1')
            ->setParameter('role', '"ROLE_ADHERENT"')
            ->getQuery()
            ->getSingleScalarResult();

        // Récupération du nombre total de cours
        $coursCount = $entityManager->getRepository(Cours::class)->count([]);

        // Transmission des données à la vue
        return $this->render('admin/index.html.twig', [
            'profCount' => $profCount,
            'adherantCount' => $adherantCount,
            'coursCount' => $coursCount,
        ]);
    }
}
