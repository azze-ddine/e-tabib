<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientAccountController extends AbstractController
{
    #[Route('/patient', name: 'app_patient_profile')]
    public function profile(): Response
    {
        return $this->render('account/patient/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('/patient/edit', name: 'app_patient_profile_edit')]
    public function editProfile(): Response
    {
        return $this->render('account/patient/edit.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
