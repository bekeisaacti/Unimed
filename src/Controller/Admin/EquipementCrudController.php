<?php

namespace App\Controller\Admin;

use App\Entity\Equipement;
use App\Service\UrgenceService;
use App\Service\HospitalService;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EquipementCrudController extends AbstractCrudController
{
    public function __construct(
        private HospitalService $hospital,
        private UrgenceService $service
        )
        {
    
        }
    public static function getEntityFqcn(): string
    {
        return Equipement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Nom'),
            BooleanField::new('est_disponible'),
            AssociationField::new('hospital'),
            AssociationField::new('service'),
            IntegerField::new('quantite')->setLabel('Quantité'),
            IntegerField::new('disponible')
        ];
    }
    
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        /** @var Equipement $entity*/
        $entity = $entityInstance;
        $entity->setService($this->service->getService());
        $entity->setHospital($this->hospital->getHospital());
        parent::persistEntity($em, $entityInstance);
    }

    public function configureActions(Actions $actions): Actions
    {
        if ($this->isGranted('ROLE_ADMIN')){
            $actions
            ->remove(Crud::PAGE_INDEX,Action::EDIT)
            ->remove(Crud::PAGE_INDEX,Action::NEW)
            ->add(Crud::PAGE_INDEX,Action::DETAIL)
            ->remove(Crud::PAGE_INDEX,Action::DELETE);
            return $actions;

        }
        $actions
        ->add(Crud::PAGE_INDEX,Action::DETAIL)
        ->add(Crud::PAGE_NEW,Action::INDEX)
        ->add(Crud::PAGE_EDIT,Action::INDEX);
        return $actions;
    }

    public function configureCrud(Crud $crud): Crud
    {
      
        return $crud
            ->setEntityLabelInSingular('un équipement')
            ->setPageTitle('index','Tous les équipements')
            
            // ...
        ;
    }

}
