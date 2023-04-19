<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use Symfony\Component\Validator\Constraints\Image;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
                // Set the base path for the uploaded files
                ->setBasePath('upload/')
                //this renames and hashes the images and gets the various extensions (jpg,png)
                ->setUploadedFileNamePattern('[randomhash], [extension]')
                // Set the field as not required    
                ->setRequired(true)
                // Set the form type options, including the file constraint
                ->setFormTypeOptions([
                    'constraints' => [
                        new Image([
                            'mimeTypes' => ['image/jpeg', 'image/png'],
                            'mimeTypesMessage' => 'Please upload a valid JPEG or PNG image',
                            'maxSize' => '5M',
                            'maxSizeMessage' => 'The file is too large ({{ size }} {{ suffix }}). Allowed maximum size is {{ limit }} {{ suffix }}.',
                            'minWidth' => 128,
                            'maxWidth' => 512,
                            'minHeight' => 128,
                            'maxHeight' => 512
                        ])
                    ]
                ]),
            MoneyField::new('price')->setCurrency('EUR'),
            IntegerField::new('promotion')->hideOnIndex(),
            TextareaField::new('description')->hideOnIndex(),
            SlugField::new('slug')->setTargetFieldName('shoesname')->hideOnIndex(),
        ];
    }

}
