<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use App\Form\EditEmailType;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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
        $form = $this->em->getRepository(Address::class)->findUserAddresses(['id' => $this->getUser()]);

        return $this->render('account/clientaddress.html.twig', [
            'form' => $form,
        ]);
    }

    //add and edit address
    #[Route('/add/address', name: 'add_address')]
    #[Route('/edit/address/{id}', name: 'edit_address')]
    public function addaddress(CartService $cartservice, Address $address = null, Request $request)
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

            if($cartservice->getCart()){
                return $this->redirectToRoute('command');
            }else{
                // Redirect to the address list after saving
                return $this->redirectToRoute('address');
            }
        }

        // Render the template for the add/edit address form
        return $this->render('address/addaddress.html.twig', [
            'form' => $form,
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

    //Client profile page
    #[Route('/myprofile', name: 'myprofile')]
    public function myProfile(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditEmailType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            return $this->redirectToRoute('myprofile');
        }
        
        return $this->render('account/myprofile.html.twig', [
            'form' => $form,
        ]);
    }

    //delete user's account
    #[Route('/delete/user', name: 'delete_user')]
    public function deleteUser(Request $request, TokenStorageInterface $tokenStorage)
    {
        $user = $this->getUser();
        if(!$user){
            $request->getSession()->invalidate();
            return $this->redirectToRoute('app_logout');
        }

        if($user){
            //Reoving the wishlist
            // $wishlists = $user->getWishlists();
            // foreach ($wishlists as $wishlist) {
            //     $this->em->remove($wishlist);
            // }

            //Removing the association of address
            $userAddresses = $user->getAddresses();
            foreach($userAddresses as $userAddress){
                $this->em->remove($userAddress);
            }
            
            // Invalidate the user's session
            $request->getSession()->invalidate();

            // Remove the user's authentication token from the security context
            $tokenStorage->setToken(null);
            $this->em->remove($user);
            $this->em->flush();

            return $this->redirectToRoute('app_logout');
        }

    }

}
