<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookingRepository;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/admin/update_book/{id}", name="admin_update_book", methods={"GET","POST"})
     */
    public function addOrUpdateBook(Request $request, EntityManagerInterface $manager, Book $book = null): Response
    {

        if (!$book) {
            $book = new Book();
        }
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('imageFile')->getData();

            if ($image != null) {
                $fichier = md5(uniqid()).'.'.$image->guessExtension();
                // On copie le fichier dans le dossier uploads
/*                 $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                ); */
                $book->setImage($fichier);
            }
            $modif = $book->getId() !== null;
            $manager->persist($book);
            $this->addFlash("success", ($modif) ? "La modification a été effectuée" : "L'ajout a été effectuée");
            $manager->flush();
            return $this->redirectToRoute('manage_books');
        }

        return $this->render('admin/manage_book/edit_book.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
            'modif' => $book->getId() !== null
        ]);
    }
    /**
     * @Route("/admin/delete_book/{id}", name="admin_delete_book")
     */
    public function deleteBook(Request $request, EntityManagerInterface $manager, Book $book = null): Response
    {
        if($this->isCsrfTokenValid('SUP' . $book->getId(), $request->get('_token'))) {
            $manager->remove($book);
            $manager->flush();
            $this->addFlash("success", "La suppression a été effectuée");

            return $this->redirectToRoute('manage_books');
        }
    }
    /**
     * @Route("/admin/manage_books", name="manage_books")
     */
    public function manageBooks(BookRepository $bookRepo): Response
    {
        $books = $bookRepo->findAll();
        return $this->render('admin/manage_book/index.html.twig', [
            'books' => $books,
        ]);
    }
    
}
