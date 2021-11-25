<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Booking;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $date = new \DateTime('1884');
        $book = new Book();
        $book->setTitle('Germinal')
            ->setAuthor('Zola')
            ->setCategory('Roman')
            ->setPublishDate($date)
            ->setDetails("Fils de Gervaise Macquart et de son amant Auguste Lantier, le jeune Étienne Lantier...")
            ->setImage('germinal.jpeg');

        $manager->persist($book);

        $date = new \DateTime('1668');
        $book2 = new Book();
        $book2->setTitle('Fables')
            ->setAuthor('J. de la Fontaine')
            ->setCategory('Poesie')
            ->setPublishDate($date)
            ->setDetails("Fils de Gervaise Macquart et de son amant Auguste Lantier, le jeune Étienne Lantier...")
            ->setImage('fables.jpeg');

        $manager->persist($book2);

        $date = new \DateTime('2021');
        $book3 = new Book();
        $book3->setTitle('Symfony pour les nuls')
            ->setAuthor('Rodolphe')
            ->setCategory('Informatique')
            ->setPublishDate($date)
            ->setDetails("Fils de Gervaise Macquart et de son amant Auguste Lantier, le jeune Étienne Lantier...")
            ->setImage('symfony.jpeg');

        $manager->persist($book3);

        $date = new \DateTime('1990-12-24');
        $userAdmin = new User();
        $userAdmin->setEmail('admin@admin.com')
            ->setPassword('$2y$13$03ctwkce7fyWWp5aIZovHuM290Csox0kSef3qfSb09.5y1lzvaeFW')
            ->setDateBirth($date)
            ->setName('Anais Admin')
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($userAdmin);

        $date = new \DateTime('1985-10-14');
        $user = new User();
        $user->setEmail('user@user.com')
            ->setPassword('$2y$13$03ctwkce7fyWWp5aIZovHuM290Csox0kSef3qfSb09.5y1lzvaeFW')
            ->setDateBirth($date)
            ->setName('Anais User')
            ->setRoles([]);
        
        $manager->persist($user);

        $booking = new Booking();

        $date = new \DateTime('2021-10-14');
        $dateReturn = new \DateTime('@'.strtotime('2021-10-14').'+ 30 days');

        $booking->setBook($book2)
            ->setUser($user)
            ->setBookingDate($date)
            ->setReturnDate($dateReturn);
        
        $manager->persist($booking);

        $booking2 = new Booking();

        $date = new \DateTime('now');

        $booking2->setBook($book3)
            ->setUser($user)
            ->setBookingDate($date);
        
        $manager->persist($booking2);

        $manager->flush();
    }
}
