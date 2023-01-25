<?php

namespace App\Controller\Admin;

use App\Entity\Header;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class HeaderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Header::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('headertitle'),
            TextField::new('headerurl'),
            BooleanField::new('isPublish'),
            ImageField::new('headerimage')
                //this is where the images will go to
                ->setUploadDir('public/HeaderImage')
                ->setBasePath('HeaderImage/')
                //this renames and hashes the images and gets the various extensions (jpg,png)
                ->setUploadedFileNamePattern('[randomhash], [extension]')
                //require is false because...
                ->setRequired(false),
            TextField::new('headerbtn'),
            TextareaField::new('headertext'),
        ];
    }
    
}
