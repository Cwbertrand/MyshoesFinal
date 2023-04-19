<?php

namespace App\Controller;

use App\Service\Email;
use DateTime;
use App\Entity\User;
use App\Entity\ContactUs;
use App\Form\ContactUsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactUsController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    #[Route('/contact/us', name: 'contact_us')]
    public function index(ContactUs $contactUs = null, Request $request): Response
    {
        $form = $this->createForm(ContactUsType::class, $contactUs);
        $form->handleRequest($request);
        $user = new User();
        if ($form->isSubmitted() && $form->isValid()) {
            $date = new DateTime();
            $contactUs = $form->getData();
            $contactUs->setUser($this->getUser());
            $contactUs->setCreateAt($date);

            $this->em->persist($contactUs);
            $this->em->flush();


            $this->addFlash('message', 'Thanks so much for reaching out to us. We will get back to you as quick as possible');
            
            $mailer = new Email();
            $content = ' Thanks so much for reaching us. We will get back to you as soon as possible';
            $mailer->sendEmail($user->getEmail(), $user->getEmail(), $contactUs->getSubject(), $content);
            
            return $this->redirectToRoute('contact_us');
        }
        return $this->render('contact_us/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
