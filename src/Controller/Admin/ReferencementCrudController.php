<?php

namespace App\Controller\Admin;

use DateTimeImmutable;
use App\Entity\Referencement;
use App\Service\UrgenceService;
use App\Service\HospitalService;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReferencementCrudController extends AbstractCrudController
{

    public function __construct(
        private HospitalService $hospital,
        private UrgenceService $service
    ) {
    }
    public static function getEntityFqcn(): string
    {
        return Referencement::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('hospital_origine')->hideOnForm(),
            AssociationField::new('hospital_destination'),
            AssociationField::new('service_origine')->hideOnForm(),
            AssociationField::new('service_destination'),
            AssociationField::new('patient'),
            AssociationField::new('medecin_referent'),
            TextField::new('raisons'),
            TextField::new('remarques'),
            TextField::new('status')->hideOnForm()->setCssClass('warning'),
            BooleanField::new('valider'),

            DateTimeField::new('date_ref')->onlyOnDetail()

        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        /** @var Referencement $entity*/
        $entity = $entityInstance;
        $entity->setStatus('Pending');
        $entity->setServiceOrigine($this->service->getService());
        $entity->setHospitalOrigine($this->hospital->getHospital());
        $entity->setDateRef(new DateTimeImmutable());
        parent::persistEntity($em, $entityInstance);
    }

    public function configureActions(Actions $actions): Actions
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $actions
                ->remove(Crud::PAGE_INDEX, Action::EDIT)
                ->remove(Crud::PAGE_INDEX, Action::NEW)
                ->add(Crud::PAGE_INDEX, Action::DETAIL)
                ->remove(Crud::PAGE_INDEX, Action::DELETE);
            return $actions;
        }
        $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_NEW, Action::INDEX)
            ->add(Crud::PAGE_EDIT, Action::INDEX);
        return $actions;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un transfert ')
            ->setPageTitle('index', 'Tous les transferts')

            // ...
        ;
    }
    
}
