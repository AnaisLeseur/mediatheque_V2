<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $book = new Book();
        $book->setTitle('Germinal')
            ->setAuthor('Zola')
            ->setCategory('Roman')
            ->setPublishDate(null)
            ->setDetails("Fils de Gervaise Macquart et de son amant Auguste Lantier, le jeune Étienne Lantier...")
            ->setImage('germinal.jpeg');

        $manager->persist($book);

        $manager->flush();
    }
}
