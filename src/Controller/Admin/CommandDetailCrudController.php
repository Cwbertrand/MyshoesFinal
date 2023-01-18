<?php

namespace App\Controller\Admin;

use App\Entity\CommandDetail;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandDetailCrudController extends AbstractCrudController
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
        return CommandDetail::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('command.user.Email', 'User Email'),
            TextField::new('command.reference', 'Command reference'),
            IntegerField::new('quantity', 'Quantity'),
            TextField::new('productname', 'Shoe name'),
            TextField::new('productmark', 'Shoe mark')->hideOnIndex(),
            TextField::new('productimage', 'Shoe image')->hideOnIndex(),
            MoneyField::new('commandtotal', 'Total')->setCurrency('EUR'),
            TextareaField::new('productdescription', 'Shoe Description')->hideOnIndex(),
            DateTimeField::new('command.createAt', 'Command date')->hideOnIndex(),
            TextField::new('command.addressname', 'Delivery name')->hideOnIndex(),
            TextField::new('command.addressmobile', 'Mobile')->hideOnIndex(),
            TextField::new('command.addresscompany', 'Company')->hideOnIndex(),
            TextField::new('command.addresscp', 'Postal Code')->hideOnIndex(),
            TextField::new('command.addresscity', 'City')->hideOnIndex(),
            CountryField::new('command.addresscountry', 'Country')->hideOnIndex(),
            TextField::new('command.transportagency', 'Delivery Agency'),
            MoneyField::new('command.transportprice', 'Delivery Cost')->setCurrency('EUR')->hideOnIndex(),
            TextareaField::new('command.description', 'Delivery description')->hideOnIndex(),

        ];
    }
    
}
