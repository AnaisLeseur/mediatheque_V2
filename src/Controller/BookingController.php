<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
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

}
