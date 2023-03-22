<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'session')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();

        if ($session->has('visite')) {

            $nbVisite = $session->get('visite') + 1;
        } else{
            $nbVisite = 1;
        }

        $session->set('visite', $nbVisite);

        return $this->render('session/index.html.twig');
    }
}
