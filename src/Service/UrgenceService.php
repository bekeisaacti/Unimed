<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\ServiceUrgence;
use Symfony\Bundle\SecurityBundle\Security;

class UrgenceService
{
    public function __construct(
        private Security $security,
    ) {
    }
    /**
     * Undocumented function
     *
     * @return null|ServiceUrgence
     */
    public function getService(): mixed
    {
        /**
         * @var User $user
         */
        $user =  $this->security->getUser();
        if ($user instanceof User) {
            return $user->getService();
        }
        return null;
    }
}
