<?php

namespace App\Controller;

use App\Entity\FicheDeSortie;
use App\Form\FicheDeSortieType;
use App\Repository\FicheDeSortieRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FicheDeSortieController extends AbstractController
{
    private $fiche;
    private $em;
    public function __construct(FicheDeSortieRepository $fiche,ObjectManager $em)
    {
        $this->fiche = $fiche;
        $this->em = $em;
    }
    public function add(Request $request)
    {
        $fiche = new FicheDeSortie();
        $form = $this->createForm(FicheDeSortieType::class, $fiche);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($fiche);
            $this->em->flush();
            return $this->redirectToRoute('listeFiche');
        }
        return $this->render('fiche_de_sortie/add.html.twig',[
            'fiche' => $fiche,
            'form' => $form->createView()
        ]);
    }
    public function edit(FicheDeSortie $fiche, Request $request)
    {
        $form = $this->createForm(FicheDeSortieType::class, $fiche);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
           
            $this->em->flush();
            return $this->redirectToRoute('listeFiche');
        }
        return $this->render('fiche_de_sortie/edit.html.twig',[
            'fiche' => $fiche,
            'form' => $form->createView()
        ]);
    }
    public function delete(FicheDeSortie $fiche)
    {
        $this->em->remove($fiche);
        $this->em->flush();
        return $this->redirectToRoute('listeFiche');
    }
    public function liste()
    {
        $fiches = $this->fiche->findAll();
        return $this->render('fiche_de_sortie/liste.html.twig', compact('fiches'));
    }
}
