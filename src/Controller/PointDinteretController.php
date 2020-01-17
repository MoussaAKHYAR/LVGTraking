<?php

namespace App\Controller;

use App\Entity\PointDinteret;
use App\Form\PointDinteretType;
use App\Repository\PointDinteretRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PointDinteretController extends AbstractController
{
    private $point;
    private $em;
    public function __construct(PointDinteretRepository $point,ObjectManager $em)
    {
        $this->point = $point;
        $this->em = $em;
    }
    public function add(Request $request)
    {
        $point = new PointDinteret();
        $form = $this->createForm(PointDinteretType::class, $point);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($point);
            $this->em->flush();
            return $this->redirectToRoute('listePointDinteret');
        }
        return $this->render('point_dinteret/add.html.twig',[
            'point' => $point,
            'form' => $form->createView()
        ]);
    }
    public function edit(PointDinteret $point, Request $request)
    {
        $form = $this->createForm(PointDinteretType::class, $point);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
           
            $this->em->flush();
            return $this->redirectToRoute('listePointDinteret');
        }
        return $this->render('point_dinteret/edit.html.twig',[
            'point' => $point,
            'form' => $form->createView()
        ]);
    }
    public function delete(PointDinteret $point)
    {
        $this->em->remove($point);
        $this->em->flush();
        return $this->redirectToRoute('listePointDinteret');
    }
    public function liste()
    {
        $points = $this->point->findAll();
        return $this->render('point_dinteret/liste.html.twig', compact('points'));
    }
}
