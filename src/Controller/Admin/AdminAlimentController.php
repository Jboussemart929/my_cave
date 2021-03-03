<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAlimentController extends AbstractController
{
    /**
     * @Route("/admin/aliment", name="admin_aliment")
     */
    public function index(AlimentRepository $repository): Response
    {
        $aliments = $repository->findAll();

        return $this->render('admin/admin_aliment/adminAliment.html.twig', [
            'aliments' => $aliments,
        ]);
    }

    /**
     * @Route("/admin/aliment/creation", name="admin_aliment_creation")
     * @Route("/admin/aliment/{id}", name="admin_aliment_modification",  methods="GET|POST")
     */
    public function ajoutEtModif(Aliment $aliment = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$aliment) {
            $aliment = new Aliment();
        }
        $form = $this->createForm(AlimentType::class, $aliment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $modif = null !== $aliment->getId(); // On vérifie si l'ID existe
            $entityManager->persist($aliment);
            $entityManager->flush();
            $this->addFlash('success', ($modif) ? 'La modification a été effectué' : "L'ajout a été effectué");

            return $this->redirectToRoute('admin_aliment');
        }

        return $this->render('admin/admin_aliment/modificationAliment.html.twig', [
            'aliment' => $aliment,
            'form' => $form->createView(),
            'isModification' => null !== $aliment->getid(),
        ]);
    }

    /**
     * @Route("/admin/aliment/{id}", name="admin_aliment_suppression", methods="delete")
     */
    public function suppression(Aliment $aliment, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('SUP'.$aliment->getId(), $request->get('_token'))) {
            $entityManager->remove($aliment);
            $entityManager->flush();
            $this->addFlash('success', 'La suppression a été effectué');

            return $this->redirectToRoute('admin_aliment');
        }
    }
}
