<?php

declare(strict_types=1);

namespace Authentication\Service;

use Authentication\Entity\Role;
use Authentication\Entity\User;
use Authentication\Entity\UserState;
use Laminas\Crypt\Password\Bcrypt;
use General\Service\MailService;
use Doctrine\ORM\EntityManager;
use Mezzio\Helper\UrlHelper;
use General\Service\GeneralService;

class UserService
{

    const USER_ROLE_GUEST = 1;

    const USER_ROLE_CUSTOMER = 10;

    const USER_ROLE_ADMIN = 30;


    const USER_STATE_ENABLED = 1;

    const USER_STATE_DISABLED = 2;

    // const USER




    /**
     * @var EntityManager
     */
    private $entityManager;

   /**
    * @var MailService 
    */
    private $mailService;

    /**
     * @var GeneralService
     */
    private $generalService;
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

    private static function generatetoken(){
        return bin2hex(openssl_random_pseudo_bytes(16));
    }


    public function createDefaultUserasCustomer($data)
    {
        $em = $this->entityManager;
        $userEntity = new User();
        $activationToken = self::generatetoken();
        $userEntity
            ->setEmail($data["email"])
            ->setPassword(self::encryptPassword($data["password"]))
            ->setUsername($data["username"])
            ->setActivationCode($activationToken)
            ->setEmailConfirmed(false)
            ->setStatus($em->find(UserState::class, self::USER_STATE_ENABLED))
            ->setCreatedOn(new \Datetime("now"))
            ->setIsActive(false)
            ;
            $userEntity->addRole($em->find(Role::class, self::USER_ROLE_CUSTOMER));

            $em->persist($userEntity);
            $em->flush();

            $activation_link = $this->generalService->absoluteUrl("authentication.confirm.email", ["code"=>$activationToken]);

            $mailData["to"] = $data["email"];
            $mailData["subject"] = "AIB :: Confirm Email";
            $mailData["params"] = [
                "activation_link"=>$activation_link
                
            ];
            $this->mailService->sendMails($mailData, "authentication_email::confirm_email");
            
            // send email notification 
    }

    /**
     * Set the value of entityManager
     *
     * @return  self
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    /**
     * Set the value of mailService
     *
     * @return  self
     */ 
    public function setMailService($mailService)
    {
        $this->mailService = $mailService;

        return $this;
    }

    /**
     * Set the value of urlHelper
     *
     * @param  UrlHelper  $urlHelper
     *
     * @return  self
     */ 
    public function setUrlHelper(UrlHelper $urlHelper)
    {
        $this->urlHelper = $urlHelper;

        return $this;
    }

    /**
     * Set the value of generalService
     *
     * @param  GeneralService  $generalService
     *
     * @return  self
     */ 
    public function setGeneralService(GeneralService $generalService)
    {
        $this->generalService = $generalService;

        return $this;
    }
}
