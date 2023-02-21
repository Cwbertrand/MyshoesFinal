<?php

namespace App\Controller;

use Stripe\Stripe;
use App\Class\Carte;
use App\Class\Email;
use App\Entity\Command;
use App\Service\CartService;
use Stripe\Checkout\Session;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route("/command/create-session/{reference}", name: 'stripe')]
    public function index($reference, $stripeSK): Response
    {
        //passing array of product for STRIPE payment
        $stripepayment = [];
        
        $YOUR_DOMAIN = 'https://127.0.0.1:8000';

        $command = $this->em->getRepository(Command::class)->findOneByReference($reference);

        //this is for the product
        foreach($command->getCommandDetails()->getValues() as $product){
            $stripepayment[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $product->getProductprice(),
                    'product_data' => [
                        'name' => $product->getProductname(),
                       // 'images' => [$YOUR_DOMAIN]."/upload/".$product->getProductimage(),
                    ],
                ],
                'quantity' => $product->getQuantity(),
            ];
        }
        
        //this is for the transporter
        $stripepayment[] = [
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => $command->getTransportprice(),
                'product_data' => [
                    'name' => $command->getTransportagency(),
                ],
            ],
            'quantity' => 1,
        ];

         ///// PAYMENT METHOD USING STRIPE /////
         //this is where you put the secrete key
        Stripe::setApiKey($stripeSK);

        $checkout_session = Session::create([
            'customer_email' => $command->getUser()->getEmail(),
            'payment_method_types' => ['card'],
            'line_items' => [
                $stripepayment,
            ],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/payment/successfull/{CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN . '/payment/error/{CHECKOUT_SESSION_ID}',
            // 'success_url'  => $this->generateUrl('success_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
            // 'cancel_url'   => $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        $command->setStripesessionid($checkout_session->id);
        $this->em->flush();

        return $this->redirect($checkout_session->url, 303);
    }

    #[Route('/payment/successfull/{stripesessionid}', name: 'success_url')]
    public function successUrl(CartService $cartservice, $stripesessionid): Response
    {
        $command = $this->em->getRepository(Command::class)->findOneBy(['stripesessionid' => $stripesessionid]);

        //for security purpose, if order do not exist and if the user
        //is different from the user of the command
        if(!$command || $command->getUser() != $this->getUser()){
            return $this->redirectToRoute('home');
        }

        if(!$command->isIsPaid()){
            //Clear the cart after payment
            $cartservice->removeCart();

            //Modify the payment status
            $command->setIsPaid(1);
            $this->em->flush();

            $email = new Email();
            $content = 'Thanks for purchasing from us';

            $email->sendEmail('email@gmail.com', 'john doe', 'Thanks for purchasing from us.', $content);
        }

        return $this->render('payment/success.html.twig', [
            'command' => $command,
        ]);
    }


    #[Route('/payment/error/{stripesessionid}', name: 'cancel_url')]
    public function cancelUrl($stripesessionid): Response
    {
        $command = $this->em->getRepository(Command::class)->findOneBy(['stripesessionid' => $stripesessionid]);

        //for security purpose, if order do not exist and if the user
        //is different from the user of the command
        if(!$command || $command->getUser() != $this->getUser()){
            return $this->redirectToRoute('home');
        }

        //dd($command);
        return $this->render('payment/cancel.html.twig', [
            'command' => $command,
        ]);
    }
}
