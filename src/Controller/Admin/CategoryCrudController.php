<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController
{
    use Trait\ReadOnlyTrait;

    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        $parentAssociationField = AssociationField::new('parent')
        ->autocomplete()
        ->setLabel('Parent Category')
        ->setFormTypeOptions([
            'required' => false,
            'attr' => ['class' => 'select2'],
        ]);

        return [
            IdField::new('id'),
            TextField::new('name'),
            TextField::new('description'),
            NumberField::new('price'),
            $parentAssociationField,
        ];
    }
    
}
