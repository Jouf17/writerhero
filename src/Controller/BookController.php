<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    /** @var EntityManager */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/book/{slug}", name="book")
     */
    public function index($slug): Response
    {
        $book = $this->entityManager->getRepository(Book::class)->findOneBySlug($slug);

        if (!$book) {
            return $this->redirectToRoute('home');
        }

        return $this->render('book/index.html.twig', [
            'book' => $book
        ]);
    }

    

    
}
