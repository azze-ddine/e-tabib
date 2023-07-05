<?php

namespace App\Controller;

use App\Repository\MultiUserLoginRepository;
use App\Repository\ConsultationRepository;
use App\Repository\OrdonnanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctorDashboardController extends AbstractController
{
    /**
     * @Route("/doctor-dashboard", name="doctor_dashboard")
     */
    public function index(
        MultiUserLoginRepository $multiUserLoginRepository,
        ConsultationRepository $consultationRepository,
        OrdonnanceRepository $ordonnanceRepository,
    ): Response {
        $totalPatients = $multiUserLoginRepository->count() - 2; // Subtract 2 to exclude admin users
        $totalConsultations = $consultationRepository->countByProfile('patient');
        $totalOrdonnances = $ordonnanceRepository->count();

        return $this->render('doctor_dashboard/dashbord.html.twig', [
            'totalPatients' => $totalPatients,
            'totalConsultations' => $totalConsultations,
            'totalOrdonnances' => $totalOrdonnances,
        ]);
    }
}
