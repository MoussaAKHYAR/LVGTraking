<?php

namespace App\Controller;

use App\Entity\Conducteur;
use App\Form\ConducteurType;
use App\Repository\ConducteurRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConducteurController extends AbstractController
{
    private $conducteur;
    private $em;
    public function __construct(ConducteurRepository $conducteur,ObjectManager $em)
    {
        $this->conducteur = $conducteur;
        $this->em = $em;
    }
    public function add(Request $request)
    {
        $conducteur = new Conducteur();
        $form = $this->createForm(ConducteurType::class, $conducteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($conducteur);
            $this->em->flush();
            return $this->redirectToRoute('listeConducteur');
        }
        return $this->render('conducteur/add.html.twig',[
            'conducteur' => $conducteur,
            'form' => $form->createView()
        ]);
    }
    public function edit(Conducteur $conducteur, Request $request)
    {
        $form = $this->createForm(ConducteurType::class, $conducteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
           
            $this->em->flush();
            return $this->redirectToRoute('listeConducteur');
        }
        return $this->render('conducteur/edit.html.twig',[
            'conducteur' => $conducteur,
            'form' => $form->createView()
        ]);
    }
    public function delete(Conducteur $conducteur)
    {
        $this->em->remove($conducteur);
        $this->em->flush();
        return $this->redirectToRoute('listeConducteur');
    }
    public function liste()
    {
        $conducteurs = $this->conducteur->findAll();
        return $this->render('conducteur/liste.html.twig', compact('conducteurs'));
    }
}
