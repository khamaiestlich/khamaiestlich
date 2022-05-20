<?php

namespace App\Controller;

use App\Entity\WorkCertificate;
use App\Entity\Worker;
use App\Form\CertifArType;
use App\Form\CertifType;
use App\Form\WorkCertificateType;
use App\Repository\WorkCertificateRepository;
use App\Repository\WorkerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/workcertificate")
 */
class WorkCertificateController extends AbstractController
{
    /**
     * @Route("/", name="app_work_certificate_index", methods={"GET"})
     * @Route("/{lang}", name="app_work_certificate_lang", methods={"GET"})
     */
    public function index(?String $lang,WorkCertificateRepository $workCertificateRepository, ManagerRegistry $doctrine): Response
    {
        if($lang === "ar"){
            return $this->render('work_certificate/index.html.twig', [
                'work_certificates' => $workCertificateRepository->findBy([
                    'lang' => 'ar'
                ]),
            ]);
        }
        else if ($lang === "fr") {
            return $this->render('work_certificate/index.html.twig', [
                'work_certificates' => $workCertificateRepository->findBy([
                    'lang' => 'fr'
                ]),
            ]);
        }
        else{
            return $this->render('work_certificate/index.html.twig', [
                'work_certificates' => $workCertificateRepository->findAll(),
            ]);
        }
    }

    /**
     * @Route("/new", name="app_work_certificate_new", methods={"GET", "POST"})
     */
    public function new(Request $request, WorkCertificateRepository $workCertificateRepository,ManagerRegistry $doctrine,WorkerRepository $workerRepository): Response
    {
        $entityManager = $doctrine->getManager();
        $workCertificate = new WorkCertificate();
        
        $form = $this->createForm(CertifType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $workCertificate->setCreatedAt(new \DateTime());
            $workCertificate->setCreatedBy($this->getUser());
            $workCertificate->setChef($form['chef']->getData());
            $workCertificate->setSignature($form['Signature']->getData());
            $workCertificate->setLang('fr');
            $reference = explode(' ',trim($form['reference']->getData()))[0];
            if ($workerRepository->findBy(["ref"=> $reference ]) == null){
                $worker = new Worker();
                $worker->setNom($form['Nom']->getData());
                $worker->setPrenom($form['Prenom']->getData());
                $worker->setRef($form['reference']->getData());
                $worker->setGenre($form['Genre']->getData());
                $worker->setType($form['type']->getData());
                $worker->setPoste($form['poste']->getData());
                $entityManager->persist($worker);
            }
            else{
                $worker = $workerRepository->findBy(["ref"=> $reference])[0];
            }
            $workCertificate->setWorker($worker); // add worker object 
            $workCertificateRepository->add($workCertificate);

            if ($form->getClickedButton() === $form->get('save')){
                return $this->redirectToRoute('app_work_certificate_index', [], Response::HTTP_SEE_OTHER);
            }else{
                return $this->redirectToRoute('app_work_certificate_show', [
                    'id' => $workCertificate->getId(),
                    'lang' => 'fr'
                ], Response::HTTP_SEE_OTHER);
            }
            // return $this->redirectToRoute('app_work_certificate_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('work_certificate/new.html.twig', [
            'work_certificate' => $workCertificate,
            'workers' => $workerRepository->findAll(),
            'form' => $form,
        ]);
    }



 /**
     * @Route("/new-ar", name="app_work_certificate_new_ar", methods={"GET", "POST"})
     */
    public function newAr(Request $request, WorkCertificateRepository $workCertificateRepository,ManagerRegistry $doctrine,WorkerRepository $workerRepository): Response
    {
        $entityManager = $doctrine->getManager();
        $workCertificate = new WorkCertificate();
        
        $form = $this->createForm(CertifArType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $workCertificate->setCreatedAt(new \DateTime());
            $workCertificate->setCreatedBy($this->getUser());
            $workCertificate->setChef($form['chef']->getData());
            $workCertificate->setSignature($form['Signature']->getData());
            $workCertificate->setLang('ar');
            $reference = explode(' ',trim($form['reference']->getData()))[0];
            if ($workerRepository->findBy(["ref"=> $reference ]) == null){
                $worker = new Worker();
                $worker->setNom($form['Nom']->getData());
                $worker->setPrenom($form['Prenom']->getData());
                $worker->setRef($form['reference']->getData());
                $worker->setGenre($form['Genre']->getData());
                $worker->setType($form['type']->getData());
                $worker->setPoste($form['poste']->getData());
                $entityManager->persist($worker);
            }
            else{
                $worker = $workerRepository->findBy(["ref"=> $reference])[0];
            }
            $workCertificate->setWorker($worker); // add worker object 
            $workCertificateRepository->add($workCertificate);
            if ($form->getClickedButton() === $form->get('save')){
                return $this->redirectToRoute('app_work_certificate_index', [], Response::HTTP_SEE_OTHER);
            }else{
                return $this->redirectToRoute('app_work_certificate_show', [
                    'id' => $workCertificate->getId(),
                    'lang' => 'ar'
                ], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('work_certificate/new_ar.html.twig', [
            'work_certificate' => $workCertificate,
            'workers' => $workerRepository->findAll(),
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}/{lang}", name="app_work_certificate_show", methods={"GET"})
     */
    public function show(WorkCertificate $workCertificate, string $lang="fr"): Response
    {
        
       
        if($lang == "ar"){
            return $this->render('work_certificate/showarab.html.twig', [
                'work_certificate' => $workCertificate,
            ]);
        }

        // $this->generatePdf($workCertificate,$lang);
        return $this->render('work_certificate/show.html.twig', [
            'work_certificate' => $workCertificate,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="app_work_certificate_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, WorkCertificate $workCertificate, WorkCertificateRepository $workCertificateRepository): Response
    {
        $form = $this->createForm(WorkCertificateType::class, $workCertificate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workCertificateRepository->add($workCertificate);
            return $this->redirectToRoute('app_work_certificate_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('work_certificate/edit.html.twig', [
            'work_certificate' => $workCertificate,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_work_certificate_delete", methods={"POST"})
     */
    public function delete(Request $request, WorkCertificate $workCertificate, WorkCertificateRepository $workCertificateRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workCertificate->getId(), $request->request->get('_token'))) {
            $workCertificateRepository->remove($workCertificate);
        }

        return $this->redirectToRoute('app_work_certificate_index', [], Response::HTTP_SEE_OTHER);
    }

    private function generatePdf($workCertificate,$lang=null)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        if($lang == "ar"){
            $html = $this->renderView('work_certificate/showarab.html.twig', [
                'work_certificate' => $workCertificate,
            ]);
        }else {
            $html = $this->renderView('work_certificate/show.html.twig', [
                'work_certificate' => $workCertificate,
            ]);
        }
        $dompdf->set_option('isRemoteEnabled',TRUE);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("attestation_".$workCertificate->getId().".pdf", [
            "Attachment" => false
        ]);
        exit();
    }
}
