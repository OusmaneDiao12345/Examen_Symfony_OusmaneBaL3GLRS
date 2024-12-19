<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{
    #[Route('/cours/create', name: 'create_cours')]
    public function createCours(Request $request, EntityManagerInterface $em): Response
    {
        $cours = new Cours();
        $form = $this->createForm(CoursType::class, $cours);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($cours);
            $em->flush();

            return $this->redirectToRoute('list_cours');
        }

        return $this->render('cours/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/cours', name: 'list_cours')]
    public function listCours(): Response
    {
        $cours = $this->getDoctrine()->getRepository(Cours::class)->findAll();

        return $this->render('cours/list.html.twig', [
            'cours' => $cours,
        ]);
    }
}
