<?php

namespace App\Controller;

use App\Entity\Knyga;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book')]
class BookController extends AbstractController
{
    #[Route('/', name: 'app_book_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $knygos = $entityManager
            ->getRepository(Knyga::class)
            ->findAll();

        return $this->render('book/index.html.twig', [
            'knygos' => $knygos,
        ]);
    }
}