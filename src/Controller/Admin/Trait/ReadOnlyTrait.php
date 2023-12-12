<?php

namespace App\Controller\Admin\Trait;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

Trait ReadOnlyTrait
{
    public function configureActions(Actions $actions): Actions
    {
        
        if ($this->isGranted('ROLE_USER')){
        
            $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT,Action::INDEX)
            ->remove(Crud::PAGE_INDEX,Action::NEW) 
            ->remove(Crud::PAGE_INDEX,Action::DELETE)
            ->remove(Crud::PAGE_INDEX,Action::EDIT)
            ->remove(Crud::PAGE_DETAIL,Action::EDIT)
            ->remove(Crud::PAGE_DETAIL,Action::DELETE);

            
        }
        return $actions;
        
        
    }
}