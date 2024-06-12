<?php

namespace App\Controller;

use App\Services\CallGotenbergApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GeneratePdfController extends AbstractController
{
    private $pdfService;

    public function __construct(CallGotenbergApi $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    #[Route('/generate-pdf', name: 'generate_pdf')]
    public function generatePdf(Request $request): Response
    {
        // Créer le formulaire
        $form = $this->createFormBuilder()
            ->add('url', null, ['required' => true])
            ->getForm();

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer l'URL saisie à partir des données du formulaire
            $url = $form->getData()['url'];

            // Faites appel à votre service pour générer le PDF
            $pdfContent = $this->pdfService->generatePdfFromUrl($url);

            // Sauvegarder le PDF dans le dossier public/pdfs
            $filename = uniqid('pdf_', true) . '.pdf';
            $publicPath = $this->getParameter('kernel.project_dir') . '/public/pdfs/';
            file_put_contents($publicPath . $filename, $pdfContent);

            // Redirect to the new route
            return $this->redirectToRoute('pdf_generated_success', ['filename' => $filename]);
        }

        // Si le formulaire n'est pas soumis ou n'est pas valide, afficher le formulaire sans le PDF
        return $this->render('pdf/generate_pdf.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/pdf-generated-success', name: 'pdf_generated_success')]
    public function pdfGeneratedSuccess(): Response
    {
        return $this->render('pdf/pdf_generated_success.html.twig');
    }
}