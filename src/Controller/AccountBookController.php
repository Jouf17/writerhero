<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Page;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AccountBookController extends AbstractController
{
    /** @var EntityManager */
    private $entityManager;

    /** @var SluggerInterface */
    private $slugger;

    public function __construct(EntityManagerInterface $entityManager, SluggerInterface $slugger) {
        $this->entityManager = $entityManager;
        $this->slugger = $slugger;
    }

    /**
     * @Route("/compte/redaction-du-book/{slugBook}", name="writing_book")
     */
    public function index($slugBook): Response
    {
        $book = $this->entityManager->getRepository(Book::class)->findOneBySlug($slugBook);
        
        $pages = $this->entityManager->getRepository(Page::class)->findBy(['book' => $book]);

        return $this->render('account/writing-book.html.twig', [
            'book' => $book,
            'pages' => $pages
        ]);
    }

    /**
     * @Route("/compte/ecrire-un-nouveau-book", name="account_new_book")
     */
    public function newBook(Request $request): Response
    {
        $notification = null;
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //ILLUSTRATION
            $illustration = $form->get('illustration')->getData();
            $originalFilename = pathinfo($illustration->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $this->slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$illustration->guessExtension();
            try {
                $illustration->move(
                    $this->getParameter('illustrations_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $book->setIllustration($newFilename);

            // SLUG
            $slug = $this->slugger->slug($book->getName())->lower();
            $book->setSlug($slug);

            // USER
            $book->setUser($this->getUser());
            
            // REST OF THE DATA
            $book = $form->getData();

            $this->entityManager->persist($book);
            $this->entityManager->flush();

            $notification = "Votre Book a bien été créé.";

            return $this->redirectToRoute('account');
        } else {
            $notification = "Une erreur s'est produite, votre Book n'a pas été créé.";
        }
        
        return $this->render('account/new-book.html.twig', [
            'notification' => $notification,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/compte/modifier-un-book/{slugBook}", name="account_edit_book")
     */
    public function editBook(Request $request, $slugBook): Response
    {
        $notification = null;
        $book = $this->entityManager->getRepository(Book::class)->findOneBySlug($slugBook);

        if (!$book || $book->getUser() != $this->getUser()) {
            return $this->redirectToRoute('account');
        }

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // //ILLUSTRATION
            // $illustration = $form->get('illustration')->getData();
            // $originalFilename = pathinfo($illustration->getClientOriginalName(), PATHINFO_FILENAME);
            // $safeFilename = $this->slugger->slug($originalFilename);
            // $newFilename = $safeFilename.'-'.uniqid().'.'.$illustration->guessExtension();
            // try {
            //     $illustration->move(
            //         $this->getParameter('illustrations_directory'),
            //         $newFilename
            //     );
            // } catch (FileException $e) {
            //     // ... handle exception if something happens during file upload
            // }
            // $book->setIllustration($newFilename);

            // // SLUG
            // $slug = $this->slugger->slug($book->getName())->lower();
            // $book->setSlug($slug);

            // // USER
            // $book->setUser($this->getUser());
            
            // // REST OF THE DATA
            // $book = $form->getData();

            // $this->entityManager->persist($book);
            $this->entityManager->flush();

            // $notification = "Votre Book a bien été créé.";

            return $this->redirectToRoute('account');
        } else {
            $notification = "Une erreur s'est produite, votre Book n'a pas été créé.";
        }
        
        return $this->render('account/new-book.html.twig', [
            'notification' => $notification,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/compte/suppression-du-book/{slugBook}", name="delete_book")
     */
    public function deleteBook($slugBook): Response
    {
        $book = $this->entityManager->getRepository(Book::class)->findOneBySlug($slugBook);

        if ($book && $book->getUser() == $this->getUser()) {
            $this->entityManager->remove($book);
            $this->entityManager->flush();

            return $this->redirectToRoute('account');
        }
    }
}
