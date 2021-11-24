<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\User;
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

        $book2 = new Book();
        $book2->setTitle('Fables')
            ->setAuthor('J. de la Fontaine')
            ->setCategory('Poesie')
            ->setPublishDate(null)
            ->setDetails("Fils de Gervaise Macquart et de son amant Auguste Lantier, le jeune Étienne Lantier...")
            ->setImage('fables.jpeg');

        $manager->persist($book2);

        $userAdmin = new User();
        $userAdmin->setEmail('admin@admin.com')
            ->setPassword('$2y$13$03ctwkce7fyWWp5aIZovHuM290Csox0kSef3qfSb09.5y1lzvaeFW')
            ->setName('Anais Admin')
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($userAdmin);

        $user = new User();
        $user->setEmail('user@user.com')
            ->setPassword('$2y$13$03ctwkce7fyWWp5aIZovHuM290Csox0kSef3qfSb09.5y1lzvaeFW')
            ->setName('Anais User')
            ->setRoles([]);
        
        $manager->persist($user);

        $manager->flush();
    }
}
