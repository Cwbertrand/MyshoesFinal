<?php

namespace App\Controller;

use App\Class\Carte;
use App\Entity\Command;
use App\Entity\CommandDetail;
use App\Form\CommandType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CommandController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    #[Route('/command', name: 'command')]
    public function index(Carte $carte): Response
    {

        //this redirects you to create an addresse if you want to pass a commande but you don't have an address yet
        if(!$this->getUser()->getAddresses()->getValues()){
            return $this->redirectToRoute('address');
        }

        // we pass null because the form is not linked to any entity and the user because we want to show only one
        //one address of the user in session
        $form = $this->createForm(CommandType::class, null, [
            'user' => $this->getUser()
        ]);

        return $this->render('command/index.html.twig', [
            'forms' => $form->createView(),
            'fullproducts' => $carte->productDetails(),

        ]);
    }

    //This injects the selected product(s), addresse, and delivery agency into the database
    #[Route('/command/recap', name: 'command_recap')]
    public function commandeRecap(Carte $carte, Request $request): Response
    {

        $form = $this->createForm(CommandType::class, null, [
            'user' => $this->getUser()
        ]);

        //handlerequest
        $form->handleRequest($request);
        
        //Handle form validation
        if($form->isSubmitted() && $form->isValid()){

            //registering the commande into the bdd when the validate button is clicked.
            // the comande entity will take care of the user, transport and addresse
            // while the ClientOrder will take care of the products and the quantity.

            $transport = $form->get('transport')->getData();
            $address = $form->get('address')->getData();
            //$firstname = $form->get('firstname')->getData();

            //dd($firstname);

            //Setting Command into the database
            $command = new Command();

            $date = new DateTime();
            $reference = $date->format('dmY').'-'.uniqid();

            $command->setCreateAt($date);
            $command->setReference($reference);
            $command->setTransportagency($transport->getTransportagency());
            $command->setTransportprice($transport->getPrice());
            $command->setDescription($transport->getDescription());
            $command->setAddressname($address->getFirstname().' '.$address->getLastname());
            $command->setAddressmobile($address->getMobile());

            if($address->getCompany()){
                $command->setAddresscompany($address->getCompany());
            }
            $command->setaddressstreet($address->getStreet());
            $command->setAddresscp($address->getPostalcode());
            $command->setAddresscity($address->getCity());
            $command->setAddresscountry($address->getCountry());
            $command->setAddresscp($address->getPostalcode());
            $command->setUser($this->getUser());
            $command->setIsPaid(0);
            $command->setDeliverystatus(0);

            //prep the order object to insert into the bdd
            $this->em->persist($command);

            //Setting up orderdetails into the database
            foreach($carte->productDetails() as $allproduct){
                $commanddetail = new CommandDetail();

                $commanddetail->setCommand($command);
                $commanddetail->setQuantity($allproduct['quantity']);
                $commanddetail->setProductname($allproduct['productdetail']->getShoesname());
                $commanddetail->setProductmark($allproduct['productdetail']->getMark());
                $commanddetail->setProductdescription($allproduct['productdetail']->getDescription());
                $commanddetail->setProductimage($allproduct['productdetail']->getImage());
                $commanddetail->setproductprice($allproduct['productdetail']->discountPrice());
                $commanddetail->setCommandtotal($allproduct['quantity'] * $allproduct['productdetail']->discountPrice());
                
                $this->em->persist($commanddetail);
                //$this->em->flush();
                //dd($allproduct);
                dd($commanddetail);
            }

        }

        return $this->render('command/commandrecap.html.twig', [
            'transport' => $transport,
            'deliveryaddress' => $address,
            'fullproducts' => $carte->productDetails(),
            'reference' => $command->getReference(),

        ]);
    }
}
