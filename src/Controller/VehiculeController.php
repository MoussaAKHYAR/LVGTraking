<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeController extends AbstractController
{
    private $vehicule;
    private $em;
    public function __construct(VehiculeRepository $vehicule,ObjectManager $em)
    {
        $this->vehicule = $vehicule;
        $this->em = $em;
    }
    public function add(Request $request)
    {
        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($vehicule);
            $this->em->flush();
            return $this->redirectToRoute('listeVehicule');
        }
        return $this->render('vehicule/add.html.twig',[
            'vehicule' => $vehicule,
            'form' => $form->createView()
        ]);
    }
    public function edit(Vehicule $vehicule, Request $request)
    {
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
           
            $this->em->flush();
            return $this->redirectToRoute('listeVehicule');
        }
        return $this->render('vehicule/edit.html.twig',[
            'vehicule' => $vehicule,
            'form' => $form->createView()
        ]);
    }
    public function delete(Vehicule $vehicule)
    {
        $this->em->remove($vehicule);
        $this->em->flush();
        return $this->redirectToRoute('listeVehicule');
    }
    public function liste()
    {
        $vehicules = $this->vehicule->findAll();
        return $this->render('vehicule/liste.html.twig', compact('vehicules'));
    }
}
