<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminCrudController extends AbstractCrudController
{
    use Trait\PasswordHashTrait;

    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
    ) {
    }
    public static function getEntityFqcn(): string
    {
        return Admin::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        $crud->setEntityPermission('ROLE_ADMIN')
        ->setPaginatorPageSize(1)
            ->setEntityLabelInSingular('un administrateur')
            ->showEntityActionsInlined()
            ->setPageTitle('index', 'Profil de l\'administrateur');

        return $crud;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('email'),
            TextField::new('telephone'),
            ChoiceField::new('roles')->allowMultipleChoices()
                ->renderAsBadges([
                    'ROLE_ADMIN' => 'success',
                    'ROLE_USER' => 'warning'
                ])
                ->setChoices([
                    'Administrateur Général' => 'ROLE_ADMIN',
                    'Utilisateur' => 'ROLE_USER'
                ]),
            TextField::new('password')->setFormType(PasswordType::class)->onlyOnForms(),


        ];
    }
    public function configureActions(Actions $actions): Actions
    {

        // if ($this->isGranted('ROLE_USER')){

        $actions
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ->add(Crud::PAGE_EDIT, Action::INDEX)
        ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::DELETE);
        return $actions;
    }
}
