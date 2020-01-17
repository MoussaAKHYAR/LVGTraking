<?php

namespace App\Controller;

use App\Entity\Position;
use App\Form\PositionType;
use App\Repository\PositionRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PositionController extends AbstractController
{
    private $position;
    private $em;
    public function __construct(PositionRepository $position,ObjectManager $em)
    {
        $this->position = $position;
        $this->em = $em;
    }

    public function addPosition()
    {
        $txt = $_POST['text'];
        var_dump($txt);
        $part = explode(':',$txt);
        $lat = (str_replace("long","",$part[1]));
        $long = (str_replace("speed","",$part[2]));
        $position = new Position();
        $position->setLatitude($lat);
        $position->setLongitude($long);
        $this->em->persist($position);
        $this->em->flush();
        return $this->redirectToRoute('index');


    }
    

}
