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
    private $paginator;

    public function __construct(EntityManagerInterface $em, PaginatorInterface $paginator)
    {
        $this->em = $em;
        $this->paginator = $paginator;
    }

    #[Route('/client/command', name: 'client_command')]
    public function index(Request $request): Response
    {
        //this gets the orders that are successfully paid only. The findByIsPaid() is created in the repository
        $command = $this->em->getRepository(Command::class)->findByIsPaid($this->getUser());
        
        // $command = $this->paginator->paginate(
        //     $command, /* query NOT result */
        //     $request->query->getInt('page', 1)/*page number*/,
        //     2/*limit per page*/
        //);
        return $this->render('account/clientcommand.html.twig', [
            'command' => $command,
        ]);
    }

    #[Route('/client/command/in/details/{reference}', name: 'details_command')]
    public function CommandDetails($reference): Response
    {
        //This get the command that is referenced to this particular command
        $commanddetail = $this->em->getRepository(Command::class)->findOneByReference($reference);

        return $this->render('account/clientDetailCommand.html.twig', [
            'commanddetails' => $commanddetail,
        ]);
    }

}
