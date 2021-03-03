<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route; // control+option+i pour ajouter Utilisateur
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface; // control+option+i pour ajouter InscriptionType

class AdminSecuController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder): Response // Ajouter Request et EntityManagerInterface au namespace
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $utilisateur); // Création de formulaire

        $form->handleRequest($request); // Récupérer ce que l'utilisateur envoie
        if ($form->isSubmitted() && $form->isValid()) { // Condition si le formulaire est soumis ET valide
            $passwordCrypto = $encoder->encodePassword($utilisateur, $utilisateur->getPassword()); // On encodee le hash pour le mot de passe dans la BDD
            $utilisateur->setPassword($passwordCrypto); //on lie l'encodage avec le mdp de l'utilisateur
            $em->persist($utilisateur); // on fait persisté
            $em->flush();

            return $this->redirectToRoute('aliments'); // On renvoie l'utilisateur vers la page aliment
        }

        return $this->render('admin_secu/inscription.html.twig', [
            'form' => $form->createView(), // Renvoyer le formulaire a la VUE sous forme de tableau associatif
        ]);
    }

    /**
     * @Route("/login", name="connexion")
     */
    public function login(AuthenticationUtils $util): Response //function de vérification
    {
        return $this->render('admin_secu/login.html.twig',[
            "lastUsername" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError()
        ]);
    }
    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion()
    {
        
    }
}
