<?php

namespace App\Controller\Admin;

use App\Entity\Command;
use App\Controller\CommandController;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\HttpFoundation\RedirectResponse;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandCrudController extends AbstractCrudController
{
    private $em;
    private $adminUrlGenerator;

    public function __construct(EntityManagerInterface $em, AdminUrlGenerator $adminUrlGenerator)
    {
        $this->em = $em;
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    //this allows you to configure the admin actions you wish to add or remove like edit, voir, supprimer, etc.
    public function configureActions(Actions $actions): Actions
    {
        //adding the delivery status actions at the show page in the admin page of 'command'
        $notpaid = Action::new('notpaid', 'Not paid')->linkToCrudAction('notpaid');
        $ordervalidate = Action::new('ordervalidate', 'Order Validated')->linkToCrudAction('ordervalidate');
        $preparingorder = Action::new('preparingorder', 'Preparing Order')->linkToCrudAction('preparingorder');
        $deliveryinprogress = Action::new('deliveryinprogress', 'Delivery in progress')->linkToCrudAction('deliveryinprogress');
        $delivered = Action::new('delivered', 'delivered')->linkToCrudAction('delivered');

        return $actions
            ->add('detail', $notpaid)
            ->add('detail', $ordervalidate)
            ->add('detail', $preparingorder)
            ->add('detail', $deliveryinprogress)
            ->add('detail', $delivered)
            ->add('index', 'detail');
    }

    //Not paid function
    public function notPaid(AdminContext $context): RedirectResponse
    {
        $command = $context->getEntity()->getInstance();
        $command->setDeliverystatus(0);
        $this->em->flush();

        // $this->addFlash('notice', "<span style='color:gren; background:white'>The command; 
        // <strong>".$command->getReference()." has been updated</strong></span>");

        //generating the url after submiting the form
        // the URL builder provides shortcuts for the most common parameters
        $url = $this->adminUrlGenerator
            ->setController(CommandCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }

    //order validated function
    public function orderValidate(AdminContext $context): RedirectResponse
    {
        $command = $context->getEntity()->getInstance();
        $command->setDeliverystatus(1);
        $this->em->flush();

        //generating the url after submiting the form
        // the URL builder provides shortcuts for the most common parameters
        $url = $this->adminUrlGenerator
            ->setController(CommandCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }

    //preparing order function
    public function preparingorder(AdminContext $context): RedirectResponse
    {
        $command = $context->getEntity()->getInstance();
        $command->setDeliverystatus(2);
        $this->em->flush();

        //generating the url after submiting the form
        // the URL builder provides shortcuts for the most common parameters
        $url = $this->adminUrlGenerator
            ->setController(CommandCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }

    //delivery in progress function
    public function deliveryinprogress(AdminContext $context): RedirectResponse
    {
        $command = $context->getEntity()->getInstance();
        $command->setDeliverystatus(3);
        $this->em->flush();

        //generating the url after submiting the form
        // the URL builder provides shortcuts for the most common parameters
        $url = $this->adminUrlGenerator
            ->setController(CommandCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }

    //delivery in progress function
    public function delivered(AdminContext $context): RedirectResponse
    {
        $command = $context->getEntity()->getInstance();
        $command->setDeliverystatus(4);
        $this->em->flush();

        //generating the url after submiting the form
        // the URL builder provides shortcuts for the most common parameters
        $url = $this->adminUrlGenerator
            ->setController(CommandCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureCrud(Crud $crud): Crud
    {
        
        return $crud->setDefaultSort(['id' => 'DESC']);
    }


    public static function getEntityFqcn(): string
    {
        return Command::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('user.Email', 'User email'),
            TextField::new('reference'),
            BooleanField::new('ispaid', 'Unpaid/Paid'),
            ChoiceField::new('deliverystatus', 'Delivery status')->setChoices([
                'Not paid' => 0,
                'Order Validated' => 1,
                'Preparing Order' => 2,
                'Delivery in progress' => 3,
                'Delivered' => 4
            ]),
            DateTimeField::new('createAt', 'Command date')->hideOnIndex(),
            ArrayField::new('commandDetails', 'Shoes name'),
        ];
    }
    
}
