<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ProjetRepository;
use App\Repository\ContactRepository;
use App\Repository\CompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
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
        CompetenceRepository $competenceRepository,
        MailerInterface $mailer
    ): Response {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();
            try {
                $email = (new TemplatedEmail())
                    ->from($contact->getEmail())
                    ->to($this->getParameter('mailer_to'))
                    ->subject('Contact portfolio')
                    ->htmlTemplate('emails/contact.html.twig')
                    ->context(['data' => $contact]);

                $mailer->send($email);

                $this->addFlash('success', 'Votre message a bien été envoyé !');

                return $this->redirectToRoute('app_home');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Impossible d\'envoyer le mail');
            }
        }

        $showProjet = $projetRepository->findAll();
        $showCompetence = $competenceRepository->findAll();

        return $this->render('home/index.html.twig', [
            'competences' => $showCompetence,
            'projets' => $showProjet,
            'formContact' => $form,
        ]);
    }
}
