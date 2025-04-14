<?php

namespace App\Controller;

use App\Entity\Shipment;
use App\Entity\User;
use App\Entity\Users;
use App\Form\RechercheType;
use App\Form\ShipmentType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Browsershot\Browsershot;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherAwareInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;



class MainController extends AbstractController
{

    public function __construct(private RequestStack $requestStack)
    {

    }
    #[Route('/main', name: 'app_main')]

    public function index(EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {

        /*  $user = new Users();
         $user->setEmail('naby@123gmail.com');
         $user->setUsername('naby');
         $user->setPassword($hasher->hashPassword($user, '123456'));
         $user->setIsVerified(true);
         $user->setRoles(['ROLE_USER']);

         $em->persist($user);
         $em->flush(); */

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);

    }

    /*  formulaire pour creer le cmr  */

    #[Route('/main/formulaire', name: 'app_main_formulaire', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function formulaire(Request $request, EntityManagerInterface $em): Response
    {
        $shipment = new Shipment();
        $form = $this->createForm(ShipmentType::class, $shipment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($shipment);
            $em->flush();

            $this->addFlash('success', "CMR creer avec succes ");
            return $this->redirectToRoute('shipment_show', ['id' => $shipment->getId()]);
        }
        return $this->render('main/formulaire.html.twig', ['form' => $form->createView()]);
    }
    /*  pour afficher le cmr creer  en fonction de L'ID donner   */
    #[Route('/shipment/{id}', name: 'shipment_show', methods: ['GET', 'POST'])]
    public function show(Shipment $shipment): Response
    {

        if (!$this->getUser()) {
            $this->addFlash('warning', " Vous devez être connecté pour accéder à cette ressource.");
            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette ressource.');

        }
        return $this->render('main/show.html.twig', ['shipment' => $shipment]);
    }
    #[Route('/shipment/update/{id}', name: 'shipment_update', methods: ['GET', 'POST'])]

    public function update(Shipment $shipment, Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->getUser()) {
            $this->addFlash('warning', " Vous devez être connecté pour accéder à cette ressource.");
            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette ressource.');
        }
        /*  $ref = $request->attributes->get('ref');
         if (!$ref) {
             $this->addFlash('error', "Veuillez entrer un numéro de référence.");
             return $this->render('main/recherche.html.twig');
         } */
        $form = $this->createForm(ShipmentType::class, $shipment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', "votre CMR  a ete modifier avec success");
            return $this->redirectToRoute('shipment_show', ['id' => $shipment->getId()]);
        }
        return $this->render('main/update.html.twig', [
            'form' => $form->createView(),
            'shipment' => $shipment
        ]);

    }

    /*  la fonction pour generer  le pdf a imprimer   */


    #[Route('/shipment/print/cmr/{id}', name: 'shipment_pdf')]

    public function generatePdf(Shipment $shipment): Response
    {

        if (!$this->getUser()) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour accéder à cette ressource.');
        }
        $url = $this->generateUrl('shipment_print_pdf', ['id' => $shipment->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        $filePath = $this->getParameter('kernel.project_dir') . '/public/shipment_' . $shipment->getId() . '.pdf';

        // Générer le PDF en passant le cookie
        /* Browsershot::url($url)
            ->setNodeBinary('/usr/bin/node')
            ->setNpmBinary('/usr/bin/npm')
            ->waitUntilNetworkIdle()
            ->format('A4')
            ->save($filePath); */
        Browsershot::url($url)
            ->setNodeBinary('/usr/homebrew//bin/node')
            ->setNpmBinary('/opt/homebrew/bin/npm')
            ->waitUntilNetworkIdle()
            ->format('A4')
            ->save($filePath);





        $this->addFlash('success', "votre CMR a ete creer avec success ");

        return $this->file($filePath, 'shipment_' . $shipment->getId() . '.pdf', ResponseHeaderBag::DISPOSITION_INLINE);
    }

    /* le pdf prete a imprimer   */
    #[Route('/shipment/pdf/{id}', name: 'shipment_print_pdf', methods: ['GET', 'POST'])]

    public function printPdf(Shipment $shipment): Response
    {
        return $this->render('main/cmr.html.twig', ['shipment' => $shipment]);
    }


}