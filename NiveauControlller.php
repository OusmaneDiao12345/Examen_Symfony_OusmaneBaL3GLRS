<?php

namespace App\Controller;

use App\Entity\Niveau;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NiveauController extends AbstractController
{
    #[Route('/niveau/create', name: 'create_niveau')]
    public function createNiveau(Request $request, EntityManagerInterface $em): Response
    {
        $niveau = new Niveau();
        $form = $this->createFormBuilder($niveau)
            ->add('nom')
            ->add('classes')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($niveau);
            $em->flush();

            return $this->redirectToRoute('list_niveau');
        }

        return $this->render('niveau/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/niveau', name: 'list_niveau')]
    public function listNiveau(): Response
    {
        $niveaux = $this->getDoctrine()->getRepository(Niveau::class)->findAll();

        return $this->render('niveau/list.html.twig', [
            'niveaux' => $niveaux,
        ]);
    }
}
