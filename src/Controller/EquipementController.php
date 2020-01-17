<?php

namespace App\Controller;

use App\Entity\Equipement;
use App\Form\EquipementType;
use App\Repository\EquipementRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EquipementController extends AbstractController
{
    private $equipement;
    private $em;
    public function __construct(EquipementRepository $equipement,ObjectManager $em)
    {
        $this->equipement = $equipement;
        $this->em = $em;
    }
    public function add(Request $request)
    {
        $equipement = new Equipement();
        $form = $this->createForm(EquipementType::class, $equipement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($equipement);
            $this->em->flush();
            return $this->redirectToRoute('listeEquipement');
        }
        return $this->render('equipement/add.html.twig',[
            'equipement' => $equipement,
            'form' => $form->createView()
        ]);
    }
    public function edit(Equipement $equipement, Request $request)
    {
        $form = $this->createForm(EquipementType::class, $equipement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
           
            $this->em->flush();
            return $this->redirectToRoute('listeEquipement');
        }
        return $this->render('equipement/edit.html.twig',[
            'equipement' => $equipement,
            'form' => $form->createView()
        ]);
    }
    public function delete(Equipement $equipement)
    {
        $this->em->remove($equipement);
        $this->em->flush();
        return $this->redirectToRoute('listeEquipement');
    }
    public function liste()
    {
        $equipements = $this->equipement->findAll();
        return $this->render('equipement/liste.html.twig', compact('equipements'));
    }
}
