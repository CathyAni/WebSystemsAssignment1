<?php

declare(strict_types=1);

namespace Authentication\Adapter;

use Doctrine\ORM\EntityManager;
use Mezzio\Authentication\UserInterface;
use Mezzio\Authentication\UserRepositoryInterface;
use Authentication\Service\UserService;
use Authentication\Entity\User;
use Exception;
use Laminas\Permissions\Rbac\RoleInterface;

class AuthenticationAdapter implements UserRepositoryInterface{

    private const METHOD_NOT_EXISTS = "Method %s not found in %s .";
    private const OPTION_VALUE_NOT_PROVIDED = "Option '%s' not provided for '%s' option.";

    private ?string $identity = null;

    private ?string $credential = null;

    private EntityManager $entityManager;

    private array $config = [];

   

      /**
     * @var EntityManager
     */
    private $em;

    

    private $userFactory;

    public function __construct(
        EntityManager $em,
        array $config,
        callable $userFactory
    ) {
        $this->em     = $em;
        $this->config = $config;

        // Provide type safety for the composed user factory.
        $this->userFactory = static function (
            string $identity,
            array $roles = [],
            array $details = []
        ) use ($userFactory): UserInterface {
            return $userFactory($identity, $roles, $details);
        };
    }


    // public function __construct(EntityManager $em, array $config)
    // {
    //     $this->entityManager = $em;
    //     $this->config = $config;
    // }

     
    /**
     * @param string $identity
     * @return $this
     */
    public function setIdentity(string $identity): self
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * @param string $credential
     * @return $this
     */
    public function setCredential(string $credential): self
    {
        $this->credential = $credential;
        return $this;
    }

    /**
     * @return string
     */
    private function getIdentity(): string
    {
        return $this->identity;
    }

    /**
     * @return string
     */
    private function getCredential(): string
    {
        return $this->credential;
    }

    public function authenticate(string $credential, ?string $password = null): ?UserInterface
    {
        if($password === null){
            throw new \Exception("No or invalid param 'identity_class' provided.");
        }
        $users = $this->em->createQueryBuilder()
            ->select(["s", 'r', "st", "at"])->from(User::class, "s")
            ->leftJoin("s.roles", "r")
            ->leftJoin("s.status", "st")
            ->leftJoin("s.authType", "at")
            ->where("c.username = :username")
            ->orWhere("c.email = :email")
            ->setParameters([
                "username" => $credential,
                "email"=>$credential,
            ])->getQuery()->getResult();

        if ($users ===  null || count($users) == 0) {
            throw new \Exception("Invalid Credentials");
        }

        /**
         * @var User
         */
        $user = $users[0];
         // check if user is enabled
        if($user->getStatus()->getStatus() < 2){
            throw new \Exception("Your account is not active, please contact administrator");
        }
        
        // check if user has confirmed password
        if(! $user->getEmailConfirmed()){
            throw new Exception("You need to confirm your email ");
        }
        
        if (UserService::verifyHashedPassword($password, $user->getPassword()))
         {
            return ($this->userFactory)(
                $credential,
                array_map(function (RoleInterface $role): string {
                    return $role->getName();
                }, $user->getRoles()->toArray()),
                $user->getDetails()
            );
            // return $user;
        }else{
           
            return null;
        }
    }

    // public function authenticate()
    // {
    //     $this->validateConfig();

    //     $repository = $this->entityManager->getRepository($this->config['orm_default']['identity_class']);
    //     $identityClass = $repository->findOneBy([
    //         $this->config['orm_default']['identity_property'] => $this->getIdentity()
    //     ]);

    //     if (null === $identityClass) {
    //         return new Result(
    //             Result::FAILURE_IDENTITY_NOT_FOUND,
    //             null,
    //             [$this->config['orm_default']['messages']['not_found']]
    //         );
    //     }



    //     $getCredential = "get" . ucfirst($this->config['orm_default']['credential_property']);

    //     /** Check if get credential method exist in the provided identity class */
    //     $this->checkMethod($identityClass, $getCredential);

    //     /** If passwords don't match, return failure response */
    //     if (false === password_verify($this->getCredential(), $identityClass->$getCredential())) {
    //         return new Result(
    //             Result::FAILURE_CREDENTIAL_INVALID,
    //             null,
    //             [$this->config['orm_default']['messages']['invalid_credential']]
    //         );
    //     }


    // }


     /**
     * @throws Exception
     */
    private function validateConfig()
    {
        if (
            ! isset($this->config['orm_default']['identity_class']) ||
            ! class_exists($this->config['orm_default']['identity_class'])
        ) {
            throw new \Exception("No or invalid param 'identity_class' provided.");
        }

        if (! isset($this->config['orm_default']['identity_property'])) {
            throw new \Exception("No or invalid param 'identity_class' provided.");
        }

        if (! isset($this->config['orm_default']['credential_property'])) {
            throw new \Exception("No or invalid param 'credential_property' provided.");
        }

        if (empty($this->identity) || empty($this->credential)) {
            throw new \Exception('No credentials provided.');
        }
    }

    /**
     * @param $identityClass
     * @param string $methodName
     * @throws Exception
     */
    private function checkMethod($identityClass, string $methodName): void
    {
        if (! method_exists($identityClass, $methodName)) {
            throw new \Exception(sprintf(
                self::METHOD_NOT_EXISTS,
                $methodName,
                get_class($identityClass)
            ));
        }
    }

}