<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Trait\ReadOnlyTrait;
use App\Entity\Hospital;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
// use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HospitalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hospital::class;
    }
    // public function configureCrud(Crud $crud): Crud
    // {
    //     $crud->setEntityPermission('ROLE_ADMIN');
    //     return $crud;
    // }





    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('adresse'),
            TextField::new('telephone'),
            EmailField::new('email'),
            TextField::new('localisation'),
            CollectionField::new('serviceUrgences')->onlyOnDetail(),
            CollectionField::new('equipements')->onlyOnDetail(),
            CollectionField::new('medecins')->onlyOnDetail(),
            CollectionField::new('patients')->onlyOnDetail(),
            CollectionField::new('users')->onlyOnDetail(),
            AssociationField::new('referencements')->onlyOnDetail(),
            CollectionField::new('specialteMedicales')->onlyOnDetail(),
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un hôpital ')
            ->setPageTitle('index','Tous les hôpitaux')
            
            // ...
        ;
    }
    public function configureActions(Actions $actions): Actions
    {
        
        if ($this->isGranted('ROLE_ADMIN')){
        
            $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::INDEX)
            ->add(Crud::PAGE_NEW, Action::INDEX);
            return $actions;

            
        }
        $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT,Action::INDEX)
            ->remove(Crud::PAGE_INDEX,Action::NEW) 
            ->remove(Crud::PAGE_INDEX,Action::DELETE)
            ->remove(Crud::PAGE_INDEX,Action::EDIT)
            ->remove(Crud::PAGE_DETAIL,Action::EDIT)
            ->remove(Crud::PAGE_DETAIL,Action::DELETE);
        return $actions;

        
        
    }
    

}
