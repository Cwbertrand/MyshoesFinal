<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('mark'),
            TextField::new('shoesname'),
            AssociationField::new('gendershoes'),
            AssociationField::new('category'),
            AssociationField::new('adultsize'),
            BooleanField::new('status'),
            BooleanField::new('isBest', 'Best promotion'),
            DateTimeField::new('createAt')->hideOnIndex(),
            ImageField::new('image')
                //this is where the images will go to
                ->setUploadDir('public/upload')
                ->setBasePath('upload/')
                //this renames and hashes the images and gets the various extensions (jpg,png)
                ->setUploadedFileNamePattern('[randomhash], [extension]')
                //require is false because...
                ->setRequired(false),
            MoneyField::new('price')->setCurrency('EUR'),
            IntegerField::new('promotion')->hideOnIndex(),
            TextareaField::new('description')->hideOnIndex(),
            SlugField::new('slug')->setTargetFieldName('shoesname')->hideOnIndex(),
        ];
    }
    
}
