<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    //#[Route('/login', name: 'app_login')]
    /**
     * 
     * @Route("/login", name="login")
     */    
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        //recuperation eventuelle de l'erreur
        $error = $authenticationUtils->getLastAuthenticationError();
        //recuperation eventuelle du dernier nom de login utilisé
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout() {
        
        
    }
}
