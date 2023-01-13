<?php

namespace App\Controller\Admin;

use App\Entity\ShoesGender;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ShoesGenderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ShoesGender::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
