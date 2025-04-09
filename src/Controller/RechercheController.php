<?php

namespace App\Controller;

use App\Entity\Shipment;
use App\Form\RechercheType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'app_recherche', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $ref = $data['ref'];

            // Rediriger vers la route qui affichera le résultat
            return $this->redirectToRoute('app_resultat', ['ref' => $ref]);
        }

        return $this->render('main/recherche.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/resultat/{ref}', name: 'app_resultat', methods: ['GET', 'POST'])]
    public function search(string $ref, EntityManagerInterface $em): Response
    {
        // Recherche en base de données
        $shipment = $em->getRepository(Shipment::class)->findOneBy(['numberReference' => $ref]);

        if (!$shipment) {
            $this->addFlash('error', "Ce numéro de référence ne correspond à aucun CMR.");
            return $this->redirectToRoute('app_recherche');
        }

        return $this->render('main/search.html.twig', [
            'shipment' => $shipment,
        ]);
    }
}
