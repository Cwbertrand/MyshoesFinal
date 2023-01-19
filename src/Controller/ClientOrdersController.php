<?php

namespace App\Controller;

use App\Entity\Command;
use App\Entity\CommandDetail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientOrdersController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/client/command', name: 'client_command')]
    public function index(): Response
    {
        $command = $this->em->getRepository(Command::class)->findByIsPaid($this->getUser());
        //dd($command);
        return $this->render('account/clientcommand.html.twig', [
            'command' => $command,
        ]);
    }
}
