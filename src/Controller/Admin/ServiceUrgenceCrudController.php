<?php
namespace App\Controller\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use App\Entity\ServiceUrgence;
use Doctrine\ORM\QueryBuilder;
use App\Service\HospitalService;
use Symfony\Bundle\SecurityBundle\Security;
use App\Repository\ServiceUrgenceRepository;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ServiceUrgenceCrudController extends AbstractCrudController
{
    use Trait\ReadOnlyTrait;

    public function __construct(private Security $security,private ServiceUrgenceRepository $serviceUrgenceRepository,private HospitalService $hospital
    )
    {
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('description'),
            TextField::new('telephone')->setLabel('Téléphone'),
            IntegerField::new('capacite')->setLabel('Capacité'),
            IntegerField::new('lits_occupes')->setLabel('Lits Occupées'),
            IntegerField::new('lits_disponibles'),
            AssociationField::new('hospital'),
            AssociationField::new('equipements')->onlyOnDetail(),
            AssociationField::new('patients')->onlyOnDetail(),
            AssociationField::new('medecins')->onlyOnDetail(),

        ];
    }



    public static function getEntityFqcn(): string
    {
        return ServiceUrgence::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        if ($this->isGranted('ROLE_USER')) {
            $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::INDEX)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
            ->remove(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE);
        return $actions;

        }
        $actions
        ->add(Crud::PAGE_EDIT, Action::INDEX)
        ->add(Crud::PAGE_NEW, Action::INDEX)
        ->add(Crud::PAGE_INDEX,Action::DETAIL);
        return $actions;

    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('un service ')
            ->setPageTitle('index','Tous les services')
            
            // ...
        ;
    }


    // public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    // {

    //     $hospital = $this->hospital->getHospital();
    //     $qb = $this->serviceUrgenceRepository->createQueryBuilder('su')
    //         ->where('su.hospital <> :hospital')
    //         ->setParameter('hospital', $hospital);

    //     return $qb;
    // }

}
