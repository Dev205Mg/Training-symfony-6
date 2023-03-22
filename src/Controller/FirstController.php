<?php

namespace App\Controller;

use index;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'name' => 'Dev205',
            'job' => 'Devellopeur'
        ]);
    }
    
    #[Route('/hello/{name}', name: 'first.hello')]
    public function sayHello(Request $request, $name): Response
    {
        dd($request);
        return $this->render('first/hello.html.twig', [
            'name' => $name
        ]);
    }
}
