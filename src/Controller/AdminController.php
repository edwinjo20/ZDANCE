<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admins/teachers', name: 'admin_teachers_list')]
    public function listAdminsAndTeachers(): Response
    {
        // Exemple de données (à remplacer par les données de la base)
        $admins = ['Admin1', 'Admin2', 'Admin3'];
        $teachers = ['Teacher1', 'Teacher2', 'Teacher3'];

        return $this->render('admins/teachers.html.twig', [
            'admins' => $admins,
            'teachers' => $teachers,
        ]);
    }
}