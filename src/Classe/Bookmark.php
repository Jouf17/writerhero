<?php
namespace App\Classe;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Bookmark
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function add($numPage)
    {
        $this->session->set('bookmark', [
            [
                'numPage' => $numPage
                // 'book' => $book
            ]
        ]);
    }

    public function get()
    {
        return $this->session->get('bookmark');
    }

    public function remove()
    {
        return $this->session->remove('bookmark');
    }
}