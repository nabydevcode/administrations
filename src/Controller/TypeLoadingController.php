<?php

namespace App\Controller;

use App\Entity\TypeLoading;
use App\Form\TypeLoadingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TypeLoadingController extends AbstractController
{
    #[Route('/type/loading', name: 'app_type_loading', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('type_loading/index.html.twig', [
            'controller_name' => 'TypeLoadingController',
        ]);
    }
    #[Route('/type/loading/formulaire', name: 'app_type_loading_formulaire', methods: ['GET', 'POST'])]
    public function formulaire(Request $request, EntityManagerInterface $em): Response
    {
        $typeloading = new TypeLoading();
        $form = $this->createForm(TypeLoadingType::class, $typeloading);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($typeloading);
            $em->flush();
            return $this->redirectToRoute('app_type_loading');
        }

        return $this->render('type_loading/formulaire.html.twig', ['form' => $form->createView()]);
    }
}
