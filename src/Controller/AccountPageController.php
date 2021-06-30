<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Page;
use App\Form\PageType;
use App\Repository\PageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountPageController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    
    /** 
     * @Route("/compte/redaction-du-book/{slugBook}/ecrire-une-nouvelle-page", name="writing_book_new_page")
     */
    public function newPage(Request $request, PageRepository $pageRepository, $slugBook): Response
    {
        $page = new Page();

        $book = $this->entityManager->getRepository(Book::class)->findOneBySlug($slugBook);
        $countPages = $pageRepository->countPagesByBook($book);
        $pagesByBook = $pageRepository->findPagesByBook($book);
        
        $page->setNumber($countPages + 1);
        $page->setName('Page ' . ($countPages + 1));
        
        $form = $this->createForm(PageType::class, $page, [
            'pagesByBook' => $pagesByBook
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dd($page);
            $page->setBook($book);
            
            $this->entityManager->persist($page);
            $this->entityManager->flush();

            return $this->redirectToRoute('writing_book', ['slugBook' => $slugBook]);
        }
        
        return $this->render('account/writing-book-writing-page.html.twig', [
            'form' => $form->createView(),
            'book' => $book
        ]);
    }

    /**
     * @Route("/compte/redaction-du-book/{slugBook}/editer-une-page/{numPage}", name="writing_book_edit_page")
     */
    public function editPage(Request $request, $slugBook, $numPage): Response
    {
        $book = $this->entityManager->getRepository(Book::class)->findOneBySlug($slugBook);
        $page = $this->entityManager->getRepository(Page::class)->findOneByNumber($numPage, $book);
        
        // $page->setName('Page' . ($countPages + 1));
        // if (!$page || $page->getBook() != $book) {
        //     return $this->redirectToRoute('writing_book', ['slugBook' => $slugBook]);
        // }
        // else if ($book->getUser() != $this->getUser()) {
        //     return $this->redirectToRoute('account');
        // }

        $form = $this->createForm(PageType::class, $page, [
            'book' => $book
        ]);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->entityManager->persist($page);
            $this->entityManager->flush();

            return $this->redirectToRoute('writing_book', ['slugBook' => $slugBook]);
        }
        
        return $this->render('account/writing-book-writing-page.html.twig', [
            'form' => $form->createView(),
            'book' => $book,
            'page' => $page
        ]);
    }
    // TODO : permettre la suppression sans foreign key constraint

     /**
     * @Route("/compte/redaction-du-book/{slugBook}/supprimer-une-page/{numPage}", name="writing_book_delete_page")
     */
    public function deletePage($slugBook, $numPage): Response
    {
        $book = $this->entityManager->getRepository(Book::class)->findOneBySlug($slugBook);
        $page = $this->entityManager->getRepository(Page::class)->findOneByNumber($numPage, $book);

        if ($page /*&& $page->getBook() == $book  && $book->getUser() == $this->getUser() */) {
            $this->entityManager->remove($page);
            $this->entityManager->flush();

            return $this->redirectToRoute('writing_book', ['slugBook' => $slugBook]);
        }
    }
}
