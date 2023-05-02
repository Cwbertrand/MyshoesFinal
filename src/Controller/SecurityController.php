<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, CartService $cartservice): Response
    {
         // If the user is already authenticated, redirect them to the command page
        if ($this->getUser() && $cartservice->getCart()) {
            return $this->redirectToRoute('command');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        // Check if the user has a product in their cart
        if ($lastUsername && $cartservice->getCart()) {
            return $this->redirectToRoute('command');
        }

        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }
            
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error]
        );
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
