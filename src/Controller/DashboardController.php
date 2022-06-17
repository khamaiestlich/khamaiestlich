<?php

namespace App\Controller;

use App\Repository\WorkerRepository;
use App\Repository\workCertificateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_dashboard")
    */
    public function index(WorkerRepository $workerRepository): Response
    {
        $famme = count($workerRepository->findBy(['Genre'=> 'F']));
        $homme = count($workerRepository->findBy(['Genre'=> 'H']));

        // dd($homme, $famme);
        return $this->render('dashboard/index.html.twig', [
            'homme' => $homme,
            'femme' => $famme
        ]);
    }
    public function statravail(workCertificateRepository $workCertificateRepository): Response
    {
        $January = count($workCertificateRepository->findBy(['m'=> 'F']));
        $February = count($workCertificateRepository->findBy(['Genre'=> 'H']));
        $March = count($workCertificateRepository->findBy(['Genre'=> 'H']));
        $April = count($workCertificateRepository->findBy(['Genre'=> 'H']));
        $May = count($workCertificateRepository->findBy(['Genre'=> 'H']));
        $June = count($workCertificateRepository->findBy(['Genre'=> 'H']));
        $Juillet = count($workCertificateRepository->findBy(['Genre'=> 'H']));
        $aout = count($workCertificateRepository->findBy(['Genre'=> 'H']));
        $septembre = count($workCertificateRepository->findBy(['Genre'=> 'H']));
        $october = count($workCertificateRepository->findBy(['Genre'=> 'H']));
        $november = count($workCertificateRepository->findBy(['Genre'=> 'H']));
        $decembre = count($workCertificateRepository->findBy(['Genre'=> 'H']));

        // dd($January, $February, $March, $avril, $May, $june, $juillet, $aout, $septembre, $octobre, $november, $decembre);
        return $this->render('dashboard/index.html.twig', [
            '1' => $January,
            '2' => $February,
            '3' => $March,
            '4' => $April,
            '5' => $May,
            '6' => $June,
            '7' => $Juillet,
            '8' => $aout,
            '9' => $septembre,
            '10' => $october,
            '11' => $november,
            '12' => $decembre,

        ]);
    }
    
}
