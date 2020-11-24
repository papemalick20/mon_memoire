<?php

namespace App\Controller;

use App\Entity\Option;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @var PropertyRipository
     */
    private $repository;

    public function __construct(PropertyRepository $repository)
    {
     $this->repository= $repository;
    }
    /**
     * @Route("/admin", name="admin.index")
     */
    public function index(): Response
    {
        $properties= $this->repository->findAll();
        return $this->render('admin/index.html.twig', compact('properties'));
    }
     /**
      * @Route("/admin/{id}", name="admin.edit")
      * @param Propery $property
      *@return \Symfony\Component\HttpFoundation\Response
      */

      /**
     * @Route("/admin/create", name="admin.new")
     */
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $property = new Property;
        //$options = new Option();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($property);
            //$manager->persist($options);
            $manager->flush();
            $this->addFlash('success', 'Bien créer avec succès');
            return $this->redirectToRoute('admin.index');
        }
        return $this->render(
            'admin/new.html.twig', [
            'property' => $property,
            //'options'=>$options,
            'form' => $form->createView()
            ]
        );
    }
    /**
     * @Route("/admin/property/edit/{id}", name="admin.edit", methods="GET|POST")
     */

      public function edit(Property $property, Request $request, EntityManagerInterface $manager):Response
      {
         
          $form = $this->createForm(PropertyType::class,$property);
          $form->handleRequest($request);
          if($form->isSubmitted() && $form->isValid()){
           $manager->flush();
           $this->addFlash('success', 'Bien modifié avec succès');
           return $this->redirectToRoute('admin.index');
          }
             return $this->render('admin/edit.html.twig',[
                 'property' =>$property,
                 'form'=> $form->createView()
             ]);
      }
       /**
     * @Route("/admin/delete/{id}", name="admin.delete", methods="DELETE")
     */

    
      public function delete(Property $property, EntityManagerInterface $manager)
    {
        $manager->remove($property);
        $manager->flush();
        $this->addFlash('success', 'Bien supprimé avec succès');
        return $this->redirectToRoute('admin.index');
    }
}
