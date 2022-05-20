<?php

namespace App\Controller;

use App\Entity\Prime;
use App\Form\PrimeType;
use App\Repository\PrimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/prime')]
class PrimeController extends AbstractController
{

    #[Route('/', name: 'app_prime_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PrimeRepository $primeRepository): Response
    {
        $prime = $primeRepository->find(1);
        $form = $this->createForm(PrimeType::class, $prime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $primeRepository->add($prime);
            return $this->redirectToRoute('app_prime_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prime/prime.html.twig', [
            'prime' => $prime,
            'form' => $form,
        ]);
    }
}
