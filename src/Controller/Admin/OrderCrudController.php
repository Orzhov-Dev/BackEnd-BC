<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $articlesAssociationField = AssociationField::new('articles')
        ->autocomplete()
        ->setLabel('Articles List')
        ->setFormTypeOptions([
            'required' => false,
            'attr' => ['class' => 'select2'],
        ]);

        return [
            IdField::new('id'),
            TextField::new('status'),
            $articlesAssociationField,
            MoneyField::new('totalPaid')->setCurrency('EUR'),
        ];
    }
    
}
