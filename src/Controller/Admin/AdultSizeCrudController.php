<?php

namespace App\Controller\Admin;

use App\Entity\AdultSize;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdultSizeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdultSize::class;
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
