<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Admin;
use App\Entity\Hospital;
use Symfony\Bundle\SecurityBundle\Security;

class HospitalService
{
    public function __construct(
        private Security $security,
    ) {
    }
    /**
     * Undocumented function
     *
     * @return null|Hospital
     */
    public function getHospital(): mixed
    {
        /**
         * @var User|Admin $user
         */
        $user =  $this->security->getUser();
        if ($user instanceof User) {
            return $user->getHospital();
        }
        return null;
    }
}
