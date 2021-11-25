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

        $user = $this->security->getUser()/* ->getId() */;
        $bookings = $bookingRepo->findBy(['user' => $user], ['booking_date' => 'desc']);
/*        $books = [];
        foreach ($bookings as $booking) {
            $book = $booking->getbook();
            array_push($books, $book);
        } */
        
        return $this->render('book/booking.html.twig', [
            'bookings' => $bookings,
        ]); 
    }
        /**
     * @Route("/admin/add_book", name="add_book")
     */
    public function addBook(): Response
    {
        return $this->render('booking/index.html.twig', [
            'controller_name' => 'BookingController',
        ]);
    }
            /**
     * @Route("/admin/update_book", name="admin_update_book")
     */
    public function updateBook(): Response
    {
        return $this->render('booking/index.html.twig', [
            'controller_name' => 'BookingController',
        ]);
    }
            /**
     * @Route("/admin/delete_book", name="admin_delete_book")
     */
    public function deleteBook(): Response
    {
        return $this->render('booking/index.html.twig', [
            'controller_name' => 'BookingController',
        ]);
    }
            /**
     * @Route("/admin/manage_books", name="manage_books")
     */
    public function manageBooks(BookRepository $bookRepo): Response
    {
        $books = $bookRepo->findAll();
        return $this->render('booking/index.html.twig', [
            'books' => $books,
        ]);
    }
    
}
