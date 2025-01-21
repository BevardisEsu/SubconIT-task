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
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/book')]
#[IsGranted('ROLE_USER')]
class BookController extends AbstractController
{
    private $bookCoversDirectory; 

        #Setting directory for book covers upload
    public function __construct(private SluggerInterface $slugger)
    {
        $this->bookCoversDirectory = 'uploads/covers/';
    }
        #Index logic
        #[Route('/', name: 'app_book_index', methods: ['GET'])]
        public function index(Request $request, EntityManagerInterface $entityManager): Response
        {
            $searchTerm = $request->query->get('search');
            $yearFrom = $request->query->get('yearFrom');
            $yearTo = $request->query->get('yearTo');
        
            $queryBuilder = $entityManager->getRepository(Knyga::class)->createQueryBuilder('k');
        
            if ($searchTerm) {
                $queryBuilder
                    ->where('k.pavadinimas LIKE :search')
                    ->orWhere('k.autorius LIKE :search')
                    ->orWhere('k.ISBN LIKE :search')
                    ->setParameter('search', '%'.$searchTerm.'%');
            }
        
            if ($yearFrom) {
                $queryBuilder
                    ->andWhere('k.isleidimo_metai >= :yearFrom')
                    ->setParameter('yearFrom', $yearFrom);
            }
        
            if ($yearTo) {
                $queryBuilder
                    ->andWhere('k.isleidimo_metai <= :yearTo')
                    ->setParameter('yearTo', $yearTo);
            }
        
            $knygos = $queryBuilder->getQuery()->getResult();
        
            return $this->render('book/index.html.twig', [
                'knygos' => $knygos,
                'searchTerm' => $searchTerm,
                'yearFrom' => $yearFrom,
                'yearTo' => $yearTo,
            ]);
        }
        #Routes for new and edits
    #[Route('/new', name: 'app_book_new', methods: ['GET', 'POST'])]
    #[Route('/new', name: 'app_book_new', methods: ['GET', 'POST'])]
        #New book creation logic
        #[Route('/new', name: 'app_book_new', methods: ['GET', 'POST'])]
        public function new(Request $request, EntityManagerInterface $entityManager): Response
        {
            $knyga = new Knyga();
            $form = $this->createForm(BookType::class, $knyga);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $coverFile = $form->get('nuotrauka')->getData();
    
                if ($coverFile) {
                    $originalFilename = pathinfo($coverFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $this->slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$coverFile->guessExtension();
    
                    try {
                        $coverFile->move(
                            $this->getParameter('kernel.project_dir').'/public/'.$this->bookCoversDirectory,
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
    
                    $knyga->setNuotrauka($this->bookCoversDirectory.$newFilename);
                }
    
                $entityManager->persist($knyga);
                $entityManager->flush();
    
                return $this->redirectToRoute('app_book_index');
            }
    
            return $this->render('book/new.html.twig', [
                'form' => $form->createView(),
            ]);
        }
            #Edits logic
        #[Route('/{id}/edit', name: 'app_book_edit', methods: ['GET', 'POST'])]
        public function edit(Request $request, Knyga $knyga, EntityManagerInterface $entityManager): Response
        {
            $form = $this->createForm(BookType::class, $knyga);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $coverFile = $form->get('nuotrauka')->getData();
                
                if ($coverFile) {
                    $originalFilename = pathinfo($coverFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $this->slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$coverFile->guessExtension();
                    var_dump($originalFilename); // Debug line
                    var_dump($coverFile->getMimeType()); // Debug line
    
                    try {
                        // Delete old file if exists
                        if ($knyga->getNuotrauka()) {
                            $oldFile = $this->getParameter('kernel.project_dir').'/public/'.$knyga->getNuotrauka();
                            if (file_exists($oldFile)) {
                                unlink($oldFile);
                            }
                        }
    
                        $coverFile->move(
                            $this->getParameter('kernel.project_dir').'/public/'.$this->bookCoversDirectory,
                            $newFilename
                        );
                    } catch (FileException $e) {
                    }
    
                    $knyga->setNuotrauka($this->bookCoversDirectory.$newFilename);
                }
    
                $entityManager->flush();
                return $this->redirectToRoute('app_book_index');
            }
    
            return $this->render('book/edit.html.twig', [
                'knyga' => $knyga,
                'form' => $form,
            ]);
        }  
            #Deletion of books
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