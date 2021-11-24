<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class BookController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    /**
     * @Route("/books", name="books")
     */
    public function index(BookRepository $bookRepo): Response
    {
        $books = $bookRepo->findAll();
        return $this->render('book/index.html.twig', [
            'books' => $books,
        ]);
    }
    
        /**
     * @Route("/book/{id}", name="show_book")
     */
    public function getById(BookRepository $bookRepo, $id): Response
    {
        $book = $bookRepo->find($id);
        return $this->render('book/detail.html.twig', [
            'book' => $book,
        ]);
    }
    
    /**
     * @Route("/booking", name="booking")
     */
    public function getBooking(BookRepository $bookRepo, BookingRepository $bookingRepo): Response
    {

        $user = $this->security->getUser()->getId();

        $bookings = $bookingRepo->findBy(['book' => 1], ['booking_date' => 'desc']);
        var_dump($bookings);
/*         $books = [];
        foreach ($bookings as $booking) {
            $book = $booking->getbook();
            array_push($books, $book);
            var_dump($book);
        } */
        
        return $this->render('book/booking.html.twig', [
            //'books' => $books,
        ]); 
    }
}
