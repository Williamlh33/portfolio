<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ProjetRepository;
use App\Repository\ContactRepository;
use App\Repository\CompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', methods: ['GET', 'POST'], name: 'app_home')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        ProjetRepository $projetRepository,
        CompetenceRepository $competenceRepository
    ): Response {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        $showProjet = $projetRepository->findAll();
        $showCompetence = $competenceRepository->findAll();

        return $this->render('accueil/index.html.twig', [
            'competences' => $showCompetence,
            'projets' => $showProjet,
            'formContact' => $form,
        ]);
    }
}
