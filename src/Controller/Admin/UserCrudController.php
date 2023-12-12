<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Trait\ReadOnlyTrait;
use App\Entity\User;
use App\Service\HospitalService;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserCrudController extends AbstractCrudController
{

    use Trait\PasswordHashTrait;
    use Trait\ReadOnlyTrait;

    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private HospitalService $hospital
    ) {
    }
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('telephone'),
            EmailField::new('email'),
            TextField::new('password')->setFormType(PasswordType::class)->onlyOnForms(),
            AssociationField::new('hospital'),
            AssociationField::new('service'),

        ];
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
            ->setEntityLabelInSingular('un utilisateur')
            ->setPageTitle('index','Tous les utilisateurs')
            
            // ...
        ;
    }
}
