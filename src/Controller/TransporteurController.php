<?php

namespace App\Controller;

use App\Entity\Transporteur;
use App\Form\TransporteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TransporteurController extends AbstractController
{
    #[Route('/transporteur', name: 'app_transporteur', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('transporteur/index.html.twig', [
            'controller_name' => 'TransporteurController',
        ]);
    }
    #[Route('/transporteur/formulaire', name: 'app_transporteur_formulaire', methods: ['GET', 'POST'])]
    public function formulaire(Request $request, EntityManagerInterface $em): Response
    {
        $transport = new Transporteur();
        $form = $this->createForm(TransporteurType::class, $transport);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($transport);
            $em->flush();
            return $this->redirectToRoute('app_transporteur');
        }

        return $this->render('transporteur/formulaire.html.twig', ['form' => $form->createView()]);
    }
}
