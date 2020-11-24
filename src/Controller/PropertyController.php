<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;
    public function __construct(PropertyRepository $repository)
    {
        $this->repository= $repository;
    }
    /**
     * @Route("/property", name="property.index")
     */
    public function index(Request $request): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);
        $properties =$this->repository->findAllVisibleQuery($search);
        return $this->render('property/index.html.twig',[
            'current_menu' => 'properties',
            'properties' => $properties,
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/biens/{slug}-{id}", name="property.show",requirements={"slug":"[a-z0-9\-]*"})
     */
    public function show(Property $property, string $slug): Response
    {
        
        if ($property->getSlug() != $slug) {
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
            
        ]);
        // $contact = new Contact();
        // $contact->setProperty($property);
        // $form = $this->createForm(ContactType::class, $contact);
        // $form->handleRequest($request);
        // if($form->isSubmitted() && $form->isValid()){
        //     $data= $form->getData();
            //dd($data);
            // // $mailerService->send(
            // //     "nouveau message",
            // //     "papa@gmail.com",
            // //     "tapha@gmail.com",
            // //     "emails/contact.html.twig",
            // //     [
            // //         "firstname"=> $data['firstname'],
            // //         "lastname"=> $data['lastname'],
            // //         "phone"=> $data['phone'],
            // //         "email"=>$data['email'],
            // //         "message"=> $data['message'],
            // //         "property"=>$data['property']
            // //     ]
            // // );
            //$mailer->send($email);
            
            //$this->addFlash('success',  'votre email à bien ètè envoyé');
            //$Notification->notify($contact);
        //   $this->addFlash('success',  'votre email à bien ètè envoyé');
        

        }

}
