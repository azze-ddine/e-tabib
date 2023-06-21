<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('account/profile/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('/profile/edit', name: 'app_profile_edit')]
    public function editProfile(): Response
    {
        return $this->render('account/profile/edit.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
