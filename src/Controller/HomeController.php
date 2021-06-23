<?php

namespace App\Controller;

use App\Entity\Book;
use App\Classe\Search;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    //TODO GENERAL : Rajouter les flashbags partout, sécuriser toutes les fonctions des contrôleurs dans le compte

    /**
     * @Route("/", name="home")
     */
    public function index(Request $request): Response
    {
        //Recherche
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $books = $this->entityManager->getRepository(Book::class)->findWithSearch($search);
        } else {
            $books = $this->entityManager->getRepository(Book::class)->findAll();
        }

        return $this->render('home/index.html.twig', [
            'books' => $books,
            'form' => $form->createView()
        ]);
    }
}
