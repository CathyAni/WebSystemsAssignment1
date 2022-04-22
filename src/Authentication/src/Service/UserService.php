<?php
declare(strict_types=1);
namespace Authentication\Service;

use Laminas\Crypt\Password\Bcrypt;

class UserService{
 /**
     * Static function for checking hashed password (as required by Doctrine)
     *
     * @param CsnUser\Entity\User $user
     *            The identity object
     * @param string $password
     *            Password provided to be verified
     * @return boolean true if the password was correct, else, returns false
     */
    public static function verifyHashedPassword($password, $passwordhash)
    {
        $bcrypt = new Bcrypt(array(
            'cost' => 10
        ));
        return $bcrypt->verify($password, $passwordhash);
    }

    /**
     * Encrypt Password
     *
     * Creates a Bcrypt password hash
     *
     * @return String
     */
    public static function encryptPassword($password)
    {
        $bcrypt = new Bcrypt(array(
            'cost' => 10
        ));
        return $bcrypt->create($password);
    }


    public function createuser(){
        
    }


}