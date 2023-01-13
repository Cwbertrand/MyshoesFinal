<?php

namespace App\Controller\Admin;

use App\Entity\ShoesCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ShoesCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ShoesCategory::class;
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
