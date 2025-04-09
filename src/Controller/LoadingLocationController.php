<?php

namespace App\Controller;


use App\Entity\LoadingLocations;
use App\Form\LoadingLocationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LoadingLocationController extends AbstractController
{
    #[Route('/loading/location', name: 'app_loading_location', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('loading_location/index.html.twig', [
            'controller_name' => 'LoadingLocationController',
        ]);
    }
    #[Route('/loading/formulaire', name: 'app_loading_formualaire', methods: ['GET', 'POST'])]
    public function formulaire(Request $request, EntityManagerInterface $em): Response
    {
        $loading = new LoadingLocations();
        $form = $this->createForm(LoadingLocationType::class, $loading);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($loading);
            $em->flush();
            return $this->redirectToRoute('app_loading_location');
        }


        return $this->render('delivery_location/formulaire.html.twig', ['form' => $form->createView()]);
    }

}
