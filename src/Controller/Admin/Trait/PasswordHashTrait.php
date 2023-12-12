<?php
namespace App\Controller\Admin\Trait;

use App\Entity\User;
use App\Entity\Admin;
use Doctrine\ORM\EntityManagerInterface;

Trait PasswordHashTrait
{

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        /** @var Admin|User $entity*/
        $entity = $entityInstance;
        $plainPassword = $entity->getPassword();
        $hashedPassword = $this->passwordHasher->hashPassword($entity, $plainPassword);

        $entity->setPassword($hashedPassword);

        parent::persistEntity($em, $entityInstance);
    }
    public function updateEntity(EntityManagerInterface $em, $entityInstance):void
    {
        /** @var Admin|user $entity*/
        $entity = $entityInstance;
        $plainPassword = $entity->getPassword();
        $hashedPassword = $this->passwordHasher->hashPassword($entity, $plainPassword);

        $entity->setPassword($hashedPassword);

        parent::persistEntity($em, $entityInstance);
        
    }
}