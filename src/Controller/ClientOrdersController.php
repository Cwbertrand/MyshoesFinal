<?php

namespace App\Controller;

use App\Entity\Command;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ClientOrdersController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/client/command', name: 'client_command')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        
        $command = $this->em->getRepository(Command::class)->findByIsPaid($this->getUser());
        
        $command = $paginator->paginate(
            $command, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );
        //dd($command);
        return $this->render('account/clientcommand.html.twig', [
            'command' => $command,
        ]);
    }
}
