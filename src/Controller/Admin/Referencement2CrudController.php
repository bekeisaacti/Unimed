<?php

namespace App\Controller\Admin;
use App\Repository\ReferencementRepository;
use App\Entity\Referencement;
use App\Service\HospitalService;
use Doctrine\ORM\Query\FilterCollection;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bundle\SecurityBundle\Security;

class Referencement2CrudController extends AbstractCrudController
{
    public function __construct(private Security $security,private ReferencementRepository $referencementRepository,private HospitalService $hospital
    )
    {
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
            
            DateTimeField::new('date_ref')->onlyOnDetail(),

        ];
    }

   
}
