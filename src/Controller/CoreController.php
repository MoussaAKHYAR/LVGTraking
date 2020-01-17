<?php

namespace App\Controller;

use App\Entity\Position;
use App\Repository\PositionRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Query;

class CoreController extends AbstractController
{
    private $em;
    private $map;

    public function __construct(PositionRepository $map, ObjectManager $em)
    {
        $this->map = $map;
        $this->em = $em;

    }

    public function index()
    {

        //$allData = $this->map->findAll();
        //$allData = json_encode($allData, true);
        //var_dump($allData);
        //exit;
        $query = $this->getDoctrine()
            ->getRepository(Position::class)
            ->createQueryBuilder('p')
            ->getQuery();
        $allData = $query->getResult(Query::HYDRATE_ARRAY);

        //var_dump(json_encode($allData, true));
        //exit;
        return $this->render('core/index.html.twig', compact('allData'));
    }


}
