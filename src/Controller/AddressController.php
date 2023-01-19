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
        if(!$address){
            $address = new Address();
        }

        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $address = $form->getData();
            $address->setUser($this->getUser());
            $this->em->persist($address);
            $this->em->flush();

            return $this->redirectToRoute('address');
        }

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
