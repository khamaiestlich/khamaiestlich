<?php

namespace App\Controller;

use App\Repository\WorkerRepository;
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
}
