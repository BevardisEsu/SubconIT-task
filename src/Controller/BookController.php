<?php

namespace App\Controller;

use App\Entity\Knyga;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/book')]
#[IsGranted('ROLE_USER')]
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
    #[Route('/new', name: 'app_book_new', methods: ['GET', 'POST'])]
    #[Route('/new', name: 'app_book_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $knyga = new Knyga();
        $form = $this->createForm(BookType::class, $knyga);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($knyga);
            $entityManager->flush();

            return $this->redirectToRoute('app_book_index');
        }

        return $this->render('book/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/{id}/edit', name: 'app_book_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Knyga $knyga, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BookType::class, $knyga);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_book_index');
        }
    
        return $this->render('book/edit.html.twig', [
            'knyga' => $knyga,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'app_book_delete', methods: ['POST'])]
    public function delete(Request $request, Knyga $knyga, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$knyga->getId(), $request->request->get('_token'))) {
            $entityManager->remove($knyga);
            $entityManager->flush();
        }
    
        return $this->redirectToRoute('app_book_index');
    }
}