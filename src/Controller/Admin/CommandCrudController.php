<?php

namespace App\Controller\Admin;

use App\Entity\Command;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class CommandCrudController extends AbstractCrudController
{

    //this allows you to configure the admin actions you wish to add or remove like edit, voir, supprimer, etc.
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add('index', 'detail');
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
            BooleanField::new('ispaid', 'Paid/Unpaid'),
            DateTimeField::new('createAt', 'Command date')->hideOnIndex(),
            ArrayField::new('commandDetails', 'Shoes name'),
        ];
    }
    
}
