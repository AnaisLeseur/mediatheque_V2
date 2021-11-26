<?php

namespace App\Controller;

use App\Entity\Booking;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\BookRepository;

class BookingController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    /**
     * @Route("/return", name="return")
     */
    public function index(): Response
    {
        return $this->render('booking/return.html.twig', [
        ]);
    }
    /**
     * @Route("/admin_booking", name="admin_booking")
     */
    public function booking(): Response
    {
        return $this->render('booking/return.html.twig', [
        ]);
    }

    /**
     * @Route("/make_booking/{id}", name="make_booking")
     */
    public function makeBooking(EntityManagerInterface $manager, BookRepository $bookRepo, $id): Response
    {
        $user = $this->security->getUser();
        $book = $bookRepo->find($id);
        $date = new \DateTime('now');

        $newBooking = new Booking();
        $newBooking->setBook($book)
            ->setUser($user)
            ->setBookingDate($date);
        
        $manager->persist($newBooking);
        $this->addFlash("success", "Votre réservation à été prise en compte");
        $manager->flush();

        return $this->redirectToRoute('booking');
    }

}
