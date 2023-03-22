<?php

namespace App\Controller;

use PhpParser\Node\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodosController extends AbstractController
{
    #[Route('/todos', name: 'todos')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        // afficher notre tableau todo
        // sinon j'initialise et puis j'affiche
        if(!$session->has('todos')){
            $todos = [
                'achat' => 'acheter un clé USB',
                'cours' => 'Finaliser mon cours',
                'correction' => 'corriger mes examens'
            ];
            $session->set('todos', $todos);
            $this->addFlash('info', "La liste des todos vient d'être initialisée");
            // si j'ai mon tableau de todo dans ma session, je ne fait que l'afficher
            // pas besoin de l'afficher ici car on accedent facilement sur view par app.session.get()
        }
        
        return $this->render('todos/index.html.twig');
    }
        
    #[Route('/todos/add/{name}/{contents}', name:'todos.add')]
    public function addTodo(Request $request, $name, $contents): Response
    {
        $session = $request->getSession();
        //verifier si todos existe
        if($session->has('todos')){
            //si oui
            $todos = $session->get('todos');
            //verifier si on  a déja un todos du même non
            if(isset($todos[$name])){
                //si oui, affiche erreur
                $this->addFlash('error', "Le todos d'id $name existe déja dans la liste ");
            } else{
                //si non, on ajoute et on affiche un message de succes
                $todos[$name] = $contents;
                $session->set('todos', $todos);
                $this->addFlash('success', "Le todos d'id $name a été ajouté avec succes ");
            }

        } else{
            //si non, on affiche une erreur et on rediriger vers TotosController::index
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");
        }

        return $this->redirectToRoute('todos');
    }
}
