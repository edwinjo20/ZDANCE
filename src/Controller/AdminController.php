<?php

namespace App\Controller;

use App\Entity\Admins;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admins', name: 'admins.')]

final class AdminController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(EntityManagerInterface $entityManager, UserPasswordHasherInterface $hasher): Response
    {
        $user = new Users(); 
        $user->setUserName('kevin')
             ->setRoles(['ROLE_ADMIN']) // Utiliser un tableau pour les rôles
             ->setIsActive(true);
        
        // Hachage du mot de passe
        $hashedPassword = $hasher->hashPassword($user, 'aaaa');
        $user->setPassword($hashedPassword);
    
        $admin = new Admins();
        $admin->setNomAdm($user->getUserName())->setPrenomAdm($user->getUserName())->setIndexAdm('kevin');
    
        // Sauvegarde en base de données
        $entityManager->persist($user);
        $entityManager->flush();
    
        return new Response('Utilisateur admin ajouté avec succès');
    }
    
}
