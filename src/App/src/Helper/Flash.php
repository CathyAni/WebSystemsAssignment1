<?php 
declare(strict_types=1);
namespace App\Helper;

use Laminas\View\Helper\AbstractHelper;
use Mezzio\Flash\FlashMessages;
use Mezzio\Session\Session;

class Flash extends AbstractHelper{

    public function __invoke(){
        $sessionStatus  = session_status() === PHP_SESSION_ACTIVE ? $_SESSION : [];
        return FlashMessages::createFromSession(
            new Session($sessionStatus)
        )->getFlashes();
    }

}