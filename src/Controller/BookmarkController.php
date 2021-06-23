<?php

namespace App\Controller;

use App\Classe\Bookmark;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookmarkController extends AbstractController
{
    /**
     * @Route("/marque-page", name="bookmark")
     */
    public function index(Bookmark $bookmark): Response
    {
        

        return $this->render('bookmark/index.html.twig', [
            'bookmark' => $bookmark   
        ]);
    }

    /**
     * @Route("/marque-page/ajouter/{numPage}", name="bookmark_add")
     */
    public function add(Bookmark $bookmark, $numPage): Response
    {
        //il reste à faire : ajouter le numéro de page, à la lecture de la page, ainsi que le livre
        $bookmark->add($numPage);

        return $this->redirectToRoute('bookmark');
    }

    /**
     * @Route("/marque-page/supprimer-les-marque-pages", name="remove_bookmark")
     */
    public function remove(Bookmark $bookmark): Response
    {
        //il reste à faire : ajouter le numéro de page, à la lecture de la page, ainsi que le livre
        $bookmark->remove();

        return $this->redirectToRoute('home');
    }
}
