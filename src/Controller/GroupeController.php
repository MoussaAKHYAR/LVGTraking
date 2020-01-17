<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Form\GroupeType;
use App\Repository\GroupeRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GroupeController extends AbstractController
{
    private $groupe;
    private $em;
    public function __construct(GroupeRepository $groupe,ObjectManager $em)
    {
        $this->groupe = $groupe;
        $this->em = $em;
    }
    public function add(Request $request)
    {
        $groupe = new Groupe();
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($groupe);
            $this->em->flush();
            return $this->redirectToRoute('listeGroupe');
        }
        return $this->render('groupe/add.html.twig',[
            'groupe' => $groupe,
            'form' => $form->createView()
        ]);
    }
    public function edit(Groupe $groupe, Request $request)
    {
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
           
            $this->em->flush();
            return $this->redirectToRoute('listeGroupe');
        }
        return $this->render('groupe/edit.html.twig',[
            'groupe' => $groupe,
            'form' => $form->createView()
        ]);
    }
    public function delete(Groupe $groupe)
    {
        $this->em->remove($groupe);
        $this->em->flush();
        return $this->redirectToRoute('listeGroupe');
    }
    public function liste()
    {
        $groupes = $this->groupe->findAll();
        return $this->render('groupe/liste.html.twig', compact('groupes'));
    }

}
