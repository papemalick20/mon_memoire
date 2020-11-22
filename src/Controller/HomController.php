<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomController extends AbstractController
{
     public function __construct(Environment $twig)
     {
         $this->twig=$twig;
     }
    /**
     * @Route("/hom", name="hom")
     */
    public function home(PropertyRepository $repository): Response
    {
        $properties= $repository->findLatest();

        return $this->render('hom/index.html.twig', [
            'properties'=> $properties
        ]);
    }
}
