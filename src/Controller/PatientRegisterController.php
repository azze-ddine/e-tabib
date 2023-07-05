<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PatientRegisterFormType; // Update the form class import
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientRegisterController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register/patient', name: 'app_patient_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $patientPasswordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        $patient = new User();
        $form = $this->createForm(PatientRegisterFormType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $patient->setPassword(
                $patientPasswordHasher->hashPassword(
                    $patient,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($patient);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('account/patient/register.html.twig', [
            'patientRegisterForm' => $form->createView(),
        ]);
    }
}
