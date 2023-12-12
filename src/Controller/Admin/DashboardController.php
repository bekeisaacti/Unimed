<?php

namespace App\Controller\Admin;

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
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
    }

    #[Route('/admin', name: 'admin_index')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $url = $this->adminUrlGenerator->setController(ReferencementCrudController::class)->generateUrl();
        return $this->redirect($url);

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<span class="p-2 rounded-1 text-capitalize  text-bg-info ">UniMed-Admin</span>');
    }

    public function configureMenuItems(): iterable
    {

        $user = $this->getUser();
        if (in_array('ROLE_ADMIN', $user->getRoles())){
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-house-medical');

            yield MenuItem::linkToCrud('Administrateurs', 'fas fa-laptop-medical', Admin::class);
            yield MenuItem::subMenu('Hôpitaux ', 'fa fa-hospital')->setSubItems([
                MenuItem::linkToCrud('Voir tout', 'fa fa-eye', Hospital::class),
                MenuItem::linkToCrud('Ajouter', 'fa fa-plus', Hospital::class)->setAction(Crud::PAGE_NEW)
            ]);
            yield MenuItem::subMenu('Services d\'urgence', 'fa fa-stethoscope')->setSubItems([
                MenuItem::linkToCrud('voir', 'fa fa-eye', ServiceUrgence::class),
                MenuItem::linkToCrud('Ajouter', 'fa fa-plus', ServiceUrgence::class)->setAction(Crud::PAGE_NEW),
            ]);

            yield MenuItem::subMenu('Utilisateurs', 'fa-solid fa-hospital-user')->setSubItems([
                MenuItem::linkToCrud('Voir tout', 'fa fa-eye', User::class),
                MenuItem::linkToCrud('Ajouter', 'fa fa-plus', User::class)->setAction(Crud::PAGE_NEW)
            ]);
            yield MenuItem::linkToCrud('Medecins', 'fa fa-user-doctor',Medecin::class);

            yield MenuItem::linkToCrud('Rapports patients', 'fas fa-file-medical', Patient::class);
            yield MenuItem::linkToCrud('Transferts', 'fa fa-truck-medical', Referencement::class);
            yield MenuItem::linkToCrud('Spécialités médicales', 'fa-solid fa-notes-medical', SpecialteMedicale::class);
            yield MenuItem::linkToCrud('Equipements', 'fas fa-suitcase-medical', Equipement::class);

        }
    elseif (in_array('ROLE_USER', $user->getRoles())){
        
   
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
                MenuItem::linkToCrud('Faire une demande', 'fa fa-plus', Referencement::class)->setAction(Crud::PAGE_NEW)
            ]);
            yield MenuItem::subMenu('Spécialités médicales', 'fa-solid fa-notes-medical')->setSubItems([
                MenuItem::linkToCrud('Voir tout', 'fa fa-eye', SpecialteMedicale::class),
                MenuItem::linkToCrud('Ajouter', 'fa fa-plus', SpecialteMedicale::class)->setAction(Crud::PAGE_NEW)
            ]);
            yield MenuItem::subMenu('Equipements', 'fas fa-suitcase-medical')->setSubItems([
                MenuItem::linkToCrud('Voir tout', 'fa fa-eye', Equipement::class),
                MenuItem::linkToCrud('Ajouter', 'fa fa-plus', Equipement::class)->setAction(Crud::PAGE_NEW)
            ]);


    }
    

        yield MenuItem::linkToLogout('Déconnexion', 'fa fa-fw fa-sign-out');
        
    }
}
