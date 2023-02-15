<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddressController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    #[Route('/address', name: 'address')]
    public function index(): Response
    {
        $form = $this->em->getRepository(Address::class)->findBy([], ['firstname' => 'ASC']);

        return $this->render('account/clientaddress.html.twig', [
            'form' => $form,
        ]);
    }

    //add and edit address
    #[Route('/add/address', name: 'add_address')]
    #[Route('/edit/address/{id}', name: 'edit_address')]
    public function addaddress(Address $address = null, Request $request)
    {
        // If an address object is not provided, create a new one
        if(!$address){
            $address = new Address();
        }

        // Create the form for the address
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        // If the form is submitted and valid, save the address
        if($form->isSubmitted() && $form->isValid()){
            $address = $form->getData();
            $address->setUser($this->getUser());
            $this->em->persist($address);
            $this->em->flush();

             // Redirect to the address list after saving
            return $this->redirectToRoute('address');
        }

        // Render the template for the add/edit address form
        return $this->render('address/addaddress.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    //delete user's address
    #[Route('/address/delete/{id}', name: 'delete_address')]
    public function deleteAdresse(Address $address = null)
    {
        if($address && $address->getUser() == $this->getUser()){
            $this->em->remove($address);
            $this->em->flush();
        }

        return $this->redirectToRoute('address');
    }
}
