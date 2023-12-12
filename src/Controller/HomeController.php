<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Admin;
use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\Hospital;
use App\Entity\Equipement;
use App\Entity\Referencement;
use App\Entity\ServiceUrgence;
use App\Entity\SpecialteMedicale;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;


class HomeController extends AbstractDashboardController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<span class="p-2 rounded-1 text-capitalize  text-bg-info ">UniMed-Admin</span>');
    }

    public function configureMenuItems(): iterable
    {
        {
            $user = $this->getUser();
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-house-medical');

            
            yield MenuItem::linkToCrud('Hôpitaux', 'fa fa-hospital', Hospital::class);
            yield MenuItem::subMenu('Services D\'Urgence', 'fa fa-stethoscope')->setSubItems([
                MenuItem::linkToCrud('voir', 'fa fa-eye', ServiceUrgence::class),
                MenuItem::linkToCrud('Modifier', 'fa fa-plus', ServiceUrgence::class)->setAction(Crud::PAGE_EDIT)->setPermission('ROLE_USER')->setEntityId($user->getService()->getId()),
            ]);
    
            yield MenuItem::subMenu('Utilisateurs', 'fa-solid fa-hospital-user')->setSubItems([
                MenuItem::linkToCrud('Voir tout', 'fa fa-eye', User::class),
                MenuItem::linkToCrud('Modifier', 'fa fa-plus', User::class)->setAction(Crud::PAGE_EDIT)->setEntityId($user->getId())
            ]);
            yield MenuItem::subMenu('Medecins', 'fa fa-user-doctor')->setSubItems([
                MenuItem::linkToCrud('Voir tout', 'fa fa-eye', Medecin::class),
                MenuItem::linkToCrud('Ajouter', 'fa fa-plus', Medecin::class)->setAction(Crud::PAGE_NEW)
            ]);

            yield MenuItem::subMenu('Rapports patients', 'fas fa-file-medical')->setSubItems([
                MenuItem::linkToCrud('Voir tout', 'fa fa-eye', Patient::class),
                MenuItem::linkToCrud('Ajouter', 'fa fa-plus', Patient::class)->setAction(Crud::PAGE_NEW)
            ]);
            yield MenuItem::subMenu('Transferts', 'fa fa-truck-medical')->setSubItems([
                MenuItem::linkToCrud('Voir tout', 'fa fa-eye', Referencement::class),
                MenuItem::linkToCrud('Ajouter', 'fa fa-plus', Referencement::class)->setAction(Crud::PAGE_NEW)
            ]);
            yield MenuItem::subMenu('Spécialités Médicales', 'fa-solid fa-notes-medical')->setSubItems([
                MenuItem::linkToCrud('Voir tout', 'fa fa-eye', SpecialteMedicale::class),
                MenuItem::linkToCrud('Ajouter', 'fa fa-plus', SpecialteMedicale::class)->setAction(Crud::PAGE_NEW)
            ]);
            yield MenuItem::subMenu('Equipements', 'fas fa-suitcase-medical')->setSubItems([
                MenuItem::linkToCrud('Voir tout', 'fa fa-eye', Equipement::class),
                MenuItem::linkToCrud('Ajouter', 'fa fa-plus', Equipement::class)->setAction(Crud::PAGE_NEW)
            ]);
            yield MenuItem::linkToLogout('Déconnexion', 'fa fa-fw fa-sign-out');
    
        }}

}
