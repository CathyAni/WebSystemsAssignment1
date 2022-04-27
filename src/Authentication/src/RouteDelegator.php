<?php


declare(strict_types=1);

namespace Authentication;

use Authentication\Handler\ConfirmEmailHandler;
use Authentication\Handler\CreateUserHandler;
use Authentication\Handler\ForgotPasswordHandler;
use Authentication\Handler\LoginApiHandler;
use Authentication\Handler\LoginHandler;
use Authentication\Handler\LogoutHandler;
use Mezzio\Csrf\CsrfMiddleware;
use Mezzio\Flash\FlashMessageMiddleware;
use Psr\Container\ContainerInterface;

class RouteDelegator
{
    public function __invoke(ContainerInterface $container, $servicename, callable $callback)
    {
        // retur
        $app = $callback();
        $app->route("/login", [
            CsrfMiddleware::class,
            FlashMessageMiddleware::class,
            LoginHandler::class
        ], ["GET", "POST"], "authentication.login");
        $app->route("/register", [CreateUserHandler::class], ["GET", "POST"], "authentication.create.user");
        $app->route("/forgot-password", [ForgotPasswordHandler::class], ["GET", "POST"], "authentication.forgot.password");
        $app->route("/logout", [LogoutHandler::class], ["GET"], "authentication.logout");
        $app->route("/confirm-password/{code}", [ConfirmEmailHandler::class], ["GET"], "authentication.confirm.email");
        

        // Api 

        $app->route("/api/login", [LoginApiHandler::class], ["POST"]);

        return $app;
    }
}
