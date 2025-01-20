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

        $book4 = new Knyga();
        $book4->setPavadinimas('Baltaragio malūnas');
        $book4->setAutorius('Kazys Boruta');
        $book4->setIsleidimoMetai(1945);
        $book4->setISBN('9786090700372');
        $book4->setApie('Romantiškas padavimas apie malūnininką Baltaragį, jo dukterį Jurgą ir velnią Pinčuką, perpintas lietuvių liaudies tradicijomis.');
        $book4->setNuotrauka('baltaragio-malunas.jpg');

        $book5 = new Knyga();
        $book5->setPavadinimas('Anykščių šilelis');
        $book5->setAutorius('Antanas Baranauskas');
        $book5->setIsleidimoMetai(1861);
        $book5->setISBN('9786090700389');
        $book5->setApie('Poetinė poema apie Anykščių šilą, jo grožį ir nykimą, gamtos ir žmogaus santykį.');
        $book5->setNuotrauka('anyksciu-silelis.jpg');

        $book6 = new Knyga();
        $book6->setPavadinimas('Balta drobulė');
        $book6->setAutorius('Antanas Škėma');
        $book6->setIsleidimoMetai(1958);
        $book6->setISBN('9786090700396');
        $book6->setApie('Modernistinis romanas apie lietuvį emigrantą Antaną Garšvą, jo prisiminimus ir psichologines būsenas.');
        $book6->setNuotrauka('balta-drobule.jpg');

        $book7 = new Knyga();
        $book7->setPavadinimas('Silva Rerum');
        $book7->setAutorius('Kristina Sabaliauskaitė');
        $book7->setIsleidimoMetai(2008);
        $book7->setISBN('9786090700402');
        $book7->setApie('Istorinis romanas apie XVII a. Lietuvos bajorų gyvenimą, tradicijas ir kultūrą.');
        $book7->setNuotrauka('silva-rerum.jpg');

        $book8 = new Knyga();
        $book8->setPavadinimas('Sename dvare');
        $book8->setAutorius('Šatrijos Ragana');
        $book8->setIsleidimoMetai(1922);
        $book8->setISBN('9786090700419');
        $book8->setApie('Apysaka apie dvaro gyvenimą, motinos ir dukters santykius, meilę ir praradimą.');
        $book8->setNuotrauka('sename-dvare.jpg');

        $book9 = new Knyga();
        $book9->setPavadinimas('Miškais ateina ruduo');
        $book9->setAutorius('Marius Katiliškis');
        $book9->setIsleidimoMetai(1957);
        $book9->setISBN('9786090700426');
        $book9->setApie('Romanas apie kaimo gyvenimą, žmonių likimus ir meilės istorijas tarpukario Lietuvoje, atskleidžiantis kaimo bendruomenės tradicijas ir vertybes.');
        $book9->setNuotrauka('miskais-ateina-ruduo.jpg');
        
        $book10 = new Knyga();
        $book10->setPavadinimas('Strazdas žalias paukštis');
        $book10->setAutorius('Kazys Saja');
        $book10->setIsleidimoMetai(1976);
        $book10->setISBN('9786090700433');
        $book10->setApie('Pasaka-drama apie laisvės troškimą, žmogaus dvasios stiprybę ir gebėjimą išlikti savimi net sunkiausiomis aplinkybėmis.');
        $book10->setNuotrauka('strazdas-zalias-paukstis.jpg');
        
        $manager->persist($book1);
        $manager->persist($book2);
        $manager->persist($book3);
        $manager->persist($book4);
        $manager->persist($book5);
        $manager->persist($book6);
        $manager->persist($book7);
        $manager->persist($book8);
        $manager->persist($book9);
        $manager->persist($book10);

        $manager->flush();
    }
}