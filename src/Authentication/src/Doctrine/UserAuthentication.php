<?php

declare(strict_types=1);

namespace Authentication\Doctrine;

use Authentication\Entity\User;

class UserAuthentication
{
    /**
     * @param User $user
     * @param $inputPassword
     * @return bool
     */
    public static function verifyCredential(User $user, $inputPassword): bool
    {
        return password_verify($inputPassword, $user->getPassword());
    }
}
