<?php

namespace App\Controller;

use App\Entity\DeliveryLocation;
use App\Form\DeliveryLocationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DeliveryLocationController extends AbstractController
{
    #[Route('/delivery/location', name: 'app_delivery_location', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('delivery_location/index.html.twig', [
            'controller_name' => 'DeliveryLocationController',
        ]);
    }


    #[Route('/delivery/formulaire', name: 'app_delivery_formulaire', methods: ['GET', 'POST'])]
    public function formulaire(Request $request, EntityManagerInterface $em): Response
    {
        $delivery_location = new DeliveryLocation();
        $form = $this->createForm(DeliveryLocationType::class, $delivery_location);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($delivery_location);
            $em->flush();
            return $this->redirectToRoute('app_delivery_location');
        }

        return $this->render('delivery_location/formulaire.html.twig', ['form' => $form->createView()]);
    }
}
