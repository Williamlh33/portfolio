<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Competence;
use App\Repository\ProjetRepository;
use App\Repository\ContactRepository;
use App\Repository\CompetenceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowController extends AbstractController
{
    #[Route('/show', methods: ['GET', 'POST'], name: 'app_show')]
    public function show(
        ProjetRepository $projetRepository,
        CompetenceRepository $competenceRepository,
        ContactRepository $contactRepository
    ): Response {
        $showProjet = $projetRepository->findAll();
        $showCompetence = $competenceRepository->findAll();
        $showContact = $contactRepository->findAll();

        return $this->render('accueil/index.html.twig', [
            'competences' => $showCompetence,
            'projets' => $showProjet,
            'contacts' => $showContact
        ]);
    }
}
