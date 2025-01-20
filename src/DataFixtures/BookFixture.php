<?php

namespace App\DataFixtures;

use App\Entity\Knyga;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $book1 = new Knyga();
        $book1->setPavadinimas('Altorių šešėly');
        $book1->setAutorius('Vincas Mykolaitis-Putinas');
        $book1->setIsleidimoMetai(1933);
        $book1->setISBN('9786090700341');
        $book1->setApie('Romanas apie jauną kunigą Liudą Vasarį, jo dvasinius išgyvenimus, meilę ir pašaukimo konfliktą.');
        $book1->setNuotrauka('altoriu-sesely.jpg');
        
        $book2 = new Knyga();
        $book2->setPavadinimas('Dievų miškas');
        $book2->setAutorius('Balys Sruoga');
        $book2->setIsleidimoMetai(1957);
        $book2->setISBN('9786090700358');
        $book2->setApie('Memuarinė knyga apie autoriaus patirtį Štuthofo koncentracijos stovykloje, parašyta su kartėliu ir ironija.');
        $book2->setNuotrauka('dievu-miskas.jpg');
        
        $book3 = new Knyga();
        $book3->setPavadinimas('Metai');
        $book3->setAutorius('Kristijonas Donelaitis');
        $book3->setIsleidimoMetai(1818);
        $book3->setISBN('9786090700365');
        $book3->setApie('Poema apie lietuvių valstiečių gyvenimą, būrų darbus ir papročius keturiais metų laikais.');
        $book3->setNuotrauka('metai.jpg');

        $manager->persist($book1);
        $manager->persist($book2);
        $manager->persist($book3);

        $manager->flush();
    }
}